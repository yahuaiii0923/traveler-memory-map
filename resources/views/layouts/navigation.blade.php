<nav class="fixed w-full bg-white/80 backdrop-blur-sm shadow-sm z-50" x-data="{ isOpen: false }">
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-2xl font-semibold text-blue-600">
                MemoryMapper
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="#how-it-works" class="text-gray-600 hover:text-blue-500 transition-colors">
                    How it works
                </a>
                <a href="{{ route('memories.index') }}" class="text-gray-600 hover:text-blue-500 transition-colors">
                    Explore
                </a>

                <!-- Authentication Links -->
                <div class="flex items-center space-x-4 ml-4">
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2">
                                <span class="text-gray-600">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Dashboard
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600">
                            Register
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="isOpen = !isOpen" class="text-gray-600 hover:text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-16 6h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="isOpen" class="md:hidden mt-4 space-y-4">
            <a href="#how-it-works" class="block text-gray-600 hover:text-blue-500">
                How it works
            </a>
            <a href="{{ route('memories.index') }}" class="block text-gray-600 hover:text-blue-500">
                Explore
            </a>

            @auth
                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('dashboard') }}" class="block py-2 text-gray-600">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block py-2 text-gray-600">
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <div class="pt-4 border-t border-gray-200 space-y-2">
                    <a href="{{ route('login') }}" class="block w-full text-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="block text-center text-blue-500 hover:text-blue-600">
                        Create Account
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
