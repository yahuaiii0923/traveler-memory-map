<main class="flex-1">
    @yield('content')
</main>

<footer class="bg-[#374151] text-[#f5f0e9] py-8">
    <div class="container px-4 mb-12">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <!-- Brand & Copyright -->
            <div class="text-center md:text-left">
                <h2 class="text-xl font-semibold">MemoryMapper</h2>
                <p class="text-sm">Your personal travel diary</p>
                <p class="text-xs">&copy; {{ date('Y') }} MemoryMapper. All rights reserved.</p>
            </div>

            <!-- Social Media Links -->
            <div class="flex space-x-4">
                <a href="https://facebook.com" target="_blank" class="text-[#f5f0e9] hover:text-[#008080]">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com" target="_blank" class="text-[#f5f0e9] hover:text-[#008080]">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="text-[#f5f0e9] hover:text-[#008080]">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://linkedin.com" target="_blank" class="text-[#f5f0e9] hover:text-[#008080]">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <!-- Links -->
        <div class="mt-6 text-center">
            <a href="{{ route('about') }}" class="text-sm text-[#f5f0e9] hover:text-[#008080]">About Us</a> |
            <a href="{{ route('contact') }}" class="text-sm text-[#f5f0e9] hover:text-[#008080]">Contact</a> |
            <a href="{{ route('privacy') }}" class="text-sm text-[#f5f0e9] hover:text-[#008080]">Privacy Policy</a>
        </div>
    </div>
</footer>
