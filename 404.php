<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(120deg, #1a2a6c, #b21f1f, #fdbb2d);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            text-align: center;
        }

        .error-container {
            max-width: 600px;
            padding: 20px;
        }

        .error-animation {
            position: relative;
        }

        h1 {
            font-size: 12rem;
            font-weight: bold;
            position: relative;
            z-index: 2;
            text-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
        }

        .circle {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 4s ease-in-out infinite;
            z-index: 1;
        }

        .shadow {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 20px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        p {
            font-size: 1.2rem;
            margin: 10px 0;
            opacity: 0.9;
        }

        .back-button {
            text-decoration: none;
            background: #ffffff;
            color: #1a2a6c;
            padding: 12px 25px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
        }

        .back-button:hover {
            background: #1a2a6c;
            color: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(-50%, -20px);
            }

            50% {
                transform: translate(-50%, 20px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                width: 150px;
            }

            50% {
                width: 160px;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-animation">
            <h1>404</h1>
            <div class="circle"></div>
            <div class="shadow"></div>
        </div>
        <p>It looks like you're lost in space.</p>
        <p>The page you’re looking for doesn’t exist.</p>
        <a href="/" class="back-button">Return to Home</a>
    </div>
</body>

</html>