<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class WebToLeadController extends BaseController
{
    /**
     * Handles the CORS Preflight request (OPTIONS)
     */
    public function options()
    {
        return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*') // Allows any domain to connect
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS')
            ->setStatusCode(200);
    }

    /**
     * Handles the actual Lead submission
     */
    public function submit()
    {
        // 1. Set CORS Headers to allow external websites to send data
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        
        // 2. Define Validation Rules
        $validationRule = [
            'name' => 'required|min_length[2]|max_length[100]',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
            'email' => 'permit_empty|valid_email|max_length[255]', // Email is optional, but if provided, must be valid
            'message' => 'permit_empty|max_length[2000]'
        ];

        if (!$this->validate($validationRule)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ])->setStatusCode(400);
        }

        // 3. Get Data
        $data = $this->request->getPost();
        
        // Use 'source' field if passed, otherwise default to 'External Website Integration'
        $source = esc($data['source'] ?? 'External Website Integration');
        
        // Determine the subject based on the source or message context
        $subject = esc($data['subject'] ?? 'External Lead Submission');

        // 4. Insert into the database (enquiries table)
        $db = \Config\Database::connect();
        $db->table('enquiries')->insert([
            'full_name' => esc($data['name'] ?? ''),
            'phone' => esc($data['phone'] ?? ''),
            'email' => esc($data['email'] ?? ''),
            'subject' => $subject,
            'message' => esc($data['message'] ?? ''),
            'status' => 'New',
            'source' => $source,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // 5. Return success response
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Lead successfully submitted to the CRM.'
        ])->setStatusCode(200);
    }
}
