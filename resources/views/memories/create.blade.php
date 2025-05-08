@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8 p-12 bg-[#dbd3c8]/30 shadow-2xl rounded-3xl border border-[#dbd3c8] max-w-4xl relative">
    <!-- Back button absolutely positioned to the left -->
    <a href="{{ route('memories.index') }}"
       class="absolute left-12 top-12 text-[#5f5240] hover:text-[#aee2e8] font-medium transition-all text-4xl">
        ←
    </a>

    <!-- Centered heading -->
    <h1 class="text-5xl font-bold text-gray-800 mb-8 text-center">Add New Memory</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6">
        <ul class="list-disc pl-6">
            @foreach ($errors->all() as $error)
            <li class="text-base">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('memories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Title -->
        <div class="space-y-2">
            <label for="title" class="block text-2xl font-semibold text-gray-800">Memory Title</label>
            <input type="text" name="title" id="title" required
                   class="w-full px-6 py-3 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-gray-800">
        </div>

        <!-- Description -->
        <div class="space-y-2">
            <label for="description" class="block text-2xl font-semibold text-gray-800">Memory Description</label>
            <textarea name="description" id="description" rows="6" required
                      class="w-full px-6 py-3 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-gray-800"></textarea>
        </div>

        <!-- Location Name -->
        <div class="space-y-2">
            <label for="location_name" class="block text-2xl font-semibold text-gray-800">Location</label>
            <input id="location_name" name="location_name" type="text" placeholder="Search for a location..."
                   class="w-full px-6 py-3 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-gray-800">
        </div>

        <!-- Hidden fields for latitude and longitude -->
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">

        <!-- Photo Upload -->
        <div class="space-y-2">
            <label class="block text-2xl font-semibold text-gray-800">Upload Photos</label>
            <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                   class="w-full file:px-4 file:py-2 file:rounded-lg file:bg-[#6b7280] file:text-white hover:file:bg-[#aee2e8] transition-all">
            <div id="photo-preview" class="mt-4 grid grid-cols-2 gap-6"></div>
        </div>

        <!-- Rating -->
        <div class="space-y-2">
            <label for="rating" class="block text-2xl font-semibold text-gray-800">Memory Rating</label>
            <select name="rating" id="rating"
                    class="w-full px-6 py-3 rounded-lg border border-[#dbd3c8] bg-[#f8f6f2] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#aee2e8]">
                <option value="">-- Select Rating (1-5) --</option>
                @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <!-- Submit -->
        <div class="text-center mt-8">
            <button type="submit"
                    class="bg-[#6b7280] hover:bg-[#aee2e8] text-white px-12 py-4 rounded-full shadow-xl font-semibold transition duration-300">
                Save Your Memory
            </button>
        </div>
    </form>
    <script>
        let autocomplete;

        function initAutocomplete() {
            const locationInput = document.getElementById('location_name');

            if (locationInput) {
                autocomplete = new google.maps.places.Autocomplete(locationInput, {
                    types: ['geocode'],  // Restrict to addresses
                    componentRestrictions: { country: 'ie' }  // Restrict to Ireland
                });

                // Listen for the place changed event
                autocomplete.addListener('place_changed', function () {
                    const place = autocomplete.getPlace();
                    if (place.geometry) {
                        const latitude = place.geometry.location.lat();
                        const longitude = place.geometry.location.lng();

                        // Store coordinates in hidden inputs
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;

                        console.log('Selected place:', place);
                        console.log('Latitude:', latitude, 'Longitude:', longitude);
                    } else {
                        console.error('No geometry data available for this place.');
                    }
                });
            } else {
                console.error('Location input element not found.');
            }
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initAutocomplete&libraries=places"></script>

</div>

@endsection
