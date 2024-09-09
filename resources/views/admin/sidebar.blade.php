<style>
    /* Sidebar styles */
#sidebar {
    position: fixed;
    top: 0;
    left: -250px; /* Hide the sidebar off-screen */
    width: 250px;
    height: 100%;
    background-color: rgb(52, 58, 64);
    transition: left 0.3s ease; /* Smooth sliding effect */
    z-index: 1000;
    overflow-y: auto;
}

#sidebar .nav-link {
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
    font-weight: 600;
    background-color: rgb(52, 58, 64);
    color: white;
    display: block;
}

#sidebar .nav-link.active {
    color: black;
    font-weight: bold;
    background-color: rgba(122, 93, 202, 1);
}

#sidebar .nav-link:hover {
    color: white;
    background-color: rgba(122, 93, 202, 1);
}

/* Sidebar toggle button styles */
.sidebar-toggle {
    position: fixed;
    top: 15px;
    left: 15px;
    background-color: rgba(122, 93, 202, 1);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    z-index: 1001; /* Ensure it is above the sidebar */
}

/* Media queries */
@media screen and (min-width: 601px) and (max-width: 1000px) {
    #sidebar {
        display: none !important;
    }
}

@media screen and (max-width: 600px) {
    #sidebar {
        display: none; /* Hide the sidebar */
    }
}

@media screen and (min-width: 1001px) and (max-width: 1390px) {
    #sidebar .nav-link {
        font-size: 14px !important;
    }
}
</style>

<nav id="sidebar" class="sidebar">
        <button id="sidebarToggle" class="sidebar-toggle">☰</button>
        <div class="position-sticky h-100">
            <ul class="nav flex-column text-center">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="margin-top:80px">DASHBOARD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{('article')}}">ARTICLE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">EVENTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{('/manageuser')}}">MANAGE USERS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{('/managematch')}}">MANAGE MATCH</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{('/adminpage')}}">MANAGE PAGES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SCOREBOARD</a>
                </li>
            </ul>
        </div>
    </nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = window.location.href;
    var navLinks = document.querySelectorAll('#sidebar .nav-link');

    navLinks.forEach(function(link) {
        if (link.href === currentUrl) {
            link.classList.add('active');
            link.style.color = 'white';
        }
    });

    var sidebar = document.getElementById('sidebar');
    var toggleButton = document.getElementById('sidebarToggle');

    toggleButton.addEventListener('click', function() {
        if (sidebar.style.left === '0px') {
            sidebar.style.left = '-250px';
        } else {
            sidebar.style.left = '0px';
        }
    });
});
</script>