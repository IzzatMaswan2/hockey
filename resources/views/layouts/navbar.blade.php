<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Use only one version of Bootstrap (5.3.3 in this case) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-6S3kS8Z2v3dHhe04cF0xtbB7t8Z6ZtQbCOkOqgRIse0dY+6BfVtA8tTu1Q8l10m4" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-DbfNwCApThcJe4fP5z5LfXz0cI0zTXh83Ge9pu6vxZyL2W1p7FSm5lZZjBX92W48" crossorigin="anonymous"></script>
    
    
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link rel="icon" href="img/Logo.png" type="image/icon type">

    <title>Dashboard</title>

    <style>
        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul.navbar-nav > li {
            display: inline-block;
            margin-right: -180px; /* Adjust the value to increase or decrease the gap */
            margin-left: 280px;
            text-align: center;
        }

        nav ul li:last-child {
            margin-right: 0; /* Removes the margin after the last link */
        }

        nav a {
            text-decoration: none;
            color: #000;
        }

        .nav li .dropdown-menu a {
            width: 80px;
        }

        .dropdown-menu {
            width: 80px; /* Adjust the dropdown width */
        }

        .dropdown-menu a {
            padding: 10px; /* Optional: Adjust padding inside the dropdown items */
            margin: 0px;
        }

    

        /* Optional: Add custom width for smaller screens */
        @media (max-width: 768px) {
            .dropdown-menu {
                width: 150px; /* Make it smaller for mobile */
            }
        }

    </style>
</head>

<body>
    <header class="py-2 shadow-sm" style="background-color: #280137; width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #280137;">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <!-- Add your logo here -->
                    <img src="{{ asset('img/Logo Latest 1.png') }}" alt="logo" style="width: 60px; height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/tournamentlist">Tournament</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/forum">Forum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/contact">Contact</a>
                        </li>
                        <li class="nav-item me">
                            <a href=" /fixture/tournamentlist" class="btn btn-light">Fixture</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ strtok(Auth::user()->fullName, ' ') }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <!-- Profile link -->
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>

            <!-- Conditional Dashboard Links based on User Role -->
            @if(Auth::user()->role === 'Manager')
                <li><a class="dropdown-item" href="{{ route('manager-dashboard') }}">Manager Dashboard</a></li>
            @endif
            
            @if(Auth::user()->role === 'Player')
                <li><a class="dropdown-item" href="{{ route('player-dashboard') }}">Player Dashboard</a></li>
            @endif
            @if(Auth::user()->role === 'Admin')
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Admin Dashboard</a></li>
            @endif
            
            <li><hr class="dropdown-divider"></li>

            <!-- Logout link -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </li>
</ul>

                </div>
            </div>
        </nav>
    </header>

    <!-- Your main content would go here -->

</body>
</html>
