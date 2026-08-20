<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function locationSearch(string $location)
    {
        $cacheKey = 'weather_locations_' . md5(strtolower(trim($location)));

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(60),
            function () use ($location) {
                $response = Http::timeout(5)->get(
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
        );
    }

    public function currentForecast(float $latitude, float $longitude)
    {
        $cacheKey = sprintf('weather_forecast_%s_%s', $latitude, $longitude);

        return Cache::remember(
            $cacheKey,
            now()->addMinutes(10),
            function () use ($latitude, $longitude) {
                $response = Http::timeout(5)->get(
                    'https://api.open-meteo.com/v1/forecast',
                    [
                        'latitude' => $latitude,
                        'longitude' => $longitude,

                        'current' => implode(',', [
                            'temperature_2m',
                            'relative_humidity_2m',
                            'apparent_temperature',
                            'precipitation',
                            'weather_code',
                            'wind_speed_10m',
                        ]),

                        'hourly' => implode(',', [
                            'temperature_2m',
                            'precipitation_probability',
                            'weather_code',
                        ]),

                        'daily' => implode(',', [
                            'weather_code',
                            'temperature_2m_max',
                            'temperature_2m_min',
                            'precipitation_probability_max',
                        ]),

                        'timezone' => 'auto',
                        'forecast_days' => 5,
                    ]
                );

                $response->throw();

                return $response->json();
            }
        );
    }
}