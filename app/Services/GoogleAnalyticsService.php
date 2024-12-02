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
}
