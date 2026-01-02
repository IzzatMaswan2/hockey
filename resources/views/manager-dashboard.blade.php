<x-admin-layout title="Manager Dashboard">

    <div class="container-fluid min-vh-100 bg-light">
        <div class="row">

            {{-- SIDEBAR --}}
            @include('layouts.sidebar-manager')

            {{-- MAIN CONTENT --}}
            <main class="col-md-10 ms-sm-auto px-4 py-4">

                {{-- PAGE HEADER --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h2 class="fw-bold mb-1" style="color:#5D3CB8;">
                            Welcome back, {{ Auth::user()->fullName }}
                        </h2>
                        <p class="text-muted mb-0">
                            Here’s what’s happening with your team today
                        </p>
                    </div>
                </div>

                {{-- STATS CARDS --}}
                <div class="row g-4 mb-4">

                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                    <i class="fas fa-user text-primary fs-4"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Players Registered by You</p>
                                    <h3 class="fw-bold mb-0">
                                        {{ count($managerPlayers) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                    <i class="fas fa-users text-success fs-4"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Players in Your Team</p>
                                    <h3 class="fw-bold mb-0">
                                        {{ count($teamPlayers) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- TOURNAMENTS --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-trophy text-warning me-2"></i>
                            Tournaments Joined
                        </h5>

                        @if($teamTournaments->count())
                            <ul class="list-group list-group-flush">
                                @foreach($teamTournaments as $tournament)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $tournament->name }}
                                        <span class="badge bg-success-subtle text-success">
                                            Active
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0">
                                Your team has not joined any tournaments yet.
                            </p>
                        @endif
                    </div>
                </div>

                {{-- PLAYERS SECTION --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#manager-players">
                                    My Registered Players
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#team-players">
                                    Team Players
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">

                            {{-- MANAGER PLAYERS --}}
                            <div class="tab-pane fade show active" id="manager-players">
                                <div class="table-responsive">
                                    <table class="table align-middle table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Jersey</th>
                                                <th>Position</th>
                                                <th>DOB</th>
                                                <th>Contact</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($managerPlayers as $player)
                                                <tr>
                                                    <td class="fw-semibold">{{ $player->fullName }}</td>
                                                    <td>{{ $player->jerseyNumber }}</td>
                                                    <td>{{ $player->position }}</td>
                                                    <td>{{ $player->dob }}</td>
                                                    <td>{{ $player->contact }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- TEAM PLAYERS --}}
                            <div class="tab-pane fade" id="team-players">
                                <div class="table-responsive">
                                    <table class="table align-middle table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Jersey</th>
                                                <th>Position</th>
                                                <th>DOB</th>
                                                <th>Contact</th>
                                                <th>Registered By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teamPlayers as $player)
                                                <tr>
                                                    <td class="fw-semibold">{{ $player->fullName }}</td>
                                                    <td>{{ $player->jerseyNumber }}</td>
                                                    <td>{{ $player->position }}</td>
                                                    <td>{{ $player->dob }}</td>
                                                    <td>{{ $player->contact }}</td>
                                                    <td>{{ $player->manager->fullName ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </main>
        </div>
    </div>

</x-admin-layout>
