<?php

namespace Frukt\Weather\Classes\helpers;

use Cache;
use Carbon\Carbon;
use Frukt\Weather\Models\Location;
use Frukt\Weather\Models\WeatherData;

class LocationHelper
{
    /**
     * Add new location in database
     *
     * @param array $data Массив с данными локации.
     * @return bool Возвращает true, если локация успешно добавлена.
     */
    public function addLocation(array $data) : bool
    {
        try {
            Location::firstOrCreate(
                [
                    'lat' => $data['lat'],
                    'lon' => $data['lon']
                ],
                [
                    'name' => $data['name'] ?? null
                ]
            );

            return true;
        } catch (\Exception $e) {
            \Log::channel('error')->error("Failed to add location: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get ALL locations from database
     */
    public function getLocations()
    {
        return Location::all(['id', 'name', 'lat', 'lon'])->map(function ($location) {
            $location->lat = floatval($location->lat);
            $location->lon = floatval($location->lon);
            return $location;
        });
    }

    /**
     * Get Average Weather from selected Location
     *
     * @param \Illuminate\Http\Request $request
     * @param $locationId
     * @return mixed
     */
    public function getAverageWeatherForLocation(\Illuminate\Http\Request $request, $locationId, $startDate, $endDate)
    {
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

        return $averageWeather;
    }

    /**
     * Get start and end dates from request
     */
    public function getDatesFromRequest(\Illuminate\Http\Request $request)
    {
        return [
            $request->input('start_date', Carbon::now()->format('Y-m-d')),
            $request->input('end_date', Carbon::now()->format('Y-m-d')),
        ];
    }
}
