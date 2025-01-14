<?php

namespace App\Http\Controllers;

use App\Services\GoogleAnalyticsService;

class AnalyticsController extends Controller
{
    protected $analytics;

    public function __construct(GoogleAnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    public function index()
    {
        
        $propertyId = '472074192'; // Replace with your property ID
        $activeUsers = $this->analytics->getActiveUsers($propertyId);
        $uniqueUsers = $this->analytics->getUniqueUsers($propertyId, '30daysAgo', 'today');
        $newUsers = $this->analytics->getNewUsers($propertyId, '30daysAgo', 'today');
       
           // Get engagement time and process it
           $avgEngagementTimeFormatted = $this->analytics->getAvgEngagementTime($propertyId, '7daysAgo', 'today');

    // Pass both formatted and milliseconds data to the view
    return view('analytics.index', [
        'activeUsers' => $activeUsers,
        'uniqueUsers' => $uniqueUsers,
        'newUsers' => $newUsers,
        'avgEngagementTimeFormatted' => $avgEngagementTimeFormatted, // MM:SS format
    ]);
    }


    public function fetchData()
    {
    $propertyId = '472074192'; // Replace with your property ID

    $activeUsers = $this->analytics->getActiveUsers($propertyId);
    $uniqueUsers = $this->analytics->getUniqueUsers($propertyId, '30daysAgo', 'today');
    $newUsers = $this->analytics->getNewUsers($propertyId, '30daysAgo', 'today');
    $avgEngagementTimeFormatted = $this->analytics->getAvgEngagementTime($propertyId, '7daysAgo', 'today');

    return response()->json([
        'activeUsers' => $activeUsers->rows[0]->metricValues[0]->value ?? 'No active users',
        'uniqueUsers' => $uniqueUsers->rows[0]->metricValues[0]->value ?? 'N/A',
        'newUsers' => $newUsers->rows[0]->metricValues[0]->value ?? 'N/A',
        'avgEngagementTime' => $avgEngagementTimeFormatted,
    ]);
    }

}

