<?php

namespace App\Http\Controllers;

use App\Services\DeliveryDateCalculationService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Lumen\Routing\Controller as BaseController;

class DeliveryDateCalculationController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/delivery_calculate",
     *     summary="returns an array of dates to ship",
     *     @OA\Parameter(
     *     parameter="date",
     *     name="date",
     *     description="Date of delivery (01.01.2000)",
     *     in="query",
     *     @OA\Schema(
     *     type="string"
     *   )
     * ),
     *     @OA\Parameter(
     *     parameter="time",
     *     name="time",
     *     description="Time of delivery (10:00)",
     *     in="query",
     *     @OA\Schema(
     *     type="string"
     *   )
     * ),
     *     @OA\Parameter(
     *     parameter="city",
     *     name="city",
     *     description="Delivery city following values (Город_1, Город_2, Город_3)",
     *     in="query",
     *     @OA\Schema(
     *     type="string"
     *   )
     * ),
     *     @OA\Response(response="200", description="returns an array of dates to ship")
     * )
     */
    public function calculation(Request $request, DeliveryDateCalculationService $calculationService)
    {
        $getParams = $request->all();

        return response()->json($calculationService->calculate($getParams['date'], $getParams['time'], $getParams['city']));
    }
}
