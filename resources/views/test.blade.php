<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta, CSS, and JavaScript links as before -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/771de58f02.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.2.2/dist/echarts.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
        #target {
            background: #0099cc;
            width: 100%; /* Adjust width to be responsive */
            max-width: 300px; /* Ensure maximum width for large screens */
            height: 160px;
            padding: 0;
            display: none;
        }

        .Hide {
            display: none;
        }

        .button {
            cursor: pointer;
            margin: 5px;
            padding: 1px;
            background-color: #5D3CB8;
            color: #fff;
            text-align: center;
            width: 100%; /* Make buttons full width within their container */
        }

        .button:hover {
            background-color: #4a2c8e;
        }

        .content {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            width: 100%; /* Make content full width within its container */
            max-width: 300px; /* Ensure maximum width for larger screens */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content */
        }

        .buttons-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            margin-right: 20px;
        }

        .selected {
            background-color: #4a2c8e;
            color: #fff;
        }

        .manager-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .manager-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .players-list {
            flex-grow: 1;
            padding-right: 5px; /* Space for the manager */
        }

        .players-list ul {
            list-style-type: none; /* Remove default list bullets */
            padding: 0; /* Remove default padding */
            margin: 0; /* Remove default margin */
        }

        .players-list li {
            font-weight: light; /* Set text to normal weight */
            font-style: normal; /* Ensure text is not italicized */
            font-size: 13px;
            margin-bottom: 5px; /* Space between list items */
        }

        /* Article card styles */
        .article-card {
            width: 100%;
            max-width: 250px;
            height: 220px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 300ms;
            margin-bottom: 10px;
        }

        .article-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .article-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-card .content {
            box-sizing: border-box;
            width: 100%;
            position: absolute;
            padding: 30px 20px 20px 20px;
            height: auto;
            bottom: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.6));
        }

        .article-card .date,
        .article-card .title {
            margin: 0;
        }

        .article-card .date {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 4px;
        }

        .article-card .title {
            font-size: 17px;
            color: #fff;
        }

        /* Resize the chart container */
        #donut {
            height: 400px; /* Adjust height as needed */
            width: 100%; /* Full width */
        }

        /* Media Queries for Responsive Design */
        @media (max-width: 767.98px) {
            .right-sidebar {
                position: relative; /* Adjust position for small screens */
                width: 100%; /* Make the sidebar full width */
                padding: 0;
                margin-top: 20px;
            }

            .col-3 {
                width: 100%;
                padding: 0;
            }

            .col-6 {
                width: 100%;
                padding: 0;
            }
        }

        @media (min-width: 768px) {
            .buttons-container {
                flex-direction: row;
                justify-content: space-around;
            }

            .buttons {
                margin-right: 0;
            }

            .col-3 {
                padding: 15px;
            }

            .col-6 {
                padding: 15px;
            }
        }

        @media (min-width: 992px) {
            .col-md-3 {
                width: 25%;
            }

            .col-md-6 {
                width: 50%;
            }
        }

        @media (min-width: 1200px) {
            .col-lg-3 {
                width: 20%;
            }

            .col-lg-6 {
                width: 60%;
            }
        }
        
        .container {
            width: 75%; /* Width of the container */
        }
        
        .row {
            display: flex;
            justify-content: center; /* Center the columns within the container */
        }

    </style>
