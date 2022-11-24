<?php
session_start();
if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='SA';
include ('Dashboard.php');
include ('Connect.php');

$appID=$_GET['AppID'];
$select="SELECT * FROM Appointments 
WHERE AppointmentID='$appID'";
$query=mysqli_query($connect,$select);
$data=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="DB.css">
</head>
<body>
    <main>
        <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="row">
                    <h3 class="text-center">Appointment Details</h3>
                    
                    </div>
                </div>
            </div>
                <div class="card-body">
                   
                <form action="AppointmentDetails.php" method="POST">
                <div class="form-group row my-2">
                    <label for="bookingID" class="col-sm-2 col-form-label">Booking ID</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="bookingID" value="<?php echo $data['AppointmentID']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="date" class="col-sm-2 col-form-label">Booking Date</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="date" value="<?php echo $data['Scheduledate']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Type" class="col-sm-2 col-form-label">Booking Type</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Type" value=" <?php echo $data['AppointmentType']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Status" value="<?php echo $data['Status']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="PatientId" class="col-sm-2 col-form-label">Patient ID</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="PatientId" value="<?php echo $data['PatientID']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="PtName" class="col-sm-2 col-form-label">Patient Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="PtName" value="<?php echo $data['PatientName']; ?>" readonly>
                    </div>
                </div>


                <div class="form-group row my-2">
                    <label for="ServiceName" class="col-sm-2 col-form-label">Service Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="ServiceName" value=" <?php echo $data['ServiceName']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="token" class="col-sm-2 col-form-label">Token Number</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="token" value=" <?php echo $data['TokenNumber']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Quantity" class="col-sm-2 col-form-label">Service Quantity</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Quantity" value=" <?php echo $data['ServiceQuantity'] .' package(s)' ; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Cost" class="col-sm-2 col-form-label">Service Cost</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Cost" value="<?php echo $data['ServiceCost']; ?>" readonly >
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="fees" class="col-sm-2 col-form-label">Total Fees</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="fees" value="<?php echo $data['TotalFees']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="payment" class="col-sm-2 col-form-label">Payment Type</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="payment" value="<?php echo $data['PaymentType']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="card" class="col-sm-2 col-form-label">Card Number</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="card" value="<?php echo $data['CardNo']; ?>" readonly>
                    </div>
                </div>
                <a href="ServiceAppointmentAdmin.php" class="btn btn-secondary btn-block">Close</a>
         
                </form>
                
                </div>
                </div>
            
        </div>

        </div>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>