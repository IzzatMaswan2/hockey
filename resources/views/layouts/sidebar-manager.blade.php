<header>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
</header>

<style>
    .sidebar {
        width: 250px !important;
        background-color: pink;
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
        margin-bottom: 50px;
    }

    .sidebar ul li {
        padding: 10px 15px;
        margin-bottom: 50px;
    }

    .sidebar ul li a {
        color: #fff;
        text-decoration: none;
        display: block;
        margin-bottom: 50px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .content {
        margin-left: 250px; /* Match the sidebar width */
        padding: 20px;
    }

    .nav-link {
        color: pink;
    }

    /* Hide sidebar on small screens */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
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
    <li class="nav-item">
        <a id="dashboard-link" class="nav-link active" aria-current="page" href="/manager-dashboard" style="color: #fff;">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a id="players-link" class="nav-link" href="/manageplayer" style="color: #fff;">
            <i class="fas fa-newspaper"></i> Manage Players
        </a>
    </li>
    {{-- <li class="nav-item">
        <a id="formations-link" class="nav-link" href="/formation" style="color: #fff;">
            <i class="fas fa-calendar-alt"></i> Manage Formations
        </a>
    </li> --}}
    <li class="nav-item">
        <a id="matchscore-link" class="nav-link" href="/match-score" style="color: #fff;">
            <i class="fas fa-calendar-alt"></i> Manage Match
        </a>
    </li>
    {{-- <li class="nav-item">
        <a id="lineup-link" class="nav-link" href="/line-up" style="color: #fff;">
            <i class="fas fa-calendar-alt"></i> Line - Up
        </a>
    </li> --}}
</ul>

<script>
       // Function to set active link on page load
function setActiveLink() {
    const currentPath = window.location.pathname;

    // Remove active class from all links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });

    // Add active class to the correct link based on the current path
    if (currentPath.includes('manager-dashboard')) {
        document.getElementById('dashboard-link').classList.add('active');
    } else if (currentPath.includes('manageplayer')) {
        document.getElementById('players-link').classList.add('active');
    } else if (currentPath.includes('formation')) {
        document.getElementById('formations-link').classList.add('active');
    } else if (currentPath.includes('line-up')) {
        document.getElementById('lineup-link').classList.add('active');
    } else if (currentPath.includes('line-up')) {
        document.getElementById('matchscore-link').classList.add('active');
    }
}

// Call the function on page load
window.onload = setActiveLink;
    </script>
</body>

