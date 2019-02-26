<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script src="carousel.js"></script>
    <title>{{config('app.name', 'LSAPP')}}</title>

    <!-- Bootstrap core CSS -->
    <link href="/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">



    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
</head>
<body class="text-center"/>
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <ul class="nav navbar-nav">
                @if (Auth::check() && Auth::user()->userRoleID == 1)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Reservation<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('student/schedules/create') }}">Room Reservation</a></li>
                            <li><a class="dropdown-item" href="{{ url('student/schedules/index') }}">Reservations</a></li>
                        </ul>
                    <li><a class="nav-link" href="/">Venues Gallery</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Profile<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('student/users/index') }}">View Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('student/users/{id}/edit') }}">Edit Profile</a></li>
                        </ul>
                            <li><a class="nav-link" href="{{ url('student/feedbacks/create') }}">Send Feedback</a></li>
                    <li><a class="nav-link" href="/">FAQ</a></li>
                @elseif (Auth::check() && Auth::user()->userRoleID == 2)
                    <li><a class="nav-link" href="/">FAQ</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Venues<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('gasd/venues/create') }}">Add Venue</a></li>
                            <li><a class="dropdown-item" href="{{ url('gasd/venues/{id}/edit') }}">Update Venue</a></li>
                            <li><a class="dropdown-item" href="{{ url('gasd/venues/index') }}">View Venue</a></li>
                        </ul>
                    <li><a class="nav-link" href="{{ url('gasd/feedbacks/index') }}">Feedbacks</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Venue Reservation<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('gasd/schedules/index') }}">Room Reservation</a></li>
                            <li><a class="dropdown-item" href="{{ url('/') }}">Reserved Rooms</a></li>
                            <li><a class="dropdown-item" href="{{ url('/') }}">Venue Gallery</a></li>
                        </ul>
                @elseif (Auth::check() && Auth::user()->userRoleID == 3)
                    <li><a class="nav-link" href="/">FAQ</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Rooms<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('registrar/venues/create') }}">Add Venues</a></li>
                            <li><a class="dropdown-item" href="{{ url('registrar/venues/{id}/edit') }}">Edit Venues</a></li>
                            <li><a class="dropdown-item" href="{{ url('registrar/venues/index') }}">View Venues</a></li>
                        </ul>
                            <li><a class="nav-link" href="{{ url('registrar/feedbacks/index') }}">Feedbacks</a></li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Room Reservation<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('registrar/schedules/index') }}">Room Reservation</a></li>
                            <li><a class="dropdown-item" href="{{ url('/') }}">Reserved Rooms</a></li>
                            <li><a class="dropdown-item" href="{{ url('/') }}">Room Gallery</a></li>
                        </ul>
                @elseif (Auth::check() && Auth::user()->userRoleID == 4)
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Users<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('itd/users/index') }}">View Users</a></li>
                            <li><a class="dropdown-item" href="{{ url('itd/users/create') }}">Create Users</a></li>
                            <li><a class="dropdown-item" href="{{ url('itd/users/{id}/edit') }}">Edit Users</a></li>
                            <li><a class="dropdown-item" href="{{ url('itd/users/{id}/edit') }}">Revoke User Access</a></li>
                        </ul>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>User Reports<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="{{ url('itd/logtimes/index') }}">Account Logs</a></li>
                            <li><a class="dropdown-item" href="{{ url('/') }}">Active Users</a></li>
                        </ul>
                    </li>
            </ul>
            @endif
        </div>
    </div>



        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest


            @endguest
            @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{Auth::user()->firstName}}<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="/home">Home</a></li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
            @endauth
        </ul>
    </div>
    </div>
</nav>
</html>
