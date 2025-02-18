<?php

namespace App\Http\Controllers;
use App\Services\SportsService;

use Illuminate\Http\Request;

class MatchController extends Controller
{

    public function cricketLive($eventId, $sportId,$channelId)
    {
        return view('home.match',compact('eventId','sportId','channelId'));
    }
}
