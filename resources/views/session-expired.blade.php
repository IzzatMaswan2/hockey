<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Expired</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Arial", sans-serif;
            background: linear-gradient(135deg, #0a1a2f, #03101f);
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.08);
            padding: 40px 50px;
            border-radius: 18px;
            text-align: center;
            width: 90%;
            max-width: 420px;
            backdrop-filter: blur(6px);
            box-shadow: 0 0 25px rgba(0,0,0,0.4);
        }

        .icon {
            font-size: 70px;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 26px;
            letter-spacing: 0.8px;
            font-weight: 700;
        }

        p {
            opacity: 0.85;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #1e90ff;
            border-radius: 30px;
            color: white;
            font-weight: bold;
            text-decoration: none;
            font-size: 16px;
            transition: 0.2s;
            margin-top: 10px;
        }

        .btn:hover {
            background: #4aa3ff;
            transform: translateY(-2px);
        }

        .countdown {
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold;
            color: #ff5555;
        }

        .rink-lines {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            opacity: 0.1;
            background: url('data:image/svg+xml;utf8,
            <svg xmlns="http://www.w3.org/2000/svg" width="600" height="300" viewBox="0 0 600 300">
                <rect x="0" y="0" width="600" height="300" fill="none" stroke="white" stroke-width="6" rx="60" ry="60"/>
                <line x1="300" y1="0" x2="300" y2="300" stroke="red" stroke-width="4"/>
                <circle cx="300" cy="150" r="60" fill="none" stroke="red" stroke-width="4"/>
                <circle cx="300" cy="150" r="8" fill="red" />
            </svg>') center/cover no-repeat;
        }
    </style>
</head>
<body>
    <div class="rink-lines"></div>

    <div class="card">
        <div class="icon">🏒</div>
        <h2>Session Expired</h2>
        <p>Your session has timed out. You will be redirected to the homepage.</p>
        <div class="countdown">Redirecting in <span id="timer">10</span> seconds...</div>
        <a href="/" class="btn">Return to Homepage Now</a>
    </div>

    <script>
        // Countdown timer in seconds
        let timeLeft = 10;
        const timerElement = document.getElementById('timer');

        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;

            if(timeLeft <= 0){
                clearInterval(countdown);
                window.location.href = '/';
            }
        }, 1000);
    </script>
</body>
</html>
