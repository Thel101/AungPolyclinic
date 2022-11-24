<?php
$page='MedicalService';
include ('header.php');
include('Connect.php');
include('Autoid.php');
include('serviceAppointFunction.php');
if(!isset($_SESSION['PatientID']))
{
    header("Location:Patient_login.php");
}
if(isset($_POST['btnBook']))
{
    $appointID= AutoID('Appointments','AppointmentID','AP-',6);
    $appointType=$_POST['txtAppType'];
    $serviceID= $_SESSION['ServiceID'];
    $serviceName =$_SESSION['ServiceName'];
    $serviceCost =$_SESSION['Cost'];
    $serviceQuantity=$_POST['txtQuantity'];
    $date=$_POST['txtDate'];
    $patientid=$_SESSION['PatientID'];   
    $patientName=$_SESSION['patientName'];
    $patientContact=$_SESSION['patientPhone'];
	
    AddMedServiceAppointment($appointID,$appointType,$serviceID,$serviceName,$serviceCost,$serviceQuantity,$date,$patientid,$patientName,$patientContact);

}
$serviceID=$_GET['ServiceID'];

$select="SELECT * FROM MedicalServices
WHERE ServiceID='$serviceID'";
$runService=mysqli_query($connect,$select);
$resultService=mysqli_fetch_array($runService);
$_SESSION['ServiceID']=$serviceID;
$_SESSION['ServiceName']=$resultService['ServiceName'];
$_SESSION['ServiceImage']= $resultService['ServiceImage'];
$_SESSION['Components']= $resultService['Components'];
$_SESSION['Description']= $resultService['Description'];
$_SESSION['Cost']= $resultService['Cost'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Service Appointment</title>
</head>
<body>

    <div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
            <li class="breadcrumb-item"><a href="MedicalServiceDisplay.php">Medical Services</a></li>
            <li class="breadcrumb-item active" aria-current="page">Appointment</li>
        </ol>
    </nav>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mt-3 border border-success">
                    <div class="card-header">
                        <h4><?php if(isset($_SESSION['ServiceID']))  { echo $_SESSION['ServiceName']; }?></h4>
                    </div>
                    <div class="card-body">
                    <img src="<?php if(isset($_SESSION['ServiceID']))  { echo $_SESSION['ServiceImage']; }?>" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card mt-3 border border-success">
                    <div class="card-header">
                        <div class="card-title">
                        <h4>Product Details</h4>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="MedicalServiceShopping.php" method="POST" enctype="multipart/form-data">
                    <h4>Components</h4>
                    <p><?php if(isset($_SESSION['ServiceID']))  { echo $_SESSION['Components']; }?></p>

                    <h4>Description</h4>
                    <p><?php if(isset($_SESSION['ServiceID']))  { echo $_SESSION['Description']; }?></p>

                    <p>Cost : <?php if(isset($_SESSION['ServiceID']))  { echo $_SESSION['Cost']; }?> MMK</p>
                  
                    <!-- Appointment type -->
                    <div>
                    <h5 class="card-title text-primary my-2">Step 1: Choose Service Type</h5>

                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="txtAppType" id="clinic" value="ClinicService" required>
                    <label class="form-check-label" for="clinic"><i class="fa-solid fa-house-medical-flag px-2"></i>Clinic</label>
                    </div>

                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="txtAppType" id="home" value="HomeService" required>
                    <label class="form-check-label" for="home"><i class="fa-solid fa-house-user"></i>Home</label>
                    </div>

                    </div>
                    <!-- Appointment type -->

                    <!-- Quantity -->
                    <div>
                    <h5 class="card-title text-primary my-2">Step 2: Select Quantity</h5>
                    <div class="form-inline my-2">
                    <label for="Quantity">Quantity : </label>
                    <input type="number" class="form-control mx-2 col-sm-4" name="txtQuantity" min="1" max="5" id="Quantity" placeholder="E.g. 1">
                    </div>

                    </div>
                    <!-- Quantity -->

                    <!-- Date -->
                    <div>
                    <h5 class="card-title text-primary my-2">Step 3: Choose Appointment Date</h5>
                    <div class="form-inline my-2">
                    <label for="date">Date : </label>
                    <input type="date" class="form-control mx-2 col-sm-4" name="txtDate" id="date">
                    </div>

                    </div>
                    <!-- Date -->
                    
                    <input type="submit" class="btn btn-primary mt-3 justify-content-center" name="btnBook" value="Book Appointment">
                    <a href="MedicalServiceDisplay.php" class="btn btn-secondary mt-3">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>

        </div>
        
    </div>

<?php
include('footer.php');

?>
</body>
</html>