<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
</header>

<style>
    .sidebar {
        width: 250px !important;
        background-color: #343a40;
        color: #fff;
        position: fixed;
        height: 100%;
        top: 0;
        left: 0;
        padding-top: 20px;
        transition: transform 0.3s ease;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 10px 15px;
    }

    .sidebar ul li a {
        color: #000;
        text-decoration: none;
        display: block;
    }

    .sidebar ul li a:hover {
        background-color: #fff;
    }

    .content {
    margin-left: 250px; /* Match the sidebar width */
    padding: 20px;
    }

    .nav-link {
        color: #fff;
    }

    /* Hide sidebar on small screens */
@media (max-width: 768px) {
    .sidebar {
        transform: translateX(-100%);
        /* Optional: Add a smooth transition */
    }

    .sidebar.show {
        transform: translateX(0);
    }
}

/* Ensure content area adjusts to sidebar */
.content {
    margin-left: 250px;
    padding: 20px;
    transition: margin-left 0.3s ease;
}

/* Adjust content margin on small screens */
@media (max-width: 768px) {
    .content {
        margin-left: 0;
    }
}

</style>

<body>
    <ul class="nav flex-column">
        <!-- Main Dashboard -->
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/dashboard" style="color: #fff;">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>

        <!-- Content Management -->
        <li class="nav-item">
            <a class="nav-link" href="/adminmanagepage" style="color: #fff;">
                <i class="fa fa-file-text"></i> Manage Pages
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/article" style="color: #fff;">
                <i class="fas fa-newspaper"></i> Manage Articles
            </a>
        </li>
        

        <!-- User & Role Management -->
        <li class="nav-item">
            <a class="nav-link" href="/manageadmin" style="color: #fff;">
                <i class="fas fa-users-cog"></i> Manage Admins
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/manageuser" style="color: #fff;">
                <i class="fas fa-users-cog"></i> Manage Managers
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/referee" style="color: #fff;">
                <i class="fas fa-users-cog"></i> Manage Officers
            </a>
        </li>

        <!-- Tournament & Venue Management -->
        <li class="nav-item">
            <a class="nav-link" href="/managevenue" style="color: #fff;">
                <i class="fa-solid fa-map-location"></i> Manage Venues
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/managetournament" style="color: #fff;">
                <i class="fas fa-calendar-alt"></i> Manage Tournaments
            </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="/managecategory" style="color: #fff;">
                <i class="fa-solid fa-tags"></i> Manage Categories
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="/participants" style="color: #fff;">
                <i class="fa-solid fa-users"></i> Manage Competitions
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="/manage-group" style="color: #fff;">
                <i class="fa-solid fa-map-location"></i> Manage Groups
            </a>
        </li>

        <!-- Match & Statistic Management -->
        <li class="nav-item">
            <a class="nav-link" href="/matches/matches" style="color: #fff;">
                <i class="fas fa-futbol"></i> Manage Match
            </a>
        </li>
        <!-- Scoreboard -->
        <li class="nav-item">
            <a class="nav-link" href="/scoreboard/tournamentlist" style="color: #fff;">
                <i class="fas fa-list-ol"></i> Manage Scoreboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/statistics/tournaments" style="color: #fff;">
                <i class="fas fa-chart-bar"></i> Manage Statistic
            </a>
        </li>

        
    </ul>
</body>


