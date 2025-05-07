<nav class="w-full mx-auto px-16 md:px-32 h-full flex items-center justify-between bg-[#374151] text-[#f5f0e9]">
    <!-- Logo -->
    <div class="flex items-center">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-[#f5f0e9] to-[#c4b8ac] bg-clip-text text-transparent relative group">
            MemoryMapper
            <div class="h-[2px] w-0 group-hover:w-full transition-all duration-300 bg-[#aee2e8] absolute bottom-0"></div>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="hidden md:flex items-center space-x-6 h-full">
        <x-nav-link href="{{ route('memories.index') }}" :active="request()->routeIs('memories.index')"
                   class="text-[#ded5cc] hover:text-[#aee2e8] transition-colors">
            Memories
        </x-nav-link>
        @auth
        <x-nav-link href="{{ route('memories.create') }}" :active="request()->routeIs('memories.create')"
                   class="text-[#ded5cc] hover:text-[#aee2e8] transition-colors">
            New Memory
        </x-nav-link>
        @endauth
    </div>

    <!-- Auth Links -->
    <div class="flex items-center space-x-4">
        @guest
        <a href="{{ route('login') }}" class="px-4 py-2 text-[#f5f0e9] hover:text-[#aee2e8] transition-colors">
            Login
        </a>
        <a href="{{ route('register') }}" class="px-4 py-2 bg-[#dbd3c8] text-[#1f2937] hover:text-[#dbd3c8]rounded-lg hover:bg-[#aee2e8] transition-all rounded-2xl

">
            Register
        </a>
        @else
        <!-- Mobile Menu Button -->
        <button @click="open = ! open" class="md:hidden text-[#f5f0e9] hover:text-[#aee2e8]">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- User Dropdown -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center text-sm focus:outline-none space-x-2">
                    <div class="mr-2 text-[#f5f0e9] font-semibold hidden md:inline-block">
                        {{ Auth::user()->username ?? Auth::user()->name }}
                    </div>
                    <div class="w-9 h-9 rounded-full overflow-hidden border-2 border-[#aee2e8]">
                        <img src="{{ Auth::user()->profile_photo
                            ? asset('storage/' . Auth::user()->profile_photo)
                            : 'https://img.icons8.com/?size=100&id=ABBSjQJK83zf&format=png&color=008080' }}"
                            alt="User Photo" class="object-cover w-full h-full">
                    </div>
                </button>
            </x-slot>

            <x-dropdown-link href="{{ route('profile.index') }}">
                Profile
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link href="{{ route('logout') }}"
                                 onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </x-dropdown-link>
            </form>
        </x-dropdown>
        @endguest
    </div>
</nav>

<!-- Mobile Menu -->
<div class="md:hidden absolute w-full bg-[#374151] text-[#f5f0e9] border-t border-[#aee2e8]/50" x-show="open" @click.away="open = false">
    <div class="px-4 py-2 space-y-2">
        <x-responsive-nav-link href="{{ route('memories.index') }}" class="text-[#f5f0e9] hover:bg-[#aee2e8]/20">
            Memories
        </x-responsive-nav-link>
        @auth
        <x-responsive-nav-link href="{{ route('memories.create') }}" class="text-[#f5f0e9] hover:bg-[#aee2e8]/20">
            New Memory
        </x-responsive-nav-link>
        @endauth
    </div>
</div>
