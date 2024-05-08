<?php namespace Frukt\Weather;

use Frukt\Weather\classes\WeatherServiceFactory;
use Frukt\Weather\console\WeatherAggregate;
use System\Classes\PluginBase;

/**
 * Plugin class
 */
class Plugin extends PluginBase
{
    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        /*
         * CONSOLE
         */
        $this->registerConsoleCommand('weather:aggregate', WeatherAggregate::class);
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
    }

    /**
     * registerSettings used by the backend.
     */
    public function registerSettings()
    {
    }

    /**
     * registerSchedule used by cron
     */
    public function registerSchedule($schedule): void
    {
        $schedule->command('weather:aggregate')->everyMinute();
    }
}
