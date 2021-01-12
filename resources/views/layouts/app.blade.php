<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>

        @guest()
            @include('partials.auth.head')
        @endguest

        @include('partials.dashboard.scripts')
    </head>
    <body>
    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
    </body>
</html>
