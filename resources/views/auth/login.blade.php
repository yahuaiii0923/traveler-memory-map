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
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800 mt-4">Login to Your Account</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login Form -->
    <div class="max-w-lg mx-auto space-y-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Welcome Back!</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-800 mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-800 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#008080] bg-white text-gray-800">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="text-gray-800">Remember Me</label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-[#374151] text-white font-semibold py-2 rounded-md hover:bg-[#2c3843] transition-all">
                    Login
                </button>
            </div>

            <!-- Forgot Password -->
            <div class="text-center mt-4">
                @if (Route::has('password.request'))
                    <a class="text-[#008080] hover:underline" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
