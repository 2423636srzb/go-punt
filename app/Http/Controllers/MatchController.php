<?php

namespace App\Http\Controllers;

use App\Services\SportsService;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    protected $sportsService;

    public function __construct(SportsService $sportsService)
    {
       
        $this->sportsService = $sportsService;
    }
    public function cricketLive($eventId, $sportId,$channelId)
    {   
        // $sportsData = $this->sportsService->getSpecificSportData($eventId);
        // dd($sportsData);
        return view('home.match',compact('eventId','sportId','channelId'));
    }
}
