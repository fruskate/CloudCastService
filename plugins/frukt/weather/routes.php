<?php

namespace Frukt\Weather;

use Frukt\Weather\Classes\helpers\LocationHelper;
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

            $locationService = new LocationHelper();
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
        Route::get('locations', function () {

            $locationService = new LocationHelper();
            $locations = $locationService->getLocations();

            return Response::json([
                'status' => 'ok',
                'response' => [
                    'description' => "Shown {$locations->count()} locations",
                    'data' => $locations
                ]
            ]);
        });

        /**
         * Show average weather
         * GET /api/v1/locations/{id}/average-weather
         */
        Route::get('locations/{id}/average-weather', function (Request $request, $locationId) {

            $locationService = new LocationHelper();
            list($from, $to) = $locationService->getDatesFromRequest($request);
            $averageWeather = $locationService->getAverageWeatherForLocation($request, $locationId, $from, $to);


            return Response::json([
                'status' => 'ok',
                'response' => [
                    'description' => "Average data collected from {$from} to {$to}",
                    'data' => $averageWeather
                ]
            ]);
        });
    });
});
