<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>@yield('title')</title>

    <!-- Scripts -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/png">

    @vite(['resources/css/mqtt.css', 'resources/js/mqtt.js'])
    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    {{--
    <x-banner /> --}}
    <div class="bg-[#f6f5f2] min-h-screen dark:bg-gray-900">
        <x-navbar />
        <x-sidebar />

        <div class="p-4 sm:ml-64">
            <div class="p-4 mt-14 rounded-lg border-gray-200 dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>
        
        @stack('modals')
        @livewireScripts
    </body>
</html>



{{-- <!DOCTYPE html>
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
        @vite(['resources/css/mqtt.css', 'resources/js/mqtt.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="mx-auto max-w-7xl px-4 py-6 lg:px-8 sm:px-6">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html> --}}
