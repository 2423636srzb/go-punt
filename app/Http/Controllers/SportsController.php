<?php

namespace App\Http\Controllers;

use App\Services\SportsService;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    protected $sportsService;

    public function __construct(SportsService $sportsService)
    {
        $this->sportsService = $sportsService;
    }

    public function index(Request $request)
    {
        // Fetch all sports data
        $sportsData = $this->sportsService->getAllSportsData();

        return view('sports.index', compact('sportsData'));
    }
}