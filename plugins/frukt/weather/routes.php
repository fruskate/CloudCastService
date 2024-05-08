<?php

namespace Frukt\Weather;

use Cache;
use Carbon\Carbon;
use Frukt\Weather\Models\Location;
use Frukt\Weather\Models\WeatherData;
use Frukt\Weather\services\LocationService;
use Route;
use Response;
use Illuminate\Http\Request;

Route::middleware('Frukt\\Weather\\Middlewares\\RequestLogger')->group(function () {
    Route::group(['prefix' => 'api/v1'], function () {

        /**
         * Test request
         * ANY /api/v1/test.
         * Simple route for easy start =)
         */
        Route::any('test', function () {
            return Response::json([
                'status' => 'ok',
                'response' => [
                    'description' => 'Test ok! Have a nice day!',
                ],
            ]);
        });

        /**
         * Add location request
         * POST /api/v1/add-location
         * This route expects lat (latitude) and lon (longitude) as part of the request.
         */
        Route::post('add-location', function (Request $request) {
            // Validate incoming request
            $validated = $request->validate([
                'lat' => 'required|numeric|between:-90,90',
                'lon' => 'required|numeric|between:-180,180',
                'name' => 'sometimes|string|max:255'
            ]);

            $locationService = new LocationService();
            $result = $locationService->addLocation($validated);

            return Response::json([
                'status' => $result ? 'ok' : 'error',
                'response' => [
                    'description' => $result ? 'Location added successfully' : 'Failed to add location'
                ]
            ]);
        });

        /**
         * Show locations request
         * GET /api/v1/locations
         */
        Route::get('locations', function (Request $request) {

            $locations = Location::all(['id', 'name', 'lat', 'lon'])->map(function ($location) {
                $location->lat = floatval($location->lat);
                $location->lon = floatval($location->lon);
                return $location;
            });

            return Response::json([
                'status' => 'ok',
                'response' => [
                    'description' => '',
                    'data' => $locations
                ]
            ]);
        });

        /**
         * Show average weather
         * GET /api/v1/locations/{id}/average-weather
         */
        Route::get('locations/{id}/average-weather', function (Request $request, $locationId) {
            $startDate = $request->input('start_date', Carbon::now()->format('Y-m-d'));
            $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

            $cacheKey = "location_{$locationId}_weather_from_{$startDate}_to_{$endDate}";

            $averageWeather = Cache::remember($cacheKey, 60, function () use ($locationId, $startDate, $endDate) {
                return WeatherData::where('location_id', $locationId)
                    ->whereDate('collected_at', '>=', Carbon::parse($startDate)->startOfDay()->toDateTimeString())
                    ->whereDate('collected_at', '<=', Carbon::parse($endDate)->endOfDay()->toDateTimeString())
                    ->selectRaw('AVG(temp) as average_temp,
                        AVG(humidity) as average_humidity,
                        AVG(pressure) as average_pressure')
                    ->first();
            });

            if ($averageWeather) {
                $averageWeather->average_temp = floatval($averageWeather->average_temp);
                $averageWeather->average_humidity = floatval($averageWeather->average_humidity);
                $averageWeather->average_pressure = floatval($averageWeather->average_pressure);
            }

            return Response::json([
                'status' => 'ok',
                'response' => [
                    'description' => '',
                    'data' => $averageWeather
                ]
            ]);
        });
    });
});