</head>
@include('layouts.navbar')
<body>
    <div class="container-fluid" style="width: 100%; height: 90%; padding: 0;">
        <div class="row">
            <div class="col-3" style="background-color: #929292; width: 20%;">
                @include('layouts.sidebar')
            </div>
            <div class="col" style="width: 60%;">
                <div class="container">
                    <div class="row">
                        <div class="col-3" >
                            <div class="card" style="width: 14rem;height:8rem; margin: 1px; margin-left: -80px;background-color: #5D3CB8;display:flex;">
                                <div class="card-body">
                                <h5 class="card-title" style="color: #fff;"><i class="fas fa-users"></i> 90</h5>
                                <h6 class="card-subtitle mb-3 text-muted" style="color: #fff;">Players</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" style="width: 14rem;height:8rem; margin: 1px; margin-left: -40px;background-color: #5D3CB8;display:flex;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-flag"></i> 30</h5>
                                    <h6 class="card-subtitle mb-3 text-muted" style="color: #fff;">Teams</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card" style="width: 14rem;height:8rem; margin: 1px; margin-right: -40px;background-color: #5D3CB8;display:flex;">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff;"><i class="fas fa-user-tie"></i> 30</h5>
                                    <h6 class="card-subtitle mb-3 text-muted" style="color: #fff;">Managers</h6>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="d-flex justify-content-center">
                    <div id="donut"></div>
                </div>
                <div class="buttons-container">
                    <div class="buttons">
                        <div class="button selected" onclick="showContent('Team A')">Team A</div>
                        <div class="button" onclick="showContent('Team B')">Team B</div>
                        <div class="button" onclick="showContent('Team C')">Team C</div>
                        <div class="button" onclick="showContent('Team D')">Team D</div>
                        <div class="button" onclick="showContent('Team E')">Team E</div>
                        <div class="button" onclick="showContent('Team F')">Team F</div>
                        <div class="button" onclick="showContent('Team G')">Team G</div>
                    </div>

                    <div id="content" class="content">
                        <!-- Content will be injected here -->
                    </div>
                    <!-- Article Card -->
                    <div class="article-card">
                        <div class="content">
                            <p class="date">Jan 1, 2022</p>
                            <p class="title">Article Title Goes Here</p>
                        </div>
                        <img src="img/hoki3.png" alt="article-cover" />
                    </div>
                </div>
            </div>

            <div class="col-3" style="background-color: #5D3CB8; width: 20%;">
                <div class="right-sidebar"style="position: absolute;">
                    <div class="card mb-3" style= "background-color: #28C179; color: #fff;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar-alt"></i> UPCOMING MATCH</h5>
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="img/hokit1.png" alt="Team A Logo" style="width: 50px; height: 50px; margin-right: 10px;">
                                    <strong>Team A</strong>
                                </div>
                                    <div style="margin: 0 10px;">vs</div>
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="img/hokit2.png" alt="Team B Logo" style="width: 50px; height: 50px;">
                                            <strong>Team B</strong>
                                        </div>
                                    </div>
                                    <p class="card-text mt-3">
                                        Date: August 15, 2024<br>
                                        Time: 7:00 PM<br>
                                        Venue: National Arena, City
                                    </p>
                            </div>
                        </div>
                    <!-- Last Match -->
                    <div class="card mb-3" style="background-color: #28C179; color: #fff;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-history"></i> LAST MATCH</h5>
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-column align-items-center">
                                    <img src="img/hokit3.png" alt="Team C Logo" style="width: 50px; height: 50px; margin-right: 10px;">
                                    <strong>Team C</strong>
                                </div>
                                <div style="margin: 0 10px;">2 - 3</div>
                                <div class="d-flex flex-column align-items-center">
                                    <img src="img/hokit4.png" alt="Team D Logo" style="width: 50px; height: 50px;">
                                    <strong>Team D</strong>
                                </div>
                            </div>
                            <p class="card-text mt-3">
                                Date: August 10, 2024<br>
                                Venue: National Arena, City
                            </p>
                        </div>
                    </div>
                    <div class="card mb-3" style="background-color: #ffc107; color: #fff;">
                        <img src="img/hoki2.png" class="card-img" alt="Ongoing Event" style="width: 100%; height: 150px; object-fit: cover;">
                        <div class="card-img-overlay d-flex flex-column justify-content-center" style="background: rgba(0, 0, 0, 0.4);">
                            <h5 class="card-title">ONGOING EVENT</h5>
                            <p class="card-text">This is where you can add additional content for the ongoing event.</p>
                        </div>
                    </div>
                    <div class="card mb-3" style="background-color: #ffc107; color: #fff;">
                        <img src="img/hoki1.png" class="card-img" alt="Upcoming Event" style="width: 100%; height: 150px; object-fit: cover;">
                        <div class="card-img-overlay d-flex flex-column justify-content-center" style="background: rgba(0, 0, 0, 0.4);">
                            <h5 class="card-title">UPCOMING EVENT</h5>
                            <p class="card-text">This is where you can add additional content for the upcoming event.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Initialize the chart on the element with ID 'donut'
        const chart = echarts.init(document.getElementById("donut"));

        // Define the chart options with result categories
        const option = {
            title: {
                text: 'Match Results',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: 'bottom'
            },
            series: [
                {
                    name: 'Results',
                    type: 'pie',
                    radius: ['40%', '70%'], // Create the donut effect
                    avoidLabelOverlap: false,
                    label: {
                        show: true,
                        position: 'outside',
                        formatter: '{b}: {d}%'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '16',
                            fontWeight: 'bold'
                        }
                    },
                    data: [
                        { value: 60, name: 'Winner', itemStyle: { color: '#31d58d' } },
                        { value: 20, name: 'Loser', itemStyle: { color: '#ed1d1a' } },
                        { value: 20, name: 'Draw', itemStyle: { color: '#f7a409' } }
                    ]
                }
            ]
        };

        // Event listener for the 'highlight' event
        chart.on('highlight', (p) => {
            const dataIndex = p.batch[0].dataIndex; // Get the index of the highlighted data
            const result = option.series[0].data[dataIndex].name; // Get the corresponding result from the data

            // Update the chart title with the highlighted result
            chart.setOption({
                title: {
                    text: `Highlighted Result: ${result}`,
                    left: 'center'
                }
            });
        });

        // Set the chart option to display the chart
        chart.setOption(option);
        // Resize chart on window resize
        window.addEventListener('resize', () => {
            chart.resize();
        });

        // Show content for a selected team
        function showContent(team) {
            const players = {
                'Team A': ['Player 1', 'Player 2', 'Player 3', 'Player 4', 'Player 5', 'Player 6', 'Player 7', 'Player 8', 'Player 9', 'Player 10'],
                'Team B': ['Player A', 'Player B', 'Player C', 'Player D', 'Player E', 'Player F', 'Player G', 'Player H', 'Player I', 'Player J'],
                'Team C': ['Player X', 'Player Y', 'Player Z', 'Player W', 'Player V', 'Player U', 'Player T', 'Player S', 'Player R', 'Player Q'],
                'Team D': ['Player 1A', 'Player 2A', 'Player 3A', 'Player 4A', 'Player 5A', 'Player 6A', 'Player 7A', 'Player 8A', 'Player 9A', 'Player 10A'],
                'Team E': ['Player A1', 'Player B1', 'Player C1', 'Player D1', 'Player E1', 'Player F1', 'Player G1', 'Player H1', 'Player I1', 'Player J1'],
                'Team F': ['Player Alpha', 'Player Beta', 'Player Gamma', 'Player Delta', 'Player Epsilon', 'Player Zeta', 'Player Eta', 'Player Theta', 'Player Iota', 'Player Kappa'],
                'Team G': ['Player 01', 'Player 02', 'Player 03', 'Player 04', 'Player 05', 'Player 06', 'Player 07', 'Player 08', 'Player 09', 'Player 10']
            };

            const managers = {
                'Team A': { name: 'Manager A', image: 'img/manager A.png' },
                'Team B': { name: 'Manager B', image: 'manager-b.jpg' },
                'Team C': { name: 'Manager C', image: 'manager-c.jpg' },
                'Team D': { name: 'Manager D', image: 'manager-d.jpg' },
                'Team E': { name: 'Manager E', image: 'manager-e.jpg' },
                'Team F': { name: 'Manager F', image: 'manager-f.jpg' },
                'Team G': { name: 'Manager G', image: 'manager-g.jpg' }
            };

            let contentDiv = document.getElementById('content');
            contentDiv.innerHTML = `
                <div class="players-list">
                    <h2>${team}</h2>
                    <ul>${players[team].map(player => `<li>${player}</li>`).join('')}</ul>
                </div>
                <div class="manager-info">
                    <div class="manager-picture">
                        <img src="${managers[team].image}" alt="Manager of ${team}">
                    </div>
                    <h4>${managers[team].name}</h4>
                </div>`;
            contentDiv.style.display = 'flex';

            // Update the selected button's appearance
            const buttons = document.querySelectorAll('.button');
            buttons.forEach(button => {
                button.classList.remove('selected');
            });
            event.target.classList.add('selected');
        }

        // Show content for 'Team A' on page load
        window.onload = function () {
            showContent('Team A');
        };
    </script>
</body>
@include('layouts.footer')
</html>