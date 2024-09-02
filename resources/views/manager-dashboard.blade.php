<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @include('layouts.navbar')

    <div class="container-fluid" style="height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #D3D3D3;">
                @include('layouts.sidebar-manager')
            </div>

            <div class="col-9 mt-5">
                <!-- Welcome Message -->
                <div class="text-center mb-4">
                    <h1 style="color:#280137; font-weight:bold;">WELCOME TO YOUR DASHBOARD</h1>
                </div>
                <br>
                <br>
                <!-- Content Sections -->
                <div class="container text-center">
                    <div class="mb-4">
                        <h2 style="color:#7A5DCA;"><i  class="fas fa-users"></i> Manage Players</h2>
                        <p>Easily add new players to the database by entering their details. 
                        ill in the player's information.</p>
                    </div>
                    <br>
                    <br>

                    <div>
                        <h2 style="color:#7A5DCA;"><i class="fa-solid fa-hockey-puck"></i> Manage Teams</h2>
                        <p>Effortlessly manage team details by adding or updating team
information. Enter the team's name, coach, roster, and other 
relevant details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
