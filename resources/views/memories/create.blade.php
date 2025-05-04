@extends('layouts.app')

@section('content')
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New Memory</h1>

    <!-- Back Button -->
    <a href="{{ route('memories.index') }}"
       class="inline-block mb-4 text-blue-600 hover:underline">
       ← Back to Memories
    </a>
@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

   <form action="{{ route('memories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
       @csrf

       <!-- Title -->
       <div>
           <label for="title" class="block text-sm font-medium text-white mb-1">Title</label>
           <input type="text" name="title" id="title" required
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-black">
       </div>

       <!-- Description -->
       <div>
           <label for="description" class="block text-sm font-medium text-white mb-1">Description</label>
           <textarea name="description" id="description" rows="4" required
                     class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-black"></textarea>
       </div>

       <!-- Location Name -->
       <div>
           <label for="location_name" class="block text-sm font-medium text-white mb-1">Search Location</label>
           <input id="location_name" name="location_name" type="text"
                  placeholder="Type a place name..."
                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-black">

      <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
      <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

       </div>
<!-- Grouped Row: Photo, Category, Rating -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Photo Upload -->
    <div>
        <label class="block text-sm font-medium text-white mb-1">Upload Photo</label>
        <input type="file" name="photo" accept="image/*"
               class="w-full file:px-4 file:py-2 file:rounded-lg file:border-0 file:bg-blue-600 file:text-white file:cursor-pointer bg-white text-black rounded-lg border border-gray-300">
    </div>

    <!-- Rating -->
    <div>
        <label for="rating" class="block text-sm font-medium text-white mb-1">Rating (1–5)</label>
        <select name="rating" id="rating"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-black focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">-- Rate your memory --</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
</div>


       <!-- Submit -->
       <div>
           <button type="submit"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition duration-200">
               Save
           </button>
       </div>
   </form>

<script>
    let autocomplete;

    function initAutocomplete() {
        const input = document.getElementById('location_name');
        autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();

            if (!place.geometry) {
                alert("No location details available for that input.");
                return;
            }

            const lat = place.geometry.location.lat();
            const lng = place.geometry.location.lng();

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    }

    // Load Google Maps Script with callback
    (function loadGoogleScript() {
        const script = document.createElement('script');
        script.src = "https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initAutocomplete";
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    })();
    document.querySelector("form").addEventListener("submit", function (e) {
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;

        if (!lat || !lng) {
            e.preventDefault();
            alert("Please select a valid location from the suggestions.");
        }
    });

</script>

  </div>
@endsection
