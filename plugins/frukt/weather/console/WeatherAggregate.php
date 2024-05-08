<?php

namespace Frukt\Weather\console;

use Frukt\Weather\Models\Location;
use Frukt\Weather\Models\WeatherProvider;
use Illuminate\Console\Command;
use Queue;

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
                Queue::push(\Frukt\Weather\Jobs\FetchWeather::class, [
                    'locationId' => $location->id,
                    'providerId' => $provider->id,
                ]);
            }
        }
    }
}
