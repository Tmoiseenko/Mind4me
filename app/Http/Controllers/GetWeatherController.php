<?php

namespace App\Http\Controllers;


use App\Repositories\GetWeatherRepository;
use App\Services\GetWeatherService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class GetWeatherController extends BaseController
{
    private GetWeatherService $weatherService;
    private GetWeatherRepository $weatherRepository;

    public function __construct(GetWeatherService $weatherService, GetWeatherRepository $weatherRepository)
    {
        $this->weatherService = $weatherService;
        $this->weatherRepository = $weatherRepository;
    }

    /**
     * @OA\Post (
     *     path="/getweather",
     *     summary="returns an array containing the date, the name of the place, and an array with the weather data",
     *     @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="date", type="string", example="2022-08-12"),
     *       @OA\Property(property="lat", type="string", example="-22.986032"),
     *       @OA\Property(property="lon", type="string", example="-43.184125"),
     *    ),
     * ),
     *     @OA\Response(response="200", description="returns an array containing the date, the name of the place, and an array with the weather data")
     * )
     */
    public function getWeather(Request $request)
    {
        $response = $this->weatherService->getWheather($request->post('lat'), $request->post('lon'), $request->post('date'));
        $result = [
            'city' => $response['location']['region'],
            'weather' => $response['current'],
        ];

        $this->weatherRepository->saveWeatherData(
            $request->post('lat'),
            $request->post('lon'),
            $response['location']['localtime'],
            $result['city'],
            $result['weather']
        );

        return response()->json($result);
    }
}
