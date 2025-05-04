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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head-scripts')
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <!-- Fixed Header -->
    <header class="fixed w-full top-0 z-50 h-16 md:h-20 bg-white dark:bg-gray-800 shadow-sm">
        @include('layouts.navigation')
    </header>

    <!-- Main Content -->
    <main class="pt-16 md:pt-20 min-h-screen">
        @yield('content')
    </main>

    <!-- Scripts Stack -->
    @stack('scripts')
</body>
</html>
