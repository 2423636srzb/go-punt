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
        $uniqueUsers = $this->analytics->getUniqueUsers($propertyId, '7daysAgo', 'today');
        // dd($uniqueUsers);
        return view('analytics.index', compact('activeUsers', 'uniqueUsers'));
    }
}

