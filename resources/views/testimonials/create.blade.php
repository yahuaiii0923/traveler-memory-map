@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-20 p-6 bg-white shadow rounded-xl border border-[#dbd3c8]">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Share Your Testimonial</h2>

    <form method="POST" action="{{ route('testimonials.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Role</label>
            <input type="text" name="role" class="w-full p-3 rounded border border-gray-300">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Testimonial</label>
            <textarea name="text" class="w-full p-3 rounded border border-gray-300" rows="4" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700">Travel Metric (e.g., 5 countries visited)</label>
            <input type="text" name="metric" class="w-full p-3 rounded border border-gray-300">
        </div>

        <button type="submit" class="bg-[#5f5240] text-white px-6 py-3 rounded hover:bg-[#463d31] transition">
            Submit Testimonial
        </button>
    </form>
</div>
@endsection
