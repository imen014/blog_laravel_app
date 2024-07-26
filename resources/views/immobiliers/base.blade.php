<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>
<body>
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (auth()->user()->role === 'home_seeker')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get_favoris') }}">
                            <i class="bi bi-bookmark-star-fill text-warning"></i>
                        </a>
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get_tchats') }}">
                            <i class="bi bi-envelope-fill text-success"></i>
                        </a>
                    </li>
                    @if (auth()->user()->role === 'manager')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asked_visites') }}">
                            <i class="bi bi-calendar-check"></i>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get_notifications') }}">
                            <i class="bi bi-bell-fill text-primary"></i>
                        
                        @if(isset($recentNotificationsCount))
                            <span class="text-danger">{{ $recentNotificationsCount }}</span>
                        @else
                            Variable non définie
                        @endif  
                    </a>  </li>
                </ul>
            </div>
        </div>
    </nav>


@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" defer></script>
</body>
</html>