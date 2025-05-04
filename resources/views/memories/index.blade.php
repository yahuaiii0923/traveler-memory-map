@extends('layouts.app')
@section('content')

<style>
  .no-scrollbar::-webkit-scrollbar {
    display: none;
  }
  .no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  #carouselWrapper::before,
  #carouselWrapper::after {
    content: "";
    position: absolute;
    top: 0;
    width: 60px;
    height: 100%;
    z-index: 20;
    pointer-events: none;
  }

  #carouselWrapper::before {
    left: 0;
    background: linear-gradient(to right, #0f172a, transparent);
  }

  #carouselWrapper::after {
    right: 0;
    background: linear-gradient(to left, #0f172a, transparent);
  }
 #scrollLeftZone,
 #scrollRightZone {
   opacity: 0;
   background: transparent;
   width: 24px; /* keep width for hover functionality */
   height: 100%;
   position: absolute;
   top: 0;
   z-index: 30;
   pointer-events: auto;
 }
</style>

<div class="container mx-auto p-0">
  <h1 class="text-2xl font-bold mb-4 text-white">Your Travel Memories</h1>
  <a href="{{ route('memories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Memory</a>

  <div class="mt-4">
    <div id="map" class="w-full h-[calc(100vh-160px)]"></div>
  </div>

  <!-- Year Carousel -->
  <div class="flex items-center justify-center py-6 relative z-10 bg-[#0f172a]">
    <!-- All Years Button -->
    <button onclick="showAllMarkers()"
            class="px-6 py-3 border border-white rounded-full text-base font-semibold text-white bg-black year-button transition-transform duration-200 hover:scale-110 hover:ring-2 hover:ring-blue-400 mr-3">
      All Years
    </button>

    <!-- Scrollable Container with Gradient Edges -->
    <div id="carouselWrapper" class="relative w-[160px] overflow-hidden">
      <div id="carouselScroll"
           class="flex gap-4 transition-transform duration-300 ease-in-out whitespace-nowrap no-scrollbar overflow-x-auto scroll-smooth px-1">
        @foreach ($years as $year)
          <button onclick="filterMarkersByYear({{ $year }})"
                  class="inline-block px-6 py-3 border border-white rounded-full text-base font-semibold text-white bg-black year-button transition-transform duration-200 hover:scale-110 hover:ring-2 hover:ring-blue-400">
            {{ $year }}
          </button>
        @endforeach
      </div>

      <!-- Scroll zones -->
      <div id="scrollLeftZone" class="absolute left-0 top-0 h-full w-6 z-30"></div>
      <div id="scrollRightZone" class="absolute right-0 top-0 h-full w-6 z-30"></div>
    </div>
  </div>
</div>

<!-- Google Map Logic -->
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
          <div class="bg-white rounded-xl shadow-lg p-6 max-w-md w-full">
            <h3 class="text-xl font-bold text-gray-900 mb-3">${memory.title}</h3>
            <p class="text-sm text-gray-700 mb-3">${memory.description}</p>
            ${memory.photo ? `<img src="/storage/${memory.photo}" class="w-full h-52 object-cover rounded-md mb-3 border" alt="Memory photo">` : ''}
            ${memory.location_name ? `<p class="text-sm text-gray-500 mb-1">📍 <em>${memory.location_name}</em></p>` : ''}
            ${memory.rating ? `<p class="text-sm text-yellow-600 mb-2">⭐ <strong>Rating:</strong> ${memory.rating}/5</p>` : ''}
            <p class="text-xs text-gray-400">🗓️ Added on ${new Date(memory.created_at).getFullYear()}</p>
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
          map.setZoom(4);
        }
      });
    }
  }

  function showAllMarkers() {
    document.querySelectorAll('.year-button, .active-year').forEach(btn => {
      btn.classList.remove('active-year', 'bg-blue-500', 'text-white');
    });

    const allButton = document.querySelector('button[onclick="showAllMarkers()"]');
    if (allButton) allButton.classList.add('active-year');

    const bounds = new google.maps.LatLngBounds();
    allMarkers.forEach(marker => {
      marker.setVisible(true);
      bounds.extend(marker.getPosition());
    });

    map.fitBounds(bounds);
  }

  window.initMap = initMap;
</script>

<!-- Hover Scroll Script -->
<script>
  const scrollContainer = document.getElementById('carouselScroll');
  const leftZone = document.getElementById('scrollLeftZone');
  const rightZone = document.getElementById('scrollRightZone');
  let scrollInterval;

  function startAutoScroll(direction) {
    stopAutoScroll();
    scrollInterval = setInterval(() => {
      scrollContainer.scrollLeft += direction * 8; // ⬆️ Faster scroll speed
    }, 10);
  }

  function stopAutoScroll() {
    clearInterval(scrollInterval);
  }

  leftZone.addEventListener('mouseenter', () => startAutoScroll(-1));
  rightZone.addEventListener('mouseenter', () => startAutoScroll(1));
  leftZone.addEventListener('mouseleave', stopAutoScroll);
  rightZone.addEventListener('mouseleave', stopAutoScroll);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endsection
