<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SportsService
{
    public function getAllSportsData()
    {
        // Fetch from first API
        $response = Http::get('http://172.105.54.97:8085/api/new/tveventlist');
        // Return decoded JSON
        return $response->json();
    }

    public function getSpecificSportData($eventId)
    {
        // Fetch from the second API
        $response = Http::get("https://live.oldd247.com/sr.php?eventid=$eventId");
        if ($response->ok()) {
            $data = $response->json();
            dd($data); // Ensure $data is not null
        } else {
            dd('API Error:', $response->status(), $response);
        }

    }
}
