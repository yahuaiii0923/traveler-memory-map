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

      @foreach ($memories as $memory)
        new google.maps.Marker({
          position: {
            lat: {{ $memory->latitude }},
            lng: {{ $memory->longitude }}
          },
          map: map,
          title: @json($memory->title),
        });
      @endforeach
    }
    window.initMap = initMap;
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
@endsection
