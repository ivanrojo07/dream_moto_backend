<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    
</head>
<body>
    <div >
        <nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto mr-auto">
                        <li>
                            <a class="nav-link" href="{{ route('tiendas.index') }}">Tiendas</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('handbooks.index') }}">Handbooks</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{url('contacto')}}">Contáctanos</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{url('nosotros')}}">Acerca de Nosotros</a>
                        </li>
                        <li>
                            <div class="btn-group">
                                <a href="#" class="nav-link dropdown-toggle" id="precargasDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Precargas</a>
                                <div class="dropdown-menu" aria-labelledby="precargasDropdown">
                                    <a class="dropdown-item" href="{{url('precargas/refaccion')}}">Refacciones</a>
                                    <a class="dropdown-item" href="{{url('precargas/revision')}}">Revisiones</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Aviso de Privacidad</a>
                        </li>
                    </ul>
                    
                </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main id="app" class="py-4">
           <div class="container-fluid" align="center">
                <section>
                    <div class="title m-b-md" style="background-image: url({{asset('img/llamas2.gif')}});">
                        <img src="{{asset('img/logo.png')}}" width="569.8px" height="222.6">
                    </div>
                </section>
           </div>
           
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/all.js') }}"></script>
    @yield('script')
</body>
</html>
