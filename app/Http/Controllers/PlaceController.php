<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function places(Request $request)
    {
        $latitude = $request->input('lat');
        $longitude = $request->input('long');
        $radius = 5000; // 5 kilometers

        $apiKey = env('GOOGLE_API_KEY');
        $apiUrl = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$latitude,$longitude&radius=$radius&key=$apiKey";

        $client = new Client();
        $response = $client->get($apiUrl);
        $places = json_decode($response->getBody(), true)['results'];

        return response([
            "places" => $places
        ]);
    }
}
