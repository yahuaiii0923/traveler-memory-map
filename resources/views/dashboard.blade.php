@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Hero Section -->
    <section class="relative bg-[#374151] py-16">
        <div class="container mx-auto text-center text-white">
            <h1 class="text-4xl font-bold mb-4">Welcome Back, {{ Auth::user()->name }}!</h1>
            <p class="text-xl">Keep track of your journey memories and explore your travel stats.</p>
        </div>
    </section>

    <!-- Stats Section -->
    <div class="container mx-auto py-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="stat-card bg-white p-8 rounded-xl shadow-lg text-center">
            <h2 class="text-3xl font-bold text-gray-800">{{ $stats['memories'] }}</h2>
            <p class="text-gray-600">Total Memories</p>
        </div>
        <div class="stat-card bg-white p-8 rounded-xl shadow-lg text-center">
            <h2 class="text-3xl font-bold text-gray-800">{{ $stats['countries'] }}</h2>
            <p class="text-gray-600">Countries Visited</p>
        </div>
        <div class="stat-card bg-white p-8 rounded-xl shadow-lg text-center">
            <h2 class="text-3xl font-bold text-gray-800">{{ $stats['photos'] }}</h2>
            <p class="text-gray-600">Photos Uploaded</p>
        </div>
    </div>

    <!-- Recent Memories Section -->
    <div class="container mx-auto py-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Memories</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($recentMemories as $memory)
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold text-gray-800">{{ $memory->title }}</h3>
                    <p class="text-gray-600">{{ $memory->description }}</p>
                    <a href="{{ route('memories.show', $memory->id) }}" class="text-blue-600 hover:underline">View Memory</a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="container mx-auto py-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('memories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Add Memory</a>
            <a href="{{ route('memories.index') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg">View Memories</a>
            <a href="{{ route('map') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg">Memory Map</a>
        </div>
    </div>
</div>
@endsection
