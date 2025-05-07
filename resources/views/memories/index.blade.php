@extends('layouts.app')

@section('content')
<style>
    .carousel-wrapper {
        background-color: #1f2937; /* gray-800 */
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0.5rem 0 1rem;
        overflow-x: auto;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .carousel-wrapper::-webkit-scrollbar {
        display: none;
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
        pointer-events: auto;
        position: relative;
        transition: all 0.3s ease;

        --angle: calc((var(--index) - ((var(--total) - 1) / 2)) * 12deg);
        transform: rotate(var(--angle)) translateY(-50px) rotate(calc(-1 * var(--angle)));
    }

    .year-button:hover {
        background-color: #4b5563;
        transform: rotate(var(--angle)) translateY(-55px) rotate(calc(-1 * var(--angle))) scale(1.05);
        z-index: 2;
    }

    .year-button.active {
        background-color: #3b82f6;
        box-shadow: 0 0 0 3px #3b82f6;
        z-index: 3;
    }

    .year-button.active::after {
        content: "";
        position: absolute;
        top: calc(100% + 5px);
        left: 50%;
        transform: translateX(-50%);
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #3b82f6;
    }
</style>

<div class="w-full max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-white mb-4">Your Travel Memories</h1>
    <a href="{{ route('memories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">Add Memory</a>

    <!-- Map -->
    <div id="map" class="w-full h-[500px] md:h-[600px] lg:h-[700px] max-h-[80vh] overflow-hidden mb-4 rounded shadow relative"></div>
</div>

<!-- Arc Carousel Below Map -->
<div class="w-full max-w-7xl mx-auto px-4">
    <div class="carousel-wrapper">
        <div class="carousel-track">
            <button class="year-button active" onclick="showAllMarkers()" id="all-years-btn" style="--index: 0; --total: {{ count($years) + 1 }};">
                All
            </button>
            @foreach ($years as $index => $year)
            <button class="year-button" onclick="filterMarkersByYear({{ $year }})" style="--index: {{ $index + 1 }}; --total: {{ count($years) + 1 }};">
                {{ $year }}
            </button>
            @endforeach
        </div>
    </div>
</div>

<script>
    let map;
    let allMarkers = [];
    let allYearsCenter;
    let allYearsZoom;

    window.initMap = function () {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: { lat: 0, lng: 0 },
            mapTypeControl: false,
            fullscreenControl: false,
            streetViewControl: false,
            zoomControl: true
        });

        setTimeout(() => {
            google.maps.event.trigger(map, "resize");
        }, 300);

        window.addEventListener("resize", () => {
            google.maps.event.trigger(map, "resize");
        });

        const memories = {!! json_encode($memories) !!};
        const bounds = new google.maps.LatLngBounds();

        allMarkers = memories.map(memory => {
            const position = {
                lat: parseFloat(memory.latitude),
                lng: parseFloat(memory.longitude)
            };

            const marker = new google.maps.Marker({
                position,
                map,
                title: memory.title
            });

            const photoHtml = memory.photos && memory.photos.length
                ? memory.photos.map(path =>
                    `<img src="/storage/${path}" class="w-full h-40 object-cover rounded mb-3 border" alt="Memory photo">`
                ).join('')
                : '';
            const infoWindow = new google.maps.InfoWindow({
                content: `
                <div class='bg-white rounded-xl shadow-lg p-6 max-w-md w-full'>
                    <h3 class='text-xl font-bold text-gray-900 mb-3'>${memory.title}</h3>
                    <p class='text-sm text-gray-700 mb-3'>${memory.description}</p>
                    ${photoHtml}
                    ${memory.location_name ? `<p class='text-sm text-gray-500 mb-1'>📍 <em>${memory.location_name}</em></p>` : ''}
                    ${memory.rating ? `<p class='text-sm text-yellow-600 mb-2'>⭐ <strong>Rating:</strong> ${memory.rating}/5</p>` : ''}
                    <p class='text-xs text-gray-400'>🗓️ Added on ${new Date(memory.created_at).getFullYear()}</p>
                </div>`
            });

            marker.year = new Date(memory.created_at).getFullYear();

            marker.addListener('click', () => {
                const previousCenter = map.getCenter();
                const previousZoom = map.getZoom();

                infoWindow.open(map, marker);

                // Recenter to ensure the InfoWindow is fully visible
                map.panTo(marker.getPosition());
                map.panBy(0, -100); // Move view slightly upward to accommodate popup

                google.maps.event.addListenerOnce(infoWindow, 'closeclick', () => {
                    map.setCenter(previousCenter);
                    map.setZoom(previousZoom);
                });
            });


            bounds.extend(position);
            return marker;
        });

        if (!bounds.isEmpty()) {
            map.fitBounds(bounds, 100);
            google.maps.event.addListenerOnce(map, 'bounds_changed', () => {
                allYearsCenter = map.getCenter();
                allYearsZoom = map.getZoom();
            });
        }
    };

    function filterMarkersByYear(year) {
        document.querySelectorAll('.year-button').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');

        allMarkers.forEach(marker => {
            marker.setVisible(marker.year === year);
        });

        if (allYearsCenter && allYearsZoom) {
            map.setCenter(allYearsCenter);
            map.setZoom(allYearsZoom);
        }
    }

    function showAllMarkers() {
        document.querySelectorAll('.year-button').forEach(btn => btn.classList.remove('active'));
        document.getElementById('all-years-btn').classList.add('active');

        const bounds = new google.maps.LatLngBounds();
        allMarkers.forEach(marker => {
            marker.setVisible(true);
            bounds.extend(marker.getPosition());
        });

        map.fitBounds(bounds, 100);
        google.maps.event.addListenerOnce(map, 'bounds_changed', () => {
            allYearsCenter = map.getCenter();
            allYearsZoom = map.getZoom();
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endsection
