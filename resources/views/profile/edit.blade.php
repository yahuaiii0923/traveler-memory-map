@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl border border-[#dbd3c8]">

        <!-- Edit Profile Header -->
        <div class="bg-[#374151] p-6 rounded-t-xl">
            <h1 class="text-3xl font-semibold text-[#f5f0e9] text-center">Edit Profile</h1>
        </div>

        <!-- Edit Profile Form -->
        <div class="p-8 space-y-6">
            @if(isset($user))
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('patch')

                    <!-- Profile Photo Preview -->
                    <div class="flex items-center justify-center">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-[#c4b8ac] bg-[#f5f0e9]">
                            <img src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : 'https://img.icons8.com/?size=100&id=ABBSjQJK83zf&format=png&color=f5f0e9' }}"
                                 alt="Profile Photo" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Profile Photo Upload -->
                    <div class="space-y-2 text-center">
                        <label for="profile_photo" class="block text-gray-700 font-medium">Profile Photo</label>
                        <input id="profile_photo" type="file" name="profile_photo"
                               class="block w-full mt-2 p-2 border rounded-md bg-gray-50 text-gray-700 focus:ring-2 focus:ring-[#c4b8ac]">
                        @error('profile_photo')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div class="space-y-2">
                        <label for="name" class="block text-gray-700 font-medium">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="block w-full p-2 border rounded-md bg-gray-50 text-gray-700 focus:ring-2 focus:ring-[#c4b8ac]">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="space-y-2">
                        <label for="username" class="block text-gray-700 font-medium">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}"
                               class="block w-full p-2 border rounded-md bg-gray-50 text-gray-700 focus:ring-2 focus:ring-[#c4b8ac]">
                        @error('username')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="space-y-2">
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="block w-full p-2 border rounded-md bg-gray-50 text-gray-700 focus:ring-2 focus:ring-[#c4b8ac]">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Save Button -->
                    <div class="text-center">
                        <button type="submit"
                                class="px-6 py-2 bg-[#c4b8ac] text-white font-semibold rounded-lg hover:bg-[#b3a899] transition-all">
                            Save Changes
                        </button>
                    </div>
                </form>
            @else
                <p class="text-red-500 text-center">User data not found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
