<?php

namespace App\Controllers\Website;
use App\Controllers\BaseController;

class ContactController extends BaseController
{
    private function sendEmail($to, $subject, $message, $replyTo = null, $attachment = null, $cc = null)
    {
        $emailConfig = config('Email');
        $email = \Config\Services::email();
        $email->initialize($emailConfig);
        $email->setMailType('html');

        $email->setFrom($emailConfig->fromEmail ?? 'your@gmail.com', $emailConfig->fromName ?? 'Fortune One');
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($replyTo) {
            $email->setReplyTo($replyTo);
        }
        
        if ($cc) {
            $email->setCC($cc);
        }

        if ($attachment && file_exists($attachment)) {
            $email->attach($attachment);
        }

        return $email->send();
    }

    public function contactSubmit()
    {
        $validationRule = [
            'name' => 'required|min_length[2]|max_length[100]',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
            'email' => 'required|valid_email|max_length[255]',
            'subject' => 'required|max_length[255]',
            'message' => 'required|max_length[2000]'
        ];
        
        if (!$this->validate($validationRule)) {
            return redirect()->to(base_url('contact'))->with('error', 'Validation failed. Please check your inputs.');
        }

        $data = $this->request->getPost();
        
        $message = "
        <h3>New Contact Inquiry</h3>
        <p><strong>Name:</strong> " . esc($data['name']) . "</p>
        <p><strong>Phone:</strong> " . esc($data['phone']) . "</p>
        <p><strong>Email:</strong> " . esc($data['email']) . "</p>
        <p><strong>Subject:</strong> " . esc($data['subject']) . "</p>
        <p><strong>Message:</strong><br/>" . nl2br(esc($data['message'])) . "</p>
        ";

        if ($this->sendEmail('cbo@fortuneone.co', 'New Contact Inquiry: ' . esc($data['subject']), $message, $data['email'])) {
            $sent = true;
            
            // Send Auto-Reply to User
            $userData = [
                'name' => esc($data['name'] ?? 'Guest'),
                'custom_message' => 'We have successfully received your enquiry. The Fortune One team will connect with you shortly.'
            ];
            $userMessage = view('common/Email/enquiry_reply', $userData);
            $this->sendEmail($data['email'], 'Thank you for your Enquiry - Fortune One', $userMessage);
        } else {
            $sent = false;
        }

        $db = \Config\Database::connect();
        $db->table('enquiries')->insert([
            'full_name' => esc($data['name'] ?? ''),
            'phone' => esc($data['phone'] ?? ''),
            'email' => esc($data['email'] ?? ''),
            'subject' => esc($data['subject'] ?? ''),
            'message' => esc($data['message'] ?? ''),
            'status' => 'New',
            'source' => 'Website Contact Form',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($sent) {
            return redirect()->to(base_url('contact'))->with('success', 'Your message has been sent successfully.');
        } else {
            return redirect()->to(base_url('contact'))->with('error', 'Failed to send message. Please try again later.');
        }
    }

    public function careerSubmit()
    {
        $validationRule = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[255]',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
            'post' => 'required|max_length[100]',
            'resume' => 'uploaded[resume]|max_size[resume,10240]|ext_in[resume,pdf]|mime_in[resume,application/pdf]'
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->to(base_url('career'))->with('error', 'Invalid submission. Ensure all fields are filled correctly and your resume is a PDF under 10MB.');
        }

        $data = $this->request->getPost();
        
        $message = "
        <h3>New Job Application</h3>
        <p><strong>Name:</strong> " . esc($data['name']) . "</p>
        <p><strong>Email:</strong> " . esc($data['email']) . "</p>
        <p><strong>Phone:</strong> " . esc($data['phone']) . "</p>
        <p><strong>Applied for Post:</strong> " . esc($data['post']) . "</p>
        <p><strong>Qualification:</strong> " . esc($data['qualification']) . "</p>
        ";

        $attachmentPath = null;
        $resumeUrl = null;
        $file = $this->request->getFile('resume');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $allowedMimeTypes = ['application/pdf'];
            
            if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
                return redirect()->to(base_url('career'))->with('error', 'Invalid file type. Only PDF documents are allowed.');
            }

            $newName = $file->getRandomName();
            $targetDir = WRITEPATH . 'uploads/resumes/'; // Moved outside public root
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $file->move($targetDir, $newName);
            
            // Note: Since this is now outside the webroot, we shouldn't serve it directly via URL.
            // We just store the backend path.
            $resumeUrl = 'writable/uploads/resumes/' . $newName;
            $attachmentPath = $targetDir . $newName;
        }

