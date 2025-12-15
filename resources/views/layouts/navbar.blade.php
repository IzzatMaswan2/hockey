<header class="bg-purple-900 shadow py-2">
    <div class="container mx-auto flex items-center justify-between px-4">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('img/Logo Latest 1.png') }}" alt="Logo" class="w-16 h-16">
        </a>

        {{-- Desktop Navigation --}}
        <nav class="hidden md:flex items-center gap-24">
            <a href="/tournamentlist" class="text-white hover:text-gray-300">Tournament</a>
            <a href="/forum" class="text-white hover:text-gray-300">Forum</a>
            <a href="/about" class="text-white hover:text-gray-300">About</a>
            <a href="/contact" class="text-white hover:text-gray-300">Contact</a>
            <a href="/fixture/tournamentlist" class="bg-white text-purple-900 px-3 py-1 rounded hover:bg-gray-200">Fixture</a>
        </nav>

        {{-- User Dropdown --}}
        <div class="hidden md:block relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 text-white font-medium px-3 py-2 rounded hover:bg-purple-800 focus:outline-none">
                {{ strtok(Auth::user()->fullName, ' ') }}
                <i :class="open ? 'rotate-180' : ''" class="fas fa-chevron-down transition-transform duration-200"></i>
            </button>
            <div x-show="open" @click.away="open = false" x-cloak
                 class="absolute right-0 mt-2 w-56 bg-white text-gray-900 rounded-lg shadow-lg z-50 ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
                <!-- Profile, Dashboard, Logout -->
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </div>
                <div class="py-1">
                    @if(Auth::user()->role === 'Manager')
                        <a href="{{ route('manager-dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                            <i class="fas fa-tachometer-alt"></i> Manager Dashboard
                        </a>
                    @endif
                    @if(Auth::user()->role === 'Player')
                        <a href="{{ route('player-dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                            <i class="fas fa-gamepad"></i> Player Dashboard
                        </a>
                    @endif
                    @if(Auth::user()->role === 'Admin')
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                            <i class="fas fa-cog"></i> Admin Dashboard
                        </a>
                    @endif
                </div>
                <div class="py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Mobile Hamburger + Merged Menu --}}
        <div class="md:hidden relative" x-data="{ open: false, userOpen: false }">
            <button @click="open = !open" class="text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>

            <!-- Mobile Menu -->
            <div x-show="open" @click.away="open = false" x-cloak
                 class="absolute top-full right-0 mt-2 w-48 bg-purple-900 text-white rounded shadow-lg z-50 flex flex-col">
                <a href="/tournamentlist" class="px-4 py-2 hover:bg-purple-800">Tournament</a>
                <a href="/forum" class="px-4 py-2 hover:bg-purple-800">Forum</a>
                <a href="/about" class="px-4 py-2 hover:bg-purple-800">About</a>
                <a href="/contact" class="px-4 py-2 hover:bg-purple-800">Contact</a>
                <a href="/fixture/tournamentlist" class="px-4 py-2 hover:bg-purple-800 bg-white text-purple-900 rounded m-2 text-center">Fixture</a>

                <!-- User Section -->
                <button @click="userOpen = !userOpen" class="flex justify-between items-center px-4 py-2 hover:bg-purple-800 w-full">
                    {{ strtok(Auth::user()->fullName, ' ') }}
                    <i :class="userOpen ? 'rotate-180' : ''" class="fas fa-chevron-down transition-transform duration-200"></i>
                </button>

                <div x-show="userOpen" x-cloak class="flex flex-col bg-purple-800">
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 hover:bg-purple-700">Profile</a>
                    @if(Auth::user()->role === 'Manager')
                        <a href="{{ route('manager-dashboard') }}" class="px-4 py-2 hover:bg-purple-700">Manager Dashboard</a>
                    @endif
                    @if(Auth::user()->role === 'Player')
                        <a href="{{ route('player-dashboard') }}" class="px-4 py-2 hover:bg-purple-700">Player Dashboard</a>
                    @endif
                    @if(Auth::user()->role === 'Admin')
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 hover:bg-purple-700">Admin Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 hover:bg-purple-700 text-left w-full">Logout</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>
