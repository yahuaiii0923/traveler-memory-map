@extends('layouts.app')

@section('content')
<div class="container mx-auto my-12 p-20 bg-[#dbd3c8]/30 shadow-2xl rounded-3xl border border-[#dbd3c8] max-w-4xl">
    <h1 class="text-5xl font-bold text-gray-800 mb-12 text-center">Add New Memory</h1>

    <!-- Back Button -->
    <a href="{{ route('memories.index') }}"
       class="inline-block mb-8 text-[#5f5240] hover:text-[#aee2e8] font-medium transition-all">
        ← Back to Memories
    </a>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-8">
        <ul class="list-disc pl-6">
            @foreach ($errors->all() as $error)
            <li class="text-base">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('memories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf

        <!-- Title -->
        <div class="space-y-3">
            <label for="title" class="block text-2xl font-semibold text-gray-800">Memory Title</label>
            <input type="text" name="title" id="title" required
                   class="w-full px-6 py-4 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-gray-800">
        </div>

        <!-- Description -->
        <div class="space-y-3">
            <label for="description" class="block text-2xl font-semibold text-gray-800">Memory Description</label>
            <textarea name="description" id="description" rows="6" required
                      class="w-full px-6 py-4 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-gray-800"></textarea>
        </div>

        <!-- Location Name -->
        <div class="space-y-3">
            <label for="location_name" class="block text-2xl font-semibold text-gray-800">Location</label>
            <input id="location_name" name="location_name" type="text" placeholder="Search for a location..."
                   class="w-full px-6 py-4 rounded-lg border border-[#dbd3c8] focus:outline-none focus:ring-2 focus:ring-[#aee2e8] bg-[#f8f6f2] text-gray-800">
        </div>

        <!-- Photo Upload -->
        <div class="space-y-3">
            <label class="block text-2xl font-semibold text-gray-800">Upload Photos</label>
            <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                   class="w-full file:px-5 file:py-3 file:rounded-lg file:bg-[#6b7280] file:text-white hover:file:bg-[#aee2e8] transition-all">
            <div id="photo-preview" class="mt-6 grid grid-cols-2 gap-8"></div>
        </div>

        <!-- Rating -->
        <div class="space-y-3">
            <label for="rating" class="block text-2xl font-semibold text-gray-800">Memory Rating</label>
            <select name="rating" id="rating"
                    class="w-full px-6 py-4 rounded-lg border border-[#dbd3c8] bg-[#f8f6f2] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#aee2e8]">
                <option value="">-- Select Rating (1-5) --</option>
                @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <!-- Submit -->
        <div class="text-center mt-10">
            <button type="submit"
                    class="bg-[#6b7280] hover:bg-[#aee2e8] text-white px-12 py-5 rounded-full shadow-xl font-semibold transition duration-300">
                Save Your Memory
            </button>
        </div>
    </form>

</div>
@endsection
