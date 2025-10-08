<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="https://pprpi.org/asset_home/img/logo.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <script>
        document.documentElement.setAttribute('data-theme', 'light');
    </script>
    <div class="min-h-screen bg-base-200">
        @include('layouts.landing-nav')

        <!-- Page Content -->
        <main class="min-h-screen">
            {{ $slot }}
        </main>

        @include('layouts.landing-footer')


        @include('sweetalert::alert')
    </div>
</body>

</html>