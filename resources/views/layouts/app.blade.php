<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @include('layouts.logout')
    <script>
        document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || 'light');
    </script>
    <div class="min-h-screen bg-base-200">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <div class="flex">
            @include('layouts.sidebar')
            <!-- Page Content -->
            <div class="w-full lg:pl-80">
                @isset($header)
                    <header class="bg-base-100 shadow-sm">
                        <div class="max-w-9xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        @include('sweetalert::alert')
    </div>
</body>

</html>
