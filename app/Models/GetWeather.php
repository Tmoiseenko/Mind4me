<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetWeather extends Model
{
    protected $fillable = ['lat', 'lon', 'date', 'city', 'result'];
}
