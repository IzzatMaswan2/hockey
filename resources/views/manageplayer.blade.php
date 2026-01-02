<x-admin-layout title="Manage Players">

    <div class="container-fluid bg-light min-vh-100">
        <div class="row">

            {{-- SIDEBAR --}}
            @include('layouts.sidebar-manager')

            {{-- MAIN CONTENT --}}
            <main class="col-md-10 ms-sm-auto px-4 py-4">

                {{-- PAGE HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1" style="color:#5D3CB8;">
                            Manage Players
                        </h2>
                        <p class="text-muted mb-0">
                            Register, update and manage your team players
                        </p>
                    </div>

                    <button
                        class="btn btn-primary fw-semibold px-4"
                        style="background:#5D3CB8;border-color:#5D3CB8"
                        data-bs-toggle="modal"
                        data-bs-target="#addPlayerModal"
                    >
                        <i class="fas fa-plus me-2"></i> Add Player
                    </button>
                </div>

                {{-- SEARCH --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="playerSearchInput"
                                    placeholder="Search players..."
                                >
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Player Name</th>
                                        <th>Jersey</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="playerTableBody">
                                    @foreach ($users as $user)
                                        @if ($user->role === 'Player')
                                            <tr data-status="{{ $user->status }}">
                                                <td class="fw-semibold">
                                                    {{ $user->fullName }}
                                                </td>
                                                <td>{{ $user->jerseyNumber }}</td>
                                                <td>{{ $user->position }}</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success">
                                                        {{ $user->field_status }}
                                                    </span>
                                                </td>
                                                <td class="text-center">

                                                    <button
                                                        class="btn btn-sm btn-outline-primary btn-view"
                                                        data-player-name="{{ $user->fullName }}"
                                                        data-player-email="{{ $user->email }}"
                                                        data-player-display-name="{{ $user->displayName }}"
                                                        data-player-dob="{{ $user->dob }}"
                                                        data-player-contact="{{ $user->contact }}"
                                                        data-player-jersey-number="{{ $user->jerseyNumber }}"
                                                        data-player-position="{{ $user->position }}"
                                                        data-player-field-status="{{ $user->field_status }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#playerModal"
                                                    >
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-outline-secondary btn-edit"
                                                        data-player-id="{{ $user->id }}"
                                                        data-player-name="{{ $user->fullName }}"
                                                        data-player-email="{{ $user->email }}"
                                                        data-player-display-name="{{ $user->displayName }}"
                                                        data-player-dob="{{ $user->dob }}"
                                                        data-player-contact="{{ $user->contact }}"
                                                        data-player-jersey-number="{{ $user->jerseyNumber }}"
                                                        data-player-position="{{ $user->position }}"
                                                        data-player-field-status="{{ $user->field_status }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editPlayerModal"
                                                    >
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('manageplayer.archive', $user->id) }}"
                                                        class="d-inline"
                                                    >
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-archive"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    {{-- MODALS (UNCHANGED LOGIC, CLEAN LOOK) --}}
    @include('manager.modals.player-view')
    @include('manager.modals.player-edit')
    @include('manager.modals.player-add')

    {{-- SEARCH + MODAL JS (UNCHANGED) --}}
    <script>
        function searchPlayers() {
            const input = document.getElementById("playerSearchInput").value.toLowerCase();
            document.querySelectorAll("#playerTableBody tr").forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(input) ? "" : "none";
            });
        }
        document.getElementById("playerSearchInput").addEventListener("input", searchPlayers);
    </script>

</x-admin-layout>
