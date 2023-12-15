<?php
include "connection.php";

if (isset($_POST['but_signup'])) {
    $newUsername = mysqli_real_escape_string($con, $_POST['txt_new_uname']);
    $newPassword = mysqli_real_escape_string($con, $_POST['txt_new_pwd']);

    if ($newUsername != "" && $newPassword != "") {
        $checkQuery = "SELECT * FROM login WHERE username = '$newUsername'";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            $query = "INSERT INTO login (username, password) VALUES ('$newUsername', '$newPassword')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo '<p style="background-color: #fff; color: #333; padding: 10px;">Registration successful. You can now log in.</p>';
            } else {
                echo '<p style="background-color: #fff; color: #333; padding: 10px;">Error registering the user.</p>';
            }
        } else {
            echo '<p style="background-color: #333; color: #fff; padding: 10px;">Username already exists. Choose a different one.</p>';
        }
    } else {
        echo '<p style="background-color: #333; color: #fff; padding: 10px;">Please provide both a username and a password for sign-up.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            overflow:hidden;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-form {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
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

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        a{
            text-decoration: none;
            font-size: 13px;
        }

        a:visited{
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
    <form class="login-form" method="post" action="signup.php">
        <h1>Sign Up</h1>
        <input type="text" name="txt_new_uname" placeholder="New Username" />
        <input type="password" name="txt_new_pwd" placeholder="New Password" />
        <input type="submit" name="but_signup" value="Sign Up" /><br><br>
        <p class="back-link"><a href="login.php">Back to Login</a></p>
    </form>
</div>
</body>
</html>
