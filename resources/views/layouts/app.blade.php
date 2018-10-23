<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app" class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-faded">
          <a class="navbar-brand" href="/">Laratter</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
                 <li class="nav-item">
                     <form action="/messages"class="form-inline my-2 my-lg-0">
                         <input class="form-control mr-sm-2" name="query" type="search" placeholder="Buscar..." aria-label="Search">
                         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                     </form>
                 </li>
             </ul>
            <ul class="navbar-nav ml-auto">

                @if (Auth::guest())
                    <li class="nav-item active"><a class="nav-link"href="{{ route('login') }}">Entrar</a></li>
                    <li  class="nav-item"><a class="nav-link" href="{{ route('register') }}">Regitrarse</a></li>
                @else

                    <notifications :user="{{ Auth::user()->id }}"></notifications>
                    
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Salir
                        </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <a class="dropdown-item" href="/{{ Auth::user()->username }}">
                            Perfil
                        </a>
                    </div>
                @endif
            </ul>
          </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->


    <script src="{{ mix('js/app.js') }}" ></script>

</body>
</html>
