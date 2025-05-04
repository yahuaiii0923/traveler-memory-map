@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="min-h-screen bg-blue-50 flex items-center">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-6">
                Map Your Memories Around the World
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Pin your past travels, add stories, and relive your adventures on an interactive world map.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('memories.index') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-full shadow-lg transition-all">
                    🗺️ Explore Map
                </a>
                @guest
                <a href="{{ route('register') }}"
                   class="border-2 border-blue-500 text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-full transition-all">
                    ✍️ Start Pinning
                </a>
                @else
                <a href="{{ route('memories.create') }}"
                   class="border-2 border-blue-500 text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-full transition-all">
                    ✍️ Add Memory
                </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>
            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="p-6 bg-white rounded-xl shadow-sm">
                    <div class="text-4xl mb-4">📍</div>
                    <h3 class="text-xl font-semibold mb-2">Pin Destinations</h3>
                    <p class="text-gray-600">Mark locations you've visited on your personal world map</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm">
                    <div class="text-4xl mb-4">🖼️</div>
                    <h3 class="text-xl font-semibold mb-2">Add Memories</h3>
                    <p class="text-gray-600">Upload photos and write stories about your experiences</p>
                </div>
                <div class="p-6 bg-white rounded-xl shadow-sm">
                    <div class="text-4xl mb-4">🌍</div>
                    <h3 class="text-xl font-semibold mb-2">Share & Explore</h3>
                    <p class="text-gray-600">Revisit your journey and share memories with others</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Preview -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8">Explore Memories</h2>
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="h-96 w-full bg-gray-100 flex items-center justify-center">
                    <p class="text-gray-500">Interactive Map Preview</p>
                </div>
            </div>
        </div>
    </section>
@endsection
