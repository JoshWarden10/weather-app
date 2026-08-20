# JoshCorp Weather
A responsive weather application built with Laravel and Vue that allows users to search for a location and view current conditions, an hourly temperature forecast, and a five-day forecast.

Weather and location data are provided by the [Open-Meteo](https://open-meteo.com/) API.

## Features
- Location search with a Select2 search dropdown
- Current temperature and weather conditions
- Feels-like temperature
- Humidity, wind speed and precipitation
- Next 24 hours temperature chart
- Five-day weather forecast
- Weather-specific icons and colours
- Loading, error and empty states
- Previously selected location remembered between visits
- Responsive desktop and mobile layouts
- Cached API responses
- Automated service and validation tests

## Tech Stack
- Laravel
- PHP
- Vue 3
- Tailwind CSS
- Axios
- Select2
- ApexCharts
- Font Awesome
- Pest
- Open-Meteo

## Installation

Clone the repository:

```bash
git clone https://github.com/JoshWarden10/weather-app.git
cd weather-app
```

Install the PHP dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate an application key:

```bash
php artisan key:generate
```

Run the database migrations:

```bash
php artisan migrate
```

Install the frontend dependencies:

```bash
npm install
```

Start the Laravel development server:

```bash
php artisan serve
```

In a separate terminal, start Vite:

```bash
npm run dev
```

The application will then be available at:

```text
http://127.0.0.1:8000
```

To create a production frontend build:

```bash
npm run build
```

No Open-Meteo API key is required.

## Testing
The project uses Pest for automated testing.

Run the test suite with:

```bash
php artisan test
```

The test suite covers:

- Location search requests
- Weather forecast requests
- Third-party API failures
- Forecast response caching
- Location search validation
- Latitude and longitude validation

Laravel's HTTP client is faked during testing, so the automated tests do not make requests to the live Open-Meteo API.

## Architecture

The frontend communicates with Laravel rather than calling Open-Meteo directly.

`WeatherController` is responsible for validating incoming requests.

`WeatherService` handles communication with Open-Meteo and caches external responses.

The Vue frontend is separated into components for location search, current conditions, hourly forecasts and the five-day forecast.

Weather-code mapping is shared between the current and forecast components through a frontend utility.

## API and Caching

Open-Meteo is used for both location searching and weather forecasts.

Location search responses are cached for an hour because location data changes infrequently.

Weather forecast responses are cached for 10 minutes to reduce unnecessary third-party requests while keeping forecast information reasonably fresh.

HTTP requests also use a timeout so an unavailable third-party API does not leave the application waiting indefinitely.

## Remembered Location

The most recently selected location is stored in browser `localStorage`.

When the application is reopened or refreshed, that location is restored automatically and its latest weather forecast is requested.

## Frontend Choices

### Vue

Vue is used for the interactive application state and weather components while Laravel remains responsible for server-side API communication and validation.

### Select2

Select2 provides the asynchronous location search interface and makes it easier to distinguish between places that share the same name.

### ApexCharts

ApexCharts displays the next 24 hours of temperature data in an interactive chart.

### Tailwind CSS

Tailwind CSS is used to build the responsive interface and application states.


## Further Improvements

Given more time, I would consider adding:

- A "Use my location" option using browser geolocation
- Celsius and Fahrenheit unit selection
- More detailed day-by-day forecasts with additional precipitation and weather data
- Further accessibility and keyboard-navigation testing