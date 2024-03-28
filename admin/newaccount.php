<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$id  = $username = $password = $conpassword = $usertype = $email = "";
$id_err = $username_err = $password_err = $conpassword_err = $usertype_err = $email_err = "";
$input_conpassword = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
     // Validate id
     $input_id = trim($_POST["id"]);
     if(empty($input_id)){
        //$id_err = "Please enter the account id.";     
        $id = $input_id;
    }else{
        $id = $input_id;
    }

    // Validate username
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
    $username_err = "Please enter a username.";
    } else{
        $username = $input_username;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter a password.";     
    }else{
        $password = $input_password;
    }

    // Confirm password
    $input_conpassword = trim($_POST["conpassword"]);
    if(empty($input_conpassword)){
        $conpassword_err = "Please re-enter password.";     
    }elseif($input_password!=$input_conpassword){
        $conpassword_err = "Password don't match";
    }else{
        $password = $input_password;
    }

    // Validate usertype
    $input_usertype = trim($_POST["usertype"]);
    if(empty($input_usertype)){
        $usertype_err = "Please enter usertype.";     
    }else{
        $usertype = $input_usertype;
    }

     // Validate email
     $input_email = trim($_POST["email"]);
     if(empty($input_email)){
         $email_err = "Please enter email.";     
     }else{
         $email = $input_email;
     }
    
    // Check input errors before inserting in database
    if(empty($id_err) && empty($username_err) && empty($password_err) && empty($usertype_err) && empty($email_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO accounts (id , username , password, usertype, email) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_id, $param_username, $param_password, $param_usertype, $param_email);
            
            // Set parameters
            $param_id = $id;
            $param_username = $username;
            $param_password = $password;
            $param_usertype = $usertype;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: dashboard.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add New Account</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="text" name="conpassword" class="form-control <?php echo (!empty($conpassword_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $conpassword; ?>">
                            <span class="invalid-feedback"><?php echo $conpassword_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Usertype</label>
                            <input type="text" name="usertype" class="form-control <?php echo (!empty($usertype_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usertype; ?>">
                            <span class="invalid-feedback"><?php echo $usertype_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-success fa fa-plus" value="Add New">
                        <a href="dashboard.php" class="btn btn-secondary ml-2">Cancel</a>

                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>