<?php

namespace App\Services;

use Google_Client;
use Google_Service_AnalyticsData;
use Illuminate\Support\Facades\Cache;
class GoogleAnalyticsService
{
    protected $analytics;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig(base_path(env('GOOGLE_APPLICATION_CREDENTIALS')));
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');

        $this->analytics = new Google_Service_AnalyticsData($client);
    }

    public function getActiveUsers($propertyId)
{
    // API call to get active users data from Google Analytics
    $response = $this->analytics->properties->runRealtimeReport(
        "properties/{$propertyId}",
        new \Google_Service_AnalyticsData_RunRealtimeReportRequest([
            'metrics' => [['name' => 'activeUsers']],
        ])
    );

    // Return the API response as a simple object
    return $response->toSimpleObject();
}


public function getUniqueUsers($propertyId, $startDate, $endDate)
{
    $response = $this->analytics->properties->runReport(
        "properties/{$propertyId}",
        new \Google_Service_AnalyticsData_RunReportRequest([
            'dateRanges' => [
                ['startDate' => $startDate, 'endDate' => $endDate],
            ],
            'metrics' => [['name' => 'totalUsers']], // Make sure the correct metric is passed here
        ])
    );

    return $response->toSimpleObject();
}

public function getNewUsers($propertyId, $startDate, $endDate)
{
    $response = $this->analytics->properties->runReport(
        "properties/{$propertyId}",
        new \Google_Service_AnalyticsData_RunReportRequest([
            'dateRanges' => [
                ['startDate' => $startDate, 'endDate' => $endDate],
            ],
            'metrics' => [['name' => 'newUsers']], // Ensure newUsers metric is used here
        ])
    );

    return $response->toSimpleObject();
}


public function getAvgEngagementTime($propertyId, $startDate, $endDate)
{
    $response = $this->analytics->properties->runReport(
        "properties/{$propertyId}",
        new \Google_Service_AnalyticsData_RunReportRequest([
            'dateRanges' => [
                ['startDate' => $startDate, 'endDate' => $endDate],
            ],
            'metrics' => [
                ['name' => 'engagementRate'], // Total engagement time in seconds
                ['name' => 'sessions'], // Total sessions
            ],
        ])
    );

    // Extract metric values
    $userEngagementDuration = $response->toSimpleObject()->rows[0]->metricValues[0]->value ?? 0;
    $sessions = $response->toSimpleObject()->rows[0]->metricValues[1]->value ?? 1;

    // Calculate the average engagement time
    if ($sessions > 0) {
        $averageEngagementTime = $userEngagementDuration / $sessions;
    } else {
        $averageEngagementTime = 0;
    }

    // Return formatted engagement time
    return $this->formatEngagementTime($averageEngagementTime);
}


private function formatEngagementTime($seconds)
{
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $remainingSeconds = $seconds % 60;

    // Format as HH:MM:SS
    return sprintf("%02d:%02d:%02d", $hours, $minutes, $remainingSeconds);
}


}
