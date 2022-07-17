<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WeatherApp extends Component
{
    public $weather;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($weather)
    {
        $this->weather = $weather;
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
