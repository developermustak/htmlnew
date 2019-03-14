<?php
require_once "config.php";
 
$car_name = $pickup_date ="";
$car_name_err = $pickup_date_err ="";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];

    $input_car_name = trim($_POST["car_name"]);
    if(empty($input_car_name)){
        $car_name_err = "Please enter a car name.";
    } else{
        $car_name = $input_car_name;
    }
    $input_pickup_date = trim($_POST["pickup_date"]);
    if(empty($input_pickup_date)){
        $pickup_date_err = "Please enter date.";     
    } else{
        $pickup_date = $input_pickup_date;
    }
    
    if(empty($car_name_err) && empty($pickup_date_err)){
        $sql = "UPDATE car_pickup SET car_name= '$car_name', pickup_date='$pickup_date' WHERE id=".$id;         
         if (mysqli_query($link, $sql)) {
             header("location: index.php");
        exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
         
    }
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
       
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM car_pickup WHERE id =".$id;
        if( $result = mysqli_query($link, $sql)){
    
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $car_name = $row["car_name"];
                    $pickup_date = $row["pickup_date"];
                } else{
                    header("location: error.php");
                    exit();
                }
                
           
        }
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Car Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($car_name_err)) ? 'has-error' : ''; ?>">
                            <label>Car Name</label>
                            <input type="text" name="car_name" class="form-control" value="<?php echo $car_name; ?>">
                            <span class="help-block"><?php echo $car_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Pickup Date</label>
                            <input type="date" name="pickup_date" class="form-control" value="<?php echo $pickup_date; ?>">
                            <span class="help-block"><?php echo $pickup_date_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>