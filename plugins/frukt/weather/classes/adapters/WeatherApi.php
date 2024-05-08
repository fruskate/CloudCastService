<?php

namespace Frukt\Weather\Classes\Adapters;

use Carbon\Carbon;
use Frukt\Weather\Classes\WeatherServiceInterface;
use Frukt\Weather\Models\WeatherData;
use Frukt\Weather\Models\WeatherProvider;
use GuzzleHttp\Client;

class WeatherApi implements WeatherServiceInterface
{

    public function fetchWeatherData($latitude, $longitude): WeatherData
    {
        $weatherProvider = WeatherProvider::whereType(2)->first();

        if (!$weatherProvider) {
            throw new \Exception("Weather provider not found. Try to add it in administration area.");
        }

        $response = $this->makeApiRequest($latitude, $longitude, $weatherProvider);

        if ($response === null) {
            throw new \Exception("Failed to retrieve data from weather API.");
        }

        return $this->transformResponseToWeatherData($response, $weatherProvider);
    }

    private function makeApiRequest($latitude, $longitude, $weatherProvider)
    {
        $baseUrl = 'http://api.weatherapi.com/v1/current.json';
        $apiKey = $weatherProvider->api_key;

        $fullUrl = "{$baseUrl}?q={$latitude},{$longitude}&key={$apiKey}";

        $client = new Client();

        try {
            $response = $client->request('GET', $fullUrl);
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            \Log::channel('error')->error("API request failed: " . $e->getMessage());
            return null;
        }
    }

    private function transformResponseToWeatherData($response, $weatherProvider)
    {
        $weatherData = new WeatherData();

        $weatherData->provider_id = $weatherProvider->id;

        $weatherData->temp = $response['current']['temp_f'];
        $weatherData->feels_like = $response['current']['feelslike_f'];
        $weatherData->pressure = $response['current']['pressure_mb'];
        $weatherData->humidity = $response['current']['humidity'];
        $weatherData->temp_min = null;
        $weatherData->temp_max = null;

        $weatherData->collected_at = Carbon::createFromTimestamp($response['current']['last_updated_epoch'], 'UTC');

        return $weatherData;
    }
}
