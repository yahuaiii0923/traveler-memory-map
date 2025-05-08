@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold mb-6">Testimonials</h1>

    @foreach($testimonials as $testimonial)
        <div class="bg-white p-4 mb-4 rounded shadow">
            <h3 class="text-xl font-semibold">{{ $testimonial->name }} ({{ $testimonial->username }})</h3>
            <p>{{ $testimonial->text }}</p>
            <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
            <p class="text-sm text-gray-400">{{ $testimonial->metric }}</p>
        </div>
    @endforeach
</div>
@endsection
