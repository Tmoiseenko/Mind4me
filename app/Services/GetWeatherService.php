<?php

namespace App\Services;


use GuzzleHttp\Client;

class GetWeatherService
{

    private Client $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
        $this->base_url = env('WEATHER_URL');
    }

    public function getWheather(string $lat, string $lon, string $date)
    {
        $url = $this->base_url;

        $response = $this->http->get($url, [
            'query' => [
                'access_key' => env('WEATHER_API_KEY'),
                'query' => $lat . ',' . $lon,
                'historical_date' => $date
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
