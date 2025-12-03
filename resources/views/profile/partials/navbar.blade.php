<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="js/faq.js"></script>
</head>

<body>
    <header>
        <!-- Desktop Header -->
        <div class="header-width1" id="lap-header">
            <a href="/"><img class="logo" src="{{ asset('img/Logo Latest 1.png') }}" alt="logo"></a>
            <nav>
                <div class="nav__toggle">
                    <i class="bi bi-list"></i>
                    <i class="bi bi-x"></i>
                </div>
                <ul class="nav__link">
                    <li><a href="/tournamentlist">Tournament</a></li>
                    <li><a href="/forum">Forum</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li class="fixture"><a href=" /fixture/tournamentlist">Fixture</a></li>
                </ul>
            </nav>
            <div class="cta">
                <button onclick="window.location.href='/fixture/tournamentlist'">Fixture</button>
            </div>
            @guest
            <a href="/login" class="login-header">LOGIN</a>
            @else
            <div class="logged-user" onclick="openNav('lap')">
                <span class="user-name">{{ strtok(Auth::user()->fullName, ' ') }}</span>
                <img 
                    src="{{ Auth::user()->Img_User ? asset('img/' . Auth::user()->Img_User) : asset('img/user-default.png') }}" 
                    alt="User Profile Image" 
                    class="user-image"/>
            </div>
            @endguest
        </div>
    
        <!-- Mobile Header -->
        <div class="header-width" id="mob-header">
            <a href="/"><img class="logo" src="{{ asset('img/Logo Latest 1.png') }}" alt="logo"></a>
            @guest
            <div class="logged-user" onclick="openNav('mob')">
                <i class="bi bi-box-arrow-in-right"></i>
                Login
            </div>
            @else
            <div class="logged-user2" onclick="openNav('mob')">
                <img 
                    src="{{ Auth::user()->Img_User ? asset('img/' . Auth::user()->Img_User) : asset('img/user-default.png') }}" 
                    alt="User Profile Image" 
                    class="user-image"/>
            </div>
            @endguest
        </div>
    </header>
    
    <script>
        function openNav(headerType) {
            if (headerType === 'lap') {
                document.getElementById("mySidenav").style.width = "250px";
            } else if (headerType === 'mob') {
                document.getElementById("mySidenav2").style.width = "250px";
            }
        }
    
        function closeNav(headerType) {
            if (headerType === 'lap') {
                document.getElementById("mySidenav").style.width = "0";
            } else if (headerType === 'mob') {
                document.getElementById("mySidenav2").style.width = "0";
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.querySelector('.nav__toggle');
            const navLinks = document.querySelector('.nav__link');
            toggleButton.addEventListener('click', function() {
                navLinks.classList.toggle('active'); 
            });
        });
    </script>
</body>
</html>
