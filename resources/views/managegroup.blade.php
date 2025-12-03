<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANAGE GROUP</title>
    <style>
        .btn-primary {
            margin-top: 20px;
            margin-bottom: 40px;
        }

        /* Styles for input fields */
        input.form-control,
        select.form-control {
            border: 2px solid #000 !important;
            border-radius: 5px !important;
        }

        input.form-control:focus,
        select.form-control:focus {
            border-color: #81deef!important;
            box-shadow: 0 0 5px rgba(0, 255, 135, 0.5) !important;
        }

        .form-control-plaintext {
            border: 2px solid #000 !important;
            border-radius: 5px;
            font-weight: bold;
            padding-left: 10px !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>

            <div class="col-9">
                <h3 style="color: #5D3CB8;"><strong>MANAGE GROUPS</strong></h3>

                <form method="POST" action="{{ route('managegroup.store') }}">
                    @csrf
                    <div class="row align-items-center">
                        <!-- Tournament Selection -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tournament">Tournament</label>
                                <select class="form-control" id="tournament" name="tournament" required>
                                    <option value="" disabled selected>Select a tournament</option>
                                    @foreach($tournaments as $tournament)
                                        <option value="{{ $tournament->id }}">{{ $tournament->name ?? 'N/A' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Category Selection -->
                        <div class="col-md-4" id="categoryDiv" style="display:none;">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="" disabled selected>Select a category</option>
                                </select>
                            </div>
                        </div>

                        <!-- Number of Teams (Read-only Input) -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="numTeams">Number of Teams</label>
                                <p class="form-control-plaintext" id="numTeams">0</p>
                            </div>
                        </div>

                        <!-- Number of Groups -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="numGroups">Number of Groups</label>
                                <input type="number" name="numGroups" id="numGroups" class="form-control" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">CREATE GROUP</button>
                    </div>
                </form>

                <hr>

                <!-- Event Selection for Table Filtering -->
                <div class="mb-3">
                    <label for="eventSelect" class="form-label">Select Tournament</label>
                    <select id="eventSelect" class="form-select">
                        <option value="all">All Tournaments</option>
                        @foreach($tournaments as $tournament)
                            <option value="{{ $tournament->id }}">{{ $tournament->name ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Groups Table -->
                @php
                    // Determine if any group has a category
                    $hasCategory = $groups->contains(function($g) {
                        return !empty($g->category_id);
                    });
                @endphp

                <table class="table table-striped" id="groupTable">
                    <thead>
                        <tr>
                            <th>TEAM</th>
                            <th>GROUP</th>

                            @if($hasCategory)
                                <th>CATEGORY</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody id="groupTableBody">
                        @foreach($groups as $group)
                            <tr data-event="{{ $group->tournament_id }}">
                                <td>{{ $group->team->name ?? '' }}</td>
                                <td>{{ $group->groupcreate->Name ?? '' }}</td>

                                @if($hasCategory)
                                    <td>{{ $group->category->name ?? '' }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        // When tournament is selected
        $('#tournament').change(function() {
            var tournamentId = $(this).val();

            if (!tournamentId) return;

            // Fetch number of teams
            fetch(`/getTournamentTeams/${tournamentId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('numTeams').textContent = data.numTeams;
                    updateTeamsPerGroup(data.numTeams);
                });

            // Fetch categories for the selected tournament
            fetch(`/getTournamentCategories/${tournamentId}`)
                .then(response => response.json())
                .then(data => {
                    const categorySelect = document.getElementById('category');
                    categorySelect.innerHTML = '<option value="" disabled selected>Select a category</option>';

                    if (data.categories.length > 0) {
                        data.categories.forEach(cat => {
                            const option = document.createElement('option');
                            option.value = cat.id;
                            option.textContent = cat.name;
                            categorySelect.appendChild(option);
                        });
                        document.getElementById('categoryDiv').style.display = 'block';
                    } else {
                        document.getElementById('categoryDiv').style.display = 'none';
                    }
                })
                .catch(error => console.error('Error fetching categories:', error));
        });

        // Filter table by tournament selection
        document.getElementById('eventSelect').addEventListener('change', function() {
            var selectedEvent = this.value;
            var rows = document.querySelectorAll('#groupTable tbody tr');

            rows.forEach(function(row) {
                if (selectedEvent === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.getAttribute('data-event') === selectedEvent ? '' : 'none';
                }
            });
        });

        // Update teams per group dynamically
        document.getElementById('numGroups').addEventListener('input', function() {
            const numTeams = parseInt(document.getElementById('numTeams').textContent);
            const numGroups = this.value;
            updateTeamsPerGroup(numTeams, numGroups);
        });

        function updateTeamsPerGroup(numTeams, numGroups = document.getElementById('numGroups').value) {
            const teamsPerGroup = numTeams > 0 && numGroups > 0 ? Math.floor(numTeams / numGroups) : 'N/A';
            // Optionally display teams per group somewhere if needed
            // document.getElementById('teamsPerGroup').textContent = teamsPerGroup > 0 ? teamsPerGroup : 'N/A';
        }
    </script>

    @include('layouts.footer')
</body>
</html>
