<?php

namespace App\Repositories;

use App\Models\GetWeather;
use Illuminate\Support\Facades\DB;

class GetWeatherRepository
{
    private GetWeather $model;

    public function __construct(GetWeather $model)
    {
        $this->model = $model;
    }

    public function saveWeatherData(string $lat, string $lon, string $date, string $city, array $weather)
    {
        DB::insert("insert into get_weathers (lat, lon, date, city, weather) values (?, ?, ?, ?, ?)", [
            $lat,
            $lon,
            $date,
            $city,
            json_encode($weather),
        ]);
    }
}
