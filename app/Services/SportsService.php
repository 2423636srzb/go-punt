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
        if (empty($eventId)) {
            dd("event id is missing");
            return response()->json(['error' => 'Event ID is required'], 400);
        }

        // Fetch from the API
        $response = Http::get("https://live.oldd247.com/sr.php", [
            'eventid' => $eventId
        ]);

        if ($response->successful()) {
            dd("success");
            return response()->json($response->json());
        } else {
            dd($response);
            return response()->json([
                'error' => 'API request failed',
                'status' => $response->status(),
                'details' => $response->body()
            ], $response->status());
        }
    }

}
