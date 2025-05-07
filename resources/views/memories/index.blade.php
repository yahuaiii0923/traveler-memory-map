@extends('layouts.app')

@section('content')
<style>
    .custom-marker {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        border: 1.5px solid #ffffff;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3);
        position: absolute;
        transform: translate(-50%, -50%);
    }

    .marker-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    #map {
        width: 100%;
        height: 800px;
        max-height: 90vh;
        overflow: hidden;
        margin-bottom: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .year-filter-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgba(55, 65, 81, 0.9); /* Gray with slight transparency */
        display: flex;
        justify-content: center;
        padding: 10px 0;
        z-index: 1000;
    }

    .year-filters {
        display: flex;
        gap: 8px;
    }

    .year-filters button {
        background-color: #2563eb;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: transform 0.2s, background-color 0.2s;
    }

    .year-filters button:hover {
        transform: scale(1.05);
        background-color: #3b82f6;
    }
</style>

<!-- Floating Plus Button -->
<a href="{{ route('memories.create') }}" class="floating-plus-button">
    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" class="plus-icon">
        <path d="M12 5v14m7-7H5"/>
    </svg>
</a>

<div class="w-full max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-white mb-4">Your Travel Memories</h1>
    <div id="map"></div>

    <!-- Year Filter Container at the Bottom of the Map -->
    <div class="year-filter-container">
        <div class="year-filters">
            <button onclick="filterMarkers('all')">All</button>
            @foreach($years as $year)
            <button onclick="filterMarkers({{ $year }})">{{ $year }}</button>
            @endforeach
        </div>
    </div>

<script>
    let map;
    let allMarkers = [];

    async function getImageUrl(memory) {
        const defaultUrl = "/images/default.png";
        const extensions = ["jpg", "png", "jpeg", "gif", "webp"];

        if (memory.photos && memory.photos.length) {
            let photoName = memory.photos[0];

            // Clean up the file name from extra prefixes and extensions
            photoName = photoName.replace(/^images\//, '').replace(/\.[^/.]+$/, "");

            for (const ext of extensions) {
                const imagePath = `/images/${photoName}.${ext}`;
                const isValid = await validateImageUrl(imagePath);
                if (isValid) {
                    return imagePath;
                }
            }
        }
        return defaultUrl;
    }

    function validateImageUrl(url) {
        return new Promise((resolve) => {
            const img = new Image();
            img.onload = () => resolve(true);
            img.onerror = () => resolve(false);
            img.src = url;
        });
    }

    async function createMarker(memory, position) {
        const imageUrl = await getImageUrl(memory);

        const markerElement = document.createElement("div");
        markerElement.classList.add("custom-marker");

        const markerImage = document.createElement("img");
        markerImage.classList.add("marker-image");
        markerImage.src = imageUrl;
        markerElement.appendChild(markerImage);

        const marker = new google.maps.marker.AdvancedMarkerElement({
            position: position,
            map: map,
            content: markerElement
        });

        marker.memoryYear = new Date(memory.created_at).getFullYear();
        allMarkers.push(marker);
    }

    function filterMarkers(year) {
        allMarkers.forEach(marker => {
            const markerYear = marker.memoryYear;
            marker.map = (year === 'all' || markerYear === parseInt(year)) ? map : null;
        });
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 3,
            center: { lat: 20, lng: 0 },
            mapId: "{{ env('GOOGLE_MAPS_MAP_ID') }}",
        });

        const memories = {!! json_encode($memories) !!};
        const bounds = new google.maps.LatLngBounds();

        memories.forEach(async (memory) => {
            const position = new google.maps.LatLng(parseFloat(memory.latitude), parseFloat(memory.longitude));
            await createMarker(memory, position);
            bounds.extend(position);
        });

        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);
        }
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=marker&callback=initMap">
</script>

@endsection