        // Send Email
        $sent = $this->sendEmail('hr@fortuneone.co', 'New Job Application: ' . esc($data['post'] ?? 'Position'), $message, $data['email'] ?? null, $attachmentPath);

        // Insert into career_applications database table
        $db = \Config\Database::connect();
        $db->table('career_applications')->insert([
            'full_name' => esc($data['name'] ?? ''),
            'email' => esc($data['email'] ?? ''),
            'phone' => esc($data['phone'] ?? ''),
            'position_applied' => esc($data['post'] ?? ''),
            'experience' => esc($data['experience'] ?? 'Not Specified'),
            'current_location' => esc($data['location'] ?? 'Not Specified'),
            'current_company' => esc($data['current_company'] ?? ''),
            'current_designation' => esc($data['current_designation'] ?? ''),
            'expected_salary' => esc($data['expected_salary'] ?? ''),
            'notice_period' => esc($data['notice_period'] ?? ''),
            'linkedin_url' => esc($data['linkedin'] ?? ''),
            'portfolio_url' => esc($data['portfolio'] ?? ''),
            'resume_url' => $resumeUrl,
            'status' => 'New',
            'source' => 'Website Career Page',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($sent) {
            return redirect()->to(base_url('career'))->with('success', 'Your application has been submitted successfully.');
        } else {
            return redirect()->to(base_url('career'))->with('success', 'Your application has been submitted successfully.');
        }
    }

    public function nriSubmit()
    {
        $validationRule = [
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[255]',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
            'country' => 'required|max_length[100]',
            'query' => 'required|max_length[2000]'
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->to(base_url('nrisupport'))->with('error', 'Validation failed. Please check your inputs.');
        }

        $data = $this->request->getPost();
        
        $message = "
        <h3>New NRI Support Inquiry</h3>
        <p><strong>Name:</strong> " . esc($data['name']) . "</p>
        <p><strong>Email:</strong> " . esc($data['email']) . "</p>
        <p><strong>Phone:</strong> " . esc($data['phone']) . "</p>
        <p><strong>Country of Residence:</strong> " . esc($data['country']) . "</p>
        <p><strong>Query:</strong><br/>" . nl2br(esc($data['query'])) . "</p>
        ";

        if ($this->sendEmail('hr@fortuneone.co', 'NRI Support Inquiry from ' . esc($data['name']), $message, $data['email'], null, 'cbo@fortuneone.co')) {
            $sent = true;

            // Send Auto-Reply to User
            $userData = [
                'name' => esc($data['name'] ?? 'Guest'),
                'custom_message' => 'We have successfully received your NRI support enquiry. The Fortune One team will connect with you shortly.'
            ];
            $userMessage = view('common/Email/enquiry_reply', $userData);
            $this->sendEmail($data['email'], 'Thank you for your Enquiry - Fortune One', $userMessage);
        } else {
            $sent = false;
        }

        $db = \Config\Database::connect();
        $db->table('enquiries')->insert([
            'full_name' => esc($data['name'] ?? ''),
            'phone' => esc($data['phone'] ?? ''),
            'email' => esc($data['email'] ?? ''),
            'subject' => 'NRI Support Inquiry: ' . esc($data['country'] ?? ''),
            'message' => esc($data['query'] ?? ''),
            'status' => 'New',
            'source' => 'NRI Support Form',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($sent) {
            return redirect()->to(base_url('nrisupport'))->with('success', 'Your inquiry has been submitted successfully. Our NRI desk will reach out soon.');
        } else {
            return redirect()->to(base_url('nrisupport'))->with('error', 'Failed to submit inquiry. Please try again later.');
        }
    }

    public function homeSubmit()
    {
        $validationRule = [
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name' => 'required|max_length[100]',
            'organization' => 'required|max_length[255]',
            'email' => 'required|valid_email|max_length[255]',
            'enquiry_type' => 'required|max_length[100]',
            'message' => 'required|max_length[2000]'
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->to(base_url(''))->with('error', 'Validation failed. Please check your inputs.');
        }

        $data = $this->request->getPost();
        
        $message = "
        <h3>New Homepage Inquiry</h3>
        <p><strong>First Name:</strong> " . esc($data['first_name']) . "</p>
        <p><strong>Last Name:</strong> " . esc($data['last_name']) . "</p>
        <p><strong>Organisation:</strong> " . esc($data['organization']) . "</p>
        <p><strong>Email:</strong> " . esc($data['email']) . "</p>
        <p><strong>Nature of Enquiry:</strong> " . esc($data['enquiry_type']) . "</p>
        <p><strong>Message:</strong><br/>" . nl2br(esc($data['message'])) . "</p>
        ";

        if ($this->sendEmail('cbo@fortuneone.co', 'New Homepage Inquiry: ' . esc($data['enquiry_type']), $message, $data['email'])) {
            $sent = true;

            // Send Auto-Reply to User
            $userData = [
                'name' => esc($data['first_name'] ?? 'Guest'),
                'custom_message' => 'We have successfully received your enquiry. The Fortune One team will connect with you shortly.'
            ];
            $userMessage = view('common/Email/enquiry_reply', $userData);
            $this->sendEmail($data['email'], 'Thank you for your Enquiry - Fortune One', $userMessage);
        } else {
            $sent = false;
        }

        $db = \Config\Database::connect();
        $full_name = trim(esc($data['first_name'] ?? '') . ' ' . esc($data['last_name'] ?? ''));
        $db->table('enquiries')->insert([
            'full_name' => $full_name,
            'phone' => '', 
            'email' => esc($data['email'] ?? ''),
            'subject' => esc($data['enquiry_type'] ?? 'General Inquiry'),
            'message' => "Organization: " . esc($data['organization'] ?? '') . "\n\n" . esc($data['message'] ?? ''),
            'status' => 'New',
            'source' => 'Homepage Inquiry Form',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if ($sent) {
            return redirect()->to(base_url(''))->with('success', 'Your inquiry has been submitted successfully.');
        } else {
            return redirect()->to(base_url(''))->with('error', 'Failed to submit inquiry. Please try again later.');
        }
    }

    public function brochureDownload()
    {
        $validationRule = [
            'name' => 'required|min_length[2]|max_length[100]',
            'phone' => 'required|numeric|min_length[10]|max_length[15]',
            'email' => 'required|valid_email|max_length[255]',
            'pdf_url' => 'required'
        ];
        
        if (!$this->validate($validationRule)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Validation failed. Please check your inputs.']);
        }

        $data = $this->request->getPost();
        
        $message = "
        <h3>New Brochure Download Request</h3>
        <p><strong>Name:</strong> " . esc($data['name']) . "</p>
        <p><strong>Phone:</strong> " . esc($data['phone']) . "</p>
        <p><strong>Email:</strong> " . esc($data['email']) . "</p>
        <p><strong>Brochure Requested:</strong> " . esc($data['pdf_url']) . "</p>
        ";

        $this->sendEmail('cbo@fortuneone.co', 'New Brochure Download: ' . esc($data['name']), $message, $data['email']);

        $db = \Config\Database::connect();
        $db->table('enquiries')->insert([
            'full_name' => esc($data['name'] ?? ''),
            'phone' => esc($data['phone'] ?? ''),
            'email' => esc($data['email'] ?? ''),
            'subject' => 'Brochure Download',
            'message' => 'Requested Brochure: ' . esc($data['pdf_url']),
            'status' => 'New',
            'source' => 'Website Brochure Form',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON(['status' => 'success', 'pdf_url' => esc($data['pdf_url'])]);
    }
}

