<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile!</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
        }

        .bg-image {
            background-image: url('/img/nyaa.png'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            padding: 60px 0; /* Increase padding for a more dramatic effect */
            color: white;
            text-align: center;
            width: 100%;
        }

        .bg-image h1,
        .bg-image h4 {
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5); /* Adding text shadow for better readability */
        }

        .narrow-container {
            max-width: 800px; /* Adjust width as needed */
            margin: -30px auto 0 auto; /* Negative margin to overlap the card with the background */
            border-radius: 20px;
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 2;
        }

        h1 {
            font-size: 50px;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        h4 {
            font-size: 30px;
            font-weight: 600;
        }

        .tab-container {
            display: flex;
            cursor: pointer;
            
            margin-bottom: 20px;
        }

        .tab-button {
            flex: 1;
            padding: 5px;
            background: #e9ecef;
            border: 1px solid #dee2e6;
            border-radius: 5px 5px 0 0;
            text-align: center;
            transition: background 0.3s ease;
            font-weight: 500;
            display: flex;
            justify-content: center;
            align-items: center;
            margin:3px;
        }

        .tab-button i {
            margin-right: 8px;
        }

        .tab-button.active {
            background: #4B006E;
            border-bottom: 1px solid transparent;
            color: white;
            font-weight: bold;
        }

        .tab-button:hover {
            background-color: #dcdcdc;
        }

        .tab-content {
            border: 1px solid #dee2e6;
            border-radius: 0 0 5px 5px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .card {
            
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            min-height: 150px; /* Set a minimum height for cards */
            margin-bottom: 20px; /* Margin between cards */
        }

        .card-title {
            font-size: 1.75rem;
            color: #4B006E;
            font-weight: 600;
        }

        .card-text {
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #4B006E;
            border-color: #4B006E;
        }

        .btn-primary:hover {
            background-color: #3a004d;
            border-color: #3a004d;
        }
        
    </style>

</head>

<body style="background-color:#eeeeee">

    <!-- Include Navbar -->
     
    @include('layouts.navbar')

    <!-- Full Width Background Image -->
    <div class="bg-image">
        <h1 class="font-weight-bold"> Your Profile!</h1>
        <br>
        <h4 class="font-weight-bold">Hello, {{ Auth::user()->fullName }}!</h4>
    </div>

    <!-- Main Content -->
    <div class="container narrow-container py-5" style="width:700px; margin-bottom:20px; background-image: url('{{ asset('img/logreg.jpg') }}'); background-repeat: repeat; background-position: center;">
        <!-- Custom Tabs -->
        <div class="tab-container" >
            <div class="tab-button active" data-target="#account-info">
                <i class="bi bi-person"></i> Account Information
            </div>
            <div class="tab-button" data-target="#update-password">
                <i class="bi bi-key"></i> Change Password
            </div>
            <div class="tab-button" data-target="#notifications">
                <i class="bi bi-bell"></i> Notifications
            </div>
            <div class="tab-button" data-target="#settings">
                <i class="bi bi-gear"></i> Settings
            </div>
            <div class="tab-button" data-target="#activity">
                <i class="bi bi-activity"></i> Activity
            </div>
        </div>

        <!-- Account Information Tab -->
        <div class="tab-pane active" id="account-info">
            <div class="card mt-3"style="background-color: rgba(255, 255, 255, 0.84);">
                <div class="card-body">
                    <h1 class="card-title text-center">Account Information</h1><br>
                    <p class="card-text"><i class="bi bi-person-circle"></i> Name: <b>{{ Auth::user()->fullName }}</b></p>
                    <p class="card-text"><i class="bi bi-envelope"></i> Email: <b>{{ Auth::user()->email }}</b></p>
                    <p class="card-text"><i class="bi bi-people"></i> Role: <b>{{ Auth::user()->role }}</b></p>

                    @if (Auth::user()->role === 'Manager')
                        <p class="card-text"><i class="bi bi-briefcase"></i> Occupation: <b>{{ Auth::user()->occupation }}</b></p>
                        <p class="card-text"><i class="bi bi-flag"></i> Team Name: <b>{{ $user->team ? $user->team->name : 'N/A' }}</b></p>
                        <!-- Display Team Logo -->
                            @if($user->team && $user->team->LogoURL)
                                <div class="mb-2">
                                <i class="fa-solid fa-square"></i> Team Logo: <img src="{{ asset('storage/' . $user->team->LogoURL) }}" alt="{{ $user->team->name }} Logo" style="width: 100px; height: 100px; border-radius: 10px;">
                                </div>
                            @else
                                <p class="card-text"><i class="bi bi-image"></i> Team Logo: <b>No logo available</b></p>
                            @endif
                        <p class="card-text"><i class="bi bi-geo-alt"></i> Address: <b>{{ Auth::user()->address }}</b></p>
                        <p class="card-text"><i class="bi bi-globe"></i> Country: <b>{{ Auth::user()->country }}</b></p>
                        <p class="card-text"><i class="bi bi-trophy"></i> Tournaments:</b></p>
                <ul>
                    @if(Auth::user()->team && Auth::user()->team->tournaments->isNotEmpty())
                        @foreach(Auth::user()->team->tournaments as $tournament)
                            <li><b>{{ $tournament->name }}</b></li>
                        @endforeach
                    @else
                        <li><b>No tournaments joined</b></li>
                    @endif
                </ul>

                    @elseif (Auth::user()->role === 'Player')
                        <p class="card-text"><i class="bi bi-calendar"></i> Date of Birth: <b>{{ Auth::user()->dob }}</b></p>
                        <p class="card-text"><i class="bi bi-display"></i> Display Name: <b>{{ Auth::user()->displayName }}</b></p>
                        <p class="card-text"><i class="bi bi-shirt"></i> Jersey Number: <b>{{ Auth::user()->jerseyNumber }}</b></p>
                        <p class="card-text"><i class="bi bi-flag"></i> Team Name: <b>{{ $user->team ? $user->team->name : 'N/A' }}</b></p>
                                                <!-- Display Team Logo -->
                                                @if($user->team && $user->team->LogoURL)
                                <div class="mb-2">
                                <i class="fa-solid fa-square"></i> Team Logo: <img src="{{ asset('storage/' . $user->team->LogoURL) }}" alt="{{ $user->team->name }} Logo" style="width: 100px; height: 100px; border-radius: 10px;">
                                </div>
                            @else
                                <p class="card-text"><i class="bi bi-image"></i> Team Logo: <b>No logo available</b></p>
                            @endif
                        <p class="card-text"><i class="bi bi-telephone"></i> Contact: <b>{{ Auth::user()->contact }}</b></p>
                        <p class="card-text"><i class="bi bi-gear"></i> Position: <b>{{ Auth::user()->position }}</b></p>
                        <p class="card-text"><i class="bi bi-trophy"></i> Tournaments:</b></p>
                <ul>
                    @if(Auth::user()->team && Auth::user()->team->tournaments->isNotEmpty())
                        @foreach(Auth::user()->team->tournaments as $tournament)
                            <li><b>{{ $tournament->name }}</b></li>
                        @endforeach
                    @else
                        <li><b>No tournaments joined</b></li>
                    @endif
                </ul>

                    @elseif (Auth::user()->role === 'Admin')
                        <p class="card-text"><i class="bi bi-shield-lock"></i> Role: <b>{{ Auth::user()->role }}</b></p>
                    @endif
                </div>
            </div>
            <!-- Update Profile Content -->
            <div class="card mt-3"style="background-color: rgba(255, 255, 255, 0.84);">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <!-- Delete Profile Content -->
            <div class="card mt-3"style="background-color: rgba(255, 255, 255, 0.84);">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>


        <!-- Update Password Tab -->
        <div class="tab-pane" id="update-password" >
            <div class="card mt-3 mb-4" style="background-color: rgba(255, 255, 255, 0.84);">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Notifications Tab -->
        <div class="tab-pane" id="notifications">
            <div class="card mt-3 mb-4" style="background-color: rgba(255, 255, 255, 0.84);">
                <div class="card-body">
                    <h3 class="text-center fw-bold">Notifications</h3>
                </div>
            </div>
        </div>

        <!-- Settings Tab -->
        <div class="tab-pane" id="settings">
            <div class="card mt-3 mb-4" style="background-color: rgba(255, 255, 255, 0.84);">
                <div class="card-body">
                    <h3 class="text-center fw-bold">Settings</h3>
                </div>
            </div>
        </div>

        <!-- Activity Tab -->
        <div class="tab-pane" id="activity">
            <div class="card mt-3 mb-4" style="background-color: rgba(255, 255, 255, 0.84);">
                <div class="card-body">
                    <h3 class="text-center fw-bold">Activity</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));

                // Add active class to clicked button
                button.classList.add('active');
                // Show the corresponding tab pane
                document.querySelector(button.getAttribute('data-target')).classList.add('active');
            });
        });
    </script>

</body>

</html>
