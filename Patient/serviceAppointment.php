<?php
$page='MedicalService';
include('header.php');
include('Connect.php');
include('serviceAppointFunction.php');

if(isset($_POST['btnConfirm']))
{
    $appointID= $_POST['txtAppID'];
    $type=$_POST['txtAppType'];
    $serviceID=$_POST['txtServiceID'];
    $serName=$_POST['txtServiceName'];
    $serCost=$_POST['txtCost'];
    $serQuantity=$_POST['txtQuantity'];
    $totalCost=$_POST['txtFees'];
    $date=$_POST['txtDate'];
    $patientid=$_POST['txtPatID'];   
    $patientName=$_POST['txtPatName'];
    $patientContact=$_POST['txtPatContact'];
    $bookingPerson=$_SESSION['PatiendID'];
    $status= "Booked";
    $paymentType=$_POST['rdoPaymentType'];
    $cardNo=$_POST['txtCardNo'];



    $check1= "SELECT * FROM Appointments 
    WHERE ServiceID='$serviceID' AND Scheduledate='$date' AND PatientName='$patientName'";
    $result1=mysqli_query($connect,$check1);
    $num1=mysqli_num_rows($result1);

    $token=$num1+1;
    
        if($num1>0)
        {
            
            echo "<script>window.alert('Appointment with the patient name has already been booked!')</script>";
            echo "<script>window.location='MedicalServiceDisplay.php'</script>";
        }
        else
        {
            $check2= "SELECT * FROM Appointments 
            WHERE ServiceID='$serviceID' AND Scheduledate='$date' ";
            $result2=mysqli_query($connect,$check2);
            $num2=mysqli_num_rows($result2);
        
            $token=$num2+1;
            
            $insert= "INSERT INTO 
            `Appointments`
            (`AppointmentID`, `AppointmentType`, `DocID`, `DocName`, `scheduleID`, `Scheduledate`, `ServiceID`, `ServiceName`, `ServiceQuantity`, `ServiceCost`, `PatientID`, `PatientName`, `TokenNumber`, `Age`, `Sex`, `Symptoms`, `Contact`, `BookingPerson`,`Status`, `TotalFees`,`PaymentType`,`CardNo`)  
            VALUES 
            ('$appointID','$type','','','','$date','$serviceID','$serName','$serQuantity','$serCost','$patientid','$patientName','$token','','','','$patientContact','$bookingPerson','$status','$totalCost','$paymentType','$cardNo')";
            $run=mysqli_query($connect,$insert);
            if($run)
            {
                unset($_SESSION['ServiceAppointment']);
                echo "<script> window.alert('Successfully booked for $serName on $date.Please view the details in your account.')</script>";
                echo "<script>window.location='MedicalServiceDisplay.php'</script>";
        
            }
            else
            {
                echo "<p>Something Went Wrong in Appointment " . mysqli_error($connect) .  "</p>";
            }
        
      }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
    <script type="text/javascript">

function COD()
{
	document.getElementById('CardPayment').style.display="none";
	document.getElementById('Kpay').style.display="none";
}
function CARD()
{
	document.getElementById('CardPayment').style.display="block";
	document.getElementById('Kpay').style.display="none";
}
function KPAY()
{
	document.getElementById('CardPayment').style.display="none";
	document.getElementById('Kpay').style.display="block";
}
</script>
</head>
<body>
<form action="serviceAppointment.php" method="post">
<?php
  

if(isset($_SESSION['ServiceAppointment']))
{   

    $appointID=$_SESSION['ServiceAppointment'][0]['AppointmentID'];
    $appointType=$_SESSION['ServiceAppointment'][0]['AppointmentType'];
    $serviceID=$_SESSION['ServiceAppointment'][0]['ServiceID'];
    $serviceName=$_SESSION['ServiceAppointment'][0]['ServiceName'];
    $cost=$_SESSION['ServiceAppointment'][0]['Cost'];
    $quantity=$_SESSION['ServiceAppointment'][0]['Quantity'];
    $TotalCost=$cost * $quantity;
    $date= $_SESSION['ServiceAppointment'][0]['Date'];
    $patID= $_SESSION['ServiceAppointment'][0]['PatientID'];
    $patName=$_SESSION['ServiceAppointment'][0]['PatientName'];
    $patContact=$_SESSION['ServiceAppointment'][0]['Contact'];
   
    ?>
    <div class="card justify-content-center my-2">
        <div class="card-header">
            <div class="card-title">
            <h3 class="card-title py-2 text-primary my-2 text-center">Confirm Patient Information</h3>
            </div>
        </div>
        <div class="col-sm-6 offset-sm-4">
        <div class="card-body">
        <table class="table table-responsive">
            <tr>
                <td><b>Appointment ID:</b></td>
                <td><input type="text" class="form-control" name="txtAppID" value="<?php echo $appointID ?>"></td>
            </tr>

            <tr>
                <td><b>Appointment Type :</b></td>
                <td><input type="text" name="txtAppType" value="<?php echo $appointType ?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="txtServiceID" value="<?php echo $serviceID ?>"></td>
            </tr>

            <tr>
                <td><b>Service Name :</b> </td>
                <td><input type="text" name="txtServiceName" value="<?php echo $serviceName ?>"></td>
            </tr>

            <tr>
                <td><b>Service Cost :</b></td>
                <td><input type="text" name="txtCost" value="<?php echo $cost ?>" MMK></td>
            </tr>

            <tr>
                <td><b>Service Quantity :</b></td>
                <td><input type="text" name="txtQuantity" value="<?php echo $quantity ?>" required></td>
            </tr>

            <tr>
                <td><b>Appointment Date :</b></td>
                <td><input type="text" name="txtDate" value="<?php echo $date ?>"></td>
            </tr>

            <tr>
                <td><b> Total Cost : </b></td>
                <td><input type="number" name="txtFees" value="<?php echo $TotalCost?>"></td>
            </tr>


            <tr>
                <td> <input type="hidden" name="txtPatID" value="<?php echo $patID ?>"></td>
            </tr>

            <tr>
                <td><b>Patient Name :</b></td>
                <td><input type="text" name="txtPatName" value="<?php echo $patName ?>"></td>
            </tr>

            <tr>
                <td> <b>Contact Number:</b> </td>
                <td> <input type="text" name="txtPatContact" value="<?php echo $patContact ?>"></td>
            </tr>

            <tr>
            <td><b><u>Payment Details :</u></b> </td>
            <td>
            <input type="radio" name="rdoPaymentType" value="COD" checked onclick="COD()" />In person |
            <input type="radio" name="rdoPaymentType" value="CARD" onclick="CARD()" />Card Payment |
            <input type="radio" name="rdoPaymentType" value="KPAY" onclick="KPAY()" />Kpay</td>
            </tr>
            
        </table>
   
        <div id="CardPayment" style="display:none;">
<table cellpadding="5px">
<tr>
	<td>
		Card Number :
		<input type="text" name="txtCardNo" placeholder="XXXX-XXXX-XXXX-XXXX" />
		&nbsp;
		Security Code :
		<input type="text" name="txtSecurity" placeholder="1234" size="4" />
		&nbsp;
		Exp-Month :
		<input type="text" name="txtMonth" placeholder="JAN" size="4" />
		&nbsp;
		Exp-Year :
		<input type="text" name="txtYear" placeholder="2023" size="4" />
	</td>
</tr>
</table>

</div>

<div id="Kpay" style="display:none;">
<img src="../Images/Kpay.jpeg" width="150px" height="150px" /> 
<br/>
KPAY- 09553344262
</div>

        <div class="row">
        <?php echo "<input type='submit' name='btnConfirm'class='btn btn-primary mx-4' value='Confirm Appointment'>" ?>
        <?php echo "<a href='MedicalServiceDisplay.php' class='btn btn-secondary'>Cancel </a>" ?>
        </div>
        </div>
    </div>
    </div>
    <?php
}
?>
</form>
<?php
include('footer.php');
?>
</body>
</html>