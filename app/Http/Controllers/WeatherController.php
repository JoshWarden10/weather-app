<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function fetchLocations(Request $request, WeatherService $weatherService) 
    {
        $validatedResponse = $request->validate([
            'search' => ['required', 'string', 'min:2'],
        ]);

        return response()->json(
            $weatherService->locationSearch($validatedResponse['search'])
        );
    }

    public function fetchWeather(Request $request, WeatherService $weatherService)
    {
        $validatedResponse = $request->validate([
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        return response()->json(
            $weatherService->currentForecast(
                $validatedResponse['latitude'],
                $validatedResponse['longitude']
            )
        );
    }
}