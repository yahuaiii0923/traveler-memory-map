@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="min-h-[calc(100vh-4rem)] md:min-h-[calc(100vh-5rem)] relative bg-gradient-to-br from-amber-50 to-amber-100">
        <div class="container mx-auto px-4 h-full flex items-center pt-4 md:pt-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl md:text-6xl font-bold text-amber-900 mb-6 animate-fadeInUp">
                    Preserve Your <span class="bg-gradient-to-r from-amber-600 to-amber-400 bg-clip-text text-transparent">Travel Legacy</span>
                </h1>
                <p class="text-xl md:text-2xl text-amber-800/90 mb-8 animate-fadeInUp delay-100">
                    Craft timeless narratives from your journeys in golden hues
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fadeInUp delay-200">
                    <a href="{{ route('memories.index') }}" class="btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Explore Memories
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Begin Journey
                    </a>
                    @else
                    <a href="{{ route('memories.create') }}" class="btn-secondary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        New Memory
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-amber-50/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-amber-900 mb-4">Golden Memory Crafting</h2>
                <p class="text-xl text-amber-800/90">Curate your experiences with gilded precision</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-amber-100 hover:shadow-lg transition-all">
                    <div class="w-16 h-16 bg-amber-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-amber-900 mb-3">Golden Mapping</h3>
                    <p class="text-amber-700/90">Pinpoint locations with golden precision</p>
                </div>
                <!-- Add other features similarly -->
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12">
                <div class="relative">
                    <div class="absolute left-6 h-full w-1 bg-gradient-to-b from-amber-200 to-amber-400"></div>
                    <div class="space-y-12 pl-10">
                        <div class="relative">
                            <div class="absolute left-0 w-6 h-6 bg-amber-400 rounded-full border-4 border-white -translate-x-1/2"></div>
                            <div class="text-sm text-amber-600 font-semibold">May 2023</div>
                            <h4 class="text-xl font-semibold text-amber-900 mt-2">Santorini Sunsets</h4>
                            <p class="text-amber-700/90 mt-2">Captured golden hour over Aegean waters</p>
                            <div class="flex items-center mt-3 text-amber-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                Oia, Santorini
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-amber-50 rounded-xl h-96 sticky top-24 border border-amber-100 overflow-hidden">
                    <div id="travel-map" class="w-full h-full rounded-xl"></div>
                </div>

                @push('scripts')
                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

                <script>
                    // Initialize map
                    const map = L.map('travel-map').setView([36.3932, 25.4615], 13); // Santorini coordinates

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);

                    // Add sample marker
                    L.marker([36.3932, 25.4615]).addTo(map)
                        .bindPopup('Santorini Memory<br>May 2023')
                        .openPopup();
                </script>
                @endpush
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-amber-100/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-amber-900 mb-4">Golden Travelers' Tales</h2>
                <p class="text-xl text-amber-800/90">Stories that glimmer with adventure</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-amber-100 hover:shadow-md transition-all">
                    <div class="flex items-start mb-4">
                        <img src="https://source.unsplash.com/100x100/?portrait-{{ $loop->index }}"
                             class="w-12 h-12 rounded-full mr-4 border-2 border-amber-200 hover:border-amber-300 transition-colors"
                             alt="{{ $testimonial['name'] }}">
                        <div>
                            <h4 class="font-bold text-amber-900">{{ $testimonial['name'] }}</h4>
                            <p class="text-sm text-amber-600">{{ $testimonial['role'] }}</p>
                        </div>
                    </div>
                    <p class="text-amber-700/90 mb-4">{{ $testimonial['text'] }}</p>
                    <div class="flex items-center text-amber-600 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        {{ $testimonial['metric'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-amber-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="grid md:grid-cols-3 gap-8 text-center">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-amber-100">
                        <div class="text-5xl font-bold text-amber-600 mb-2">{{ $stats['memories'] }}</div>
                        <div class="text-amber-700 uppercase text-sm tracking-wide">Golden Memories</div>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-amber-100">
                        <div class="text-5xl font-bold text-amber-600 mb-2">{{ $stats['countries'] }}</div>
                        <div class="text-amber-700 uppercase text-sm tracking-wide">Countries Explored</div>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-amber-100">
                        <div class="text-5xl font-bold text-amber-600 mb-2">{{ $stats['photos'] }}</div>
                        <div class="text-amber-700 uppercase text-sm tracking-wide">Moments Captured</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-br from-amber-400 to-amber-600">
        <div class="container mx-auto px-4 py-20 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Ready to Gild Your Memories?</h2>
            <p class="text-xl text-amber-100 mb-8">Begin your golden travel chronicle today</p>
            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-amber-600 font-semibold rounded-lg hover:bg-amber-50 transition-all shadow-lg hover:shadow-xl">
                Start Your Legacy
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.animate-fadeInUp').forEach(el => observer.observe(el));
    });
</script>
@endpush
