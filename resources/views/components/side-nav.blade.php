<div id="mySidenav" class="sidenav">
    @guest
        <a href="/login" class="login-header">LOGIN</a>
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