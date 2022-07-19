<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="app-holder">
            @if (count($weather))
                <x-weather-app :weather="$weather" />
            @else
                <x-error-message :message='"Unreachable data, please try again later!"' />
            @endif
        </div>
    </body>
</html>
