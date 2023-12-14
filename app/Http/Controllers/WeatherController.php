<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class WeatherController extends Controller
{
    public function index(WeatherService $weatherService)
    {
        // Fetch the weather data
        $weather = $weatherService->getCurrentWeather('London'); // Replace 'London' as needed

        // Pass the weather data to the view
        return view('weather.index', compact('weather'));
    }
}
