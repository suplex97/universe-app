<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    @if ($weather)
    <div class="container mt-4">
      <div class="card shadow">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h5 class="card-title font-weight-bold">Current Weather in London</h5>
              <p class="card-text text-muted">Updated at: {{ date('h:i a', $weather['dt']) }}</p>
            </div>
            <div class="col-md-4 text-center">
              <img src="{{ $weather['weather_icon_url'] }}" alt="Weather Icon" class="img-fluid" style="width: 80px; height: 80px;">
            </div>
          </div>

          <hr>

          <div class="mt-3">
            <p class="mb-2 font-weight-bold"><i class="fas fa-thermometer-half me-2 fa-lg"></i>{{ $weather['main']['temp'] }}°C</p>
            <p class="mb-2 text-muted"><i class="fas fa-cloud me-2 fa-lg"></i>Humidity: {{ $weather['main']['humidity'] }}%</p>
            <p class="mb-2 text-muted"><i class="fas fa-wind me-2 fa-lg"></i>Wind speed: {{ $weather['wind']['speed'] }} mph</p>
            <p class="mb-0 text-muted"><i class="fas fa-tachometer-alt me-2 fa-lg"></i>Pressure: {{ $weather['main']['pressure'] }} hPa</p>
            
          </div>
        </div>
      </div>
    </div>
    @endif





    




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>