@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#dbd3c8]/30 py-16 flex items-center justify-center">
    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl border border-[#dbd3c8] px-8 py-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Create Your Account</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input id="name" type="text"
                       class="w-full px-4 py-2 border border-[#dbd3c8] rounded-lg focus:ring-2 focus:ring-[#c4b8ac] @error('name') border-red-500 @enderror"
                       name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input id="username" type="text"
                       class="w-full px-4 py-2 border border-[#dbd3c8] rounded-lg focus:ring-2 focus:ring-[#c4b8ac] @error('username') border-red-500 @enderror"
                       name="username" value="{{ old('username') }}" required>
                @error('username')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input id="email" type="email"
                       class="w-full px-4 py-2 border border-[#dbd3c8] rounded-lg focus:ring-2 focus:ring-[#c4b8ac] @error('email') border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password"
                       class="w-full px-4 py-2 border border-[#dbd3c8] rounded-lg focus:ring-2 focus:ring-[#c4b8ac] @error('password') border-red-500 @enderror"
                       name="password" required>
                <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters, include a letter, a number, and a symbol.</p>
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input id="password-confirm" type="password"
                       class="w-full px-4 py-2 border border-[#dbd3c8] rounded-lg"
                       name="password_confirmation" required>
            </div>

            <!-- Profile Photo -->
            <div>
                <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-1">Profile Photo (Optional)</label>
                <input id="profile_photo" type="file"
                       class="w-full px-4 py-2 border border-[#dbd3c8] rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-[#dbd3c8]/50 file:text-gray-700 hover:file:bg-[#c4b8ac]/70"
                       name="profile_photo" accept="image/*">
                @error('profile_photo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                        class="w-full bg-[#1f2937] text-[#dbd3c8] py-3 rounded-lg font-semibold hover:bg-[#374151] transition-all">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
