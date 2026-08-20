<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/weather/locations', [WeatherController::class, 'fetchLocations']);
Route::get('/weather/forecast', [WeatherController::class, 'fetchWeather']);
