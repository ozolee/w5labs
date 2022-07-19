<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeatherApp extends Component
{
    public array $todayWeather;
    public array $weatherHistory;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $weather)
    {
        $this->initHistory(array_reverse($weather));
    }

    private function initHistory(array $weatherHistory)
    {
        $this->todayWeather = $weatherHistory[0];
        unset($weatherHistory[0]);
        $this->weatherHistory = $weatherHistory;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render(): View|string|\Closure
    {
        return view('components.weather-app');
    }
}
