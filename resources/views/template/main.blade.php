<!DOCTYPE html>
<html lang="es">

    <head>
        <link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
        <title>@yield("title")</title>
        <meta charset="utf-8" />
        @yield('head')
    </head>

    <body>
        @include('template.header')
        <br/><br/>
        <div id="content">
            @yield('content')
        </div>
        <br/><br/>
        <footer class="footer">
                <br>
                Universidad Distrital Francisco José de Caldas<br>
                Facultad Tecnologica<br>
                Teoria General de Sistemas<br>
                2016 -3<br>
        </footer>
        @yield('script')
    </body>
</html>