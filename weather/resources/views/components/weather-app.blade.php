<div id="weather-app">
    <div class="location">
        Budapest, Hungary
        <span>weather history</span>
    </div>
    <ul class="history">
        @foreach($weather as $day)
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
