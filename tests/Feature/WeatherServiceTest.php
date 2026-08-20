<?php

use App\Services\WeatherService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Cache::flush();

    Http::preventStrayRequests();
});

test('searching for locations', function () {
    Http::fake([
        'https://geocoding-api.open-meteo.com/*' => Http::response([
            'results' => [
                [
                    'id' => 2655603,
                    'name' => 'Birmingham',
                    'latitude' => 52.48142,
                    'longitude' => -1.89983,
                    'country' => 'United Kingdom',
                ],
            ],
        ]),
    ]);

    $service = app(WeatherService::class);

    $locations = $service->locationSearch('Birmingham');

    expect($locations)
        ->toHaveCount(1)
        ->and($locations[0]['name'])
        ->toBe('Birmingham');

    Http::assertSent(function ($request) {
        $url = parse_url($request->url());

        parse_str($url['query'] ?? '', $query);

        return $url['host'] === 'geocoding-api.open-meteo.com'
            && $url['path'] === '/v1/search'
            && $query['name'] === 'Birmingham'
            && (int) $query['count'] === 10;
    });
});

test('fetching a weather forecast', function () {
    Http::fake([
        'https://api.open-meteo.com/*' => Http::response([
            'current' => [
                'temperature_2m' => 18.4,
                'weather_code' => 2,
            ],

            'hourly' => [
                'time' => [
                    '2026-08-20T12:00',
                    '2026-08-20T13:00',
                ],
                'temperature_2m' => [
                    18.4,
                    19.1,
                ],
            ],

            'daily' => [
                'time' => [
                    '2026-08-20',
                ],
                'temperature_2m_max' => [
                    21.2,
                ],
                'temperature_2m_min' => [
                    13.7,
                ],
            ],
        ]),
    ]);

    $service = app(WeatherService::class);

    $weather = $service->currentForecast(
        52.48142,
        -1.89983
    );

    expect($weather['current']['temperature_2m'])
        ->toBe(18.4)
        ->and($weather['current']['weather_code'])
        ->toBe(2)
        ->and($weather['hourly']['temperature_2m'])
        ->toHaveCount(2)
        ->and($weather['daily']['time'])
        ->toHaveCount(1);

    Http::assertSent(function ($request) {
        $url = parse_url($request->url());

        parse_str($url['query'] ?? '', $query);

        return $url['host'] === 'api.open-meteo.com'
            && $url['path'] === '/v1/forecast'
            && (float) $query['latitude'] === 52.48142
            && (float) $query['longitude'] === -1.89983
            && (int) $query['forecast_days'] === 5;
    });
});

test('caching weather forecasts', function () {
    Http::fake([
        'https://api.open-meteo.com/*' => Http::response([
            'current' => [
                'temperature_2m' => 18,
            ],
        ]),
    ]);

    $service = app(WeatherService::class);

    $service->currentForecast(
        52.48142,
        -1.89983
    );

    $service->currentForecast(
        52.48142,
        -1.89983
    );

    Http::assertSentCount(1);
});

test('throwing an exception when the weather api fails', function () {
    Http::fake([
        'https://api.open-meteo.com/*' => Http::response(
            [],
            500
        ),
    ]);

    $service = app(WeatherService::class);

    expect(function () use ($service) {
        $service->currentForecast(
            52.48142,
            -1.89983
        );
    })->toThrow(RequestException::class);
});