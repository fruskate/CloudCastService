<?php

namespace Frukt\Weather\console;

use Frukt\Weather\Classes\WeatherServiceFactory;
use Frukt\Weather\Models\Location;
use Frukt\Weather\Models\WeatherProvider;
use Illuminate\Console\Command;

class WeatherAggregate extends Command
{
    /**
     * @var string The console command name.
     */
    protected $name = 'weather:aggregate';

    /**
     * @var string The console command description.
     */
    protected $description = 'Make queues to aggregate weather data from weather providers';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $locations = Location::all();
        $weatherProviders = WeatherProvider::active()->get();

        foreach ($locations as $location) {
            foreach ($weatherProviders as $provider) {
                $this->collectAndSaveWeatherData($location, $provider);
            }
        }
    }

    private function collectAndSaveWeatherData(Location $location, WeatherProvider $provider)
    {
        try {
            $weatherService = WeatherServiceFactory::create($provider->type);
            $weatherData = $weatherService->fetchWeatherData($location->lat, $location->lon);
            $weatherData->location_id = $location->id;
            $weatherData->save();

        } catch (\Exception $e) {
            \Log::error("Error collecting weather data for location {$location->id} from provider {$provider->id}: " . $e->getMessage());
        }
    }
}
