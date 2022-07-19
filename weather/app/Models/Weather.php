<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Weather extends Model
{

    /**
     * Save the data of the day when it has not saved in the database
     *
     * @param array $day
     */
    public function dayCheck(array $day)
    {
        if (!$this->isSavedDate($day['date']))
        {
            $this->saveWeatherHistory($day);
        }
    }

    /**
     * Check that the day has already saved in the weather_history table
     *
     * @param string $date
     * @return object|null
     */
    private function isSavedDate(string $date): object|null
    {
        return (DB::table('weather_history')->where('date', $date)->first());
    }

    /**
     * @param array $day
     */
    private function saveWeatherHistory(array $day)
    {
        $qb = $this->newBaseQueryBuilder();
        $qb->from('weather_history')
            ->insert([
            'date' => $day['date'],
            'temp_max' => $day['temp_max'],
            'temp_min' => $day['temp_min']
        ]);
    }

    /**
     * Give weather history data from database for the asked day count
     *
     * @param int $pastDays
     * @return array
     */
    public function getWeatherHistory(int $pastDays): array
    {
        $currentDate = Carbon::now();
        $minDate = Carbon::parse($currentDate)->subtract('day', $pastDays)->format('Y-m-d');

        $qb = $this->newBaseQueryBuilder();
        $response = $qb->select('*')
            ->from('weather_history')
            ->where('date', '>=', $minDate)
            ->get();
        return $response->all();
    }
}
