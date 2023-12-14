<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

        @php
            $notifications = auth()->user()->unreadNotifications;
            dd($notifications); // This will dump the notifications collection
        @endphp
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid start-100">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="#">UNIVERSES</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse position-absolute top-50 end-0 translate-middle-y" id="navbarSupportedContent">
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="material-symbols-outlined">notifications_active</span>
                  @if(auth()->user()->unreadNotifications->count())
                      <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                  @endif
              </a>
              <ul class="dropdown-menu">
                  @foreach(auth()->user()->unreadNotifications as $notification)
                      <li><a class="dropdown-item" href="#">New comment on your post</a></li>
                      {{-- Customize the notification text and link as needed --}}
                  @endforeach
              </ul>
          </li>
            <a class="nav-link active  " aria-current="page" href="#">
                <div class="modal-dialog modal-dialog-centered"><span class="material-symbols-outlined">
                  chat_bubble
                  </span>
                </div>
            </a>
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
    
    

   
    
    @yield('customnav')




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>