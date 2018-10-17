<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="container-fluid">
                <section>
            <div class="title m-b-md" style="background-image: url({{asset('img/llamas2.gif')}});">
                <img style="display: block!important;margin-left: auto!important;margin-right: auto!important;width: 50%!important;" src="{{asset('img/logo.png')}}">
            </div>
        </section>

                <div class="links" align="center">
                    <a href="{{ route('tiendas.index') }}">Tiendas</a>
                    <a href="{{ route('handbooks.index') }}">Handbooks</a>
                    <a href="{{ route('servicios') }}">Servicios</a>
                        <a href="#" class="dropdown-toggle" id="precargasDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Precargas</a>
                        <div class="dropdown-menu" aria-labelledby="precargasDropdown">
                            <a class="dropdown-item" href="{{url('precargas/refaccion')}}">Refacciones</a>
                            <a class="dropdown-item" href="{{url('precargas/revision')}}">Revisiones</a>
                        </div>
                    
                    <a href="{{url('contacto')}}">Contáctanos</a>
                    <a href="{{url('nosotros')}}">Acerca de Nosotros</a>
                    <a href="#">Aviso de Privacidad</a>
                    
                </div>
            </div>
        </div>
    </body>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
