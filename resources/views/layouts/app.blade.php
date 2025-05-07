<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MemoryMapper') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head-scripts')
</head>
<body>
    <!-- Header - Full width background -->
    <header class="fixed w-full top-0 z-50 h-16 md:h-20 shadow-sm border-b border-[#c4b8ac]/30 bg-[#374151] text-[#f5f0e9]">
        @include('layouts.navigation')
    </header>

    <!-- Main Content -->
    <main class="pt-16 md:pt-20 min-h-screen">
        @yield('content')
    </main>

    @include('layouts.footer')
</body>
</html>
