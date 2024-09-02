
<body>
<div class="header">
    <span onclick="openNav()">&#9776;</span>
    @guest
        <a href="/login" class="login-header">LOGIN</a>
        @else
            
                <span class="user-name">{{ strtok(Auth::user()->name, ' ') }}</span>
            <img 
            src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('img/user-default.png') }}" 
            alt="User Profile Image" 
            class="user-image"/>
            </div>
    @endguest
</div>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="#">Dashboard</a>
    <a href="#">Manage User</a>
</div>

</body>

