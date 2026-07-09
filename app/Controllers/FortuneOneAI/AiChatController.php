<?php

namespace App\Controllers\FortuneOneAI;
use App\Controllers\BaseController;

class AiChatController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function sendMessage()
    {
        if (function_exists('ini_set')) {
            ini_set('zlib.output_compression', 'Off');
            ini_set('output_buffering', 'Off');
        }
        if (function_exists('apache_setenv')) {
            apache_setenv('no-gzip', '1');
        }

        $request = \Config\Services::request();
        $apiKey  = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return $this->response->setJSON(['error' => 'API key not configured'])->setStatusCode(500);
        }

        // -------------------------------------------------------
        // RATE LIMITING — max 1 request per 4 seconds per session
        // -------------------------------------------------------
        $session          = session();
        $lastRequestTime  = $session->get('last_ai_request');

        if ($lastRequestTime && (time() - $lastRequestTime) < 4) {
            // Return as SSE so the frontend chat stream handles it cleanly
            while (ob_get_level() > 0) ob_end_clean();
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');
            header('X-Accel-Buffering: no');
            echo "data: " . json_encode([
                'candidates' => [[
                    'content' => ['parts' => [['text' => 'Please wait a moment before sending another message.']]]
                ]]
            ]) . "\n\n";
            flush();
            exit;
        }

        $session->set('last_ai_request', time());


        $json = $request->getJSON();
        if (!$json || !isset($json->messages)) {
            return $this->response->setJSON(['error' => 'Invalid request payload'])->setStatusCode(400);
        }

        $frontendMessages = $json->messages;

        // Keep only last 10 messages for context continuity
        if (count($frontendMessages) > 10) {
            $frontendMessages = array_slice($frontendMessages, -10);
        }

        $latestMsg  = end($frontendMessages);
        $userQuery  = $latestMsg->content ?? '';
        $userQueryL = strtolower($userQuery);

        $mode       = isset($json->mode) ? $json->mode : 'text';
        $sessionId  = isset($json->session_id) ? $json->session_id : session_id();

        // -------------------------------------------------------
        // LOG USER MESSAGE
        // -------------------------------------------------------
        if (!empty($userQuery)) {
            $this->logConversation($sessionId, 'user', $userQuery);
        }

        // -------------------------------------------------------
        // LOAD SYSTEM PROMPT
        // -------------------------------------------------------
        $promptPath   = ($mode === 'voice')
            ? FCPATH . '../ai_voice_system_prompt.md'
            : FCPATH . '../ai_system_prompt.md';

        $systemPrompt = "You are a helpful property advisor.";
        if (file_exists($promptPath)) {
            $systemPrompt = file_get_contents($promptPath);
        }

        // -------------------------------------------------------
        // STEP 1: DETECT INTENT
        // -------------------------------------------------------
        $intent = $this->detectIntent($userQueryL);

        // -------------------------------------------------------
        // STEP 2: FETCH RELEVANT DATABASE CONTEXT
        // -------------------------------------------------------
        $dbContext = $this->buildDatabaseContext($intent, $userQueryL, $sessionId);

        // -------------------------------------------------------
        // STEP 3: INJECT DB CONTEXT INTO SYSTEM PROMPT
        // -------------------------------------------------------
        if (!empty($dbContext)) {
            $systemPrompt .= "\n\n--- DATABASE CONTEXT (Source of Truth) ---\n";
            $systemPrompt .= "Use ONLY the following verified data. Do not invent or assume any facts.\n\n";
            $systemPrompt .= $dbContext;
        }

        // -------------------------------------------------------
        // STEP 4: PREPARE GEMINI API PAYLOAD
        // -------------------------------------------------------
        $contents = [];
        foreach ($frontendMessages as $msg) {
            $role       = ($msg->role === 'assistant') ? 'model' : 'user';
            $contents[] = [
                'role'  => $role,
                'parts' => [['text' => $msg->content]],
            ];
        }

        $payload = [
            'systemInstruction' => [
                'parts' => [['text' => $systemPrompt]],
            ],
            'contents'          => $contents,
            'generationConfig'  => [
                'temperature'     => 0.7,
                'topK'            => 40,
                'topP'            => 0.95,
                'maxOutputTokens' => 350,
            ],
        ];

        // -------------------------------------------------------
        // STEP 5: STREAM FROM GEMINI
        // -------------------------------------------------------
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite:streamGenerateContent?alt=sse&key=' . $apiKey;

        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('X-Accel-Buffering: no');

        // Flush 2KB of padding immediately. Mobile browsers (especially iOS Safari) 
        // often buffer the first 1-2KB of an SSE stream before releasing it to the JavaScript reader.
        echo str_repeat(": padding \n", 200) . "\n\n";
        flush();

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $rawResponse = '';
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($curl, $data) use (&$rawResponse) {
            $rawResponse .= $data;
            echo $data;
            flush();
            return strlen($data);
        });

        curl_exec($ch);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            echo "event: error\ndata: " . json_encode(['error' => 'Connection to AI failed: ' . $curlError]) . "\n\n";
            flush();
        } else {
            // -------------------------------------------------------
            // LOG ASSISTANT MESSAGE
            // -------------------------------------------------------
            $assistantMessage = '';
            $lines = explode("\n", $rawResponse);
            foreach ($lines as $line) {
                if (strpos($line, 'data: ') === 0) {
                    $jsonStr = substr($line, 6);
                    $decoded = json_decode($jsonStr, true);
                    if ($decoded && isset($decoded['candidates'][0]['content']['parts'])) {
                        foreach ($decoded['candidates'][0]['content']['parts'] as $part) {
                            if (isset($part['text'])) {
                                $assistantMessage .= $part['text'];
                            }
                        }
                    }
                }
            }
            $this->logConversation($sessionId, 'assistant', $assistantMessage);
        }

        exit;
    }

    // -------------------------------------------------------
    // INTENT DETECTION
    // -------------------------------------------------------
    private function detectIntent(string $query): array
    {
        $intent = [];

        // Contact / Company info
        if (preg_match('/phone|email|contact|reach|call|whatsapp|website|office/i', $query)) {
            $intent[] = 'company';
        }

        // Pricing
        if (preg_match('/price|pricing|cost|rate|budget|lakh|crore|₹|rs\.|rupee/i', $query)) {
            $intent[] = 'pricing';
        }

        // Amenities
        if (preg_match('/ameniti|facilit|clubhouse|pool|gym|park|feature|offer|include/i', $query)) {
            $intent[] = 'amenities';
        }

        // Location
        if (preg_match('/locat|nandi|hesaragatta|devanahalli|chikkaballa|where|far|distance|km|airport|bengaluru|bangalore/i', $query)) {
            $intent[] = 'location';
        }

        // Project comparison
        if (preg_match('/compar|vs|versus|difference|better|which|both|two project/i', $query)) {
            $intent[] = 'compare';
        }

        // Specific projects
        if (preg_match('/eshavana|esha vana|farm\s?land/i', $query)) {
            $intent[] = 'project_eshavana';
        }
        if (preg_match('/vistaa|vista|villa\s?plot|nandi\s?hills/i', $query)) {
            $intent[] = 'project_vistaa';
        }

        // General project info (if no specific one found)
        if (empty($intent) || count(array_intersect(['project_eshavana', 'project_vistaa', 'compare'], $intent)) === 0) {
            if (preg_match('/project|property|invest|plot|land|opportunit|option|available/i', $query)) {
                $intent[] = 'projects_overview';
            }
        }

        // Booking / Visit
        if (preg_match('/visit|site\s?visit|appointment|book|schedule|meet|advisor|consultant|call\s?back/i', $query)) {
            $intent[] = 'booking';
        }

        // If nothing matched, inject overview
        if (empty($intent)) {
            $intent[] = 'overview';
        }

        return $intent;
    }

    // -------------------------------------------------------
    // BUILD DATABASE CONTEXT STRING
    // -------------------------------------------------------
    private function buildDatabaseContext(array $intent, string $query, string $sessionId): string
    {
        $parts = [];

        // --- COMPANY INFO ---
        if (in_array('company', $intent) || in_array('overview', $intent)) {
            $rows = $this->db->query("SELECT setting_key, setting_value FROM company_settings ORDER BY id")->getResultArray();
            if ($rows) {
                $info = [];
                foreach ($rows as $row) {
                    $info[] = ucfirst(str_replace('_', ' ', $row['setting_key'])) . ': ' . $row['setting_value'];
                }
                $parts[] = "## Company Information\n" . implode("\n", $info);
            }
        }

        // --- ESHAVANA PROJECT ---
        if (in_array('project_eshavana', $intent) || in_array('compare', $intent) || in_array('projects_overview', $intent)) {
            $parts[] = $this->buildProjectContext(1, in_array('amenities', $intent));
        }

        // --- VISTAA PROJECT ---
        if (in_array('project_vistaa', $intent) || in_array('compare', $intent) || in_array('projects_overview', $intent)) {
            $parts[] = $this->buildProjectContext(2, in_array('amenities', $intent));
        }

        // --- PRICING (force amenities + features into project context) ---
        if (in_array('pricing', $intent)) {
            $rows = $this->db->query("SELECT name, project_type, starting_price, max_price, plot_sizes, status FROM projects WHERE starting_price IS NOT NULL ORDER BY id")->getResultArray();
            if ($rows) {
                $priceLines = [];
                foreach ($rows as $r) {
                    $price = '₹' . number_format($r['starting_price'] / 100000, 0) . ' Lakhs onwards';
                    if ($r['max_price']) {
                        $price .= ' – ₹' . number_format($r['max_price'] / 100000, 0) . ' Lakhs';
                    }
                    $priceLines[] = "- {$r['name']} ({$r['project_type']}): {$price}" . ($r['plot_sizes'] ? ", Plot Size: {$r['plot_sizes']}" : '') . ", Status: {$r['status']}";
                }
                $parts[] = "## Project Pricing\n" . implode("\n", $priceLines);
            }
        }

        // --- LOCATION ---
        if (in_array('location', $intent)) {
            // Try to match specific location keywords
            $locationKeywords = [
                'hesaragatta' => 1,
                'nandi'       => 2,
                'devanahalli' => 3,
                'chikka'      => 4,
            ];
            $locationIds = [];
            foreach ($locationKeywords as $kw => $id) {
                if (strpos($query, $kw) !== false) {
                    $locationIds[] = $id;
                }
            }

            // If no specific location matched, load all
            $whereClause = '';
            if (!empty($locationIds)) {
                $ids         = implode(',', $locationIds);
                $whereClause = "WHERE id IN ($ids)";
            }

            $rows = $this->db->query("SELECT name, overview, airport_distance, city_distance, growth_factors, infrastructure FROM locations $whereClause ORDER BY id")->getResultArray();
            if ($rows) {
                $locParts = [];
                foreach ($rows as $r) {
                    $text = "### {$r['name']}\n";
                    $text .= "Overview: {$r['overview']}\n";
                    if ($r['airport_distance']) $text .= "Distance from Airport: {$r['airport_distance']}\n";
                    if ($r['city_distance'])   $text .= "Distance from Bengaluru: {$r['city_distance']}\n";
                    if ($r['growth_factors'])  $text .= "Growth Factors: {$r['growth_factors']}\n";
                    if ($r['infrastructure'])  $text .= "Infrastructure: {$r['infrastructure']}\n";
                    $locParts[] = $text;
                }
                $parts[] = "## Location Intelligence\n" . implode("\n", $locParts);
            }
        }

        // --- CUSTOMER PROFILE (from ai_leads) ---
        if ($sessionId) {
            $lead = $this->db->query(
                "SELECT goal, budget, location, timeline, priority, buyer_type, interest_level, last_project_viewed 
                 FROM ai_leads WHERE session_id = ? LIMIT 1",
                [$sessionId]
            )->getRowArray();

            if ($lead) {
                $profile = [];
                foreach ($lead as $k => $v) {
                    if ($v && $v !== 'cold') {
                        $profile[] = ucfirst(str_replace('_', ' ', $k)) . ': ' . $v;
                    }
                }
                if (!empty($profile)) {
                    $parts[] = "## Known Customer Profile (use naturally, don't repeat)\n" . implode("\n", $profile);
                }
            }
        }

        return implode("\n\n", array_filter($parts));
    }

    // -------------------------------------------------------
    // BUILD SINGLE PROJECT CONTEXT
    // -------------------------------------------------------
    private function buildProjectContext(int $projectId, bool $includeAmenities = true): string
    {
        $project = $this->db->query(
            "SELECT p.name, p.project_type, p.starting_price, p.max_price, p.plot_sizes, 
                    p.description, p.investment_angle, p.target_buyer, p.status, p.risk_level,
                    l.name as location_name, l.overview as location_overview
             FROM projects p 
             LEFT JOIN locations l ON p.location_id = l.id
             WHERE p.id = ?",
            [$projectId]
        )->getRowArray();

        if (!$project) return '';

        $price = $project['starting_price']
            ? '₹' . number_format($project['starting_price'] / 100000, 0) . ' Lakhs onwards'
            : 'Pricing on request';

        $text  = "## Project: {$project['name']}\n";
        $text .= "Type: {$project['project_type']}\n";
        $text .= "Starting Price: {$price}\n";
        if ($project['plot_sizes'])       $text .= "Plot Sizes: {$project['plot_sizes']}\n";
        if ($project['status'])           $text .= "Status: {$project['status']}\n";
        if ($project['location_name'])    $text .= "Location: {$project['location_name']}\n";
        if ($project['location_overview'])$text .= "Location Overview: {$project['location_overview']}\n";
        if ($project['description'])      $text .= "Description: {$project['description']}\n";
        if ($project['investment_angle']) $text .= "Investment Angle: {$project['investment_angle']}\n";
        if ($project['target_buyer'])     $text .= "Target Buyer: {$project['target_buyer']}\n";
        if ($project['risk_level'])       $text .= "Risk Level: {$project['risk_level']}\n";

        // Features
        $features = $this->db->query(
            "SELECT feature_name, feature_value FROM project_features WHERE project_id = ? ORDER BY feature_name",
            [$projectId]
        )->getResultArray();

        if ($features) {
            $grouped = [];
            foreach ($features as $f) {
                $grouped[$f['feature_name']][] = $f['feature_value'];
            }
            $text .= "Key Features:\n";
            foreach ($grouped as $name => $values) {
                $text .= "  - {$name}: " . implode(', ', $values) . "\n";
            }
        }

        // Amenities
        if ($includeAmenities) {
            $amenities = $this->db->query(
                "SELECT amenity_name FROM project_amenities WHERE project_id = ? ORDER BY amenity_name",
                [$projectId]
            )->getResultArray();

            if ($amenities) {
                $names = array_column($amenities, 'amenity_name');
                $text .= "Amenities: " . implode(', ', $names) . "\n";
            }
        }

        return $text;
    }

    // -------------------------------------------------------
    // LOG CONVERSATION HISTORY
    // -------------------------------------------------------
    private function logConversation(string $sessionId, string $role, string $message)
    {
        if (empty(trim($message))) return;

        $leadId = null;
        $lead = $this->db->query("SELECT id FROM ai_leads WHERE session_id = ? LIMIT 1", [$sessionId])->getRowArray();
        if ($lead) {
            $leadId = $lead['id'];
        }

        $this->db->query(
            "INSERT INTO conversation_history (session_id, lead_id, role, message) VALUES (?, ?, ?, ?)",
            [$sessionId, $leadId, $role, $message]
        );
    }
}

