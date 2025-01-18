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
    public function cricketLive($eventId, $sportId)
    {
        $match = $this->sportsService->getSpecificSportData($eventId);

        dd($match);
        if (!$match) {
            return redirect()->back()->with('error', ' match not found.');
        }

        return view('home.match',compact('eventId','sportId','match'));
    }
}
