<?php

namespace Frukt\Weather\Classes;

use Frukt\Weather\Classes\Adapters\OpenWeatherMapService;

class WeatherServiceFactory
{
    public static function create($type) {
        switch ($type) {
            case 1:
                return new OpenWeatherMapService();
            default:
                throw new \Exception("Unsupported weather service type");
        }
    }
}
