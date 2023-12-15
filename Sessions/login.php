<?php

include "connection1.php";
session_start();

if (isset($_POST['but_submit'])) {
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $password = mysqli_real_escape_string($con, $_POST['pwd']);

    $query = "SELECT * FROM login WHERE username='$uname' AND password='$password'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['uname'] = $uname;
        header('Location: index1.php');
    } else {
        echo '<p style="background-color: #333; color: #fff; padding: 10px;">Invalid username and password</p>';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            overflow: hidden;
        }
        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
            padding-bottom: 50px;
            width: 300px;
            text-align: center;
        }
        .login-form h1 {
            margin: 0 0 20px;
            color: #333;
        }
        .login-form input {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-form input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: 0;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }
        .login-form input[type="submit"]:hover {
            background-color: #2980b9;
        }

        a{
            text-decoration: none;
            font-size: 13px;
        }

        a:visited{
            color: #000;
        }

    </style>
</head>
<body>
<div class="container">
    <form class="login-form" method="post" action="">
        <h1>Login</h1>
        <input type="text" name="uname" placeholder="Username" required />
        <input type="password" name="pwd" placeholder="Password" required />
        <input type="submit" name="but_submit" value="Submit" />
        <a href="signup.php">Sign Up</a>
    </form>
</div>
</body>
</html>
