<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "icon" type = "image/png" href="{{ Vite::asset('resources/img/logo-icon.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('partials.header')
        <main class="bg-green">
            <div class="container py-5">
                @yield('content')
            </div>
        </main>
        @include('partials.footer')
    </div>
    @include('partials.footer')

    @yield('scripts')
</body>

</html>