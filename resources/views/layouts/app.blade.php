<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/47d3f22c9f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto pt-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Course Of Study
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @auth
                                    @if(Auth::user()->type == 'teacher')
                                        <a class="dropdown-item" href="/addCourseOfStudy">Add Course Of Study</a>
                                    @endif
                                @endauth
                                <a class="dropdown-item" href="/courseOfStudy/First Grade">First</a>
                                <a class="dropdown-item" href="/courseOfStudy/Second Grade">Second</a>
                                <a class="dropdown-item" href="/courseOfStudy/Third Grade">Third</a>
                                <a class="dropdown-item" href="/courseOfStudy/Fourth Grade">Fourth</a>
                                <a class="dropdown-item" href="/courseOfStudy/Fifth Grade">Fifth</a>
                                <a class="dropdown-item" href="/courseOfStudy/Sixth Grade">Sixth</a>
                            </div>
                          </li>
                            @auth
                                @if(Auth::user()->type == 'manager')
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Students
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                          <a class="dropdown-item" href="/addStudent">Add Student</a>
                                          <a class="dropdown-item" href="/students">Students</a>
                                        </div>
                                    </li>
                                @endif
                            @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @auth
                                        @if(Auth::user()->type == 'student')
                                            <a class="dropdown-item" href="/showStudent/{{Auth::user()->id}}">
                                                {{ __('My Resault') }}
                                            </a>
                                        @endif
                                    @endauth
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="min-height: 100vh">
            @yield('content')
        </main>
    </div>
     <footer class="page-footer font-small bg-dark pt-4" id="contact-me" style="min-height: 14%;">
        <div class="row justify-content-center text-white m-0">
            <div class="col-12 text-center"><a class="text-decoration-none" target="_blank" href=""><i class="fas fa-map-marker-alt" aria-hidden="true"></i> School Address</a></div>
            <div class="col-md-4 col-12 p-0 text-center">
                <p><i class="far fa-envelope"></i> School Email</p>
            </div>
            <div class="col-12 p-0 text-center">
                <p>© School 2021. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
