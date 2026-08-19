<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function locationSearch(string $location)
    {
        $response = Http::get(
            'https://geocoding-api.open-meteo.com/v1/search',
            [
                'name' => $location,
                'count' => 10,
                'language' => 'en',
                'format' => 'json',
            ]
        );

        $response->throw();

        return $response->json('results', []);
    }
}