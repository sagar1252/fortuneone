<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class WebToAppointmentController extends BaseController
{
    /**
     * Handles the CORS Preflight request (OPTIONS)
     */
    public function options()
    {
        return $this->response
            ->setHeader('Access-Control-Allow-Origin', '*') 
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS')
            ->setStatusCode(200);
    }

    /**
     * Handles the actual Appointment submission
     */
    public function submit()
    {
        // 1. Set CORS Headers
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        
        // 2. Define Validation Rules
        $validationRule = [
            'name' => 'required|min_length[2]|max_length[100]',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
            'email' => 'permit_empty|valid_email|max_length[255]',
            'date' => 'required',
            'time' => 'required',
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
        
        $source = esc($data['source'] ?? 'External Website Integration');

        // 4. Insert into the database (appointments table)
        $db = \Config\Database::connect();
        $db->table('appointments')->insert([
            'name'             => esc($data['name'] ?? ''),
            'phone'            => esc($data['phone'] ?? ''),
            'email'            => esc($data['email'] ?? ''),
            'project_name'     => 'Fortune One',
            'appointment_mode' => 'Site Visit',
            'preferred_date'   => esc($data['date']),
            'preferred_time'   => esc($data['time']),
            'status'           => 'Scheduled',
            'source'           => $source,
            'meeting_link'     => 'https://meet.google.com/ndf-aidw-pzd', // default from vista
            'notes'            => esc($data['message'] ?? ''),
            'created_at'       => date('Y-m-d H:i:s')
        ]);

        // 5. Return success response
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Appointment successfully submitted to the CRM.'
        ])->setStatusCode(200);
    }
}
