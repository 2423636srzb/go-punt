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
        // Cache key is unique to the propertyId
        $cacheKey = "analytics_active_users_{$propertyId}";

        // Try to get the data from cache, or fetch from API if not cached
        return Cache::remember($cacheKey, 3600, function () use ($propertyId) {
            // API call to get active users data from Google Analytics
            $response = $this->analytics->properties->runRealtimeReport(
                "properties/{$propertyId}",
                new \Google_Service_AnalyticsData_RunRealtimeReportRequest([
                    'metrics' => [['name' => 'activeUsers']],
                ])
            );

            // Return the API response as a simple object
            return $response->toSimpleObject();
        });
    }

    public function getUniqueUsers($propertyId, $startDate, $endDate)
    {
        $response = $this->analytics->properties->runReport(
            "properties/{$propertyId}",
            new \Google_Service_AnalyticsData_RunReportRequest([
                'dateRanges' => [
                    ['startDate' => $startDate, 'endDate' => $endDate],
                ],
                'metrics' => [['name' => 'totalUsers']],
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
            'metrics' => [['name' => 'newUsers']],
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
            'metrics' => [['name' => 'engagementRate']],
        ])
    );
   
    // Get the engagement rate value in seconds
    $engagementRate = $response->toSimpleObject()->rows[0]->metricValues[0]->value ?? 0;

    // Format the engagement rate into MM:SS format
    $formattedEngagementRate = $this->formatEngagementTime($engagementRate);

    // Convert engagement rate to milliseconds with 2 decimal places
    $engagementRateInMilliseconds = $this->convertToMilliseconds($engagementRate);

    return [
        'formatted' => $formattedEngagementRate,
        'milliseconds' => $engagementRateInMilliseconds,
    ];
}

private function formatEngagementTime($seconds)
{
    // Convert seconds into minutes and seconds format
    $minutes = floor($seconds / 60);
    $remainingSeconds = $seconds % 60;

    // Format it as MM:SS
    return sprintf("%02d:%02d", $minutes, $remainingSeconds);
}

private function convertToMilliseconds($seconds)
{
    // Convert seconds to milliseconds and format to 2 decimal places
    $milliseconds = $seconds * 1000;
    return number_format($milliseconds, 2); // Format to 2 decimal places
}

}
