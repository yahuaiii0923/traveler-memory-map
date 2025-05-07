@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden border border-[#dbd3c8]">

        <!-- Edit Profile Header -->
        <div class="bg-[#dbd3c8]/30 p-4 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800">Edit Profile</h1>
        </div>

        <!-- Edit Profile Form -->
        <div class="p-4 space-y-4">
            @if(isset($user))
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('patch')

                    <!-- Name -->
                    <div class="space-y-1">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="block w-full mt-1 border-gray-300 rounded-md">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="space-y-1">
                        <label for="username" class="block text-gray-700">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}"
                               class="block w-full mt-1 border-gray-300 rounded-md">
                        @error('username')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-1">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="block w-full mt-1 border-gray-300 rounded-md">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Profile Photo -->
                    <div class="space-y-2">
                        <label for="profile_photo" class="block text-gray-700">Profile Photo</label>
                        <input id="profile_photo" type="file" name="profile_photo" class="block w-full mt-1">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="mt-2 w-24 h-24 rounded-full">
                        @else
                            <p class="text-gray-500">No profile photo uploaded.</p>
                        @endif
                        @error('profile_photo')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Save Button -->
                    <div class="space-y-1">
                        <button type="submit" class="px-4 py-2 bg-[#c4b8ac] text-white rounded-lg hover:bg-[#b3a899] transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            @else
                <p class="text-red-500">User data not found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
