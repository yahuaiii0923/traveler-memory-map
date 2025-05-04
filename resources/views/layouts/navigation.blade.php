<nav class="fixed w-full top-0 bg-white shadow-sm z-[100] h-16 md:h-20 border-b border-gray-100" x-data="{ isOpen: false }">
    <div class="container mx-auto h-full px-6">
        <div class="flex justify-between items-center h-full">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-semibold text-blue-600">
                MemoryMapper
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center h-full space-x-8">
                <div class="flex items-center h-full space-x-8">
                    <a href="#how-it-works" class="text-gray-600 hover:text-blue-500 transition-colors h-full flex items-center pb-1 border-b-2 border-transparent hover:border-blue-500">
                        How it works
                    </a>
                    <a href="{{ route('memories.index') }}" class="text-gray-600 hover:text-blue-500 transition-colors h-full flex items-center pb-1 border-b-2 border-transparent hover:border-blue-500">
                        Explore
                    </a>
                </div>

                <!-- Authentication Links -->
                <div class="flex items-center space-x-4 ml-4 h-full">
                    @auth
                    <div x-data="{ open: false }" class="relative h-full flex items-center">
                        <button @click="open = !open" class="flex items-center space-x-2">
                            <span class="text-gray-600">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute right-0 top-full mt-1 w-48 bg-white rounded-lg shadow-xl py-2 border border-gray-100">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="flex items-center space-x-4 h-full">
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600 font-medium">
                            Register
                        </a>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center h-full">
                <button @click="isOpen = !isOpen" class="text-gray-600 hover:text-blue-500 p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-16 6h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="isOpen" x-cloak class="md:hidden bg-white border-t shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <!-- Mobile menu items -->
        </div>
    </div>
</nav>
