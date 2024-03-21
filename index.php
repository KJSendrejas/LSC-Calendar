<?php
include "config.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "admin"){
        header("Location: calendar2.php");
    exit();
    }else{
        echo '<script>alert("Incorrect Username or Password");</script>';
    }

}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <title>Lion Sports Consultants</title>
    
</head>
    <body>
        <div class="container">
            <div class="login-form">
                <form method = "POST" action="">
                    <div class="landing"> 
                        <img src="img\lsclogo.png">
                    </div>
                        <h1>Login</h1>
                        <input type="text" placeholder="Username" name="username">
                        <input type="password" placeholder="Password" name="password">
                        <button type="submit" name="submit" value="Login">Login</button>
                        <p>Forgot Password</p>
                </form>
            </div>
            <div class="side-content">
                <div class="bg"> 
                    
                </div>
    </div>
        </div>
    </body>

   
</html>