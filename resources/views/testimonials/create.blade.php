@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-4">Submit a Testimonial</h2>

    <form action="{{ route('testimonials.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Role</label>
            <input type="text" name="role" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Testimonial</label>
            <textarea name="text" class="w-full border p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Metric (e.g., "1200+ Memories Created")</label>
            <input type="text" name="metric" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Related Memory Slug (optional)</label>
            <input type="text" name="memory_slug" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_public" value="1" checked>
                <span class="ml-2">Make testimonial public</span>
            </label>
        </div>

        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Submit</button>
    </form>
</div>
@endsection
