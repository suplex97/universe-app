<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    @if ($weather)
    <div class="weather-info">
        <h3>Weather in {{ $weather['name'] ?? 'Unknown location' }}</h3>
        @if (isset($weather['weather_icon_url']))
            <img src="{{ $weather['weather_icon_url'] }}" alt="Weather Icon" style="width: 50px; height: 50px;">
        @endif
        <p>Temperature: {{ $weather['main']['temp'] ?? 'N/A' }}°C</p>
        <p>Description: {{ $weather['weather'][0]['description'] ?? 'No description' }}</p>
    </div>
@endif




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>