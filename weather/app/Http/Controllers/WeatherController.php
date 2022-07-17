<?php

namespace App\Http\Controllers;


use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use PHPUnit\Exception;

class WeatherController extends Controller
{
    private WeatherService $service;

    public function __construct(int $pastDays)
    {
        $this->service = new WeatherService($pastDays);
    }

    /**
     * @return JsonResponse|array|Collection
     */
    public function getWeatherHistory(): JsonResponse|array|Collection
    {
        try {
            return $this->service->getWeatherHistory();
        } catch (Exception $exception) {
            return response()->json(['message'=>$exception->getMessage()], 422);
        }
    }
}
