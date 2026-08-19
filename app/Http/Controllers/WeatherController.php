<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function fetchLocations(Request $request, WeatherService $weatherService) 
    {
        $request->validate([
            'search' => ['required', 'string', 'min:2'],
        ]);

        return response()->json(
            $weatherService->locationSearch($request->string('search'))
        );
    }
}