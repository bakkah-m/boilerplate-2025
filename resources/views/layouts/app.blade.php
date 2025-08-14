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
            <div class="w-full transition-all duration-200 ease-in-out" id="main-content">

                @isset($header)
                    <header class="bg-base-100 shadow-xs px-4 rounded-none lg:rounded-lg lg:px-0 lg:m-4 lg:mb-0 card flex-row justify-between items-center">
                        <div class="py-6 sm:px-6 ">
                            {{ $header }}
                        </div>
                        <div class="py-6 sm:px-6 lg:flex gap-2 hidden">
                            <a class="link" href="{{'/'}}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" />
                                </svg>
                            </a>
                            {{ isset($menu) ? '/' : '' }}
                            {{ $menu ?? '' }}
                        </div>
                    </header>
                @endisset
                <main>
                    {{ $slot }}
                </main>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var value = localStorage.getItem('sidebar');
                    var mainContent = document.getElementById('main-content');

                    if (value === 'open') {
                        mainContent.classList.add('lg:pl-80');
                    } else {
                        mainContent.classList.remove('lg:pl-80');
                    }
                })
            </script>
        </div>

        @include('sweetalert::alert')
    </div>
</body>

</html>
