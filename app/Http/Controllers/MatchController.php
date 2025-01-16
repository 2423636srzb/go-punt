<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function cricketLive()
    {
        return view('home.cricket');
    }
    public function tennisLive()
    {
        return view('home.tennis');
    }
    public function footballLive()
    {
        return view('home.football');
    }
}
