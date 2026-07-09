<?php

namespace App\Libraries;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Exception;

class GoogleSheetsService
{
    private $client;
    private $service;
    private $credentialsPath;

    public function __construct()
    {
        $this->credentialsPath = FCPATH . 'assets/fortune-one-website-leads-0349fd1bd031.json';
        $this->initClient();
    }

    private function initClient()
    {
        if (!file_exists($this->credentialsPath)) {
            log_message('error', 'Google Sheets Error: Credentials file not found at ' . $this->credentialsPath);
            throw new Exception("Google Credentials file missing.");
        }

        $this->client = new Client();
        $this->client->setAuthConfig($this->credentialsPath);
        $this->client->addScope(Sheets::SPREADSHEETS);
        $this->client->setAccessType('offline');

        $this->service = new Sheets($this->client);
    }

    /**
     * Appends a new lead to the Google Sheet.
     * Prevents duplicate phone numbers if a match is found.
     */
    public function appendLead(string $spreadsheetId, array $leadData, string $range = 'Sheet1')
    {
        try {
            // 1. Check for duplicates based on Phone (assuming Phone is in the 2nd column, index 1)
            // Adjust the index if your column order changes.
            if (!empty($leadData[1])) {
                $isDuplicate = $this->checkIfPhoneExists($spreadsheetId, $range, $leadData[1]);
                if ($isDuplicate) {
                    log_message('info', 'Google Sheets: Duplicate lead skipped for phone ' . $leadData[1]);
                    return ['status' => true, 'message' => 'Lead already exists']; // Return true to not fail the frontend
                }
            }

            // 2. Append new row
            $body = new ValueRange([
                'values' => [$leadData]
            ]);

            $params = [
                'valueInputOption' => 'USER_ENTERED'
            ];

            $result = $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

            return ['status' => true, 'updatedRows' => $result->getUpdates()->getUpdatedRows()];
        } catch (Exception $e) {
            log_message('error', 'Google Sheets Append Error: ' . $e->getMessage());
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Checks if a phone number already exists in the sheet to prevent duplicates.
     */
    private function checkIfPhoneExists(string $spreadsheetId, string $range, string $phone): bool
    {
        try {
            $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
            $values = $response->getValues();

            if (empty($values)) {
                return false;
            }

            // Assume phone is the 2nd column (index 1) based on standard data structure
            // Row data: Name, Phone, Email, Location, Budget, Property Type, Purpose, Timeline, Created Date/Time, Lead Source
            foreach ($values as $row) {
                if (isset($row[1])) {
                    // Clean both numbers for comparison
                    $existingPhone = preg_replace('/[^0-9]/', '', $row[1]);
                    $incomingPhone = preg_replace('/[^0-9]/', '', $phone);
                    
                    if (!empty($existingPhone) && $existingPhone === $incomingPhone) {
                        return true;
                    }
                }
            }

            return false;
        } catch (Exception $e) {
            log_message('error', 'Google Sheets Check Duplicate Error: ' . $e->getMessage());
            // If we fail to check, default to false so we don't block submissions
            return false;
        }
    }
}
