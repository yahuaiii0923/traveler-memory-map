@extends('layouts.app')

@section('content')
<style>
    .custom-marker {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        border: 3px solid #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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

    .floating-plus-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #3b82f6;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease, background-color 0.3s ease;
        z-index: 1000;
    }

    .floating-plus-button:hover {
        transform: scale(1.1);
        background-color: #2563eb;
    }

    .plus-icon {
        width: 30px;
        height: 30px;
        stroke: white;
        stroke-width: 2;
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
</div>

<script>
    let map;
    let allMarkers = [];



    async function getImageUrl(memory) {
        let imageUrl = "/images/default.png";
        const extensions = ["jpg", "png", "jpeg", "gif", "webp"];

        if (memory.photos && memory.photos.length) {
            // Check if the filename already has an extension
            const photoName = memory.photos[0];
            const fileExtension = photoName.split('.').pop().toLowerCase();

            if (extensions.includes(fileExtension)) {
                // If the extension is already present, use it directly
                const imagePath = `/images/${photoName}`;
                const isValid = await validateImageUrl(imagePath);
                if (isValid) {
                    return imagePath;
                }
            } else {
                // If not, try adding each extension
                for (const ext of extensions) {
                    const imagePath = `/images/${photoName}.${ext}`;
                    const isValid = await validateImageUrl(imagePath);
                    if (isValid) {
                        return imagePath;
                    }
                }
            }
        }

        return imageUrl;
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

        new google.maps.marker.AdvancedMarkerElement({
            position: position,
            map: map,
            content: markerElement
        });
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
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

    window.onload = function () {
        initMap();
    };
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=marker&callback=initMap"
    async
    defer>
</script>




@endsection
