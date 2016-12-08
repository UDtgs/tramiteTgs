<!DOCTYPE html>

<html lang="es">

    <head>
        <link type="text/css" rel="stylesheet" href="{{asset('style.css')}}">
        <title>@yield("title")</title>
        <meta charset="utf-8" />
        @yield('head')
    </head>

    <body>
        @include('template.header')
        <div id="content">
            @yield('content')
        </div>
        <footer>
            Teoria General de Sistemas 2016 - 3
        </footer>
        @yield('script')
    </body>
</html>