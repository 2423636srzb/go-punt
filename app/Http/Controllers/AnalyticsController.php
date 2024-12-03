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
        
        $propertyId = '468590145'; // Replace with your property ID
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
}

