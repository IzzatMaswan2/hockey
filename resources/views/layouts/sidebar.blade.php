{{-- resources/views/layouts/sidebar.blade.php --}}
<aside class="w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white min-h-screen flex flex-col p-4 shadow-xl" x-data="{ openMenu: null }">

    {{-- Logo / Brand --}}
    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('img/Logo Latest 1.png') }}" alt="Logo" class="w-2 h-2 rounded-full shadow-md">
    </div>

    {{-- Dashboard --}}
    <a href="/dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 hover:shadow-md transition-all duration-300">
        <i class="fas fa-tachometer-alt w-5 text-purple-400"></i>
        <span class="font-semibold text-white">Dashboard</span>
    </a>

    {{-- Content Management --}}
    <div class="mt-4">
        <button 
            @click="openMenu === 1 ? openMenu = null : openMenu = 1" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 hover:shadow-md transition-all duration-300"
        >
            <span class="flex items-center gap-3 text-white font-semibold">
                <i class="fa fa-file-text w-5 text-blue-400"></i>
                Content Management
            </span>
            <i :class="openMenu === 1 ? 'rotate-180' : ''" class="fas fa-chevron-down text-gray-300 transition-transform duration-300"></i>
        </button>
        <div x-show="openMenu === 1" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/adminmanagepage" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Pages</a>
            <a href="/article" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Articles</a>
        </div>
    </div>

    {{-- User & Role Management --}}
    <div class="mt-3">
        <button 
            @click="openMenu === 2 ? openMenu = null : openMenu = 2" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 hover:shadow-md transition-all duration-300"
        >
            <span class="flex items-center gap-3 text-white font-semibold">
                <i class="fas fa-users-cog w-5 text-green-400"></i>
                User & Role Management
            </span>
            <i :class="openMenu === 2 ? 'rotate-180' : ''" class="fas fa-chevron-down text-gray-300 transition-transform duration-300"></i>
        </button>
        <div x-show="openMenu === 2" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/manageadmin" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Admins</a>
            <a href="/manageuser" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Managers</a>
            <a href="/referee" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Officers</a>
        </div>
    </div>

    {{-- Tournament & Venue Management --}}
    <div class="mt-3">
        <button 
            @click="openMenu === 3 ? openMenu = null : openMenu = 3" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 hover:shadow-md transition-all duration-300"
        >
            <span class="flex items-center gap-3 text-white font-semibold">
                <i class="fas fa-calendar-alt w-5 text-yellow-400"></i>
                Tournament & Venue
            </span>
            <i :class="openMenu === 3 ? 'rotate-180' : ''" class="fas fa-chevron-down text-gray-300 transition-transform duration-300"></i>
        </button>
        <div x-show="openMenu === 3" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/managevenue" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Venues</a>
            <a href="/managetournament" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Tournaments</a>
            <a href="/participants" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Competitions</a>
            <a href="/manage-group" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Groups</a>
        </div>
    </div>

    {{-- Match & Statistic Management --}}
    <div class="mt-3">
        <button 
            @click="openMenu === 4 ? openMenu = null : openMenu = 4" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 hover:shadow-md transition-all duration-300"
        >
            <span class="flex items-center gap-3 text-white font-semibold">
                <i class="fas fa-futbol w-5 text-red-400"></i>
                Matches & Stats
            </span>
            <i :class="openMenu === 4 ? 'rotate-180' : ''" class="fas fa-chevron-down text-gray-300 transition-transform duration-300"></i>
        </button>
        <div x-show="openMenu === 4" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/matches/matches" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Match</a>
            <a href="/scoreboard/tournamentlist" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Scoreboard</a>
            <a href="/statistics/tournaments" class="block p-2 rounded-lg hover:bg-gray-700 hover:shadow-sm transition-all duration-200">Manage Statistic</a>
        </div>
    </div>

</aside>

{{-- Alpine.js --}}
<script src="//unpkg.com/alpinejs" defer></script>
