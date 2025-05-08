@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-[#f8f6f2] py-8">
    <!-- Floating Plus Button -->
    <a href="{{ route('memories.create') }}" class="fixed bottom-8 right-8 bg-[#d3bba3] text-[#002d62] p-4 rounded-full shadow-lg hover:scale-110 transition-transform">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
            <path d="M12 5v14m7-7H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>

    <div class="w-full max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-5xl font-extrabold text-[#374151] mb-6">Your Travel Memories</h1>
        <div id="map" class="w-full h-[700px] rounded-md shadow-md"></div>

        <!-- Year Filter Carousel -->
        <div class="flex justify-center items-center bg-gray-800 text-gray-100 py-6 rounded-full shadow-lg mt-8 relative overflow-hidden">
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-100" fill="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l4 8H8l4-8z" />
                </svg>
            </div>
            <div id="yearFilters" class="flex space-x-4 px-4 py-3 overflow-x-auto scrollbar-hide transform-gpu transition-transform duration-300">
            </div>
        </div>
    </div>
</div>

<script>
    let map;
    let allMarkers = [];
    const currentYear = new Date().getFullYear();
    const memories = {!! json_encode($memories) !!};
    const years = Array.from(new Set(memories.map(memory => new Date(memory.created_at).getFullYear()))).sort((a, b) => b - a);

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 20, lng: 0 },
            zoom: 3,
            mapId:'ad19d26bd1eaba5671468b3c',
            mapTypeControl: false,
            mapTypeId: 'roadmap'
        });

        const bounds = new google.maps.LatLngBounds();

        memories.forEach(async (memory) => {
            const position = { lat: parseFloat(memory.latitude), lng: parseFloat(memory.longitude) };
            await createMarker(memory, position);
            bounds.extend(position);
        });

        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);
        }
        updateYearButtons();
    }
    window.initMap = initMap;

    async function createMarker(memory, position) {
        const imageUrl = await getImageUrl(memory);
        const markerElement = document.createElement('div');
        markerElement.style.width = '50px';
        markerElement.style.height = '50px';
        markerElement.style.borderRadius = '50%';
        markerElement.style.backgroundImage = `url(${imageUrl})`;
        markerElement.style.backgroundSize = 'cover';
        markerElement.style.border = '2px solid #374151';

        if (google.maps.marker && google.maps.marker.AdvancedMarkerElement) {
            const marker = new google.maps.marker.AdvancedMarkerElement({
                map: map,
                position: position,
                title: memory.title,
                content: markerElement,
            });
            marker.memoryYear = new Date(memory.created_at).getFullYear();
            allMarkers.push(marker);
        }
    }

    function getImageUrl(memory) {
        if (memory.photos && memory.photos.length) {
            const photoPath = memory.photos[0].file_path;
            return `{{ asset('storage/${photoPath}') }}`;
        }
        return "{{ asset('images/default.png') }}";
    }

    function updateYearButtons() {
        const yearFilters = document.getElementById("yearFilters");
        yearFilters.innerHTML = `<button onclick="filterMarkers('all')" class="bg-gray-700 text-gray-400 px-4 py-2 rounded-full transition-transform transform hover:scale-110">All Years</button>`;
        years.forEach((year) => {
            yearFilters.innerHTML += `<button onclick="filterMarkers(${year})" class="bg-gray-700 text-gray-400 px-4 py-2 rounded-full transition-transform transform hover:scale-110">${year}</button>`;
        });
    }

    function filterMarkers(year) {
        allMarkers.forEach(marker => {
            marker.setMap((year === 'all' || marker.memoryYear === parseInt(year)) ? map : null);
        });
    }
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=marker&v=beta"></script>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection