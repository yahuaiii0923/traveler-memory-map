@extends('layouts.app')
@section('content')
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New Memory</h1>
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
        <x-map :lat="old('latitude', 0)" :lng="old('longitude', 0)" />
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
  </div>
  @extends('layouts.app')
  @section('content')
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Add New Memory</h1>
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
          <x-map :lat="old('latitude', 0)" :lng="old('longitude', 0)" />
          <input type="hidden" name="latitude" id="latitude">
          <input type="hidden" name="longitude" id="longitude">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
      </form>
    </div>
  @endsection

@endsection
