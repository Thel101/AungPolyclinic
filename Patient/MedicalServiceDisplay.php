<?php

$page='MedicalService';
include('header.php');
include ('Connect.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Services Display</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
    <li class="breadcrumb-item"><a href="MedicalServiceDisplay.php">Medical Services</a></li>
    
</ol>
</nav>
<h3 class="card-title my-sm-3 text-center">How to book for our services</h3>
    <div class="row my-3">
        <div class="col-sm-3 offset-sm-1">

            <div class="card border border-success">

                <div class="card-header">
                    <div class="card-title text-center"><h5>Step 1</h5></div>
                </div>

                <div class="card-body">
                    <b>Register on Aung Polyclinic website</b>
                    <br><br>
                    <a href="Patient_Registration.php">Sign Up</a> or 
                    <a href="Patient_login.php">Log in</a> here.
                    
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card border border-success">

                <div class="card-header">
                    <div class="card-title text-center"> <h5>Step 2</h5></div>
                </div>

                <div class="card-body">
                   <p>Make appointment for the preferred services <a href="MedicalServiceShopping.php">here.</a></p>
                   <br>
                   
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card border border-success">
                <div class="card-header">
                    <div class="card-title text-center"><h5>Step 3</h5></div>
                </div>
                <div class="card-body">
                    <p>Our clinic nurses will contact you and confirm the appointment.</p>
                    <p>Receive our quality medical services.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
<table class="table table-bordered ">
<?php

$docQuery= "SELECT * From MedicalServices";
$docRet=mysqli_query($connect,$docQuery);
$docCount=mysqli_num_rows($docRet);

for($i=0; $i < $docCount; $i+=3)
{
    $docQuery2="SELECT * From MedicalServices LIMIT $i,3";
    $docRet2=mysqli_query($connect,$docQuery2);
    $docCount2=mysqli_num_rows($docRet2);

    echo "<tr>";
    for($x=0; $x <$docCount2; $x++)
    {
        $row= mysqli_fetch_array($docRet2);
        $serviceID=$row['ServiceID'];
        $servicePic=$row['ServiceImage'];
        $serviceName=$row['ServiceName'];
        $serviceCost= $row['Cost'];
        $serviceComponents= $row['Components'];
        $serviceDescription= $row['Description'];

        $_SESSION['serviceID']=$serviceID;
        $_SESSION['serviceName']=$serviceName;
        $_SESSION['servicePic']=$servicePic;
        $_SESSION['serviceCost']=$serviceCost;
        $_SESSION['serviceComponents']=$serviceComponents;
        $_SESSION['serviceDescription']=$serviceDescription;
        ?>
         <td class="table-light">
             <img src="<?php  echo $servicePic ?>" width="300px" height="300px"/>
             <p><?php echo $serviceName . '  '  . '('. $serviceCost . 'MMK)' ;?></p>
          
             <?php echo "<a class='btn btn-primary btn-sm' href='MedicalServiceShopping.php?ServiceID=$serviceID'>Book Appointment</a>" ?>
            
            

         </td>
        <?php
    }
    echo "</tr>";

}

?>
</table>
</div>
<?php
include('footer.php');
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>