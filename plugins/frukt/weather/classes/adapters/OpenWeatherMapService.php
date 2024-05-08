<?php

namespace Frukt\Weather\Classes\Adapters;

use Carbon\Carbon;
use Frukt\Weather\Classes\WeatherServiceInterface;
use Frukt\Weather\Models\WeatherData;
use Frukt\Weather\Models\WeatherProvider;
use GuzzleHttp\Client;

class OpenWeatherMapService implements WeatherServiceInterface
{

    /**
     * Retrieving data from API and returning WeatherData model.
     *
     * @param $latitude
     * @param $longitude
     * @return WeatherData
     * @throws \Exception
     */
    public function fetchWeatherData($latitude, $longitude): WeatherData
    {
        $weatherProvider = WeatherProvider::whereType(1)->first();

        if (!$weatherProvider) {
            throw new \Exception("Weather provider not found. Try to add it in administration area.");
        }

        $response = $this->makeApiRequest($latitude, $longitude, $weatherProvider);

        if ($response === null) {
            throw new \Exception("Failed to retrieve data from weather API.");
        }

        return $this->transformResponseToWeatherData($response, $weatherProvider);
    }

    /**
     * Make API Request
     *
     * @param $latitude
     * @param $longitude
     * @param $weatherProvider
     * @return array|null
     */
    private function makeApiRequest($latitude, $longitude, $weatherProvider): ?array
    {
        $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';
        $apiKey = $weatherProvider->api_key;

        $fullUrl = "{$baseUrl}?lat={$latitude}&lon={$longitude}&appid={$apiKey}";

        $client = new Client();

        try {
            $response = $client->request('GET', $fullUrl);
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            \Log::error("API request failed: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Transforming response data to WeatherData model
     *
     * @param array $response
     * @param WeatherProvider $weatherProvider
     * @return WeatherData
     */
    private function transformResponseToWeatherData(array $response, WeatherProvider $weatherProvider): WeatherData
    {
        $weatherData = new WeatherData();

        $weatherData->provider_id = $weatherProvider->id;

        $weatherData->temp = $response['main']['temp'];
        $weatherData->feels_like = $response['main']['feels_like'];
        $weatherData->pressure = $response['main']['pressure'];
        $weatherData->humidity = $response['main']['humidity'];
        $weatherData->temp_min = $response['main']['temp_min'];
        $weatherData->temp_max = $response['main']['temp_max'];

        $weatherData->collected_at = Carbon::createFromTimestamp($response['dt'], 'UTC');

        // This part is GOVNOCODE, but proger want to know name of location =) 
        $weatherData->location_name = $response['name'];

        return $weatherData;
    }
}
