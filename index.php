<?php
include "config.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fixed the query to properly handle the input variables without adding extra spaces
    $sql = "SELECT * FROM accounts WHERE username='".$username."' AND password='".$password."'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_array($result);

        if ($row && $row["usertype"] == "user") {
            $_SESSION["username"]=$username;
            header("location:calendar.php");
            exit; // Don't forget to exit after sending a header redirection
        } elseif ($row && $row["usertype"] == "admin") {
            $_SESSION["username"]=$username;
            header("location:admin/dashboard.php");
        } else {
            echo "NO ACCOUNT FOUND";
        }
    } else {
        echo "Error executing query: " . mysqli_error($conn);
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
                        <img src="img\head.png">
                    </div>
                        <h1>Login</h1>
                        <input type="text" placeholder="Username" name="username">
                        <input type="password" placeholder="Password" name="password">
                        <button type="submit" name="submit" value="Login">Login</button>
                        <p>Forgot Password</p>
                </form>
            </div>
            <div class="side-content">
                <img src="img/cover.jpg">
        </div>
    </body>

   
</html>