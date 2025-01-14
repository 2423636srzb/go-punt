<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function show()
    {
        // Retrieve match data from the database
        // $match = Match::findOrFail($matchId);

        // Pass match data to the view
        return view('home.match-detail');
    }
}
