<?php

test('location search requires a search term', function () {
    $response = $this->getJson('/weather/locations');

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'search',
        ]);
});

test('location search requires at least two characters', function () {
    $response = $this->getJson(
        '/weather/locations?search=B'
    );

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'search',
        ]);
});

test('weather forecast requires coordinates', function () {
    $response = $this->getJson('/weather/forecast');

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'latitude',
            'longitude',
        ]);
});

test('weather forecast rejects invalid coordinates', function () {
    $response = $this->getJson(
        '/weather/forecast?latitude=100&longitude=200'
    );

    $response
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'latitude',
            'longitude',
        ]);
});