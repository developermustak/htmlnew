<?php
require_once "config.php";
$car_name = $pickup_date ="";
$car_name_err = $pickup_date_err ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_car_name = trim($_POST["car_name"]);
    if(empty($input_car_name)){
        $car_name_err = "Please enter a name.";
    }else{
        $car_name = $input_car_name;
    }
    $input_pickup_date = trim($_POST["pickup_date"]);
    if(empty($input_pickup_date)){
        $pickup_date_err = "Please enter date.";     
    } else{
        $pickup_date = $input_pickup_date;
    }
    // Check input errors before inserting in database
 if(empty($car_name_err) && empty($pickup_date_err)){
        // Prepare an insert statement
    $sql = "INSERT INTO car_pickup (car_name, pickup_date)
        VALUES ('".$car_name."','".$pickup_date."')";

        if (mysqli_query($link, $sql)) {
             header("location: index.php");
        exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
   }

    
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Car</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add Car record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($car_name_err)) ? 'has-error' : ''; ?>">
                            <label>Car Name</label>
                            <input type="text" name="car_name" class="form-control" value="<?php echo $car_name; ?>">
                            <span class="help-block"><?php echo $car_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($pickup_date_err)) ? 'has-error' : ''; ?>">
                            <label>Pickup Date</label>
                            <input type="date" name="pickup_date" class="form-control" value="<?php echo $pickup_date; ?>">
                            <span class="help-block"><?php echo $pickup_date_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>