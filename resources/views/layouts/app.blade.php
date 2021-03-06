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

    {{-- ---------- Start of Css ---------- --}}
    @yield('css')
    {{-- ---------- End of Css ---------- --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ url('/user/notifications') }}" class="nav-link badge badge-info">{{ auth()->user()->unreadNotifications()->count() }}</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a href="{{ url('/discussions') }}" class="nav-link">Discussions</a>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

                @if (session()->has('success'))
                    <div class="container">
                        <div class="alert alert-success">
                            {{ session()->get('success') }}    
                        </div>                
                    </div>
                @endif

                @if (!in_array(Request::path(), ['login', 'register', 'password/confirm', 'password/email', 'password/reset']))
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            @auth
                                <div class="my-2">
                                    <a href="{{ url('/discussions/create') }}" class="btn btn-primary w-100">Add Discussion</a>
                                </div>
                            @else
                                <div class="my-2">
                                    <a href="{{ url('/login') }}" class="btn btn-primary w-100">Sign in to add Discussion</a>
                                </div>
                            @endauth
                            <ul class="list-group">
                                @foreach ($channels as $channel)
                                    <li class="list-group-item"><a href="{{ url('/discussions?channel=' . $channel->slug) }}" class="text-decoration-none text-dark">{{ $channel->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-8">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @else
                    @yield('content')
                @endif

        </main>
    </div>

    {{-- ---------- Start of Js ---------- --}}
    @yield('js')
    {{-- ---------- End of Js ---------- --}}

</body>
</html>
