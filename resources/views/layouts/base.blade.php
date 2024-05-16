<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ isset($titlePrefix) ? $titlePrefix : "Internal Swytch" }}  {{ isset($title) ? " - ".$title : "" }}</title>

        <!-- Styles -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        @yield('headStyles')

        <!-- Scripts -->
        @yield('headScripts')
    </head>
    <body id="app">
        @yield('navbar')

        <div class="container">
            @yield('content')
        </div>

        @auth
        <script>
            window.Laravel = {!! json_encode(['api_token' => (Auth::user())->api_token, 'user_id' => auth()->id()]) !!}
        </script>
        @endauth
        {{-- https://laravel-mix.com/docs/5.0/workflow --}}
        <script src="{{ mix('js/app.js') }}"></script> 
        @yield('scripts')
    </body>
</html>
