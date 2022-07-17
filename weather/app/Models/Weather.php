<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;

class Weather extends Model
{

    public function dayCheck(Array $day)
    {
        if (!$this->isSavedDate($day['date']))
        {
            $this->saveWeatherHistory($day);
        }
    }

    private function isSavedDate(string $date): object|null
    {
        return (DB::table('weather_history')->where('date', $date)->first());
    }

    private function saveWeatherHistory(Array $day)
    {
        $qb = $this->newBaseQueryBuilder();
        $qb->from('weather_history')
            ->insert([
            'date' => $day['date'],
            'temp_max' => $day['temp_max'],
            'temp_min' => $day['temp_min']
        ]);
    }

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
