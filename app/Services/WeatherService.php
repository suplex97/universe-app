<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    public function getCurrentWeather($city)
    {
        $response = Http::get("http://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric'
        ]);
        \Log::info('Weather API Response:', $response->json());

        if ($response->successful()) {
            return $response->json();
            if (!empty($data['weather'][0]['icon'])) {
                
                $iconCode = $data['weather'][0]['icon'];
                dd($iconCode);
            $data['weather_icon_url'] = "http://openweathermap.org/img/wn/$iconCode.png";
            
        }
            

        }
    
        return null; // Ensure a null value is returned on failure
    }
}
