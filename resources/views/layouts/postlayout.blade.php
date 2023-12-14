<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Laravel Social Media</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  

      
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid start-100">
          <form class="d-flex" role="search" style="margin-bottom: 0px;">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="#">UNIVERSE</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse position-absolute top-50 end-0 translate-middle-y " id="navbarSupportedContent" style="margin-right: 15px;">
            <ul class="navbar-nav me-auto mb-4 mb-lg-0">
              <li class="nav-item ">
              
                <a class="nav-link active  " aria-current="page" href="#">
                    <div class="modal-dialog modal-dialog-centered"><span class="material-symbols-outlined">
                      notifications_active
                      </span>
              </div>
            </a>
          </li>

          <li class="nav-item ">
            
            <a class="nav-link active  " aria-current="page" href="#">
                <div class="modal-dialog modal-dialog-centered"><span class="material-symbols-outlined">
                  chat_bubble
                  </span>
          </div>
        </a>
          </li>
          @auth
    @php
    $notifications = \App\Models\notification::where('user_id', auth()->id())
                           ->latest()
                           ->take(5)
                           ->get();
    @endphp

    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notifications
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @foreach($notifications as $notification)
    <a class="dropdown-item" href="#" onclick="markNotificationAsRead({{ $notification->id }})">
        {{ $notification->data['message'] ?? 'You have a new notification.' }}
    </a>
@endforeach
        </div>
    </li>
@endauth

          
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{ Auth::user()->name }}
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/profile">{{ __('Profile') }}</a></li>
                    <li>
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a class="dropdown-item" href="/logout"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();">{{ __('Log Out') }}</a>
                      </form>
                  </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                  </ul>
                </li>

                
        </li>
            


          </ul>
            
          </div>
        </div>
    </nav>

@yield('content')


<script>

function markNotificationAsRead(notificationId) {
    fetch('/notifications/' + notificationId + '/mark-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
          var notificationItem = document.getElementById('notification-item-' + notificationId);
            if (notificationItem) {
                notificationItem.style.backgroundColor = '#f8f9fa'; // Example color

                // Alternatively, hide the notification item
                // notificationItem.style.display = 'none';
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
