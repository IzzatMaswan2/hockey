{{-- <header class="tw-w-full tw-bg-[#280137] tw-shadow-sm">
    <nav class="tw-max-w-[1400px] tw-mx-auto tw-flex tw-items-center tw-justify-between tw-py-2 tw-px-6">

        <!-- Logo -->
        <a href="/" class="tw-flex tw-items-center">
            <img src="{{ asset('img/Logo Latest 1.png') }}" alt="logo" class="tw-w-14 tw-h-14">
        </a>

        <!-- Desktop Menu -->
        <ul class="tw-hidden lg:tw-flex tw-items-center tw-gap-12 tw-text-white tw-text-lg tw-font-medium">
            <li><a href="/tournamentlist" class="hover:tw-text-gray-300">Tournament</a></li>
            <li><a href="/forum" class="hover:tw-text-gray-300">Forum</a></li>
            <li><a href="/about" class="hover:tw-text-gray-300">About</a></li>
            <li><a href="/contact" class="hover:tw-text-gray-300">Contact</a></li>
            <li>
                <a href="/fixture/tournamentlist" class="tw-bg-white tw-text-black tw-px-4 tw-py-2 tw-rounded hover:tw-bg-gray-200">
                    Fixture
                </a>
            </li>
        </ul>

        <!-- User Dropdown -->
        <div class="tw-hidden lg:tw-block tw-relative" x-data="{ open: false }" @mouseleave="open = false">
            <button class="tw-text-white tw-font-medium tw-flex tw-items-center tw-gap-1" @click="open = !open">
                {{ strtok(Auth::user()->fullName, ' ') }}
                <svg class="tw-w-4 tw-h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
            </button>
            <div x-show="open" x-transition class="tw-absolute tw-right-0 tw-mt-2 tw-bg-white tw-text-black tw-w-44 tw-rounded tw-shadow-lg tw-z-50">
                <a href="{{ route('profile.edit') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Profile</a>
                <div class="tw-border-t tw-my-1"></div>
                @if(Auth::user()->role === 'Manager')
                <a href="{{ route('manager-dashboard') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Manager Dashboard</a>
                @endif
                @if(Auth::user()->role === 'Player')
                <a href="{{ route('player-dashboard') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Player Dashboard</a>
                @endif
                @if(Auth::user()->role === 'Admin')
                <a href="{{ route('dashboard') }}" class="tw-block tw-px-4 tw-py-2 hover:tw-bg-gray-100">Admin Dashboard</a>
                @endif
                <div class="tw-border-t tw-my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="tw-w-full tw-text-left tw-px-4 tw-py-2 hover:tw-bg-gray-100">Logout</button>
                </form>
            </div>
        </div>

        <!-- Mobile Toggle -->
        <button id="mobileMenuBtn" class="lg:tw-hidden tw-text-3xl tw-text-white">&#9776;</button>

    </nav>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="tw-hidden tw-bg-[#280137] tw-text-white tw-flex tw-flex-col tw-gap-4 tw-px-6 tw-pb-4">
        <a href="/tournamentlist" class="hover:tw-text-gray-300">Tournament</a>
        <a href="/forum" class="hover:tw-text-gray-300">Forum</a>
        <a href="/about" class="hover:tw-text-gray-300">About</a>
        <a href="/contact" class="hover:tw-text-gray-300">Contact</a>
        <a href="/fixture/tournamentlist" class="tw-bg-white tw-text-black tw-px-4 tw-py-2 tw-rounded hover:tw-bg-gray-200">Fixture</a>

        <div class="tw-border-t tw-my-2"></div>

        <span class="tw-font-bold">{{ strtok(Auth::user()->fullName, ' ') }}</span>

        <a href="{{ route('profile.edit') }}" class="hover:tw-text-gray-300">Profile</a>
        @if(Auth::user()->role === 'Manager')
        <a href="{{ route('manager-dashboard') }}" class="hover:tw-text-gray-300">Manager Dashboard</a>
        @endif
        @if(Auth::user()->role === 'Player')
        <a href="{{ route('player-dashboard') }}" class="hover:tw-text-gray-300">Player Dashboard</a>
        @endif
        @if(Auth::user()->role === 'Admin')
        <a href="{{ route('dashboard') }}" class="hover:tw-text-gray-300">Admin Dashboard</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="tw-text-left hover:tw-text-gray-300">Logout</button>
        </form>
    </div>
</header>

<script>
document.getElementById('mobileMenuBtn').addEventListener('click', () => {
    document.getElementById('mobileMenu').classList.toggle('tw-hidden');
});
</script> --}}
