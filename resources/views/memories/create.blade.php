@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Create New Memory</h1>
    <form action="{{ route('memories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" class="border rounded p-2 w-full">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="border rounded p-2 w-full"></textarea>
        </div>
        <div class="mb-4">
            <div id="map" class="h-96 w-full"></div>
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Memory</button>
    </form>
</div>
@endsection
