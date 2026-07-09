<?php

namespace App\Controllers\FortuneOneCRM;
use App\Controllers\BaseController;

use CodeIgniter\Controller;

class AdminController extends BaseController
{
    private $db;
    
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        // Load session library helper
        helper('url');
    }

    /**
     * Auth Helper - Checks if user is logged in.
     * Redirects to login if not authenticated.
     */
    private function checkAuth($allowedRoles = [])
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to(base_url('admin'));
        }
        
        if (!empty($allowedRoles) && !in_array($session->get('role'), $allowedRoles)) {
            return redirect()->to(base_url('dashboard'))->with('error', 'Unauthorized access.');
        }
        
        return null;
    }

    /**
     * Checks if current user has permission for a feature.
     */
    private function hasPermission($permission)
    {
        $userId = session()->get('user_id');
        $email = session()->get('user_email');
        $role = session()->get('role');
        if (!$userId) return false;

        // admin role or admin@fortuneone.co has all permissions
        if ($role === 'admin' || $email === 'admin@fortuneone.co') {
            return true;
        }

        // Only admin role or admin@fortuneone.co can manage users
        if ($permission === 'users_manage') {
            return false;
        }

        $user = $this->db->query("SELECT permissions FROM crm_users WHERE id = ? LIMIT 1", [$userId])->getRowArray();
        $userPermissions = json_decode($user['permissions'] ?? '[]', true) ?: [];
        return in_array($permission, $userPermissions);
    }

    /**
     * Enforce a specific feature permission.
     */
    private function checkPermission($permission)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        if (!$this->hasPermission($permission)) {
            return \Config\Services::response()
                ->setStatusCode(403)
                ->setBody('<div style="font-family: sans-serif; text-align: center; margin-top: 100px;">
                            <h1 style="color: #d32f2f;">403 Access Denied</h1>
                            <p>You do not have the required permissions to view this module.</p>
                            <a href="'.base_url('dashboard').'" style="color: #1976d2; text-decoration: none;">&larr; Return to Dashboard</a>
                           </div>');
        }
        return null;
    }

    /**
     * Shared Data Helper
     */
    private function getCommonData()
    {
        $session = session();
        
        // Fetch company settings
        $dbSettings = $this->db->query("SELECT setting_key, setting_value FROM company_settings")->getResultArray();
        $settings = [];
        foreach ($dbSettings as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        $userId = $session->get('user_id');
        $userPermissions = [];
        if ($userId) {
            $user = $this->db->query("SELECT permissions FROM crm_users WHERE id = ? LIMIT 1", [$userId])->getRowArray();
            if ($user) {
                $userPermissions = json_decode($user['permissions'] ?? '[]', true) ?: [];
            }
        }

        $notifications = [];
        $unreadCount = 0;
        if ($userId) {
            $notifications = $this->db->query("SELECT * FROM crm_notifications WHERE (user_id = ? OR user_id IS NULL) ORDER BY created_at DESC LIMIT 10", [$userId])->getResultArray();
            $unreadCount = $this->db->query("SELECT COUNT(id) as count FROM crm_notifications WHERE (user_id = ? OR user_id IS NULL) AND is_read = 0", [$userId])->getRow()->count;
        }

        return [
            'user_name' => $session->get('user_name') ?? 'User',
            'user_role' => $session->get('role') ?? 'User',
            'user_role_label' => ucfirst($session->get('role') ?? 'User'),
            'user_avatar' => $session->get('avatar_url') ?? base_url('assets/website/images/default-avatar.png'),
            'company_settings' => $settings,
            'userPermissions' => $userPermissions,
            'isAdmin' => ($session->get('role') === 'admin' || $session->get('user_email') === 'admin@fortuneone.co'),
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ];
    }

    public function markNotificationsRead()
    {
        $userId = session()->get('user_id');
        if ($userId) {
            $this->db->query("UPDATE crm_notifications SET is_read = 1 WHERE (user_id = ? OR user_id IS NULL) AND is_read = 0", [$userId]);
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    /**
     * Login Page (GET)
     */
    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('FortuneOneCRM/auth/admin');
    }

    /**
     * Login POST Action
     */
    public function loginPost()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Please fill in all fields.']);
        }

        $user = $this->db->query("SELECT * FROM crm_users WHERE email = ? AND status = 'Active' LIMIT 1", [$email])->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            \App\Libraries\ActivityLogger::log('User Login', 'Auth', $user['id']);
            // Set session variables
            session()->set([
                'logged_in' => true,
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'role' => $user['role'],
                'avatar_url' => $user['avatar_url'],
                'user_email' => $user['email']
            ]);

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Login successful',
                'redirect' => base_url('dashboard')
            ]);
        }

        \App\Libraries\ActivityLogger::log('Failed Login', 'Auth');
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Invalid email or password.'
        ]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        \App\Libraries\ActivityLogger::log('User Logout', 'Auth');
        session()->destroy();
        return redirect()->to(base_url('admin'));
    }

    /**
     * Forgot Password (GET)
     */
    public function forgotPassword()
    {
        return view('FortuneOneCRM/auth/ForgotPassword');
    }

    /**
     * Forgot Password (POST)
     */
    public function forgotPasswordPost()
    {
        $email = $this->request->getPost('email');
        if (empty($email)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Email is required.']);
        }

        $user = $this->db->query("SELECT id, name FROM crm_users WHERE email = ? LIMIT 1", [$email])->getRowArray();
        
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));
            
            $this->db->query("UPDATE crm_users SET reset_token = ?, reset_token_expires_at = ? WHERE id = ?", [$token, $expiresAt, $user['id']]);
            
            // Send email
            $emailService = \Config\Services::email();
            $emailService->setTo($email);
            $emailService->setSubject('Password Reset - Fortune One CRM');
            
            $resetLink = base_url('reset-password?token=' . $token);
            
            $message = "
            <html>
            <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <h2>Password Reset Request</h2>
                <p>Hello {$user['name']},</p>
                <p>We received a request to reset your password for Fortune One CRM. Click the link below to choose a new password. This link will expire in 1 hour.</p>
                <p><a href='{$resetLink}' style='display:inline-block; padding:10px 20px; background-color:#111827; color:#fff; text-decoration:none; border-radius:5px;'>Reset Password</a></p>
                <p>If you did not request this, please ignore this email.</p>
            </body>
            </html>
            ";
            
            $emailService->setMailType('html');
            $emailService->setMessage($message);
            
            if (!$emailService->send()) {
                log_message('error', 'Email sending failed: ' . $emailService->printDebugger(['headers']));
                return $this->response->setJSON(['status' => false, 'message' => 'Failed to send email. Please check server configuration.']);
            }
        } else {
            // Wait, if the user doesn't exist, we still return true to prevent enumeration, but let's log it for debugging
            log_message('debug', 'Forgot password requested for non-existent email: ' . $email);
        }

        // Always return success to prevent email enumeration
        return $this->response->setJSON(['status' => true, 'message' => 'Instructions sent successfully']);
    }

    /**
     * Reset Password (GET)
     */
    public function resetPassword()
    {
        $token = $this->request->getGet('token');
        if (!$token) {
            return redirect()->to(base_url('admin'))->with('error', 'Invalid password reset link.');
        }

        $user = $this->db->query("SELECT id, email FROM crm_users WHERE reset_token = ? AND reset_token_expires_at > NOW() LIMIT 1", [$token])->getRowArray();
        
        if (!$user) {
            return redirect()->to(base_url('admin'))->with('error', 'Password reset link is invalid or has expired.');
        }

        return view('FortuneOneCRM/auth/ResetPassword', ['token' => $token, 'email' => $user['email']]);
    }

    /**
     * Reset Password (POST)
     */
    public function resetPasswordPost()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        
        if (empty($token) || empty($password)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Token and new password are required.']);
        }
        
        if (strlen($password) < 8) {
            return $this->response->setJSON(['status' => false, 'message' => 'Password must be at least 8 characters long.']);
        }

        $user = $this->db->query("SELECT id FROM crm_users WHERE reset_token = ? AND reset_token_expires_at > NOW() LIMIT 1", [$token])->getRowArray();
        
        if (!$user) {
            return $this->response->setJSON(['status' => false, 'message' => 'Password reset link is invalid or has expired.']);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $this->db->table('crm_users')->where('id', $user['id'])->update(['password' => $hashedPassword, 'reset_token' => null, 'reset_token_expires_at' => null, 'updated_at' => date('Y-m-d H:i:s')]);
        \App\Libraries\ActivityLogger::log('Password Reset', 'Auth', $user['id']);

        return $this->response->setJSON(['status' => true, 'message' => 'Password reset successfully']);
    }

    /**
     * Analytics Dashboard Page
     */
    public function analytics()
    {
        $redirect = $this->checkPermission('dashboard_access');
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        return view('FortuneOneCRM/analytics/dashboard', $data);
    }

    /**
     * Fetch Live GA4 Data via AJAX
     */
    public function getAnalyticsData()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $this->response->setJSON(['error' => true, 'message' => 'Unauthorized']);

        $timeframe = $this->request->getGet('timeframe') ?? 'weekly';
        
        $credentialsPath = FCPATH . 'assets/credentials.json';
        $propertyId = '488145142';

        try {
            $client = new \Google\Client();
            
            // Bypass SSL verification for local XAMPP environment to prevent cURL error 60
            $httpClient = new \GuzzleHttp\Client(['verify' => false]);
            $client->setHttpClient($httpClient);

            $client->setAuthConfig($credentialsPath);
            $client->addScope('https://www.googleapis.com/auth/analytics.readonly');
            
            $analytics = new \Google\Service\AnalyticsData($client);

            // Timeframe config
            $startDate = '7daysAgo';
            $prevStartDate = '14daysAgo';
            $prevEndDate = '7daysAgo';
            $timelineDimension = 'date';
            $endDate = 'today';
            
            switch($timeframe) {
                case 'daily':
                    $startDate = 'today';
                    $prevStartDate = 'yesterday';
                    $prevEndDate = 'yesterday';
                    $timelineDimension = 'hour';
                    break;
                case 'custom':
                    $reqStart = $this->request->getGet('start_date');
                    $reqEnd = $this->request->getGet('end_date');
                    if ($reqStart && $reqEnd) {
                        $startDate = $reqStart;
                        $endDate = $reqEnd;
                        // Calculate diff to determine timeline format and previous period
                        $tsStart = strtotime($reqStart);
                        $tsEnd = strtotime($reqEnd);
                        $diffDays = round(($tsEnd - $tsStart) / (60 * 60 * 24));
                        
                        $prevEndTs = strtotime("-1 day", $tsStart);
                        $prevStartTs = strtotime("-{$diffDays} days", $prevEndTs);
                        
                        $prevEndDate = date('Y-m-d', $prevEndTs);
                        $prevStartDate = date('Y-m-d', $prevStartTs);
                        
                        if ($diffDays <= 1) $timelineDimension = 'hour';
                        else if ($diffDays <= 31) $timelineDimension = 'date';
                        else if ($diffDays <= 90) $timelineDimension = 'week';
                        else $timelineDimension = 'month';
                    }
                    break;
                case 'monthly':
                    $startDate = '30daysAgo';
                    $prevStartDate = '60daysAgo';
                    $prevEndDate = '30daysAgo';
                    $timelineDimension = 'week';
                    break;
                case 'yearly':
                    $startDate = '365daysAgo';
                    $prevStartDate = '730daysAgo';
                    $prevEndDate = '365daysAgo';
                    $timelineDimension = 'month';
                    break;
                case 'weekly':
                default:
                    $startDate = '7daysAgo';
                    $prevStartDate = '14daysAgo';
                    $prevEndDate = '7daysAgo';
                    $timelineDimension = 'date';
                    break;
            }

            // 1. Summary Request
            $summaryRequest = new \Google\Service\AnalyticsData\RunReportRequest([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    ['name' => 'current', 'startDate' => $startDate, 'endDate' => $endDate],
                    ['name' => 'previous', 'startDate' => $prevStartDate, 'endDate' => $prevEndDate]
                ],
                'metrics' => [
                    ['name' => 'activeUsers'],
                    ['name' => 'screenPageViews'],
                    ['name' => 'userEngagementDuration'],
                    ['name' => 'bounceRate']
                ]
            ]);
            $summaryResponse = $analytics->properties->runReport("properties/{$propertyId}", $summaryRequest);

            // 2. Timeline Request
            $timelineRequest = new \Google\Service\AnalyticsData\RunReportRequest([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => $endDate]
                ],
                'dimensions' => [
                    ['name' => $timelineDimension]
                ],
                'metrics' => [
                    ['name' => 'activeUsers'],
                    ['name' => 'screenPageViews'],
                    ['name' => 'userEngagementDuration'],
                    ['name' => 'bounceRate']
                ],
                'orderBys' => [
                    [
                        'dimension' => ['dimensionName' => $timelineDimension],
                        'desc' => false
                    ]
                ]
            ]);
            $timelineResponse = $analytics->properties->runReport("properties/{$propertyId}", $timelineRequest);

            // 3. Top Pages Matrix Request
            $topPagesRequest = new \Google\Service\AnalyticsData\RunReportRequest([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => $endDate]
                ],
                'dimensions' => [
                    ['name' => 'pagePath']
                ],
                'metrics' => [
                    ['name' => 'screenPageViews'],
                    ['name' => 'userEngagementDuration'],
                    ['name' => 'bounceRate']
                ],
                'orderBys' => [
                    [
                        'metric' => ['metricName' => 'screenPageViews'],
                        'desc' => true
                    ]
                ],
                'limit' => 10
            ]);
            $topPagesResponse = $analytics->properties->runReport("properties/{$propertyId}", $topPagesRequest);

            // 4. Geographic Distribution
            $geoRequest = new \Google\Service\AnalyticsData\RunReportRequest([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => $endDate]
                ],
                'dimensions' => [
                    ['name' => 'country'],
                    ['name' => 'city']
                ],
                'metrics' => [
                    ['name' => 'activeUsers']
                ],
                'orderBys' => [
                    [
                        'metric' => ['metricName' => 'activeUsers'],
                        'desc' => true
                    ]
                ],
                'limit' => 10
            ]);
            $geoResponse = $analytics->properties->runReport("properties/{$propertyId}", $geoRequest);

            // 5. Device Category
            $deviceRequest = new \Google\Service\AnalyticsData\RunReportRequest([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => $endDate]
                ],
                'dimensions' => [
                    ['name' => 'deviceCategory']
                ],
                'metrics' => [
                    ['name' => 'activeUsers']
                ]
            ]);
            $deviceResponse = $analytics->properties->runReport("properties/{$propertyId}", $deviceRequest);

            // 6. Traffic Acquisition Channels
            $channelRequest = new \Google\Service\AnalyticsData\RunReportRequest([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => $endDate]
                ],
                'dimensions' => [
                    ['name' => 'sessionDefaultChannelGroup']
                ],
                'metrics' => [
                    ['name' => 'activeUsers']
                ]
            ]);
            $channelResponse = $analytics->properties->runReport("properties/{$propertyId}", $channelRequest);

            // 7. GET REFERRALS MATRIX (Source)
            $referralsRequest = new \Google\Service\AnalyticsData\RunReportRequest([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => 'today']
                ],
                'dimensions' => [
                    ['name' => 'sessionSource']
                ],
                'metrics' => [
                    ['name' => 'activeUsers'],
                    ['name' => 'screenPageViews']
                ],
                'orderBys' => [
                    [
                        'metric' => ['metricName' => 'activeUsers'],
                        'desc' => true
                    ]
                ],
                'limit' => 6
            ]);
            $referralsResponse = $analytics->properties->runReport("properties/{$propertyId}", $referralsRequest);

            // ================== DATA PROCESSING ================== //
            
            // Process Summary Data
            $users = 0; $views = 0; $duration = 0; $bounce = 0;
            $prevUsers = 0; $prevViews = 0; $prevBounce = 0;

            if (isset($summaryResponse->rows)) {
                foreach ($summaryResponse->rows as $row) {
                    $range = $row->dimensionValues[0]->value;
                    if ($range === 'current') {
                        $users = (int) $row->metricValues[0]->value;
                        $views = (int) $row->metricValues[1]->value;
                        $duration = (int) $row->metricValues[2]->value;
                        $bounce = (float) $row->metricValues[3]->value;
                    } else if ($range === 'previous') {
                        $prevUsers = (int) $row->metricValues[0]->value;
                        $prevViews = (int) $row->metricValues[1]->value;
                        $prevBounce = (float) $row->metricValues[3]->value;
                    }
                }
            }

            $avgRetentionSeconds = $users > 0 ? floor($duration / $users) : 0;
            $retentionStr = floor($avgRetentionSeconds / 60) . "m " . ($avgRetentionSeconds % 60) . "s";
            
            $bounceRatePct = round($bounce * 100, 1);
            $prevBounceRatePct = round($prevBounce * 100, 1);

            $calcTrend = function($curr, $prev) {
                if ($prev == 0) return '+100%';
                $diff = $curr - $prev;
                $pct = round(($diff / $prev) * 100);
                return ($pct >= 0 ? '+' : '') . $pct . '%';
            };

            // Process Timeline Data
            $timelineLabels = [];
            $timelineUsers = [];
            $timelineViews = [];
            $timelineTime = [];
            $timelineBounce = [];
            
            if (isset($timelineResponse->rows)) {
                foreach ($timelineResponse->rows as $row) {
                    $label = $row->dimensionValues[0]->value;
                    if ($timeframe === 'daily') $label = $label . ':00';
                    else if ($timeframe === 'yearly') $label = 'Month ' . $label;
                    else if ($timeframe === 'weekly') {
                        $label = substr($label, 6, 2) . '/' . substr($label, 4, 2);
                    }
                    
                    $timelineLabels[] = $label;
                    $usersCount = (int) $row->metricValues[0]->value;
                    $viewsCount = (int) $row->metricValues[1]->value;
                    $duration = (int) $row->metricValues[2]->value;
                    $bounce = (float) $row->metricValues[3]->value;
                    
                    $timelineUsers[] = $usersCount;
                    $timelineViews[] = $viewsCount;
                    $timelineTime[] = $usersCount > 0 ? floor($duration / $usersCount) : 0;
                    $timelineBounce[] = round($bounce * 100, 1);
                }
            }

            // Process Top Pages Matrix
            $topPagesData = [];
            if (isset($topPagesResponse->rows)) {
                foreach ($topPagesResponse->rows as $row) {
                    $path = $row->dimensionValues[0]->value ?: '/';
                    $pageViews = (int) $row->metricValues[0]->value;
                    $pageDuration = (int) $row->metricValues[1]->value;
                    $pageBounce = (float) $row->metricValues[2]->value;
                    
                    $avgSeconds = $pageViews > 0 ? floor($pageDuration / $pageViews) : 0;
                    
                    $topPagesData[] = [
                        'path' => $path,
                        'views' => $pageViews,
                        'avgTime' => floor($avgSeconds / 60) . "m " . ($avgSeconds % 60) . "s",
                        'avgTimeSeconds' => $avgSeconds,
                        'bounceRate' => round($pageBounce * 100, 1)
                    ];
                }
            }

            // Process Geographic Data
            $geoData = [];
            $countryDistribution = [];
            if (isset($geoResponse->rows)) {
                foreach ($geoResponse->rows as $row) {
                    $country = $row->dimensionValues[0]->value;
                    $city = $row->dimensionValues[1]->value;
                    $activeU = (int) $row->metricValues[0]->value;
                    
                    $geoData[] = [
                        'country' => $country,
                        'city' => $city,
                        'users' => $activeU
                    ];
                    
                    if (!isset($countryDistribution[$country])) {
                        $countryDistribution[$country] = 0;
                    }
                    $countryDistribution[$country] += $activeU;
                }
            }
            
            // Sort country distribution
            arsort($countryDistribution);
            $topCountries = [
                'labels' => array_keys($countryDistribution),
                'data' => array_values($countryDistribution)
            ];

            // Process Devices
            $deviceLabels = [];
            $deviceData = [];
            if (isset($deviceResponse->rows)) {
                foreach ($deviceResponse->rows as $row) {
                    $deviceLabels[] = ucfirst($row->dimensionValues[0]->value);
                    $deviceData[] = (int) $row->metricValues[0]->value;
                }
            }

            // Process Channels
            $channelLabels = [];
            $channelData = [];
            if (isset($channelResponse->rows)) {
                foreach ($channelResponse->rows as $row) {
                    $channelLabels[] = $row->dimensionValues[0]->value;
                    $channelData[] = (int) $row->metricValues[0]->value;
                }
            }

            // Process Referrals
            $referralsData = [
                'labels' => [],
                'users' => [],
                'views' => []
            ];
            if (isset($referralsResponse->rows)) {
                foreach ($referralsResponse->rows as $row) {
                    $rawSource = strtolower($row->dimensionValues[0]->value);
                    $prettySource = ucfirst($rawSource);
                    if (str_contains($rawSource, 'google')) $prettySource = 'Google';
                    else if (str_contains($rawSource, 'facebook') || str_contains($rawSource, 'fb')) $prettySource = 'Facebook';
                    else if (str_contains($rawSource, 'instagram') || str_contains($rawSource, 'ig')) $prettySource = 'Instagram';
                    else if (str_contains($rawSource, 'linkedin')) $prettySource = 'LinkedIn';
                    else if (str_contains($rawSource, 'direct')) $prettySource = 'Direct Traffic';
                    else if (str_contains($rawSource, 'openai') || str_contains($rawSource, 'chatgpt')) $prettySource = 'ChatGPT / AI';
                    
                    $referralsData['labels'][] = $prettySource;
                    $referralsData['users'][] = (int) $row->metricValues[0]->value;
                    $referralsData['views'][] = (int) $row->metricValues[1]->value;
                }
            }

            $finalData = [
                'summary' => [
                    'users' => $users,
                    'views' => $views,
                    'retention' => $retentionStr,
                    'avgRetentionSeconds' => $avgRetentionSeconds,
                    'bounceRate' => $bounceRatePct,
                    'usersTrend' => $calcTrend($users, $prevUsers),
                    'viewsTrend' => $calcTrend($views, $prevViews),
                    'bounceTrend' => $calcTrend($bounceRatePct, $prevBounceRatePct)
                ],
                'trafficTimeline' => [
                    'labels' => $timelineLabels,
                    'users' => $timelineUsers,
                    'views' => $timelineViews,
                    'time' => $timelineTime,
                    'bounce' => $timelineBounce
                ],
                'topPagesMatrix' => $topPagesData,
                'geo' => [
                    'cities' => $geoData,
                    'countries' => $topCountries
                ],
                'devices' => [
                    'labels' => $deviceLabels,
                    'data' => $deviceData
                ],
                'channels' => [
                    'labels' => $channelLabels,
                    'data' => $channelData
                ],
                'referrals' => $referralsData
            ];

            return $this->response->setJSON($finalData);

        } catch (\Throwable $e) {
            return $this->response->setJSON(['error' => true, 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }
    }

    /**
     * Dashboard Page
     */
    public function dashboard()
    {
        $redirect = $this->checkPermission('dashboard_access');
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        // 1. Fetch Real KPI Counts
        $totalLeads = $this->db->query("SELECT COUNT(*) as count FROM ai_leads")->getRow()->count;
        $newLeadsToday = $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE DATE(created_at) = CURRENT_DATE")->getRow()->count;
        $advisorRequests = $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE last_action LIKE '%advisor%' OR goal = 'advisor'")->getRow()->count;
        $appointmentsCount = $this->db->query("SELECT COUNT(*) as count FROM appointments")->getRow()->count;
        $careersCount = $this->db->query("SELECT COUNT(*) as count FROM career_applications")->getRow()->count;
        $activeChats = $this->db->query("SELECT COUNT(DISTINCT session_id) as count FROM conversation_history")->getRow()->count;
        $enquiriesCount = $this->db->query("SELECT COUNT(*) as count FROM enquiries")->getRow()->count;

        $data['kpis'] = [
            'total_leads' => $totalLeads,
            'new_leads_today' => $newLeadsToday,
            'advisor_requests' => $advisorRequests,
            'appointments' => $appointmentsCount,
            'careers' => $careersCount,
            'active_chats' => $activeChats,
            // Appt Widgets
            'appt_total' => $appointmentsCount,
            'appt_upcoming' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE preferred_date >= CURRENT_DATE AND status IN ('Scheduled', 'Confirmed')")->getRow()->count,
            'appt_pending' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE status = 'Scheduled'")->getRow()->count,
            'appt_completed' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE status = 'Completed'")->getRow()->count,
            'appt_today' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE preferred_date = CURRENT_DATE")->getRow()->count,
            // Career Widgets
            'career_total' => $careersCount,
            'career_new' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE status = 'New'")->getRow()->count,
            'career_month' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE MONTH(created_at) = MONTH(CURRENT_DATE)")->getRow()->count,
            'career_interviews' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE status = 'Interview Scheduled'")->getRow()->count,
            'career_selected' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE status = 'Selected'")->getRow()->count,
            // Enquiries Widgets
            'enq_total' => $enquiriesCount,
            'enq_new' => $this->db->query("SELECT COUNT(*) as count FROM enquiries WHERE status = 'New'")->getRow()->count,
            'enq_unread' => $this->db->query("SELECT COUNT(*) as count FROM enquiries WHERE status = 'New'")->getRow()->count,
            'enq_today' => $this->db->query("SELECT COUNT(*) as count FROM enquiries WHERE DATE(created_at) = CURRENT_DATE")->getRow()->count
        ];

        // Fetch Pipeline counts
        $data['pipeline'] = [
            'new' => $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE interest_level = 'cold'")->getRow()->count,
            'contacted' => $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE last_action IS NOT NULL AND last_action != ''")->getRow()->count,
            'interested' => $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE interest_level = 'warm'")->getRow()->count,
            'negotiation' => $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE interest_level = 'ready'")->getRow()->count,
            'booked' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE status = 'Completed'")->getRow()->count,
        ];

        // Build Activity Feed
        $feed = [];
        $recentAppts = $this->db->query("SELECT id, name as title, 'Appointment' as type, created_at FROM appointments ORDER BY created_at DESC LIMIT 5")->getResultArray();
        $recentCareers = $this->db->query("SELECT id, full_name as title, 'Career Application' as type, created_at FROM career_applications ORDER BY created_at DESC LIMIT 5")->getResultArray();
        $recentEnquiries = $this->db->query("SELECT id, full_name as title, 'Enquiry' as type, created_at FROM enquiries ORDER BY created_at DESC LIMIT 5")->getResultArray();
        
        $feed = array_merge($recentAppts, $recentCareers, $recentEnquiries);
        usort($feed, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        $data['activity_feed'] = array_slice($feed, 0, 5);

        // Fetch Project Interest Counts
        $data['project_interests'] = $this->db->query("
            SELECT last_project_viewed as project, COUNT(*) as count
            FROM ai_leads
            WHERE last_project_viewed IS NOT NULL AND last_project_viewed != ''
            GROUP BY last_project_viewed
            ORDER BY count DESC
            LIMIT 3
        ")->getResultArray();

        // --- FETCH REAL CHART DATA FOR ENQUIRIES TREND ---
        $enquiries = $this->db->query("SELECT created_at FROM enquiries")->getResultArray();
        
        $chartDataMap = [
            '1_day' => ['labels' => [], 'data' => []],
            '1_week' => ['labels' => [], 'data' => []],
            '1_month' => ['labels' => [], 'data' => []],
            '1_year' => ['labels' => [], 'data' => []],
            'all_time' => ['labels' => [], 'data' => []],
        ];

        // 1 Week (Last 7 days)
        $weekData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $chartDataMap['1_week']['labels'][] = date('D', strtotime("-$i days"));
            $weekData[$date] = 0;
        }

        // 1 Month (Last 30 days)
        $monthData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $chartDataMap['1_month']['labels'][] = ($i % 5 == 0 || $i == 0) ? date('d M', strtotime("-$i days")) : '';
            $monthData[$date] = 0;
        }

        // 1 Year (Last 12 months)
        $yearData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $chartDataMap['1_year']['labels'][] = date('M Y', strtotime("-$i months"));
            $yearData[$month] = 0;
        }
        
        // All Time
        $allTimeData = [];
        
        // 1 Day (Last 24 hours)
        $dayData = [];
        for ($i = 23; $i >= 0; $i--) {
            $hour = date('Y-m-d H', strtotime("-$i hours"));
            // Only show labels every 4 hours to avoid crowding
            $chartDataMap['1_day']['labels'][] = ($i % 4 == 0 || $i == 0) ? date('g A', strtotime("-$i hours")) : '';
            $dayData[$hour] = 0;
        }

        foreach ($enquiries as $enq) {
            if(empty($enq['created_at'])) continue;
            $ts = strtotime($enq['created_at']);
            $date = date('Y-m-d', $ts);
            $month = date('Y-m', $ts);
            $year = date('Y', $ts);
            $hour = date('Y-m-d H', $ts);
            
            if (isset($weekData[$date])) $weekData[$date]++;
            if (isset($monthData[$date])) $monthData[$date]++;
            if (isset($yearData[$month])) $yearData[$month]++;
            if (isset($dayData[$hour])) $dayData[$hour]++;
            
            if (!isset($allTimeData[$year])) $allTimeData[$year] = 0;
            $allTimeData[$year]++;
        }
        
        if (empty($allTimeData)) {
            $allTimeData[date('Y')] = 0; // fallback if no data
        }

        ksort($allTimeData);
        $chartDataMap['all_time']['labels'] = array_keys($allTimeData);
        $chartDataMap['all_time']['data'] = array_values($allTimeData);
        
        $chartDataMap['1_week']['data'] = array_values($weekData);
        $chartDataMap['1_month']['data'] = array_values($monthData);
        $chartDataMap['1_year']['data'] = array_values($yearData);
        $chartDataMap['1_day']['data'] = array_values($dayData);

        $data['chartDataMap'] = json_encode($chartDataMap);

        return view('FortuneOneCRM/dashboard/Dashboard', $data);
    }

    /**
     * Leads List Page
     */
    public function leads()
    {
        $redirect = $this->checkPermission('lead_management');
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        // Fetch Real KPI Counts for Leads View
        $totalLeads = $this->db->query("SELECT COUNT(*) as count FROM ai_leads")->getRow()->count;
        $newLeadsToday = $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE DATE(created_at) = CURRENT_DATE")->getRow()->count;
        $advisorRequests = $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE last_action LIKE '%advisor%' OR goal = 'advisor'")->getRow()->count;
        $siteVisits = $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE appointment_type = 'site_visit'")->getRow()->count;
        $hotLeads = $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE interest_level = 'hot' OR priority = 'high'")->getRow()->count;
        $bookedCount = $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE status = 'completed'")->getRow()->count;

        $data['kpis'] = [
            'total_leads' => $totalLeads,
            'new_leads_today' => $newLeadsToday,
            'advisor_requests' => $advisorRequests,
            'site_visits' => $siteVisits,
            'hot_leads' => $hotLeads,
            'booked' => $bookedCount
        ];

        // Get Filters and Search Query
        $search = $this->request->getGet('q') ?? '';
        $interest = $this->request->getGet('interest') ?? '';
        $priority = $this->request->getGet('priority') ?? '';
        $page = (int)($this->request->getGet('page') ?? 1);
        if ($page < 1) $page = 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Build Query
        $where = ["1=1"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(name LIKE ? OR email LIKE ? OR phone LIKE ? OR location LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        if (!empty($interest)) {
            $where[] = "interest_level = ?";
            $params[] = $interest;
        }
        if (!empty($priority)) {
            $where[] = "priority = ?";
            $params[] = $priority;
        }

        $whereClause = implode(" AND ", $where);

        // Fetch Count
        $countQuery = $this->db->query("SELECT COUNT(*) as count FROM ai_leads WHERE $whereClause", $params);
        $totalRows = $countQuery->getRow()->count;
        $totalPages = ceil($totalRows / $limit);

        // Fetch Paginated Rows
        $sql = "SELECT * FROM ai_leads WHERE $whereClause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $data['leads'] = $this->db->query($sql, $params)->getResultArray();
        
        $data['search'] = $search;
        $data['interest'] = $interest;
        $data['priority'] = $priority;
        $data['page'] = $page;
        $data['totalPages'] = $totalPages;
        $data['totalRows'] = $totalRows;

        return view('FortuneOneCRM/leads/Leads', $data);
    }

    /**
     * Lead Details Page
     */
    public function leadDetails($id = null)
    {
        $redirect = $this->checkPermission('lead_management');
        if ($redirect) return $redirect;

        if (!$id) {
            return redirect()->to(base_url('leads'));
        }

        $data = $this->getCommonData();

        // Fetch specific lead
        $lead = $this->db->query("SELECT * FROM ai_leads WHERE id = ? LIMIT 1", [$id])->getRowArray();
        if (!$lead) {
            return redirect()->to(base_url('leads'))->with('error', 'Lead not found.');
        }

        $data['lead'] = $lead;

        // Fetch Conversation History
        $data['conversations'] = [];
        if (!empty($lead['session_id'])) {
            $data['conversations'] = $this->db->query("
                SELECT * FROM conversation_history 
                WHERE session_id = ? 
                ORDER BY created_at ASC
            ", [$lead['session_id']])->getResultArray();
        }

        return view('FortuneOneCRM/leads/Leaddetails', $data);
    }

    
    /**
     * Appointments List Page
     */
    public function appointments()
    {
        $redirect = $this->checkPermission('appointments_access');
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        $data['kpis'] = [
            'appt_total' => $this->db->query("SELECT COUNT(*) as count FROM appointments")->getRow()->count,
            'appt_upcoming' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE preferred_date >= CURRENT_DATE AND status IN ('Scheduled', 'Confirmed')")->getRow()->count,
            'appt_today' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE preferred_date = CURRENT_DATE")->getRow()->count,
            'appt_completed' => $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE status = 'Completed'")->getRow()->count,
        ];

        $search = $this->request->getGet('q') ?? '';
        $type = $this->request->getGet('type') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $page = (int)($this->request->getGet('page') ?? 1);
        if ($page < 1) $page = 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $where = ["1=1"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(name LIKE ? OR phone LIKE ? OR email LIKE ? OR project_name LIKE ?)";
            $params[] = "%" . $search . "%";
            $params[] = "%" . $search . "%";
            $params[] = "%" . $search . "%";
            $params[] = "%" . $search . "%";
        }
        if (!empty($type)) {
            $where[] = "appointment_type = ?";
            $params[] = $type;
        }
        if (!empty($status)) {
            $where[] = "status = ?";
            $params[] = $status;
        }

        $whereClause = implode(" AND ", $where);

        $countQuery = $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE $whereClause", $params);
        $totalRows = $countQuery->getRow()->count;
        $totalPages = ceil($totalRows / $limit);

        $sql = "SELECT * FROM appointments WHERE $whereClause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $data['appointments'] = $this->db->query($sql, $params)->getResultArray();

        $data['search'] = $search;
        $data['type'] = $type;
        $data['status'] = $status;
        $data['page'] = $page;
        $data['totalPages'] = $totalPages;
        $data['totalRows'] = $totalRows;

        return view('FortuneOneCRM/appointments/Appointments', $data);
    }

    /**
     * Appointment Details Page
     */
    public function appointmentDetails($id = null)
    {
        $redirect = $this->checkPermission('appointments_access');
        if ($redirect) return $redirect;

        if (!$id) return redirect()->to(base_url('appointments'));

        $data = $this->getCommonData();
        
        $appt = $this->db->query("SELECT * FROM appointments WHERE id = ?", [$id])->getRowArray();
        if (!$appt) return redirect()->to(base_url('appointments'))->with('error', 'Appointment not found.');
        
        $data['appt'] = $appt;
        return view('FortuneOneCRM/appointments/AppointmentDetails', $data);
    }

    /**
     * Update Appointment details (POST)
     */
    public function updateAppointment()
    {
        $redirect = $this->checkPermission('appointments_manage');
        if ($redirect) return $redirect;

        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $internal_notes = $this->request->getPost('internal_notes');

        if (empty($id)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Missing Appointment ID']);
        }

        $this->db->query("UPDATE appointments SET status = ?, internal_notes = ?, updated_at = NOW() WHERE id = ?", [$status, $internal_notes, $id]);

        return $this->response->setJSON(['status' => true, 'message' => 'Appointment updated successfully.']);
    }

    /**
     * Career Applications List
     */
    public function careerApplications()
    {
        $redirect = $this->checkPermission('careers_access');
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        $data['kpis'] = [
            'career_total' => $this->db->query("SELECT COUNT(*) as count FROM career_applications")->getRow()->count,
            'career_month' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE MONTH(created_at) = MONTH(CURRENT_DATE)")->getRow()->count,
            'career_new' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE status = 'New'")->getRow()->count,
            'career_interviews' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE status = 'Interview Scheduled'")->getRow()->count,
            'career_selected' => $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE status = 'Selected'")->getRow()->count,
        ];

        $search = $this->request->getGet('q') ?? '';
        $post = $this->request->getGet('post') ?? '';
        $status = $this->request->getGet('status') ?? '';
        $page = (int)($this->request->getGet('page') ?? 1);
        if ($page < 1) $page = 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $where = ["1=1"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(full_name LIKE ? OR email LIKE ? OR phone LIKE ? OR current_company LIKE ?)";
            $params[] = "%" . $search . "%";
            $params[] = "%" . $search . "%";
            $params[] = "%" . $search . "%";
            $params[] = "%" . $search . "%";
        }
        if (!empty($post)) {
            $where[] = "position_applied = ?";
            $params[] = $post;
        }
        if (!empty($status)) {
            $where[] = "status = ?";
            $params[] = $status;
        }

        $whereClause = implode(" AND ", $where);

        $countQuery = $this->db->query("SELECT COUNT(*) as count FROM career_applications WHERE $whereClause", $params);
        $totalRows = $countQuery->getRow()->count;
        $totalPages = ceil($totalRows / $limit);

        $sql = "SELECT * FROM career_applications WHERE $whereClause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $data['applications'] = $this->db->query($sql, $params)->getResultArray();

        $data['search'] = $search;
        $data['post'] = $post;
        $data['status'] = $status;
        $data['page'] = $page;
        $data['totalPages'] = $totalPages;
        $data['totalRows'] = $totalRows;

        return view('FortuneOneCRM/career/CareerApplications', $data);
    }

    /**
     * Application Details Page
     */
    public function applicationDetails($id = null)
    {
        $redirect = $this->checkPermission('careers_access');
        if ($redirect) return $redirect;

        if (!$id) return redirect()->to(base_url('careers'));

        $data = $this->getCommonData();

        $app = $this->db->query("SELECT * FROM career_applications WHERE id = ? LIMIT 1", [$id])->getRowArray();
        if (!$app) return redirect()->to(base_url('careers'))->with('error', 'Application not found.');

        $data['app'] = $app;
        return view('FortuneOneCRM/career/ApplicationDetails', $data);
    }

    /**
     * Update Application Status/Notes (POST)
     */
    public function updateApplication()
    {
        $redirect = $this->checkPermission('careers_manage');
        if ($redirect) return $redirect;

        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('notes');

        if (empty($id)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Missing ID']);
        }

        $this->db->query("UPDATE career_applications SET status = ?, notes = ?, updated_at = NOW() WHERE id = ?", [$status, $notes, $id]);

        return $this->response->setJSON(['status' => true, 'message' => 'Application updated successfully.']);
    }

/**
     * Users List Page
     */
    public function users()
    {
        $redirect = $this->checkPermission('users_manage');
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        $search = $this->request->getGet('q') ?? '';
        $role = $this->request->getGet('role') ?? '';
        $page = (int)($this->request->getGet('page') ?? 1);
        if ($page < 1) $page = 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $where = ["1=1"];
        $params = [];

        if (!empty($search)) {
            $where[] = "(name LIKE ? OR email LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        if (!empty($role)) {
            $where[] = "role = ?";
            $params[] = $role;
        }

        $whereClause = implode(" AND ", $where);

        $countQuery = $this->db->query("SELECT COUNT(*) as count FROM crm_users WHERE $whereClause", $params);
        $totalRows = $countQuery->getRow()->count;
        $totalPages = ceil($totalRows / $limit);

        $sql = "SELECT * FROM crm_users WHERE $whereClause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $data['users'] = $this->db->query($sql, $params)->getResultArray();

        $data['search'] = $search;
        $data['role'] = $role;
        $data['page'] = $page;
        $data['totalPages'] = $totalPages;
        $data['totalRows'] = $totalRows;

        // Overall stats for the summary cards
        $data['totalUsers'] = $this->db->query("SELECT COUNT(*) as count FROM crm_users")->getRow()->count;
        $data['activeUsers'] = $this->db->query("SELECT COUNT(*) as count FROM crm_users WHERE status = 'Active'")->getRow()->count;
        $data['activePercent'] = $data['totalUsers'] > 0 ? round(($data['activeUsers'] / $data['totalUsers']) * 100) : 0;
        
        $data['advisorUsers'] = $this->db->query("SELECT COUNT(*) as count FROM crm_users WHERE role = 'sales_advisor'")->getRow()->count;
        $data['managerUsers'] = $this->db->query("SELECT COUNT(*) as count FROM crm_users WHERE role = 'manager'")->getRow()->count;
        $data['adminUsers'] = $this->db->query("SELECT COUNT(*) as count FROM crm_users WHERE role = 'admin'")->getRow()->count;

        return view('FortuneOneCRM/settings/Users', $data);
    }

    /**
     * User Details Page
     */
    public function userDetails($id = null)
    {
        $redirect = $this->checkPermission('users_manage');
        if ($redirect) return $redirect;

        if (!$id) {
            return redirect()->to(base_url('users'));
        }

        $data = $this->getCommonData();

        $user = $this->db->query("SELECT * FROM crm_users WHERE id = ? LIMIT 1", [$id])->getRowArray();
        if (!$user) {
            return redirect()->to(base_url('users'))->with('error', 'User not found.');
        }

        $data['user'] = $user;

        // Fetch dynamic counts & lists for User Details view
        $data['total_leads_count'] = $this->db->query("SELECT COUNT(*) as count FROM ai_leads")->getRow()->count;
        $data['site_visits_count'] = $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE appointment_type = 'site_visit'")->getRow()->count;
        $data['bookings_closed_count'] = $this->db->query("SELECT COUNT(*) as count FROM appointments WHERE status = 'completed'")->getRow()->count;
        $data['active_conversations_count'] = $this->db->query("SELECT COUNT(DISTINCT session_id) as count FROM conversation_history")->getRow()->count;

        $data['assigned_leads'] = $this->db->query("SELECT * FROM ai_leads ORDER BY created_at DESC LIMIT 5")->getResultArray();
        
        $data['user_appointments'] = $this->db->query("
            SELECT *, name as lead_name 
            FROM appointments 
            ORDER BY preferred_date DESC 
            LIMIT 5
        ")->getResultArray();

        return view('FortuneOneCRM/settings/UserDetails', $data);
    }

    /**
     * Create New User (POST)
     */
       public function createUser()
    {
        $redirect = $this->checkPermission('users_manage');
        if ($redirect) return $redirect;

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone') ?? '';
        $role = $this->request->getPost('role');
        $department = $this->request->getPost('department') ?? ''; // ADDED THIS
        $password = $this->request->getPost('password');
        $status = $this->request->getPost('status') ?? 'Active';
        $permissions = $this->request->getPost('permissions') ?? [];

        if (empty($name) || empty($email) || empty($role) || empty($password)) {
            return redirect()->back()->with('error', 'Missing required fields.');
        }

        // Check if email already exists
        $exists = $this->db->query("SELECT id FROM crm_users WHERE email = ?", [$email])->getRowArray();
        if ($exists) {
            return redirect()->back()->with('error', 'Email already exists.');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $permissionsJson = json_encode($permissions);

        $this->db->query("
            INSERT INTO crm_users (name, email, password, role, department, status, permissions, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ", [$name, $email, $hashedPassword, $role, $department, $status, $permissionsJson]); // ADDED DEPARTMENT HERE

        return redirect()->back()->with('success', 'User created successfully.');
    }


    /**
     * Update User Info/Role (POST)
     */
       public function updateUser()
    {
        $redirect = $this->checkPermission('users_manage');
        if ($redirect && !$this->request->isAJAX()) return $redirect;
        if ($redirect && $this->request->isAJAX()) return $this->response->setJSON(['status' => false, 'message' => 'Unauthorized']);

        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');
        $department = $this->request->getPost('department') ?? ''; // ADDED THIS
        $status = $this->request->getPost('status') ?? 'Active';
        $password = $this->request->getPost('password');

        if (empty($id) || empty($name) || empty($email) || empty($role)) {
            if ($this->request->isAJAX()) return $this->response->setJSON(['status' => false, 'message' => 'Missing required fields.']);
            return redirect()->back()->with('error', 'Missing required fields.');
        }

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->db->query("
                UPDATE crm_users 
                SET name = ?, email = ?, role = ?, department = ?, status = ?, password = ?, updated_at = NOW() 
                WHERE id = ?
            ", [$name, $email, $role, $department, $status, $hashedPassword, $id]); // ADDED DEPARTMENT HERE
        } else {
            $this->db->query("
                UPDATE crm_users 
                SET name = ?, email = ?, role = ?, department = ?, status = ?, updated_at = NOW() 
                WHERE id = ?
            ", [$name, $email, $role, $department, $status, $id]); // ADDED DEPARTMENT HERE
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => true, 'message' => 'Profile updated successfully']);
        }
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    /**
     * Update User Permissions (POST)
     */
    public function updateUserPermissions()
    {
        $redirect = $this->checkPermission('users_manage');
        if ($redirect && !$this->request->isAJAX()) return $redirect;
        if ($redirect && $this->request->isAJAX()) return $this->response->setJSON(['status' => false, 'message' => 'Unauthorized']);

        $userId = $this->request->getPost('user_id');
        $permissions = $this->request->getPost('permissions') ?? [];

        if (empty($userId)) {
            if ($this->request->isAJAX()) return $this->response->setJSON(['status' => false, 'message' => 'Missing User ID']);
            return redirect()->back()->with('error', 'Missing User ID');
        }

        $permissionsJson = json_encode($permissions);

        $this->db->query("
            UPDATE crm_users 
            SET permissions = ?, updated_at = NOW() 
            WHERE id = ?
        ", [$permissionsJson, $userId]);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => true, 'message' => 'User permissions updated successfully.']);
        }
        return redirect()->back()->with('success', 'User permissions updated successfully.');
    }



    /**
     * Company Settings Page (GET)
     */
    public function settings()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        return view('FortuneOneCRM/settings/CompanyDetails', $data);
    }

    /**
     * Update Profile (POST)
     */
    public function updateProfile()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $userId = session()->get('user_id');
        $name = $this->request->getPost('name');

        if (empty($name)) {
            return redirect()->back()->with('error', 'Name cannot be empty.');
        }

        $avatarFile = $this->request->getFile('avatar');
        $avatarUrl = session()->get('avatar_url'); // Keep existing if no new upload

        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $newName = $avatarFile->getRandomName();
            $avatarFile->move(FCPATH . 'uploads/avatars', $newName);
            $avatarUrl = base_url('uploads/avatars/' . $newName);
        }

        $this->db->query("UPDATE crm_users SET name = ?, avatar_url = ?, updated_at = NOW() WHERE id = ?", [$name, $avatarUrl, $userId]);
        
        session()->set('user_name', $name);
        session()->set('avatar_url', $avatarUrl);

        return redirect()->back()->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Update Password (POST)
     */
    public function updatePassword()
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;

        $userId = session()->get('user_id');
        $current = $this->request->getPost('current_password');
        $new = $this->request->getPost('new_password');
        $confirm = $this->request->getPost('confirm_password');

        if (empty($current) || empty($new) || empty($confirm)) {
            return redirect()->back()->with('error', 'Please fill in all password fields.');
        }

        if ($new !== $confirm) {
            return redirect()->back()->with('error', 'New password and confirm password do not match.');
        }

        if (strlen($new) < 8) {
            return redirect()->back()->with('error', 'New password must be at least 8 characters long.');
        }

        $user = $this->db->query("SELECT password FROM crm_users WHERE id = ? LIMIT 1", [$userId])->getRowArray();
        
        if (!password_verify($current, $user['password'])) {
            return redirect()->back()->with('error', 'Incorrect current password.');
        }

        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $this->db->query("UPDATE crm_users SET password = ?, updated_at = NOW() WHERE id = ?", [$hashed, $userId]);

        return redirect()->back()->with('success', 'Your password has been updated successfully.');
    }

    /**
     * Enquiries List
     */
    public function enquiries()
    {
        $redirect = $this->checkPermission('enquiries_access');
        if ($redirect) return $redirect;

        $data = $this->getCommonData();

        $data['kpis'] = [
            'enq_total' => $this->db->query("SELECT COUNT(*) as count FROM enquiries")->getRow()->count,
            'enq_new' => $this->db->query("SELECT COUNT(*) as count FROM enquiries WHERE status = 'New'")->getRow()->count,
            'enq_read' => $this->db->query("SELECT COUNT(*) as count FROM enquiries WHERE status = 'Read'")->getRow()->count,
            'enq_replied' => $this->db->query("SELECT COUNT(*) as count FROM enquiries WHERE status = 'Replied'")->getRow()->count,
            'enq_closed' => $this->db->query("SELECT COUNT(*) as count FROM enquiries WHERE status = 'Closed'")->getRow()->count,
        ];

        // Fetch paginated Enquiries
        $page = $this->request->getVar('page') ?? 1;
        $search = $this->request->getVar('search') ?? '';
        $status = $this->request->getVar('status') ?? 'all';
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $whereClause = "1=1";
        $params = [];

        if (!empty($search)) {
            $whereClause .= " AND (full_name LIKE ? OR email LIKE ? OR phone LIKE ? OR subject LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }

        if ($status !== 'all') {
            $whereClause .= " AND status = ?";
            $params[] = $status;
        }

        $countQueryStr = "SELECT COUNT(*) as count FROM enquiries WHERE $whereClause";
        $totalRows = $this->db->query($countQueryStr, $params)->getRow()->count;
        $totalPages = ceil($totalRows / $limit);

        $sql = "SELECT * FROM enquiries WHERE $whereClause ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $data['enquiries'] = $this->db->query($sql, $params)->getResultArray();

        $data['search'] = $search;
        $data['status'] = $status;
        $data['page'] = $page;
        $data['totalPages'] = $totalPages;
        $data['totalRows'] = $totalRows;

        return view('FortuneOneCRM/enquiries/Enquiries', $data);
    }

    /**
     * Enquiry Details
     */
    public function enquiryDetails($id = null)
    {
        $redirect = $this->checkPermission('enquiries_access');
        if ($redirect) return $redirect;

        if (!$id) return redirect()->to(base_url('enquiries'));

        $data = $this->getCommonData();
        
        $enq = $this->db->query("SELECT * FROM enquiries WHERE id = ?", [$id])->getRowArray();
        if (!$enq) return redirect()->to(base_url('enquiries'))->with('error', 'Enquiry not found.');
        
        // Auto mark as Read if New
        if ($enq['status'] === 'New') {
            $this->db->query("UPDATE enquiries SET status = 'Read', updated_at = NOW() WHERE id = ?", [$id]);
            $enq['status'] = 'Read';
        }

        $data['enq'] = $enq;
        return view('FortuneOneCRM/enquiries/EnquiryDetails', $data);
    }

    /**
     * Update Enquiry
     */
    public function updateEnquiry()
    {
        $redirect = $this->checkPermission('enquiries_manage');
        if ($redirect) return $redirect;

        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        if (empty($id) || empty($status)) {
            return $this->response->setJSON(['status' => false, 'message' => 'Missing data.']);
        }

        $this->db->query("UPDATE enquiries SET status = ?, updated_at = NOW() WHERE id = ?", [$status, $id]);
        
        return $this->response->setJSON(['status' => true, 'message' => 'Enquiry status updated.']);
    }


    /**
     * View Activity Logs (Admin Only)
     */
    public function activityLogs()
    {
        $this->checkAuth();
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Unauthorized access.');
        }
        
        $logs = $this->db->query("SELECT * FROM activity_logs ORDER BY timestamp DESC LIMIT 500")->getResultArray();
        
        // Passing logs to a new view that we will create.
        return view('FortuneOneCRM/settings/ActivityLogs', ['logs' => $logs]);
    }

}
