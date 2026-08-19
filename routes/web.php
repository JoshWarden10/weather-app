<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather/locations', [WeatherController::class, 'fetchLocations']);
Route::get('/weather/forecast', [WeatherController::class, 'fetchWeather']);