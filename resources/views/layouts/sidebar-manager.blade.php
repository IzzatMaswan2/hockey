<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>

    <style>
        .nav {
            background-color: #D3D3D3; /* Background color for the sidebar */
            padding: 0px; /* Add padding around the sidebar */
            height: 100vh; /* Full height */
            color:#595959;
            margin-top: 10px;
        }

        .nav-item {
            margin-bottom: 15px; /* Space between each item */
            color:#595959;
        }

        .nav-link {
            font-weight: 600; /* Make the text bold */
            padding: 10px 15px; /* Add padding for better spacing */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth transition on hover */
            color:#595959;
        }

        .nav-link.active {
            background-color: #595959; /* Background color for active link */
            color: #fff; /* Active link text color */
        }

        .nav-link:hover {
            background-color: #595959; /* Hover effect */
            color: #fff; /* Change text color on hover */
        }

        .dropdown-menu {
            background-color: #D3D3D3; /* Background color for dropdown */
            border: none; /* Remove border */
        }

        .dropdown-item {
            color: #fff; /* Text color for dropdown items */
            font-weight: 600; /* Make the text bold */
            padding: 10px 15px; /* Add padding for better spacing */
            transition: background-color 0.3s ease; /* Smooth transition on hover */
        }

        .dropdown-item:hover {
            background-color: #595959; /* Hover effect for dropdown items */
            color: #fff; /* Change text color on hover */
        }
    </style>
</head>
<body>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="/manager-dashboard">
                <i class="fa-solid fa-chalkboard"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/player-view">
                <i class="fa-solid fa-user-check"></i> Manage Player
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/formation">
                <i class="fa-solid fa-user-check"></i> Formation
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/line-up">
                <i class="fa-solid fa-user-check"></i> Line-Up
            </a>
        </li>
    </ul>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentLocation = location.href;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.href === currentLocation) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
