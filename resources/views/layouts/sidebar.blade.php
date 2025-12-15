{{-- resources/views/layouts/sidebar.blade.php --}}

<aside 
    x-data="{ openMenu: null, mobileOpen: false }"
    class="bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-xl
           w-64 min-h-screen p-4 flex-col hidden md:flex"
>
    {{-- Desktop Sidebar --}}
    <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('img/Logo Latest 1.png') }}" alt="Logo" class="w-14 h-14 rounded-full shadow-md">
    </div>

    {{-- Dashboard --}}
    <a href="/dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-700 transition">
        <i class="fas fa-tachometer-alt w-5 text-purple-400"></i>
        <span class="font-semibold">Dashboard</span>
    </a>

    {{-- Content Management --}}
    <div class="mt-4">
        <button 
            @click="openMenu === 1 ? openMenu = null : openMenu = 1" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 transition"
        >
            <span class="flex items-center gap-3">
                <i class="fa fa-file-text w-5 text-blue-400"></i>
                Content Management
            </span>
            <i :class="openMenu === 1 ? 'rotate-180' : ''" class="fas fa-chevron-down transition"></i>
        </button>

        <div x-show="openMenu === 1" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/adminmanagepage" class="block p-2 hover:bg-gray-700 rounded">Manage Pages</a>
            <a href="/article" class="block p-2 hover:bg-gray-700 rounded">Manage Articles</a>
        </div>
    </div>

    {{-- User & Role Management --}}
    <div class="mt-3">
        <button 
            @click="openMenu === 2 ? openMenu = null : openMenu = 2" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 transition"
        >
            <span class="flex items-center gap-3">
                <i class="fas fa-users-cog w-5 text-green-400"></i>
                User & Role Management
            </span>
            <i :class="openMenu === 2 ? 'rotate-180' : ''" class="fas fa-chevron-down transition"></i>
        </button>

        <div x-show="openMenu === 2" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/manageadmin" class="block p-2 hover:bg-gray-700 rounded">Manage Admins</a>
            <a href="/manageuser" class="block p-2 hover:bg-gray-700 rounded">Manage Managers</a>
            <a href="/officer" class="block p-2 hover:bg-gray-700 rounded">Manage Officers</a>
        </div>
    </div>

    {{-- Tournament --}}
    <div class="mt-3">
        <button 
            @click="openMenu === 3 ? openMenu = null : openMenu = 3" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 transition"
        >
            <span class="flex items-center gap-3">
                <i class="fas fa-calendar-alt w-5 text-yellow-400"></i>
                Tournament & Venue
            </span>
            <i :class="openMenu === 3 ? 'rotate-180' : ''" class="fas fa-chevron-down transition"></i>
        </button>

        <div x-show="openMenu === 3" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/managevenue" class="block p-2 hover:bg-gray-700 rounded">Manage Venues</a>
            <a href="/managetournament" class="block p-2 hover:bg-gray-700 rounded">Manage Tournaments</a>
            <a href="/participants" class="block p-2 hover:bg-gray-700 rounded">Manage Competitions</a>
            <a href="/manage-group" class="block p-2 hover:bg-gray-700 rounded">Manage Groups</a>
        </div>
    </div>

    {{-- Matches --}}
    <div class="mt-3">
        <button 
            @click="openMenu === 4 ? openMenu = null : openMenu = 4" 
            class="flex items-center justify-between w-full p-3 rounded-lg hover:bg-gray-700 transition"
        >
            <span class="flex items-center gap-3">
                <i class="fas fa-futbol w-5 text-red-400"></i>
                Matches & Stats
            </span>
            <i :class="openMenu === 4 ? 'rotate-180' : ''" class="fas fa-chevron-down transition"></i>
        </button>

        <div x-show="openMenu === 4" x-transition class="pl-8 mt-2 space-y-2">
            <a href="/matches/matches" class="block p-2 hover:bg-gray-700 rounded">Manage Match</a>
            <a href="/scoreboard/tournamentlist" class="block p-2 hover:bg-gray-700 rounded">Manage Scoreboard</a>
            <a href="/statistics/tournaments" class="block p-2 hover:bg-gray-700 rounded">Manage Statistic</a>
        </div>
    </div>

</aside>




{{-- MOBILE BOTTOM NAVIGATION --}}
<div 
    x-data="{ mobileOpen: false }"
    class="md:hidden fixed bottom-0 left-0 w-full bg-gray-900 text-white shadow-2xl z-50"
>
    <div class="flex justify-around py-3">

        <!-- Dashboard -->
        <a href="/dashboard" class="flex flex-col items-center text-xs">
            <i class="fas fa-home text-lg"></i>
            <span>Home</span>
        </a>

        <!-- Content -->
        <button @click="mobileOpen = 'content'" class="flex flex-col items-center text-xs">
            <i class="fa fa-file text-lg"></i>
            <span>Content</span>
        </button>

        <!-- Tournament -->
        <button @click="mobileOpen = 'tournament'" class="flex flex-col items-center text-xs">
            <i class="fas fa-calendar-alt text-lg"></i>
            <span>Events</span>
        </button>

        <!-- Matches -->
        <button @click="mobileOpen = 'matches'" class="flex flex-col items-center text-xs">
            <i class="fas fa-futbol text-lg"></i>
            <span>Matches</span>
        </button>

        <!-- More -->
        <button @click="mobileOpen = 'menu'" class="flex flex-col items-center text-xs">
            <i class="fas fa-bars text-lg"></i>
            <span>More</span>
        </button>

    </div>




    {{-- MOBILE DRAWER --}}
    <div 
        x-show="mobileOpen"
        x-transition
        class="fixed bottom-14 left-0 w-full bg-gray-800 text-white p-4 rounded-t-2xl shadow-2xl z-50"
    >
        <button @click="mobileOpen = false" class="w-full text-center text-gray-300 mb-2">
            <i class="fas fa-times text-xl"></i>
        </button>

        {{-- Dynamic Menu Content --}}
        <template x-if="mobileOpen === 'content'">
            <div class="space-y-2">
                <a href="/adminmanagepage" class="block p-2 rounded bg-gray-700">Manage Pages</a>
                <a href="/article" class="block p-2 rounded bg-gray-700">Manage Articles</a>
            </div>
        </template>

        <template x-if="mobileOpen === 'tournament'">
            <div class="space-y-2">
                <a href="/managevenue" class="block p-2 bg-gray-700 rounded">Manage Venues</a>
                <a href="/managetournament" class="block p-2 bg-gray-700 rounded">Manage Tournaments</a>
                <a href="/participants" class="block p-2 bg-gray-700 rounded">Manage Competitions</a>
                <a href="/manage-group" class="block p-2 bg-gray-700 rounded">Manage Groups</a>
            </div>
        </template>

        <template x-if="mobileOpen === 'matches'">
            <div class="space-y-2">
                <a href="/matches/matches" class="block p-2 bg-gray-700 rounded">Manage Match</a>
                <a href="/scoreboard/tournamentlist" class="block p-2 bg-gray-700 rounded">Manage Scoreboard</a>
                <a href="/statistics/tournaments" class="block p-2 bg-gray-700 rounded">Manage Statistic</a>
            </div>
        </template>

        <template x-if="mobileOpen === 'menu'">
            <div class="space-y-2">
                <a href="/manageadmin" class="block p-2 bg-gray-700 rounded">Manage Admins</a>
                <a href="/manageuser" class="block p-2 bg-gray-700 rounded">Manage Managers</a>
                <a href="/officer" class="block p-2 bg-gray-700 rounded">Manage Officers</a>
            </div>
        </template>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
