<?php

namespace App\Controllers\FortuneOneAI;
use App\Controllers\BaseController;
use App\Libraries\GoogleSheetsService;

class LeadController extends BaseController
{
    public function submit()
    {
        // Only accept AJAX POST requests
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['status' => false, 'message' => 'Invalid request']);
        }

        // 1. Validate required fields
        $rules = [
            'name'  => 'required|min_length[3]',
            'phone' => 'required|min_length[10]',
            'email' => 'valid_email' // Email can be optional, but must be valid if provided
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => false,
                'errors' => $this->validator->getErrors()
            ]);
        }

        // 2. Prepare Lead Data
        $data = [
            'name'          => $this->request->getPost('name') ?? '',
            'phone'         => $this->request->getPost('phone') ?? '',
            'email'         => $this->request->getPost('email') ?? '',
            'location'      => $this->request->getPost('location') ?? '',
            'budget'        => $this->request->getPost('budget') ?? '',
            'property_type' => $this->request->getPost('property_type') ?? '',
            'purpose'       => $this->request->getPost('purpose') ?? '',
            'timeline'      => $this->request->getPost('timeline') ?? '',
            'created_at'    => date('Y-m-d H:i:s'),
            'lead_source'   => $this->request->getPost('lead_source') ?? 'Website Generic Form'
        ];

        // Format data into a flat array for Google Sheets
        // Expected Columns: Name, Phone, Email, Location, Budget, Property Type, Purpose, Timeline, Created Date/Time, Lead Source
        $rowArray = [
            $data['name'] ?? '',
            $data['phone'] ?? '',
            $data['email'] ?? '',
            $data['date'] ?? date('Y-m-d'),
            $data['slot'] ?? '',
            $data['source'] ?? 'Website Form',
            date('Y-m-d H:i:s'),
            'New'
        ];

        // 3. Connect to Google Sheets
        // Get Spreadsheet ID from .env or config
        $spreadsheetId = env('GOOGLE_LEADS_SPREADSHEET_ID');
        
        if (empty($spreadsheetId)) {
            log_message('error', 'Google Sheets Integration: GOOGLE_LEADS_SPREADSHEET_ID is missing in .env');
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Server configuration error: Missing Spreadsheet ID.'
            ]);
        }

        $googleSheetsService = new GoogleSheetsService();
        $result = $googleSheetsService->appendLead($spreadsheetId, $rowArray, 'Sheet1');

        if ($result['status']) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Lead submitted successfully.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Failed to connect to the tracking system. Please try again later.'
            ]);
        }
    }
}

