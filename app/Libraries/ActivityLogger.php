<?php

namespace App\Libraries;

use CodeIgniter\I18n\Time;

class ActivityLogger
{
    /**
     * Logs an activity to the database.
     *
     * @param string $action Example: "User Login", "Settings Updated"
     * @param string $module Example: "Auth", "Settings", "Appointments"
     * @param int|null $userId Optional specific user ID. If null, fetches from session.
     */
    public static function log($action, $module, $userId = null)
    {
        $session = session();
        
        $logData = [
            'user_id'    => $userId ?? $session->get('user_id') ?? 0,
            'user_name'  => $session->get('user_name') ?? 'System / Guest',
            'role'       => $session->get('role') ?? 'Guest',
            'action'     => $action,
            'module'     => $module,
            'ip_address' => service('request')->getIPAddress(),
            'browser'    => service('request')->getUserAgent()->getAgentString(),
            'timestamp'  => Time::now()->toDateTimeString(),
            'status'     => 'Logged'
        ];

        // Fire and forget insert for high performance
        $db = \Config\Database::connect();
        $db->table('activity_logs')->insert($logData);
    }
}
