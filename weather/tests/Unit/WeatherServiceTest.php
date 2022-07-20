<?php

namespace Tests\Unit;

use App\Http\Controllers\WeatherController;
use Carbon\Carbon;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     * @return void
     */
    public function weather_history_response_structure_test()
    {
        // arrange
        $testController = new WeatherController(0);

        // act
        $response = $testController->getWeatherHistory();

        //result
        $this->assertIsArray($response);
        $this->assertCount(1, $response);
        $this->assertArrayHasKey('date', $response[0]);
        $this->assertArrayHasKey('temp_max', $response[0]);
        $this->assertArrayHasKey('temp_min', $response[0]);
    }

    /**
     * @test
     * @return void
     */
    public function weather_history_week_test()
    {
        // arrange
        $pastDays = 7;
        $currentDate = Carbon::now();
        $minDate = Carbon::parse($currentDate)->subtract('day', $pastDays)->format('Y-m-d');
        $testController = new WeatherController($pastDays);

        // act
        $response = $testController->getWeatherHistory();

        // result
        $this->assertIsArray($response);
        $this->assertCount(8, $response);
        $this->assertArrayHasKey('date', $response[0]);
        $this->assertArrayHasKey('temp_max', $response[0]);
        $this->assertArrayHasKey('temp_min', $response[0]);
        $this->assertEquals($minDate, $response[0]['date']);
    }
}
