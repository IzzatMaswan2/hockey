<x-admin-layout :title="'Dashboard'">

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 space-y-6 bg-gray-100 min-h-screen">

        <!-- Welcome -->
        <h2 class="text-2xl font-bold">Welcome, Admin {{ Auth::user()->fullName }}</h2>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div class="bg-purple-700 text-white rounded-lg p-4 shadow flex items-center gap-4">
                <i class="fas fa-users text-3xl"></i>
                <div>
                    <div class="text-xl font-bold">{{ $total_player }}</div>
                    <div>Players</div>
                </div>
            </div>
            <div class="bg-purple-700 text-white rounded-lg p-4 shadow flex items-center gap-4">
                <i class="fas fa-flag text-3xl"></i>
                <div>
                    <div class="text-xl font-bold">{{ $teamsCount }}</div>
                    <div>Teams</div>
                </div>
            </div>
            <div class="bg-purple-700 text-white rounded-lg p-4 shadow flex items-center gap-4">
                <i class="fas fa-user-tie text-3xl"></i>
                <div>
                    <div class="text-xl font-bold">{{ $managersCount }}</div>
                    <div>Managers</div>
                </div>
            </div>
        </div>

        <!-- Statistics Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

            <!-- Donut Chart -->
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-bold mb-2">Statistics</h3>
                <div id="donut" class="w-full h-64"></div>
            </div>

            <!-- Extra Stats Cards -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-3">
                    <img src="{{ asset('img/goalicon.png') }}" alt="Goals" class="w-12 h-12">
                    <div>
                        <h5 class="text-xl font-bold">{{ $goalsScored }}</h5>
                        <p class="text-gray-600 text-sm">Goals Scored</p>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4 flex items-center gap-3">
                    <img src="{{ asset('img/stickhoki.png') }}" alt="Penalty" class="w-12 h-12">
                    <div>
                        <h5 class="text-xl font-bold">{{ $penaltyCorner }}</h5>
                        <p class="text-gray-600 text-sm">Penalty Corner Goals</p>
                    </div>
                </div>

                <!-- Card Colors for Red/Yellow/Green -->
                <div class="col-span-2 grid grid-cols-3 gap-4 mt-2">
                    <div class="bg-white rounded-lg shadow p-3 flex items-center gap-2">
                        <img src="{{ asset('img/red.png') }}" alt="Red Card" class="w-5 h-7">
                        <div class="flex justify-between w-full">
                            <span>Red Card</span>
                            <span class="font-bold text-lg">{{ $totalRedCards }}</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-3 flex items-center gap-2">
                        <img src="{{ asset('img/yellow.png') }}" alt="Yellow Card" class="w-5 h-7">
                        <div class="flex justify-between w-full">
                            <span>Yellow Card</span>
                            <span class="font-bold text-lg">{{ $totalYellowCards }}</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-3 flex items-center gap-2">
                        <img src="{{ asset('img/green.png') }}" alt="Green Card" class="w-5 h-7">
                        <div class="flex justify-between w-full">
                            <span>Green Card</span>
                            <span class="font-bold text-lg">{{ $totalGreenCards }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Standings Table -->
        <div class="bg-white rounded-lg shadow mt-6 p-4">
            <h3 class="font-bold mb-2">Team Standings</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Rank</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Team</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Points</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($groupData['team'] as $index => $group)
                            <tr>
                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                <td class="px-4 py-2 flex items-center gap-2">
                                    <img src="{{ !empty($group->team) && !empty($group->team->LogoURL) ? asset('storage/' . $group->team->LogoURL) : asset('images/default-team.png') }}" alt="{{ $group->team->name ?? 'TBA' }} Logo" class="w-8 h-8 rounded">
                                    {{ $group->team->name ?? 'TBA'}}
                                </td>
                                <td class="px-4 py-2">{{ $group->points }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Articles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            @foreach($recentArticles as $article)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h5 class="font-bold text-lg mb-2"><i class="fas fa-newspaper"></i> {{ $article->title }}</h5>
                        <p class="text-gray-600 text-sm">{{ $article->summary }}</p>
                        <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#articleModal{{ $article->id }}">
                            Read More
                        </button>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="articleModal{{ $article->id }}" tabindex="-1" aria-labelledby="articleModalLabel{{ $article->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="articleModalLabel{{ $article->id }}">{{ $article->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-auto mb-3" alt="{{ $article->title }}">
                                <p class="whitespace-pre-wrap">{{ $article->content }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- ECharts Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var donutChart = echarts.init(document.getElementById('donut'));

            var wins = {{ $wins }};
            var losses = {{ $losses }};
            var draws = {{ $draws }};

            var donutOptions = {
                tooltip: { trigger: 'item' },
                legend: { orient: 'vertical', left: 'left' },
                series: [{
                    name: 'Statistics',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    avoidLabelOverlap: false,
                    label: { show: false, position: 'center' },
                    emphasis: { label: { show: true, fontSize: '30', fontWeight: 'bold' } },
                    labelLine: { show: false },
                    data: [
                        { value: wins, name: 'Wins', itemStyle: { color: '#31d58d' } },
                        { value: losses, name: 'Losses', itemStyle: { color: '#ed1d1a' } },
                        { value: draws, name: 'Draws', itemStyle: { color: '#f7a409' } }
                    ]
                }]
            };

            donutChart.setOption(donutOptions);
        });
    </script>

</x-admin-layout>
