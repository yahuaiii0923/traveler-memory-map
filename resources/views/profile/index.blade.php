@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Hero Section -->
    <div class="relative bg-[#374151] p-8 rounded-xl shadow-lg mb-8 text-center">
        <div class="flex items-center justify-center">
            <div class="w-32 h-32 p-1 rounded-full overflow-hidden border-4 border-[#f5f0e9]">
              <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://img.icons8.com/?size=100&id=ABBSjQJK83zf&format=png&color=f5f0e9' }}"
                   alt="Profile Photo" class="w-32 h-32 rounded-full">
            </div>
        </div>
        <h1 class="text-4xl font-bold text-[#f5f0e9] mt-4">{{ $user->name }}</h1>
        <p class="text-lg text-[#f5f0e9] opacity-75">@ {{ $user->username }}</p>
        <p class="text-sm text-[#f5f0e9] opacity-75">{{ $user->email }}</p>
    </div>

    <!-- My Memories Section -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-[#dbd3c8] mb-8">
        <h2 class="text-2xl font-bold text-[#374151] mb-4">My Memories</h2>
        @if($user->memories->isEmpty())
            <p class="text-[#374151]/90">You haven't shared any memories yet.</p>
            <a href="{{ route('memories.create') }}" class="text-[#11bdbd] hover:underline">Share your first memory</a>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($user->memories as $memory)
                    <div class="p-4 bg-[#dbd3c8]/20 rounded-lg hover:shadow-md transition-all">
                        <h3 class="text-xl font-semibold text-[#374151]">{{ $memory->title }}</h3>
                        <p class="text-gray-700">{{ Str::limit($memory->description, 100) }}</p>
                        <a href="{{ route('memories.show', $memory->slug) }}" class="text-[#11bdbd] hover:underline">View Memory</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Account Settings -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-[#dbd3c8]">
        <h2 class="text-2xl font-bold text-[#374151] mb-4">Account Settings</h2>
        <a href="{{ route('profile.edit') }}" class="text-[#11bdbd] hover:underline">Update Profile</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-700 text-white rounded-2xl hover:bg-red-500 transition-all">Log Out</button>
        </form>
    </div>
</div>
@endsection
