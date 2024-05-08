<?php

namespace Frukt\Weather\Classes;

use Frukt\Weather\Models\WeatherData;

interface WeatherServiceInterface
{
    public function fetchWeatherData($latitude, $longitude): WeatherData;
}
