<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$id  = $date = $name = $broll = $spbet = $winlose = "";
$id_err  = $date_err = $name_err = $start_broll_err = $unit_psize_err = $win_lose_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
     // Validate id
     $input_id = trim($_POST["id"]);
     if(empty($input_id)){
        //$id_err = "Please enter the account id.";     
        $id = $input_id;
    } else{
        $id = $input_id;
    }

    // Validate date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
    $date_err = "Please enter date.";     
    } else{
    $date = $input_date;
    }

    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
    $name_err = "Please enter a name.";
    } else{
        $name = $input_name;
    }
    
    // Validate bankroll
    $input_broll = trim($_POST["broll"]);
    if(empty($input_broll)){
        $start_broll_err = "Please enter the starting bankroll.";     
    } elseif(!ctype_digit($input_broll)){
        $start_broll_err = "Please enter a valid input.";
    } else{
        $broll = $input_broll;
    }

    // Validate unit size per bet
    $input_spbet = trim($_POST["spbet"]);
    if(empty($input_spbet)){
        $unit_psize_err = "Please enter the unit size amount.";     
    } elseif(!ctype_digit($input_spbet)){
        $unit_psize_err = "Please enter a valid input.";
    } else{
        $spbet = $input_spbet;
    }

     // Validate win/lose
     $input_winlose = trim($_POST["winlose"]);
     if(empty($input_winlose)){
         $win_lose_err = "Please enter the win or lose amount.";     
     } elseif(!is_numeric($input_winlose)){
         $win_lose_err = "Please enter a valid input.";
     } else{
         $winlose = $input_winlose;
     }
    
    // Check input errors before inserting in database
    if(empty($id_err) && empty($date_err) && empty($name_err) && empty($start_broll_err) && empty($unit_psize_err) && empty($winlose_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO members (id , date , name, start_broll, unit_pbet, win_lose) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_id, $param_date, $param_name, $param_broll, $param_spbet, $param_winlose);
            
            // Set parameters
            $param_id = $id;
            $param_date = $date;
            $param_name = $name;
            $param_broll = $broll;
            $param_spbet = $spbet;
            $param_winlose = $winlose;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: calendar.php");
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
                    <h2 class="mt-5">Add New</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="id" class="form-control <?php echo (!empty($id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $id; ?>">
                            <span class="invalid-feedback"><?php echo $id_err;?></span>
                        </div>
                        <script>
                        $(document).ready(function(){
                            $('input[name="date"]').datepicker({
                                dateFormat: 'yy-mm-dd' // Adjust the date format as needed
                            });
                        });
                        </script>
                        <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
                        <span class="invalid-feedback"><?php echo $date_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Starting Bankroll</label>
                            <input type="text" name="broll" class="form-control <?php echo (!empty($start_broll_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $broll; ?>">
                            <span class="invalid-feedback"><?php echo $start_broll_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Unit Size per Bet</label>
                            <input type="text" name="spbet" class="form-control <?php echo (!empty($unit_psize_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $spbet; ?>">
                            <span class="invalid-feedback"><?php echo $unit_psize_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Win/Lose</label>
                            <input type="text" name="winlose" class="form-control <?php echo (!empty($win_lose_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $winlose; ?>">
                            <span class="invalid-feedback"><?php echo $win_lose_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-success fa fa-plus" value="Add New">
                        <a href="calendar.php" class="btn btn-secondary ml-2">Cancel</a>

                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>