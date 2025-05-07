@extends('layouts.app')

@section('content')
<style>
    #map {
        width: 100%;
        height: 800px;
        max-height: 90vh;
        overflow: hidden;
        margin-bottom: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    }

    .carousel-wrapper {
        background-color: #1f2937;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0.5rem 0 1rem;
        overflow-x: auto;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .carousel-track {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 1.5rem;
        height: 120px;
        white-space: nowrap;
        padding: 0 1rem;
    }

    .year-button {
        flex: 0 0 auto;
        width: 56px;
        height: 56px;
        border-radius: 9999px;
        background-color: #374151;
        color: white;
        font-weight: 600;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        scroll-snap-align: center;
        transition: all 0.3s ease;
    }

    .year-button:hover {
        background-color: #4b5563;
    }

    .year-button.active {
        background-color: #3b82f6;
    }
</style>

<div class="w-full max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-white mb-4">Your Travel Memories</h1>
    <a href="{{ route('memories.create') }}" class="bg-black text-white px-4 py-2 rounded mb-6 inline-block">+</a>

    <div id="map"></div>
</div>

<div class="w-full max-w-7xl mx-auto px-4">
    <div class="carousel-wrapper">
        <div class="carousel-track">
            <button class="year-button active" onclick="showAllMarkers()" id="all-years-btn">All</button>
            @if(is_countable($years) && count($years) > 0)
            @foreach ($years as $year)
            <button class="year-button" onclick="filterMarkersByYear({{ $year }})">{{ $year }}</button>
            @endforeach
            @endif
        </div>
    </div>
</div>

<script>
    let map;
    let allMarkers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: { lat: 20, lng: 0 }
        });

        const memories = {!! json_encode($memories) !!};
        const bounds = new google.maps.LatLngBounds();

        memories.forEach(memory => {
            const position = new google.maps.LatLng(parseFloat(memory.latitude), parseFloat(memory.longitude));
            const imageUrl = memory.photos && memory.photos.length
                ? `{{ asset('images/') }}/${memory.photos[0]}`
                : "{{ asset('images/default.png') }}";
            const year = new Date(memory.created_at).getFullYear();

            // Create a div for the custom marker with an image inside
            const markerDiv = document.createElement("div");
            markerDiv.className = "custom-marker";

            const img = document.createElement("img");
            img.src = imageUrl;
            img.className = "marker-image";
            markerDiv.appendChild(img);

            // Create a custom marker using the div
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: memory.title,
                icon: {
                    url: imageUrl,
                    scaledSize: new google.maps.Size(60, 60), // Match the CSS size
                },
                year: year
            });

            allMarkers.push(marker);
            bounds.extend(position);
        });


        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);
        }
    }


    function createCircularImage(url, size, callback) {
        const canvas = document.createElement("canvas");
        canvas.width = size;
        canvas.height = size;
        const context = canvas.getContext("2d");

        const img = new Image();
        img.onload = () => {
            // Draw a circular image
            context.beginPath();
            context.arc(size / 2, size / 2, size / 2, 0, 2 * Math.PI);
            context.closePath();
            context.clip();
            context.drawImage(img, 0, 0, size, size);

            // Optional: Add a border
            context.lineWidth = 3;
            context.strokeStyle = "white";
            context.stroke();

            callback(canvas.toDataURL());
        };
        img.src = url;
    }

    function addMemoryMarker(memory) {
        const position = new google.maps.LatLng(parseFloat(memory.latitude), parseFloat(memory.longitude));
        const imageUrl = memory.photos && memory.photos.length
            ? `{{ asset('images/') }}/${memory.photos[0]}`
            : "{{ asset('images/default.png') }}";
        const year = new Date(memory.created_at).getFullYear();

        createCircularImage(imageUrl, 60, (iconUrl) => {
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: memory.title,
                icon: {
                    url: iconUrl,
                    scaledSize: new google.maps.Size(60, 60), // Adjusted size for visibility
                },
                year: year
            });

            allMarkers.push(marker);
            bounds.extend(position);
        });
    }

    memories.forEach(memory => {
        addMemoryMarker(memory);
    });


    function filterMarkersByYear(year) {
        document.querySelectorAll('.year-button').forEach(btn => btn.classList.remove('active'));
        event.currentTarget.classList.add('active');
        allMarkers.forEach(marker => {
            marker.setVisible(marker.year === year);
        });
    }

    function showAllMarkers() {
        document.querySelectorAll('.year-button').forEach(btn => btn.classList.remove('active'));
        document.getElementById('all-years-btn').classList.add('active');
        allMarkers.forEach(marker => {
            marker.setVisible(true);
        });
    }

    window.onload = function () {
        initMap();
    };
</script>

<!-- Placing the script at the bottom to ensure it loads correctly -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
@endsection
