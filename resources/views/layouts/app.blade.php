<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Login Page HTML Template">
        <title>B-Space Auth</title>

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('partials.head')
    </head>
    <body class="bg-light">
        <div id="app">
            <main>
                @yield('content')
            </main>
        </div>

        @include('partials.scripts')

    </body>
</html>
