<?php

namespace Frukt\Weather;

use Frukt\Weather\Models\Location;
use Frukt\Weather\services\LocationService;
use Route;
use Response;
use Illuminate\Http\Request;

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
});
