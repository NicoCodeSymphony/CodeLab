<?php
include "connection.php";

session_start();

if (!isset($_SESSION['uname'])) {
    header('Location: login.php');
    exit;
}

if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: login.php');
}
?>
<!doctype html>
<title>Main Page</title>
<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 30px 50px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            display: flex;
            justify-content: end;
            align-items: center;
            background-color: #333;
            padding: 10px 20px;
            position: relative;
        }

        .header h1 {
            color: white;
            font-size: 24px;
            white-space: nowrap;
            position: absolute;
            left: 0;
            animation: moveText 20s linear infinite; 
        }

        .header form {
            display: inline;
        }

        .header button {
            background-color: #3498db;
            color: white;
            border: 0;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .header button:hover {
            background-color: #2980b9;
        }

        iframe {
            width: 100%;
            height: 90vh;
            max-width: 90%;
            max-height: 90vh;
            margin-left: 70px;
            margin-top: 20px;
        }

        @keyframes moveText {
            0% {
                left: -30%;
            }
            100% {
                left: 120%; 
            }
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Rock n Roll to the World</h1>
</div>

<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ?si=A41zYeZJyOwlcb3-&autoplay=1&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</body>
</html>
