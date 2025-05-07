@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="min-h-[calc(100vh-4rem)] md:min-h-[calc(100vh-5rem)] relative flex items-center justify-center">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/breathtaking-view-natural-beach-landscape.jpg') }}"
                     class="w-full h-full object-cover object-center"
                     alt="Sailboat background">
            </div>

            <!-- Content Container -->
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6 animate-fadeInUp">
                        <span class="block">Welcome to</span>
                        <span class="bg-gradient-to-r from-white via-[#6b7280] to-[#1e2a38] bg-clip-text text-transparent">
                            Memory Mapper
                        </span>
                    </h1>

                    <p class="text-xl md:text-2xl text-gray-700 mb-8 animate-fadeInUp delay-100">
                        Your personal compass for preserving unforgettable journeys.
                    </p>

                    <div class="animate-fadeInUp delay-200">
                        <a href="{{ route('memories.index') }}"
                           class="inline-flex items-center bg-gray-800 hover:bg-gray-700 text-[#dbd3c8] px-8 py-4 rounded-lg font-semibold transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            Explore Memories
                        </a>
                    </div>
                </div>
            </div>
        </section>

    <!-- Features Section -->
    <section class="py-20 bg-[#dbd3c8]/30">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Why Choose Memory Mapper?</h2>
                    <p class="text-xl text-[#5f5240]">Capture, map, and relive your most cherished travel experiences.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                        <div class="w-16 h-16 bg-[#dbd3c8] rounded-xl flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-[#5f5240]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-[#5f5240] mb-3">Interactive World Mapping</h3>
                        <p class="text-[#7a6b59]">Drop pins on your journey and watch your adventures come to life with immersive map views.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                        <div class="w-16 h-16 bg-[#dbd3c8] rounded-xl flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-[#5f5240]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-[#5f5240] mb-3">Chronological Journey</h3>
                        <p class="text-[#7a6b59]">Effortlessly arrange your travels in a time-ordered flow that feels like storytelling.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                        <div class="w-16 h-16 bg-[#dbd3c8] rounded-xl flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-[#5f5240]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-[#5f5240] mb-3">Visual Memory Showcase</h3>
                        <p class="text-[#7a6b59]">Create an elegant travel gallery—highlighting your favorite sights, moments, and stories.</p>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-8 mt-16">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                        <h3 class="text-2xl font-semibold text-[#5f5240] mb-3">Personalized Location Details</h3>
                        <p class="text-[#7a6b59]">Attach custom notes, tags, and dates to every location—building a deeply personal travel archive.</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                        <h3 class="text-2xl font-semibold text-[#5f5240] mb-3">Mobile-Friendly Exploration</h3>
                        <p class="text-[#7a6b59]">Access your Memory Map on the go, anytime, anywhere—perfect for travel journaling on the move.</p>
                    </div>
                </div>
            </div>
        </section>

    <!-- Timeline Section -->
       <section class="py-20 bg-[#ede6dd]">
           <div class="container mx-auto px-4">
               <div class="text-center mb-16">
                   <h2 class="text-4xl font-bold text-gray-800 mb-4">Journey Timeline</h2>
                   <p class="text-xl text-gray-700/90">Navigate through your coastal memories</p>
               </div>

               <div class="grid lg:grid-cols-2 gap-8 lg:gap-16">
                   <!-- Interactive Timeline -->
                   <div class="relative space-y-12">
                       <div class="absolute left-6 h-full w-1 bg-gradient-to-b from-[#dbd3c8] to-[#dbd3c8]/40"></div>

                       <!-- Santorini Entry -->
                       <div class="relative group pl-10 timeline-entry"
                            data-lat="36.3932"
                            data-lng="25.4615"
                            data-zoom="13">
                           <div class="absolute left-0 w-6 h-6 bg-[#dbd3c8] rounded-full border-4 border-white -translate-x-1/2 transition-all group-hover:scale-125 group-hover:bg-[#c4b8ac]"></div>
                           <div class="p-6 bg-white rounded-xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                               <div class="flex items-baseline gap-4">
                                   <div class="text-sm font-semibold text-[#c4b8ac]">May 2023</div>
                                   <div class="w-4 h-px bg-[#dbd3c8] flex-1"></div>
                               </div>
                               <h3 class="text-2xl font-semibold text-gray-800 mt-2">Santorini Sunsets</h3>
                               <p class="text-gray-600/90 mt-2">Golden hour over Aegean waters</p>
                               <div class="flex items-center mt-4 text-[#8a7866]">
                                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                   </svg>
                                   <span class="text-sm font-medium">Oia, Santorini</span>
                               </div>
                           </div>
                       </div>

                       <!-- Maldives Entry -->
                       <div class="relative group pl-10 timeline-entry"
                            data-lat="4.1755"
                            data-lng="73.5093"
                            data-zoom="12">
                           <div class="absolute left-0 w-6 h-6 bg-[#dbd3c8] rounded-full border-4 border-white -translate-x-1/2 transition-all group-hover:scale-125 group-hover:bg-[#c4b8ac]"></div>
                           <div class="p-6 bg-white rounded-xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                               <div class="flex items-baseline gap-4">
                                   <div class="text-sm font-semibold text-[#c4b8ac]">August 2023</div>
                                   <div class="w-4 h-px bg-[#dbd3c8] flex-1"></div>
                               </div>
                               <h3 class="text-2xl font-semibold text-gray-800 mt-2">Maldives Serenity</h3>
                               <p class="text-gray-600/90 mt-2">Turquoise meets powder sands</p>
                               <div class="flex items-center mt-4 text-[#8a7866]">
                                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                   </svg>
                                   <span class="text-sm font-medium">Malé, Maldives</span>
                               </div>
                           </div>
                       </div>

                       <!-- Bali Entry -->
                       <div class="relative group pl-10 timeline-entry opacity-90 hover:opacity-100 transition-opacity duration-300"
                            data-lat="-8.4095"
                            data-lng="115.1889"
                            data-zoom="12">
                           <div class="absolute left-0 w-6 h-6 bg-[#dbd3c8] rounded-full border-4 border-white -translate-x-1/2 transition-all group-hover:scale-125 group-hover:bg-[#c4b8ac]"></div>
                           <div class="p-6 bg-white rounded-xl shadow-sm border border-[#dbd3c8] hover:shadow-lg transition-all">
                               <div class="flex items-baseline gap-4">
                                   <div class="text-sm font-semibold text-[#c4b8ac]">November 2023</div>
                                   <div class="w-4 h-px bg-[#dbd3c8] flex-1"></div>
                               </div>
                               <h3 class="text-2xl font-semibold text-gray-800 mt-2">Bali Retreat</h3>
                               <p class="text-gray-600/90 mt-2">Emerald rice terraces and ocean bliss</p>
                               <div class="flex items-center mt-4 text-[#8a7866]">
                                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                   </svg>
                                   <span class="text-sm font-medium">Ubud, Bali</span>
                               </div>
                           </div>
                       </div>
                   </div>

                   <!-- Google Map Container -->
                   <div class="sticky top-24 h-[600px] rounded-xl overflow-hidden shadow-lg border border-[#dbd3c8]">
                       <div id="travel-map" class="w-full h-full bg-[#dbd3c8]/20"></div>
                   </div>
               </div>
           </div>
       </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gradient-to-b from-[#f8f6f2] to-[#ede8e1]">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">What Explorers Say & Memory Stats</h2>
                    <p class="text-xl text-gray-700/90">Reflections and numbers from your fellow Memory Mappers</p>
                </div>

                <!-- Testimonials -->
                <div class="grid md:grid-cols-3 gap-8 mb-20">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-[#dbd3c8] hover:shadow-md transition-all">
                            <div class="flex items-start mb-4">
                                <img src="https://source.unsplash.com/100x100/?portrait-{{ $loop->index }}"
                                     class="w-12 h-12 rounded-full mr-4 border-2 border-[#dbd3c8] hover:border-[#c4b8ac] transition-colors"
                                     alt="{{ $testimonial->name }}">
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $testimonial->name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $testimonial->role }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600/90 mb-4">{{ $testimonial->text }}</p>
                            <div class="flex items-center text-gray-600 text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ $testimonial->metric }}
                            </div>
                            @if($testimonial->memory_slug && $testimonial->is_public)
                                <a href="{{ route('memories.show', $testimonial->memory_slug) }}"
                                   class="mt-3 inline-block text-sm text-[#5f5240] hover:underline">
                                    → View This Memory
                                </a>
                            @endif
                        </div>
                    @endforeach
                    <div class="text-center mt-10 col-span-full">
                        <a href="{{ route('testimonials.index') }}" class="text-[#008080] hover:underline font-medium mr-4">
                            → View all testimonials
                        </a>
                        <a href="{{ route('testimonials.create') }}" class="text-[#008080] hover:underline font-medium">
                            → Share your own testimonial
                        </a>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid md:grid-cols-3 gap-8 text-center mb-20">
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-[#dbd3c8]">
                        <div class="text-5xl font-bold text-gray-700 mb-2">{{ $stats['memories'] }}</div>
                        <div class="text-gray-600 uppercase text-sm tracking-wide">Sandy Memories</div>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-[#dbd3c8]">
                        <div class="text-5xl font-bold text-gray-700 mb-2">{{ $stats['countries'] }}</div>
                        <div class="text-gray-600 uppercase text-sm tracking-wide">Coasts Explored</div>
                    </div>
                    <div class="bg-white p-8 rounded-xl shadow-sm border border-[#dbd3c8]">
                        <div class="text-5xl font-bold text-gray-700 mb-2">{{ $stats['photos'] }}</div>
                        <div class="text-gray-600 uppercase text-sm tracking-wide">Tides Captured</div>
                    </div>
                </div>
            </div>
        </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-br from-[#dbd3c8] to-[#c4b8ac]">
            <div class="container mx-auto px-4 py-20 text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Preserve Your Memories?</h2>
                <p class="text-xl text-gray-700/90 mb-8">Begin your coastal travel chronicle today</p>
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-4 bg-white text-gray-800 font-semibold rounded-lg hover:bg-[#dbd3c8]/20 transition-all shadow-lg hover:shadow-xl">
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
    function initMap() {
        const mapContainer = document.getElementById('travel-map');
        if (!mapContainer) return;

        const map = new google.maps.Map(mapContainer, {
            center: { lat: 36.3932, lng: 25.4615 },
            zoom: 5,
            styles: [
                { featureType: "poi", stylers: [{ visibility: "off" }] },
                { featureType: "transit", stylers: [{ visibility: "off" }] }
            ]
        });

        const locations = [
            { title: "Santorini", lat: 36.3932, lng: 25.4615, date: "May 2023" },
            { title: "Maldives", lat: 4.1755, lng: 73.5093, date: "August 2023" },
            { title: "Bali", lat: -8.4095, lng: 115.1889, date: "November 2023" }
        ];

        const infoWindow = new google.maps.InfoWindow();

        locations.forEach(loc => {
            const marker = new google.maps.Marker({
                position: { lat: loc.lat, lng: loc.lng },
                map: map,
                title: loc.title
            });

            marker.addListener("mouseover", () => {
                infoWindow.setContent(`<strong>${loc.title}</strong><br>${loc.date}`);
                infoWindow.open(map, marker);
            });

            marker.addListener("mouseout", () => {
                infoWindow.close();
            });
        });

        document.querySelectorAll('.timeline-entry').forEach(entry => {
            entry.addEventListener('mouseenter', function () {
                const lat = parseFloat(this.dataset.lat);
                const lng = parseFloat(this.dataset.lng);
                const zoom = parseInt(this.dataset.zoom);
                map.panTo({ lat, lng });
                map.setZoom(zoom);
            });
        });
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&callback=initMap"></script>
