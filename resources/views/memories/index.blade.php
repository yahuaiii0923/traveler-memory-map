@extends('layouts.app')
@section('content')
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Your Travel Memories</h1>
    <a href="{{ route('memories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Memory</a>
    <div class="mt-4">
      <div id="map" class="h-96 w-full"></div>
    </div>
    @foreach ($memories as $memory)
      <!-- List memories here -->
    @endforeach
  </div>

  <script>
      function initMap() {
          const map = new google.maps.Map(document.getElementById("map"), {
              center: {
                  lat: {{ $memories->first()->latitude ?? 0 }},
                  lng: {{ $memories->first()->longitude ?? 0 }}
              },
              zoom: 4,
          });

          const memories = @json($memories);

          memories.forEach(memory => {
              const marker = new google.maps.Marker({
                  position: {
                      lat: parseFloat(memory.latitude),
                      lng: parseFloat(memory.longitude)
                  },
                  map: map,
                  title: memory.title
              });

              const infoWindow = new google.maps.InfoWindow({
                  content: `
                      <div class="p-2 min-w-[200px]">
                          <h3 class="font-bold text-lg mb-1">${memory.title}</h3>
                          <p class="text-gray-600">${memory.description}</p>
                          <p class="text-gray-500 italic">${memory.location_name}</p>
                          <p class="text-xs text-gray-400 mt-2">Added in ${new Date(memory.created_at).getFullYear()}</p>
                      </div>`
              });

              marker.addListener('click', () => {
                  infoWindow.open(map, marker);
              });
          });
      }

      window.initMap = initMap;
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>

@endsection
