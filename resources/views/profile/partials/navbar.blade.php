<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Link to Bootstrap CSS and your custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css"> <!-- Ensure this file has the corrected CSS -->
    <link rel="stylesheet" href="css/about.css"> <!-- Ensure this file is needed and has no conflicting styles -->
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/tournament.css">
    
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
        <a href="/"><img class="logo" src="img/Logo Latest 1.png" alt="logo"></a>
        <nav>
            <div class="nav__toggle">
                <i class="bi bi-list"></i>
                <i class="bi bi-x"></i> 
            </div>
            <ul class="nav__link">
                <li><a href="/tournament">Tournament</a></li>
                <li><a href="/group">Group</a></li>
                <li><a href="/forum">Forum</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
        <a class="cta" href="#"><button>Fixture</button></a>
    </header>

    <!-- JavaScript for toggling the navigation menu -->
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
