<?php

namespace Frukt\Weather\Classes;

use Frukt\Weather\Classes\Adapters\OpenWeatherMapService;
use Frukt\Weather\Classes\Adapters\WeatherApi;

class WeatherServiceFactory
{
    public static function create($type) {
        switch ($type) {
            case 1:
                return new OpenWeatherMapService();
            case 2:
                return new WeatherApi();
            default:
                throw new \Exception("Unsupported weather service type");
        }
    }
}
