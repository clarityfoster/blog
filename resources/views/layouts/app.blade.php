<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/blogging.png') }}" type="image/png">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand text-muted" href="{{ url('/') }}">
                    <img src="{{ asset('img/blogging.png') }}" class="me-2" alt="Logo" style="max-width: 30px; max-height: 30px">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @php
                        use Illuminate\Support\Facades\Request;
                    @endphp
                    @auth
                        <ul class="navbar-nav me-auto">
                            @if (Request::path() !== 'users/users-list')
                                <li class="nav-item">
                                    <a href="/users/users-list" class="nav-link text-muted">
                                        <i class="bi bi-list-nested"></i>
                                        Users List
                                    </a>
                                </li>
                            @endif
                            @if (Request::path() !== 'articles/add')
                                <li class="nav-item">
                                    <a href="{{ url('/articles/add') }}" class="nav-link text-success">
                                        + Add Post
                                    </a>
                                </li>
                            @endif
                            @if (!Request::routeIs('dashboard'))
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" class="nav-link">
                                        Dashboard
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <form method="GET" class="input-group me-3" action="{{ url('/users/search') }}">
                                <input type="text" class="form-control" placeholder="Search"
                                    aria-label="Example text with button addon" aria-describedby="button-addon1"
                                    name="query">
                                <button class="btn btn-primary" type="submit" id="button-addon1">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        @endauth


                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="btn btn-primary dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/users/profile/' . Auth::user()->id) }}">
                                        Profile
                                    </a>
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
