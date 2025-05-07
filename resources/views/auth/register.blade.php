@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Back Button -->
    <div class="flex justify-between items-center mb-6 mt-6">
        <a href="{{ route('home') }}" class="text-[#008080] hover:underline">
            ←
        </a>
    </div>

    <!-- Page Title -->
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800 mt-4">Create Your Account</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Registration Form -->
    <div class="max-w-lg mx-auto space-y-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Welcome to MemoryMapper!</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-800 mb-1">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-800 mb-1">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-800 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-800 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
                <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters, include a letter, a number, and a symbol.</p>
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password-confirm" class="block text-sm font-medium text-gray-800 mb-1">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
            </div>

            <!-- Profile Photo -->
            <div>
                <label for="profile_photo" class="block text-sm font-medium text-gray-800 mb-1">Profile Photo (Optional)</label>
                <input id="profile_photo" type="file" name="profile_photo" accept="image/*"
                       class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white text-gray-800 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-[#374151] file:text-white hover:file:bg-[#2c3843]">
                @error('profile_photo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Register Button -->
            <div>
                <button type="submit"
                        class="w-full bg-[#374151] text-white font-semibold py-2 rounded-md hover:bg-[#2c3843] transition-all">
                    Register
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center mt-4">
                <p class="text-gray-700">Already have an account?
                    <a href="{{ route('login') }}" class="text-[#008080] hover:underline">Login</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
