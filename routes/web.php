<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () {
    return 'Тестовое задание';
});
$router->post('/getweather', ['as' => 'getweather', 'uses' => 'GetWeatherController@getWeather']);
$router->get('/delivery_calculate', ['as' => 'delivery_calculate', 'uses' => 'DeliveryDateCalculationController@calculation']);
