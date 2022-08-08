<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BeeVerse</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body style="background-color: #18191a">
    @include('sweetalert::alert')

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">BeeVerse</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search Friends.." aria-label="Search"
                    style="background-color: #3a3b3c;color:white">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{$active == 'home' ? 'active': ''}}">
                    <a class="nav-link" href="/">Home</a>
                </li>

                @if (Auth::check())
                    <li class="nav-item {{$active == 'friends' ? 'active': ''}}">
                        <a class="nav-link" href="/friends">Friends</a>
                    </li>
                    <li class="nav-item {{$active == 'message' ? 'active': ''}}">
                        <a class="nav-link" href="/message">Message</a>
                    </li>
                    <li class="nav-item {{$active == 'profile' ? 'active': ''}}">
                        <a class="nav-link" href="/profile">Profile</a>
                    </li>
                @else
                    <li class="nav-item {{$active == 'login' ? 'active': ''}}">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item {{$active == 'register' ? 'active': ''}}">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                @endif

            </ul>

        </div>
    </nav>

    <div>
        @yield('content')
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script src="/js/main.js" type="text/javascript"></script>
    <script src="/js/chatSystem.js"></script>
</body>

</html>