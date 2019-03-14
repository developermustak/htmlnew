<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        .table > tbody > tr > td{
            padding: 0 !important;
        }
        span{
            padding: 0px 5px !important;
        }

    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Available Pickup's</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add New Car</a>
                         <a href="list.php" class="btn btn-primary pull-right">List of Cars</a>
                    </div>
                    <?php
                    require_once "config.php";
                    $sql = "SELECT * FROM car_pickup";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                    $days = array();
                                    for ($i = 0; $i < 7; $i++) {
                                        $days[$i] = jddayofweek($i,1);
                                    }
                                    foreach ($days as $key => $dname) {
                                        echo "<th>".$dname."</th>";
                                       }
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    $nameOfDay = date('l', strtotime($row['pickup_date']));
                                     if($nameOfDay == "Monday"){ $Monday[] = array('car_name'=>$row['car_name'],'picku_date'=>$row['pickup_date']); }else{ echo ""; }
                                     if($nameOfDay == "Tuesday"){ $Tuesday[] = array('car_name'=>$row['car_name'],'picku_date'=>$row['pickup_date']); }else{ echo ""; }
                                     if($nameOfDay == "Wednesday"){ $Wednesday[] = array('car_name'=>$row['car_name'],'picku_date'=>$row['pickup_date']); }else{ echo "";  }
                                     if($nameOfDay == "Thursday"){ $Thursday[] = array('car_name'=>$row['car_name'],'picku_date'=>$row['pickup_date']); }else{ echo ""; }
                                     if($nameOfDay == "Friday"){ $Friday[] = array('car_name'=>$row['car_name'],'picku_date'=>$row['pickup_date']); }else{ echo "";  }
                                     if($nameOfDay == "Saturday"){ $Saturday[] = array('car_name'=>$row['car_name'],'picku_date'=>$row['pickup_date']); }else{ echo "";  }
                                     if($nameOfDay == "Sunday"){ $Sunday[] = array('car_name'=>$row['car_name'],'picku_date'=>$row['pickup_date']); }else{ echo "";  }
                                      }
                                    ?>
                                    <tr>
                                    <td>
                                    <?php 
                                    if(!empty($Monday)){
                                        foreach ($Monday as $valuem) {
                                             echo  "<span>".$valuem['car_name'];
                                             echo   "<br>";
                                             echo   $valuem['picku_date']."</span><br>";
                                             
                                         } 
                                     }
                                    ?>
                                    </td>                                    
                                    <td><?php
                                     if(!empty($Tuesday)){
                                        foreach ($Tuesday as $valuet) {
                                             echo  "<span>".$valuet['car_name'];
                                             echo   "<br>";
                                             echo   $valuet['picku_date']."</span><br>";
                                             
                                         } 
                                     }
                                      ?></td>
                                    <td><?php
                                     if(!empty($Wednesday)){
                                        foreach ($Wednesday as $valuew) {
                                             echo  "<span>".$valuew['car_name'];
                                             echo   "<br>";
                                             echo   $valuew['picku_date']."</span><br>";
                                             
                                         } 
                                     }
                                      ?></td>
                                    <td><?php
                                    if(!empty($Thursday)){
                                        foreach ($Thursday as $valueth) {
                                             echo  "<span>".$valueth['car_name'];
                                             echo   "<br>";
                                             echo   $valueth['picku_date']."</span><br>";
                                             
                                         } 
                                     }
                                      ?></td>
                                    <td><?php
                                    if(!empty($Friday)){
                                        echo  "<span>";
                                        foreach ($Friday as $valuef) {
                                             echo  $valuef['car_name'];
                                             echo   "<br>";
                                             echo   $valuef['picku_date'];
                                             
                                         } 
                                         echo "</span><br>";
                                     }
                                      ?></td>
                                    <td>
                                        <?php
                                        if(!empty($Saturday)){
                                            foreach ($Saturday as $valuemssn) {
                                                 echo  "<span>".$valuemssn['car_name'];
                                                 echo   "<br>";
                                                 echo   $valuemssn['picku_date']."</span><br>";
                                                 
                                             } 
                                         }
                                      ?></td>
                                      <td>
                                        <?php
                                        if(!empty($Sunday)){
                                            foreach ($Sunday as $Sundays) {
                                                 echo  "<span>".$Sundays['car_name'];
                                                 echo   "<br>";
                                                 echo   $Sundays['picku_date']."</span><br>";
                                                 
                                             } 
                                        }
                                      ?>
                                      </td>
                                    </tr>
                                    
                                        <?php                                    
                               
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No Car records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>