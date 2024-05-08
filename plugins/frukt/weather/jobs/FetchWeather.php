<?php

namespace Frukt\Weather\jobs;

use Frukt\Weather\Classes\WeatherServiceFactory;
use Frukt\Weather\Models\Location;
use Frukt\Weather\Models\WeatherProvider;

class FetchWeather
{
    public function fire($job, $data)
    {


        $location = Location::find($data['locationId']);
        $provider = WeatherProvider::find($data['providerId']);

        if (!$location || !$provider) {
            \Log::channel('error')->error("Not found Location or Weather Provider in Queue!");
            $job->delete();
        }

        try {
            $weatherService = WeatherServiceFactory::create($provider->type);
            $weatherData = $weatherService->fetchWeatherData($location->lat, $location->lon);
            $weatherData->location_id = $location->id;

            // This part is GOVNOCODE, but proger want to know name of location =)
            if ($location->name === null && $provider->type === 1) {
                $location->name = $weatherData->location_name;
                $location->save();
            }
            unset($weatherData->location_name);

            $weatherData->save();

            $job->delete();

        } catch (\Exception $e) {
            \Log::channel('error')->error("Error collecting weather data for location {$location->id} from provider {$provider->id}: " . $e->getMessage());
            if ($job->attempts() <= 3) {
                $job->release(10);
            }
        }
    }
}
