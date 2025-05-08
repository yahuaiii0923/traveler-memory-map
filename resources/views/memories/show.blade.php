@extends('layouts.app')

@section('content')
<div class="memory-details">
    <h2>{{ $memory->title }}</h2>
    <p>{{ $memory->description }}</p>
    <p>Location: {{ $memory->location_name }}</p>
    <p>Date: {{ $memory->created_at->format('F d, Y') }}</p>

    <div class="image-gallery">
        @foreach($memory->photos as $photo)
        <img src="{{ asset('storage/' . $photo->file_path) }}" alt="Memory Image" class="memory-image">
        @endforeach
    </div>

    <a href="{{ route('memories.index') }}" class="btn btn-primary">Back to Memories</a>
</div>
@endsection
<css>
    .memory-details {
    margin: 20px;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;
    }

    .image-gallery {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    }

    .memory-image {
    width: 150px;
    height: 100px;
    object-fit: cover;
    border-radius: 6px;
    }

</css>
