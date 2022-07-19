<div id="weather-app">
    <div class="today">
        <div class="col degree">
            <div class="max">{{$todayWeather['temp_max']}} &#176;C</div>
            <div class="min">{{$todayWeather['temp_min']}} &#176;C</div>
        </div>
        <div class="col ">
            <div class="row location">
                Budapest, Hungary
            </div>
            <div class="hide">{{$todayDate = strtotime($todayWeather['date'])}}</div>
            <div class="col">{{date('D', $todayDate)}},</div>
            <div class="col">{{date('m.d', $todayDate)}}</div>
        </div>
    </div>
    <ul class="history">
        @foreach($weatherHistory as $day)
            <div class="hide">{{$date = strtotime($day['date'])}}</div>
            <li>
                <div class="col day">{{date('D', $date)}}</div>
                <div class="col date">{{date('m.d', $date)}}</div>
                <div class="col degree">
                    <div class="max">{{$day['temp_max']}} &#176;C</div>
                    <div class="min">{{$day['temp_min']}} &#176;C</div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
