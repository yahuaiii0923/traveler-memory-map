@extends('layouts.app')
@section('content')
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Your Travel Memories</h1>
    <a href="{{ route('memories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Memory</a>
    <div class="mt-4">
      <div id="map" class="h-[600px] w-full rounded-lg shadow-md"></div>
<div></div>
<!-- Year Filter Carousel - Centered, No Background -->
<div class="mt-6 py-2 rounded-lg">
  <div class="flex justify-center items-center gap-3 relative">

    <!-- Left Arrow -->
    <button onclick="scrollYears('left')" class="text-white text-xl hover:text-blue-400">
      &lt;
    </button>

    <!-- Scrollable Year Buttons -->
    <div id="yearScrollContainer"
         class="flex gap-3 overflow-x-auto scrollbar-hide scroll-smooth px-2">
      <button onclick="showAllMarkers()"
              class="px-4 py-2 rounded-full border border-gray-400 text-sm font-medium hover:bg-blue-500 hover:text-white transition-all active-year">
        All Years
      </button>

      @foreach ($groupedMemories as $year => $group)
        <button onclick="filterMarkersByYear({{ $year }})"
                class="px-4 py-2 rounded-full border border-gray-400 text-sm font-medium hover:bg-blue-500 hover:text-white transition-all year-button">
          {{ $year }}
        </button>
      @endforeach
    </div>

    <!-- Right Arrow -->
    <button onclick="scrollYears('right')" class="text-white text-xl hover:text-blue-400">
      &gt;
    </button>
  </div>
</div>


     <!-- Right Arrow -->
     <button onclick="scrollYears('right')" class="absolute right-0 z-10 bg-white border rounded-full p-2 shadow hover:bg-blue-100">
       &#8594;
     </button>
   </div>
 </div>

    @foreach ($memories as $memory)
      <!-- List memories here -->
    @endforeach
  </div>

  <script>
    let map;
    let allMarkers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: { lat: 0, lng: 0 }
        });

        const memories = @json($memories);
        const bounds = new google.maps.LatLngBounds();

        allMarkers = memories.map(memory => {
            const position = {
                lat: parseFloat(memory.latitude),
                lng: parseFloat(memory.longitude)
            };

            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: memory.title
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="p-2 min-w-[250px] max-w-[300px]">
                        <h3 class="font-bold text-lg mb-2">${memory.title}</h3>
                        <p class="text-sm text-gray-700 mb-2">${memory.description}</p>
                        ${memory.photo ? `<img src="/storage/${memory.photo}" class="rounded mb-2 w-full h-auto max-h-48 object-cover" alt="Memory photo">` : ''}
                        ${memory.location_name ? `<p class="text-xs text-gray-600 italic">📍 ${memory.location_name}</p>` : ''}
                        ${memory.rating ? `<p class="text-sm text-yellow-600">⭐ Rating: ${memory.rating}/5</p>` : ''}
                        <p class="text-xs text-gray-400 mt-2">Added on ${new Date(memory.created_at).getFullYear()}</p>
                    </div>`
            });

            marker.year = new Date(memory.created_at).getFullYear();

            marker.addListener('click', () => infoWindow.open(map, marker));
            bounds.extend(position);
            return marker;
        });

        if (!bounds.isEmpty()) {
            map.fitBounds(bounds);
        }
    }

    function filterMarkersByYear(year) {
        document.querySelectorAll('.year-button, .active-year').forEach(btn => {
            btn.classList.remove('active-year', 'bg-blue-500', 'text-white');
        });
        event.target.classList.add('active-year');

        const bounds = new google.maps.LatLngBounds();
        let hasVisible = false;

        allMarkers.forEach(marker => {
            const visible = marker.year === year;
            marker.setVisible(visible);
            if (visible) bounds.extend(marker.getPosition());
            hasVisible = hasVisible || visible;
        });

        if (hasVisible) {
            map.fitBounds(bounds);

              google.maps.event.addListenerOnce(map, 'idle', () => {
                      const visibleMarkers = allMarkers.filter(m => m.getVisible());
                      if (visibleMarkers.length === 1) {
                          map.setZoom(4); // Set a comfortable zoom level manually
                      } else {
                          const currentZoom = map.getZoom();
                          if (currentZoom > 4) {
                              map.setZoom(currentZoom - 1); // Zoom out slightly for context
                          }
                      }
                  })
        }
    }

    function showAllMarkers() {
        document.querySelectorAll('.year-button, .active-year').forEach(btn => {
            btn.classList.remove('active-year', 'bg-blue-500', 'text-white');
        });
        document.querySelector('button.active-year').classList.add('active-year');

        const bounds = new google.maps.LatLngBounds();
        allMarkers.forEach(marker => {
            marker.setVisible(true);
            bounds.extend(marker.getPosition());
        });
        map.fitBounds(bounds);
    }

    window.initMap = initMap;
  </script>


  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>


@endsection
