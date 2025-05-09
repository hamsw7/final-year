<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $cities = [
            'Addis Ababa',
            'Dire Dawa',
            'Bahir Dar',
            'Gondar',
            'Hawassa',
            'Mekelle',
            'Jimma',
            'Harar',
            'Adama',
            'Axum'
        ];

        $city = $request->input('city', 'Addis Ababa'); // default
        $weather = null;
        $error = null;

        try {
            $apiKey = env('OPENWEATHER_API_KEY');

            $response = Http::timeout(10)->get("https://api.openweathermap.org/data/2.5/weather", [
                'q'     => $city,
                'appid' => $apiKey,
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                $weather = $response->json();
            } else {
                $error = "Could not fetch weather for '{$city}'.";
            }
        } catch (\Exception $e) {
            $error = "An error occurred: " . $e->getMessage();
        }

        return view('weather.index', compact('cities', 'weather', 'error', 'city'));
    }
}
