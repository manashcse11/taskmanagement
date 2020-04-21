<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Task Management - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        <script src="{{ asset('js/app.js') }}" ></script>
    </head>
    <body>
    <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Tasks</a>
                        <a class="nav-item nav-link {{ Request::routeIs('projects.index') ? 'active' : '' }}" href="{{ route('projects.index') }}">Projects</a>
                    </div>
                </div>
            </nav>
            <div class="mt-5">
                @yield('content')
            </div>

        </div>
    </body>
</html>
