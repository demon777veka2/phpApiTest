<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">


  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>@yield('title')</title>
</head>

<body>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page">
                <ya-tr-span data-index="1-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Home" data-translation="Таблицы:" data-type="trSpan">
                  <h5>Таблицы:</h5>
                </ya-tr-span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('users')}}">
                <ya-tr-span data-index="1-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Home" data-translation="Пользователь" data-type="trSpan">Пользователь</ya-tr-span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('positions')}}">
                <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Link" data-translation="Должность" data-type="trSpan">Должность</ya-tr-span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="{{route('departments')}}">
                <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Link" data-translation="Отдел" data-type="trSpan">Отдел</ya-tr-span>
              </a>
            </li>

            <li style="padding-left: 190%;">
              <div>
                <nav>
                  <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                      <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <!-- Left Side Of Navbar -->
                      <ul class="navbar-nav mr-auto">

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
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
              </div>
            </li>


          </ul>

        </div>
      </div>
    </nav>
  </header>

  <main class="flex-shrink-0">
    <div class="countainer" style="margin-top:70px;">
      @yield('main_content')
    </div>
  </main>


</body>

</html>