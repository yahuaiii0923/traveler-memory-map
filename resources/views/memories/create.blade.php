@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-28 mb-40 p-12 bg-[#dbd3c8]/30 shadow-2xl rounded-3xl border border-[#dbd3c8] max-w-4xl relative">
    <!-- Back button with journal feel -->
    <a href="{{ route('memories.index') }}"
       class="absolute left-8 top-8 text-[#374151] hover:text-[#aee2e8] font-medium transition-all text-3xl">
        ←
    </a>

    <!-- Journal-Style Heading -->
    <div class="text-center mb-8">
        <div class="text-2xl font-bold text-[#374151] mb-2">New Memory Entry</div>
        <div class="h-1 bg-[#374151] w-32 mx-auto"></div>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6 border-l-4 border-red-500">
        <ul class="list-disc pl-6">
            @foreach ($errors->all() as $error)
            <li class="text-base">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('memories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Title -->
        <div class="space-y-2">
            <label for="title" class="block text-xl font-semibold text-[#374151]">Memory Title</label>
            <input type="text" name="title" id="title" required
                   class="w-full px-4 py-2 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-[#374151]">
        </div>

        <!-- Description -->
        <div class="space-y-2">
            <label for="description" class="block text-xl font-semibold text-[#374151]">Memory Description</label>
            <textarea name="description" id="description" rows="4" required
                      class="w-full px-4 py-2 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-[#374151]"></textarea>
        </div>

        <!-- Location Name with Autocomplete -->
        <div class="space-y-2">
            <label for="location_name" class="block text-xl font-semibold text-[#374151]">Location</label>
            <input id="location_name" name="location_name" type="text" placeholder="Where did this happen?"
                   class="w-full px-4 py-2 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-[#374151]">
        </div>

        <!-- Hidden fields for latitude and longitude -->
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">

        <!-- Photo Upload with Preview and Deletion -->
        <div class="space-y-2">
            <label class="block text-xl font-semibold text-[#374151]">Upload Photos</label>
            <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                   class="w-full file:px-3 file:py-1 file:rounded-lg file:bg-[#374151] file:text-[#dbd3c8] hover:file:bg-[#aee2e8] transition-all">
            <div id="photo-preview" class="mt-4 grid grid-cols-2 gap-4"></div>
        </div>

        <!-- Submit Button - Reduced bottom margin here since we added container margin -->
        <div class="text-center mt-6 mb-16">
            <button type="submit"
                    class="bg-[#374151] hover:bg-[#aee2e8] text-[#dbd3c8] px-10 py-3 rounded-full shadow-xl font-semibold transition duration-300">
                Save Memory
            </button>
        </div>
    </form>

    <script>
        let autocomplete;
        function initAutocomplete() {
            const locationInput = document.getElementById('location_name');
            if (locationInput) {
                autocomplete = new google.maps.places.Autocomplete(locationInput, {
                    types: ['geocode'], // Allow any geographic location
                });
                autocomplete.addListener('place_changed', function () {
                    const place = autocomplete.getPlace();
                    if (place.geometry) {
                        document.getElementById('latitude').value = place.geometry.location.lat();
                        document.getElementById('longitude').value = place.geometry.location.lng();
                    }
                });
            }
        }

        const photoInput = document.getElementById('photos');
        const preview = document.getElementById('photo-preview');
        let uploadedFiles = [];

        photoInput.addEventListener('change', function(event) {
            Array.from(event.target.files).forEach((file) => {
                uploadedFiles.push(file);
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group rounded-xl overflow-hidden shadow-md';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-48 object-cover';
                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = '×';
                    removeBtn.className = 'absolute top-1 right-1 text-white bg-red-600 rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700 transition-all';
                    removeBtn.onclick = () => {
                        uploadedFiles = uploadedFiles.filter(f => f !== file);
                        div.remove();
                    };
                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initAutocomplete&libraries=places"></script>

</div>
@endsection
