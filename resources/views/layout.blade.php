<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">


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
              <a class="nav-link active" aria-current="page" href="/user-table">
                <ya-tr-span data-index="1-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Home" data-translation="Пользователь" data-type="trSpan">Пользователь</ya-tr-span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/post-table">
                <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Link" data-translation="Должность" data-type="trSpan">Должность</ya-tr-span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/otdel-table">
                <ya-tr-span data-index="2-0" data-translated="true" data-source-lang="en" data-target-lang="ru" data-value="Link" data-translation="Отдел" data-type="trSpan">Отдел</ya-tr-span>
              </a>
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