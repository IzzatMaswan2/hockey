<!-- Desktop Side Navigation -->
<div id="mySidenav" class="sidenav">
    @guest
        <a href="/login" class="login-header">LOGIN</a>
    @else
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('lap')">&times;</a>
        <div class="sidenav-user">
            <img 
                src="{{ Auth::user()->Img_User ? asset('img/' . Auth::user()->Img_User) : asset('img/user-default.png') }}" 
                alt="User Profile Image" 
                class="sidenav-userimage"/> 
            <span class="sidenav-name">{{ Auth::user()->name }}</span>
        </div>
        <br>
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

<!-- Mobile Side Navigation -->
<div id="mySidenav2" class="sidenav">
    @guest
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('mob')">&times;</a>
        <div class="sidenav-user">
            <img 
                src="{{ asset('img/user-default.png') }}" 
                alt="User Profile Image" 
                class="sidenav-userimage"/> 
            <a href="/login" class="login-header">LOGIN</a>
        </div>
        <a href="/tournament">Tournament</a>
        <a href="/forum">Forum</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
        <a href="/fixture" class="sidefixture">Fixture</a>
    @else
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('mob')">&times;</a>
        <div class="sidenav-user">
            <img 
                src="{{ Auth::user()->Img_User ? asset('img/' . Auth::user()->Img_User) : asset('img/user-default.png') }}"  
                alt="User Profile Image" 
                class="sidenav-userimage"/> 
            <span class="sidenav-name">{{ Auth::user()->name }}</span>
        </div>
        <br>
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
        <a href="/fixture" class="sidefixture">Fixture</a>
        <form method="POST" action="{{ route('logout') }}" id="logout-form">
            @csrf
            <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
        </form>
    @endguest
</div>

<!-- JavaScript -->
<script>
    // Function to navigate to the user page and open a specific tab
    function navigateAndOpenTab(tabName) {
        window.location.href = "{{ route('user') }}";
        setTimeout(function() {
            var tabLinks = document.getElementsByClassName("tablinks");
            for (var i = 0; i < tabLinks.length; i++) {
                if (tabLinks[i].innerHTML.trim() === tabName) {
                    tabLinks[i].click(); // Simulate click on the tab
                }
            }
        }, 500); // Adjust timeout duration if necessary
    }

    // Function to open the side navigation menu
    function openNav(headerType) {
        if (headerType === 'lap') {
            document.getElementById("mySidenav").style.width = "250px";
        } else if (headerType === 'mob') {
            document.getElementById("mySidenav2").style.width = "250px";
        }
    }

    // Function to close the side navigation menu
    function closeNav(headerType) {
        if (headerType === 'lap') {
            document.getElementById("mySidenav").style.width = "0";
        } else if (headerType === 'mob') {
            document.getElementById("mySidenav2").style.width = "0";
        }
    }

    // Dropdown menu functionality
    document.querySelectorAll(".dropdown-btn").forEach(function(button) {
        button.addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
        });
    });
</script>
