<?php

namespace App\Services;


use App\Models\Weather;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    private int $pastDays;
    private Weather $weatherModel;

    public function __construct(int $pastDays)
    {
        $this->pastDays = $pastDays;
        $this->weatherModel = new Weather();
    }

    /**
     * When weather api endpoint call was success the function
     * return with a unified array from API response data.
     * When the call failed the function return with
     * an array from the database.
     *
     * @return array
     */
    public function getWeatherHistory(): array
    {
        $weatherApiResponse = $this->weatherApiCall();
        if ($weatherApiResponse->status() == 200) {
            $jsonDays = $weatherApiResponse->json();
            return $this->createResponse($jsonDays['daily']);
        } else {
            return json_decode(json_encode($this->weatherModel->getWeatherHistory($this->pastDays)), true);
        }
    }

    /**
     * Create a unified response body for view
     *
     * @param array $days
     * @return array
     */
    private function createResponse(array $days): array
    {
        $responseDays = [];
        for ($counter = 0; $counter <= $this->pastDays; $counter++) {
            $day = [
              'date' => $days['time'][$counter],
              'temp_max' => $days['temperature_2m_max'][$counter],
              'temp_min' => $days['temperature_2m_min'][$counter]
            ];
            $this->weatherModel->dayCheck($day);
            array_push($responseDays, $day);
        }
        return $responseDays;
    }

    /**
     * @return Response
     */
    private function weatherApiCall(): Response
    {
        return Http::get("https://api.open-meteo.com/v1/forecast?latitude=47.4984&longitude=19.0408&daily=temperature_2m_max,temperature_2m_min&timezone=Europe%2FBerlin&past_days=" . $this->pastDays);
    }
}
