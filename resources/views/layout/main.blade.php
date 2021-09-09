<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="base-url" content="{{ route('home') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @auth
            <meta name="auth-user" content="{{ Auth::user() }}" />
        @endauth
        @guest
            <meta name="auth-user" content="{{ false }}" />
        @endguest

        <title>Gw2Box</title>

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <div id="app">
            <nav-bar></nav-bar>
        </div>

        @yield('content')

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
