
<nav class="w-full mx-auto px-32 h-full flex items-center justify-between">
    <!-- Logo -->
    <div class="flex items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-gray-700 to-gray-500 bg-clip-text text-transparent relative group">
            MemoryMapper
            <div class="h-[2px] w-0 group-hover:w-full transition-all duration-300 bg-[#c4b8ac] absolute bottom-0"></div>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="hidden md:flex items-center space-x-8 h-full">
        <x-nav-link href="{{ route('memories.index') }}" :active="request()->routeIs('memories.index')"
                   class="text-gray-700 hover:text-[#8a7866] transition-colors">
            Memories
        </x-nav-link>
        @auth
        <x-nav-link href="{{ route('memories.create') }}" :active="request()->routeIs('memories.create')"
                   class="text-gray-700 hover:text-[#8a7866] transition-colors">
            New Memory
        </x-nav-link>
        @endauth
    </div>

    <!-- Auth Links -->
    <div class="flex items-center space-x-4">
        @guest
        <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-[#6b5e52] transition-colors">
            Login
        </a>
        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#c4b8ac] text-white rounded-lg hover:bg-[#b3a899] transition-colors">
            Register
        </a>
        @else
        <!-- Mobile Menu Button -->
        <button @click="open = ! open" class="md:hidden text-gray-700 hover:text-[#6b5e52]">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- User Dropdown -->
        <x-dropdown align="right" width="48">
            <!-- ... existing dropdown structure ... -->
        </x-dropdown>
        @endguest
    </div>
</nav>

<!-- Mobile Menu -->
<div class="md:hidden absolute w-full bg-[#dbd3c8] border-t border-[#c4b8ac]/30" x-show="open" @click.away="open = false">
    <div class="px-4 py-2 space-y-2">
        <x-responsive-nav-link href="{{ route('memories.index') }}" class="text-gray-700 hover:bg-[#c4b8ac]/20">
            Memories
        </x-responsive-nav-link>
        @auth
        <x-responsive-nav-link href="{{ route('memories.create') }}" class="text-gray-700 hover:bg-[#c4b8ac]/20">
            New Memory
        </x-responsive-nav-link>
        @endauth
    </div>
</div>
