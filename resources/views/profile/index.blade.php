@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden border border-[#dbd3c8]">

        <!-- Profile Header -->
        <div class="bg-[#f5f0e9] p-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-[#c4b8ac]">
                    <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://img.icons8.com/?size=100&id=ABBSjQJK83zf&format=png&color=c4b8ac' }}"
                         alt="Profile Photo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->username }}</p>
                    <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="p-6 space-y-6">
            <h2 class="text-xl font-bold text-gray-700">My Memories</h2>
            @if($user->memories->isEmpty())
                <p class="text-gray-600">You haven't shared any memories yet.</p>
                <a href="{{ route('memories.create') }}" class="text-[#008080] font-bold hover:underline">Share your first memory</a>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($user->memories as $memory)
                        <div class="p-4 bg-[#dbd3c8]/20 rounded-lg border border-[#dbd3c8] hover:shadow-md transition-all">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $memory->title }}</h3>
                            <p class="text-sm text-gray-600">{{ Str::limit($memory->description, 100) }}</p>
                            <a href="{{ route('memories.show', $memory->slug) }}" class="text-[#008080] font-bold hover:underline">
                                View Memory
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Testimonials -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-700">My Testimonials</h2>
                @if($user->testimonials->isEmpty())
                    <p class="text-gray-600">You haven't shared any testimonials yet.</p>
                    <a href="{{ route('testimonials.create') }}" class="text-[#008080] font-bold hover:underline">Share your story</a>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($user->testimonials as $testimonial)
                            <div class="p-4 bg-[#dbd3c8]/20 rounded-lg border border-[#dbd3c8] hover:shadow-md transition-all">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $testimonial->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $testimonial->text }}</p>
                                <span class="text-xs text-gray-500">{{ $testimonial->created_at->format('d M Y') }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Account Settings -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-700">Account Settings</h2>
                <a href="{{ route('profile.edit') }}" class="text-[#008080] font-bold hover:underline">Update Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500 transition-all">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
