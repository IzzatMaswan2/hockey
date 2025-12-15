<x-admin-layout :title="'Player Dashboard'">

    <main class="flex-1 p-8 min-h-screen bg-purple-50">

        <!-- Greeting -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-purple-700">Welcome, {{ Auth::user()->fullName }}!</h1>
            <p class="text-purple-600 mt-2">Here’s your activity dashboard</p>
        </div>

        <!-- Player Summary Cards -->
        <div class="grid md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <h3 class="text-purple-700 font-bold text-xl">Matches Played</h3>
                <p class="text-3xl font-extrabold mt-2">24</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <h3 class="text-purple-700 font-bold text-xl">Goals Scored</h3>
                <p class="text-3xl font-extrabold mt-2">15</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <h3 class="text-purple-700 font-bold text-xl">Daily Running (km)</h3>
                <p class="text-3xl font-extrabold mt-2">5</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                <h3 class="text-purple-700 font-bold text-xl">Push-ups Today</h3>
                <p class="text-3xl font-extrabold mt-2">50</p>
            </div>
        </div>

        <!-- Activity Feed / Graphs -->
        <div class="grid md:grid-cols-2 gap-6 mb-10">

            <!-- Activity Chart Mockup -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-purple-700 font-bold text-xl mb-4">Weekly Running Distance (km)</h3>
                <div class="w-full h-48 flex items-end gap-2">
                    <!-- Hardcoded bar chart -->
                    <div class="w-8 bg-purple-500 rounded-t" style="height:40%;"></div>
                    <div class="w-8 bg-purple-500 rounded-t" style="height:60%;"></div>
                    <div class="w-8 bg-purple-500 rounded-t" style="height:50%;"></div>
                    <div class="w-8 bg-purple-500 rounded-t" style="height:80%;"></div>
                    <div class="w-8 bg-purple-500 rounded-t" style="height:70%;"></div>
                    <div class="w-8 bg-purple-500 rounded-t" style="height:60%;"></div>
                    <div class="w-8 bg-purple-500 rounded-t" style="height:90%;"></div>
                </div>
                <div class="flex justify-between text-purple-600 text-sm mt-2">
                    <span>Mon</span>
                    <span>Tue</span>
                    <span>Wed</span>
                    <span>Thu</span>
                    <span>Fri</span>
                    <span>Sat</span>
                    <span>Sun</span>
                </div>
            </div>

            <!-- Daily Activities -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-purple-700 font-bold text-xl mb-4">Daily Activities</h3>
                <ul class="space-y-3">
                    <li class="flex justify-between">
                        <span>Push-ups</span>
                        <span class="font-bold text-purple-700">50 reps</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Running</span>
                        <span class="font-bold text-purple-700">5 km</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Squats</span>
                        <span class="font-bold text-purple-700">40 reps</span>
                    </li>
                    <li class="flex justify-between">
                        <span>Training Minutes</span>
                        <span class="font-bold text-purple-700">60 min</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Tournaments Joined -->
        <div class="bg-white rounded-2xl shadow-lg max-w-5xl mx-auto p-6 mb-10">
            <h3 class="text-purple-700 font-bold text-xl mb-4 text-center">Tournaments Your Team Has Joined</h3>
            @if($teamTournaments->isEmpty())
                <p class="text-purple-600 text-center">No tournaments joined yet.</p>
            @else
                <ul class="space-y-3 text-purple-600">
                    @foreach($teamTournaments as $tournament)
                        <li class="flex items-center gap-3">
                            <i class="fas fa-trophy text-purple-400"></i>
                            {{ $tournament->name }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Optional: Recent Activity Feed -->
        <div class="bg-white rounded-2xl shadow-lg max-w-5xl mx-auto p-6">
            <h3 class="text-purple-700 font-bold text-xl mb-4 text-center">Recent Activity</h3>
            <ul class="space-y-3 text-purple-600">
                <li>🏃 Ran 5 km in morning practice</li>
                <li>💪 Completed 50 push-ups</li>
                <li>⚽ Participated in team match against Tigers</li>
                <li>🏋️‍♂️ 60 min training session</li>
            </ul>
        </div>

    </main>

</x-admin-layout>
