<?php
include "config.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "admin"){
        header("Location: calendar.php");
    exit();
    }else{
        echo '<script>alert("Incorrect Username or Password");</script>';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
        <div class="bg"></div>
        <div class="landing"> 
            <img src="img\lsclogo.png">
        </div>

        <div class="login-form">
            <form method = "POST" action="">
                <fieldset>
                    <legend>
                        Administrator Login
                    </legend>
                    <br>
                    Username:<br>
                    <input type="text" name="username">
                    <br>
                    Password:<br>
                    <input type="password" name="password">
                    <br><br>
                    <input type="submit" name="submit" value="Login">
                </fieldset>    
            </form>
        </div>
</body>
</html>