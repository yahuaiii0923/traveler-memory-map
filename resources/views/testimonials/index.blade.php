@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold">Testimonials</h1>
        @foreach($testimonials as $testimonial)
            <div class="bg-white p-4 mb-4 rounded shadow">
                <h2 class="text-xl">{{ $testimonial->name }}</h2>
                <p>{{ $testimonial->text }}</p>
                <p class="text-gray-600">{{ $testimonial->role }}</p>
            </div>
        @endforeach

        <!-- Pagination Links -->
        {{ $testimonials->links() }}
    </div>
@endsection
