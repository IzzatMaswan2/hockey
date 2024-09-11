<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('css/formation.css') }}" rel="stylesheet">
</head>
<body>

    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #D3D3D3;">
                @include('layouts.sidebar-manager')
            </div>

            <div class="col-9 mt-5">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="text-center" style="color:#5D3CB8;font-weight:bold;">Formation</h1>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="whatthesigma">
                    <img src="img/hockey_.jpg" alt="Hockey Field">
                    <button class="gk" data-position="Goalkeeper">GK<span class="tooltip">Goalkeeper</span></button>
                    <button class="rd" data-position="Right Defender">RD<span class="tooltip">Right Defender</span></button>
                    <button class="ld" data-position="Left Defender">LD<span class="tooltip">Left Defender</span></button>
                    <button class="rm" data-position="Right Midfielder">RM<span class="tooltip">Right Midfielder</span></button>
                    <button class="cm" data-position="Center Midfielder">CM<span class="tooltip">Center Midfielder</span></button>
                    <button class="lm" data-position="Left Midfielder">LM<span class="tooltip">Left Midfielder</span></button>
                    <button class="ri" data-position="Right Inner">RI<span class="tooltip">Right Inner</span></button>
                    <button class="li" data-position="Left Inner">LI<span class="tooltip">Left Inner</span></button>
                    <button class="rf" data-position="Right Forward">RF<span class="tooltip">Right Forward</span></button>
                    <button class="cf" data-position="Center Forward">CF<span class="tooltip">Center Forward</span></button>
                    <button class="lf" data-position="Left Forward">LF<span class="tooltip">Left Forward</span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-modal" style="display: none;">
        <div class="modal-content">
            <div class="close">
                <i class='bx bxs-x-circle'></i>
            </div>
            <!-- Content inside modal -->
            <div class="tab-container">
                <button class="tab-btn active" onclick="openTab(event, 'selectPlayerTab')">Select Player</button>
                <button class="tab-btn" onclick="openTab(event, 'changePlayerTab')">Change Player</button>
            </div>

            <div id="selectPlayerTab" class="tab-content active">
                <form id="formationForm" action="{{ route('formation.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="player" style="color:white;font-weight:bold;">Select Player: </label>
                        <select class="form-control @error('player_id') is-invalid @enderror" id="player" name="player_id" required>
                            <option value="">Select a player</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->fullName ?? $player->Name }} ({{ $player->jerseyNumber }})</option>
                            @endforeach
                        </select>
                        @error('player_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" id="formationPosition" name="formationPosition" value="">
                    <button type="submit" class="btn btn-primary" style="background-color:#5D3CB8;font-weight:bold;color:white;border:#5D3CB8 1px solid;">Add Player to Formation</button>
                </form>
            </div>

            <!-- Change Player Tab -->
            <div id="changePlayerTab" class="tab-content">
                <!-- Similar structure as Select Player Tab -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Initialize a set to keep track of selected players
        var selectedPlayers = new Set();

        // Function to update the player dropdown based on selected players
        function updatePlayerDropdown() {
            var playerSelect = document.getElementById('player');
            var options = playerSelect.querySelectorAll('option');
            
            options.forEach(function(option) {
                if (selectedPlayers.has(option.value)) {
                    option.style.display = 'none';
                } else {
                    option.style.display = 'block';
                }
            });
        }

        // Add event listeners to each formation button to show the modal, set the formation position, and update player dropdown
        document.querySelectorAll('.whatthesigma button').forEach(function(button) {
            button.addEventListener('click', function() {
                var position = this.getAttribute('data-position');
                document.getElementById('formationPosition').value = position;
                document.querySelector('.bg-modal').style.display = 'flex'; // Show modal
            });
        });

        // Close the modal when the close button is clicked
        document.querySelector('.close').addEventListener('click', function() {
            document.querySelector('.bg-modal').style.display = 'none'; // Hide the modal
        });

        // Update the player dropdown and track the selected player
        document.getElementById('player').addEventListener('change', function() {
            var selectedValue = this.value;
            if (selectedValue) {
                selectedPlayers.add(selectedValue);
                updatePlayerDropdown();
            }
        });

        // Function to handle switching between tabs
        function openTab(event, tabName) {
            // Hide all tab content
            var i, tabContent, tabButtons;
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }

            // Remove active class from all tab buttons
            tabButtons = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tabButtons.length; i++) {
                tabButtons[i].className = tabButtons[i].className.replace(" active", "");
            }

            // Show the current tab and add the active class to the button
            document.getElementById(tabName).style.display = "block";
            event.currentTarget.className += " active";
        }

        // By default, open the first tab
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("selectPlayerTab").style.display = "block";
        });
    </script>
    
</body>
@include('layouts.footer')

</html>
