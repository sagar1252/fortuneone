<?php

namespace App\Controllers\Website;
use App\Controllers\BaseController;

class BookingController extends BaseController
{
    public function index()
    {
        return view('Website/booking_view');
    }

    public function getBookedSlots()
    {
        $bookingsFile = WRITEPATH . 'bookings.json';
        $bookings = [];
        if (file_exists($bookingsFile)) {
            $bookings = json_decode(file_get_contents($bookingsFile), true) ?? [];
        }
        return $this->response->setJSON(['status' => true, 'booked_slots' => $bookings]);
    }

    public function send()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['status' => false, 'message' => 'Invalid request']);
        }

        $rules = [
            'full_name'     => 'required|min_length[3]|max_length[100]',
            'email'         => 'required|valid_email|max_length[255]',
            'phone'         => 'required|numeric|min_length[10]|max_length[15]',
            'selected_date' => 'required',
            'selected_time' => 'required',
            'message'       => 'permit_empty|max_length[2000]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'full_name'     => $this->request->getPost('full_name'),
            'email'         => $this->request->getPost('email'),
            'phone'         => $this->request->getPost('phone'),
            'selected_date' => $this->request->getPost('selected_date'),
            'selected_time' => $this->request->getPost('selected_time'),
            'message'       => $this->request->getPost('message'),
        ];

        // Double-booking Check
        $bookingsFile = WRITEPATH . 'bookings.json';
        $bookings = [];
        if (file_exists($bookingsFile)) {
            $bookings = json_decode(file_get_contents($bookingsFile), true) ?? [];
        }
        
        $slotKey = $data['selected_date'] . '_' . $data['selected_time'];
        if (in_array($slotKey, $bookings)) {
            return $this->response->setJSON([
                'status' => false, 
                'error_type' => 'slot_full',
                'message' => 'This time slot is already booked. Please choose a different slot.'
            ]);
        }

        // Save new booking slot
        $bookings[] = $slotKey;
        if (is_writable(WRITEPATH)) {
            file_put_contents($bookingsFile, json_encode($bookings));
        } else {
            log_message('error', 'WRITEPATH is not writable. Cannot save bookings.json');
        }

        // Insert into CRM database
        try {
            $db = \Config\Database::connect();
            $meetingLink = 'https://meet.google.com/zkr-hfzf-tuo'; // Hardcoded for now based on existing logic
            $db->table('appointments')->insert([
                'name'             => esc($data['full_name']),
                'phone'            => esc($data['phone'] ?? ''),
                'email'            => esc($data['email']),
                'project_name'     => 'Fortune One',
                'appointment_mode' => 'Site Visit',
                'preferred_date'   => esc($data['selected_date']),
                'preferred_time'   => esc($data['selected_time']),
                'status'           => 'Scheduled',
                'source'           => 'Website',
                'meeting_link'     => $meetingLink,
                'notes'            => esc($data['message'] ?? ''),
                'created_at'       => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Failed to insert appointment into database: ' . $e->getMessage());
        }

        // --- ASYNC EARLY RESPONSE (Background Processing) ---
        // This instantly tells the frontend "Success" while we process Sheets, Calendar, & Email in the background.
        if (function_exists('fastcgi_finish_request')) {
            $this->response->setJSON(['status' => true, 'message' => 'Booking confirmed.'])->send();
            fastcgi_finish_request();
        } else {
            ignore_user_abort(true);
            ob_start();
            $responseJson = json_encode(['status' => true, 'message' => 'Booking confirmed.']);
            header('Connection: close');
            header('Content-Length: ' . strlen($responseJson));
            header('Content-Type: application/json');
            echo $responseJson;
            ob_end_flush();
            flush();
        }

        // Close session to allow user to keep navigating while background tasks run
        if (session_status() === PHP_SESSION_ACTIVE) session_write_close();

        // Push to Google Sheets Lead Tracker
        try {
            $spreadsheetId = env('GOOGLE_LEADS_SPREADSHEET_ID');
            if (!empty($spreadsheetId)) {
                $googleSheetsService = new \App\Libraries\GoogleSheetsService();
                $sheetData = [
                    $data['full_name'],                             // Name
                    $data['phone'],                                 // Phone
                    $data['email'],                                 // Email
                    $data['selected_date'],                         // Date
                    $data['selected_time'],                         // Slot
                    'Appointment Popup',                            // Source
                    date('Y-m-d H:i:s'),                            // Created at
                    'New',                                          // Status
                    'https://meet.google.com/zkr-hfzf-tuo'          // Google Meet Link
                ];
                $googleSheetsService->appendLead($spreadsheetId, $sheetData, 'Sheet1');
            }
        } catch (\Exception $e) {
            log_message('error', 'Failed to push booking to Google Sheets: ' . $e->getMessage());
        }

        // Create Google Calendar Event
        $googleCalendarCreated = false;
        try {
            $credentialPath = ROOTPATH . env('GOOGLE_APPLICATION_CREDENTIALS');
            if (file_exists($credentialPath) && class_exists('Google_Client')) {
                $client = new \Google_Client();
                $client->setAuthConfig($credentialPath);
                $client->addScope(\Google_Service_Calendar::CALENDAR);
                
                $service = new \Google_Service_Calendar($client);
                
                $startDateTime = date('c', strtotime($data['selected_date'] . ' ' . $data['selected_time']));
                $endDateTime = date('c', strtotime($startDateTime . ' +1 hour')); // Assumed 1 hour meeting
                
                $event = new \Google_Service_Calendar_Event([
                    'summary' => 'Meeting for Fortune One is scheduled with ' . $data['full_name'],
                    'description' => "Phone: {$data['phone']}\nMessage: {$data['message']}",
                    'start' => [
                        'dateTime' => $startDateTime,
                        'timeZone' => 'Asia/Kolkata', // Set appropriate timezone
                    ],
                    'end' => [
                        'dateTime' => $endDateTime,
                        'timeZone' => 'Asia/Kolkata',
                    ],
                    'attendees' => [
                        ['email' => $data['email']],
                    ],
                    'reminders' => [
                        'useDefault' => FALSE,
                        'overrides' => [
                            ['method' => 'email', 'minutes' => 24 * 60], // 24 hours before
                            ['method' => 'popup', 'minutes' => 60],      // 1 hour before
                        ],
                    ],
                ]);
                
                $calendarId = env('GOOGLE_CALENDAR_ID');
                $event = $service->events->insert($calendarId, $event, ['sendUpdates' => 'all']);
                $googleCalendarCreated = true;
            }
        } catch (\Exception $e) {
            log_message('error', 'Google Calendar Error: ' . $e->getMessage());
        }

        $emailConfig = config('Email');
        $email = \Config\Services::email();

        // Fix for local XAMPP SSL certificate missing (only if file exists locally)
        if (file_exists('C:\xampp\apache\bin\curl-ca-bundle.crt')) {
            ini_set('openssl.cafile', 'C:\xampp\apache\bin\curl-ca-bundle.crt');
            ini_set('curl.cainfo', 'C:\xampp\apache\bin\curl-ca-bundle.crt');
        }

        $email->initialize($emailConfig);
        $email->setMailType('html');

        $email->setFrom($emailConfig->fromEmail ?? 'your@gmail.com', $emailConfig->fromName ?? 'Booking System');
        $email->setTo('cbo@fortuneone.co');
        $email->setSubject('New Meeting Request');
        
        // Admin email data
        $adminData = $data;
        $email->setMessage(view('common/Email/booking_email', $adminData));
        $adminSent = $email->send();
        if (!$adminSent) {
            log_message('error', 'Failed to send admin confirmation email. Error: ' . $email->printDebugger(['headers']));
        }

        // User confirmation email
        $email->clear();
        $email->setMailType('html');
        $email->setFrom($emailConfig->fromEmail ?? 'your@gmail.com', $emailConfig->fromName ?? 'Fortune One Booking');
        $email->setTo($data['email']);
        $email->setSubject('Booking Confirmation - Fortune One');
        
        $userData = $data;
        $userData['is_user'] = true;
        $email->setMessage(view('common/Email/booking_email', $userData));
        $userSent = $email->send();
        if (!$userSent) {
            log_message('error', 'Failed to send user confirmation email. Error: ' . $email->printDebugger(['headers']));
        }

        // Attempt to send WhatsApp message if phone is provided
        $this->sendWhatsAppMessage($data['phone'], $data['selected_date'], $data['selected_time']);
        
        exit; // End execution without returning a CI4 Response, as we already flushed the output.
    }

    private function sendWhatsAppMessage($phone, $date, $time)
    {
        if (empty($phone)) return;
        
        // Twilio WhatsApp API Credentials (to be added to .env)
        $sid    = env('twilio.sid', 'your_twilio_sid');
        $token  = env('twilio.token', 'your_twilio_token');
        $from   = env('twilio.from', 'whatsapp:+14155238886'); // Default Twilio sandbox number
        
        // Format phone number (Twilio expects E.164 format, assuming India +91 for example if missing)
        $toPhone = (strpos($phone, '+') === false) ? '+91' . ltrim($phone, '0') : $phone;
        $to = 'whatsapp:' . $toPhone;
        
        $message = "Hello! Your Appointment with Fortune One is confirmed for {$date} at {$time}.\n\nJoin Google Meet link: https://meet.google.com/zkr-hfzf-tuo";

        // Skip execution if API credentials are not yet configured in .env
        if ($sid === 'your_twilio_sid') return;

        $url = "https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json";
        
        $data = [
            'From' => $from,
            'To' => $to,
            'Body' => $message
        ];
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$sid:$token");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);
        curl_close($ch);
    }
}

