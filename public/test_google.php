<?php
require __DIR__ . '/../vendor/autoload.php';

try {
    echo "Starting...\n";
    $credentialsPath = __DIR__ . '/assets/credentials.json';
    $propertyId = '488145142';

    $client = new \Google\Client();
    $client->setAuthConfig($credentialsPath);
    $client->addScope('https://www.googleapis.com/auth/analytics.readonly');
    
    $analytics = new \Google\Service\AnalyticsData($client);
    
    echo "Client created.\n";

    $summaryRequest = new \Google\Service\AnalyticsData\RunReportRequest([
        'property' => "properties/{$propertyId}",
        'dateRanges' => [
            ['name' => 'current', 'startDate' => '7daysAgo', 'endDate' => 'today']
        ],
        'metrics' => [
            ['name' => 'activeUsers']
        ]
    ]);
    
    echo "Sending request...\n";
    $summaryResponse = $analytics->properties->runReport("properties/{$propertyId}", $summaryRequest);
    echo "Response received!\n";
    var_dump($summaryResponse->rows);
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage();
}
