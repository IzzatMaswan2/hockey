<x-admin-layout :title="'Edit Profile'">

    <!-- Header with background image -->


    <!-- Main content container -->
    <div class="max-w-4xl mx-auto my-12 px-4 w-full">

    <div class="w-full bg-cover bg-center py-20 text-center rounded-md text-white " style="background-image: url('{{ asset('img/nyaa.png') }}');">
        {{-- <h1 class="text-5xl font-bold">Your Profile!</h1> --}}
        <h4 class="text-3xl font-semibold mt-2">Hello, {{ Auth::user()->fullName }}!</h4>
    </div>
        <!-- Tabs -->
        <div class="flex justify-center space-x-2 mb-6 border-b border-gray-300 w-full">
            <button class="tab-btn px-4 py-2 font-semibold text-gray-700 hover:text-purple-700 border-b-2 border-transparent focus:outline-none" data-target="#account-info">
                <i class="bi bi-person mr-1"></i> Account Info
            </button>
            <button class="tab-btn px-4 py-2 font-semibold text-gray-700 hover:text-purple-700 border-b-2 border-transparent focus:outline-none" data-target="#update-password">
                <i class="bi bi-key mr-1"></i> Change Password
            </button>
            <button class="tab-btn px-4 py-2 font-semibold text-gray-700 hover:text-purple-700 border-b-2 border-transparent focus:outline-none" data-target="#notifications">
                <i class="bi bi-bell mr-1"></i> Notifications
            </button>
            <button class="tab-btn px-4 py-2 font-semibold text-gray-700 hover:text-purple-700 border-b-2 border-transparent focus:outline-none" data-target="#settings">
                <i class="bi bi-gear mr-1"></i> Settings
            </button>
            <button class="tab-btn px-4 py-2 font-semibold text-gray-700 hover:text-purple-700 border-b-2 border-transparent focus:outline-none" data-target="#activity">
                <i class="bi bi-activity mr-1"></i> Activity
            </button>
        </div>

        <!-- Tab Panes -->
        <div class="space-y-6">

            <!-- Account Info Tab -->
            <div id="account-info" class="tab-pane hidden">
                <div class="bg-white bg-opacity-90 rounded-2xl shadow p-6" style="background-image: url('{{ asset('img/logreg.jpg') }}'); background-repeat: repeat;">
                    <h2 class="text-2xl font-bold text-gray-100 text-center mb-4">Account Information</h2>

                    <section class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow-lg space-y-4">

                        <div class="space-y-2 text-gray-700">
                            <p class="flex items-center gap-2"><i class="bi bi-person-circle text-purple-700"></i> Name: <b>{{ Auth::user()->fullName }}</b></p>
                            <p class="flex items-center gap-2"><i class="bi bi-envelope text-purple-700"></i> Email: <b>{{ Auth::user()->email }}</b></p>
                            <p class="flex items-center gap-2"><i class="bi bi-people text-purple-700"></i> Role: <b>{{ Auth::user()->role }}</b></p>
                        </div>

                        @if(Auth::user()->role === 'Manager')
                            <div class="space-y-2 text-gray-700">
                                <p class="flex items-center gap-2"><i class="bi bi-briefcase text-purple-700"></i> Occupation: <b>{{ Auth::user()->occupation }}</b></p>
                                <p class="flex items-center gap-2"><i class="bi bi-flag text-purple-700"></i> Team Name: <b>{{ $user->team ? $user->team->name : 'N/A' }}</b></p>

                                @if($user->team && $user->team->LogoURL)
                                    <div class="flex items-center gap-2">
                                        <span class="text-purple-700">Team Logo:</span>
                                        <img src="{{ asset('storage/' . $user->team->LogoURL) }}" alt="{{ $user->team->name }} Logo" class="w-24 h-24 rounded-lg border shadow-sm">
                                    </div>
                                @endif

                                <p class="flex items-center gap-2"><i class="bi bi-geo-alt text-purple-700"></i> Address: <b>{{ Auth::user()->address }}</b></p>
                                <p class="flex items-center gap-2"><i class="bi bi-globe text-purple-700"></i> Country: <b>{{ Auth::user()->country }}</b></p>

                                <p class="mt-2 font-semibold text-gray-800">Tournaments:</p>
                                <ul class="list-disc list-inside ml-6">
                                    @if(Auth::user()->team && Auth::user()->team->tournaments->isNotEmpty())
                                        @foreach(Auth::user()->team->tournaments as $tournament)
                                            <li>{{ $tournament->name }}</li>
                                        @endforeach
                                    @else
                                        <li>No tournaments joined</li>
                                    @endif
                                </ul>
                            </div>
                        @elseif(Auth::user()->role === 'Player')
                            <div class="space-y-2 text-gray-700">
                                <p class="flex items-center gap-2"><i class="bi bi-calendar text-purple-700"></i> Date of Birth: <b>{{ Auth::user()->dob }}</b></p>
                                <p class="flex items-center gap-2"><i class="bi bi-display text-purple-700"></i> Display Name: <b>{{ Auth::user()->displayName }}</b></p>
                                <p class="flex items-center gap-2"><i class="bi bi-shirt text-purple-700"></i> Jersey Number: <b>{{ Auth::user()->jerseyNumber }}</b></p>
                                <p class="flex items-center gap-2"><i class="bi bi-flag text-purple-700"></i> Team Name: <b>{{ $user->team ? $user->team->name : 'N/A' }}</b></p>

                                @if($user->team && $user->team->LogoURL)
                                    <div class="flex items-center gap-2">
                                        <span class="text-purple-700">Team Logo:</span>
                                        <img src="{{ asset('storage/' . $user->team->LogoURL) }}" alt="{{ $user->team->name }} Logo" class="w-24 h-24 rounded-lg border shadow-sm">
                                    </div>
                                @endif

                                <p class="flex items-center gap-2"><i class="bi bi-telephone text-purple-700"></i> Contact: <b>{{ Auth::user()->contact }}</b></p>
                                <p class="flex items-center gap-2"><i class="bi bi-gear text-purple-700"></i> Position: <b>{{ Auth::user()->position }}</b></p>

                                <p class="mt-2 font-semibold text-gray-800">Tournaments:</p>
                                <ul class="list-disc list-inside ml-6">
                                    @if(Auth::user()->team && Auth::user()->team->tournaments->isNotEmpty())
                                        @foreach(Auth::user()->team->tournaments as $tournament)
                                            <li>{{ $tournament->name }}</li>
                                        @endforeach
                                    @else
                                        <li>No tournaments joined</li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </section>


                    <!-- Forms -->
                    <div class="mt-4">@include('profile.partials.update-profile-information-form')</div>
                    <div class="mt-4">@include('profile.partials.delete-user-form')</div>
                </div>
            </div>

            <!-- Change Password Tab -->
            <div id="update-password" class="tab-pane hidden">
                <div class="bg-purple bg-opacity-90 rounded-2xl shadow p-6" style="background-image: url('{{ asset('img/logreg.jpg') }}'); background-repeat: repeat;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Notifications Tab -->
            <div id="notifications" class="tab-pane hidden">
                <div class="bg-white bg-opacity-90 rounded-2xl shadow p-6 text-center" style="background-image: url('{{ asset('img/logreg.jpg') }}'); background-repeat: repeat;">
                    <h3 class="text-xl font-bold">Notifications</h3>
                </div>
            </div>

            <!-- Settings Tab -->
            <div id="settings" class="tab-pane hidden">
                <div class="bg-white bg-opacity-90 rounded-2xl shadow p-6 text-center" style="background-image: url('{{ asset('img/logreg.jpg') }}'); background-repeat: repeat;">
                    <h3 class="text-xl font-bold">Settings</h3>
                </div>
            </div>

            <!-- Activity Tab -->
            <div id="activity" class="tab-pane hidden">
                <div class="bg-white bg-opacity-90 rounded-2xl shadow p-6 text-center" style="background-image: url('{{ asset('img/logreg.jpg') }}'); background-repeat: repeat;">
                    <h3 class="text-xl font-bold">Activity</h3>
                </div>
            </div>

        </div>
    </div>

    <!-- Tabs JS -->
    <script>
        const tabs = document.querySelectorAll('.tab-btn');
        const panes = document.querySelectorAll('.tab-pane');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('text-purple-700', 'border-b-2', 'border-purple-700'));
                tabs.forEach(t => t.classList.add('text-gray-700', 'border-transparent'));
                panes.forEach(p => p.classList.add('hidden'));

                tab.classList.add('text-purple-700', 'border-b-2', 'border-purple-700');
                tab.classList.remove('text-gray-700', 'border-transparent');

                const target = document.querySelector(tab.getAttribute('data-target'));
                target.classList.remove('hidden');
            });
        });

        // Activate first tab on page load
        tabs[0].click();
    </script>

</x-admin-layout>
