<div id="mySidenav" class="sidenav">
    @guest
        <a href="/login" class="login-header">LOGIN0</a>
        @else
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="sidenav-user">
            <img 
                src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('img/user-default.png') }}" 
                alt="User Profile Image" 
                class="sidenav-userimage"/> 
        <span class="sidenav-name">{{Auth::user()->name}}</span>
        </div><br>
        <a href="/user">Profile</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('Notification')">Notification</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('ResetPassword')">Reset Password</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('Setting')">Setting</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('Activity')">Activity</a>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
        </form>
    @endguest
</div>

<div id="mySidenav1" class="sidenav">
    @guest
        <a href="/login" class="login-header">LOGIN1</a>
        @else
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="sidenav-user">
            <img 
                src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('img/user-default.png') }}" 
                alt="User Profile Image" 
                class="sidenav-userimage"/> 
        <span class="sidenav-name">{{Auth::user()->name}}</span>
        </div><br>
        <a href="/user">Profile</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('Notification')">Notification</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('ResetPassword')">Reset Password</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('Setting')">Setting</a>
        <a href="javascript:void(0)" onclick="navigateAndOpenTab('Activity')">Activity</a>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
        </form>
    @endguest
</div>

<div id="mySidenav2" class="sidenav">
    @guest
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="sidenav-user">
            <img 
                src="{{ asset('img/user-default.png') }}" 
                alt="User Profile Image" 
                class="sidenav-userimage"/> 
            <a href="/login" class="login-header">LOGIN2</a>
        </div>
        <a href="/tournament">Tournament</a>
        <a href="/forum">Forum</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
        <a href="/fixture" class="sidefixture">Fixture</a>
    @else
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="sidenav-user">
            <img 
                src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('img/user-default.png') }}" 
                alt="User Profile Image" 
                class="sidenav-userimage"/> 
            <span class="sidenav-name">{{ Auth::user()->name }}</span>
        </div><br>
        <button class="dropdown-btn">User 
            <i class="bi bi-caret-down-fill"></i>
        </button>
        <div class="dropdown-container">
            <a href="/user">Profile</a>
            <a href="javascript:void(0)" onclick="navigateAndOpenTab('Notification')">Notification</a>
            <a href="javascript:void(0)" onclick="navigateAndOpenTab('ResetPassword')">Reset Password</a>
            <a href="javascript:void(0)" onclick="navigateAndOpenTab('Setting')">Setting</a>
            <a href="javascript:void(0)" onclick="navigateAndOpenTab('Activity')">Activity</a>
        </div>
        <a href="/tournament">Tournament</a>
        <a href="/forum">Forum</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
        <a href="/fixture">Fixture</a>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
        </form>
    @endguest
</div>

<script>
    // Function to navigate to the user page and open a specific tab
    function navigateAndOpenTab(tabName) {
        // Redirect to user page
        window.location.href = "{{ route('user') }}";

        // Use a timeout to ensure the page is loaded before running the tab function
        setTimeout(function() {
            var tabLinks = document.getElementsByClassName("tablinks");
            for (var i = 0; i < tabLinks.length; i++) {
                if (tabLinks[i].innerHTML.trim() === tabName) {
                    tabLinks[i].click(); // Simulate click on the tab
                }
            }
        }, 500); // Adjust timeout duration if necessary
    }
</script>
<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
        });
    }
    </script>