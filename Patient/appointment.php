<?php
include('header.php');
include('Connect.php');
include('appointment_function.php');

if(isset($_POST['btnConfirm']))
{
    $appointID= $_POST['txtAppID'];
    $type=$_POST['txtAppType'];
    $schedule=$_POST['txtSchedule'];
    $date=$_POST['txtAppDate'];
    $docid=$_POST['txtDocID'];
    $docName=$_POST['txtDocName'];
    $TotalFees=$_POST['txtFees'];
    $patientid=$_POST['txtPatID'];   
    $patientName=$_POST['txtPatName'];
    $patientContact=$_POST['txtPatContact'];
    $patientGender=$_POST['txtPatGender'];
    $patientAge=$_POST['txtPatAge'];
    $bookingPerson=$_SESSION['PatientID'];
    $symptoms =$_POST['txtsymptoms'];
    $status= "Booked";
    $paymentType=$_POST['rdoPaymentType'];
    $cardNo=$_POST['txtCardNo'];


    $check1= "SELECT * FROM Appointments 
    WHERE scheduleID='$schedule' AND Scheduledate='$date' AND PatientName='$patientName'";
    $result1=mysqli_query($connect,$check1);
    $num1=mysqli_num_rows($result1);
    
        $select="SELECT * FROM DoctorSchedule 
        WHERE ScheduleID='$schedule' AND DocID='$docid'";
        $result=mysqli_query($connect,$select);
        $data=mysqli_fetch_array($result);
        $maxPatient= $data['MaxPatient'];

        $check2= "SELECT * FROM Appointments 
        WHERE scheduleID='$schedule' AND Scheduledate='$date'";
        $result2=mysqli_query($connect,$check2);
        $num2=mysqli_num_rows($result2);
        $token= $num2+1;
        if($num2 > $maxPatient)
        {
           
            echo "<script>window.alert('Appointment for the chosen date is full! Please select a new date.')</script>";
            echo "<script>window.location='DoctorDisplay.php'</script>";
        }
        elseif($num1>0)
        {
            
            echo "<script>window.alert('Appointment with the patient name has already been booked!')</script>";
            echo "<script>window.location='DoctorDisplay.php'</script>";
        }
        else
        {
            
            $insert= "INSERT INTO 
            `Appointments`
            (`AppointmentID`, `AppointmentType`, `DocID`, `DocName`, `scheduleID`, `Scheduledate`, `ServiceID`, `ServiceName`, `ServiceQuantity`, `ServiceCost`, `PatientID`, `PatientName`, `TokenNumber`, `Age`, `Sex`, `Symptoms`, `Contact`, `BookingPerson`,`Status`, `TotalFees`,`PaymentType`,`CardNo`)  
            VALUES 
            ('$appointID','$type','$docid','$docName','$schedule','$date','','',0,0,'$patientid','$patientName','$token','$patientAge','$patientGender','$symptoms','$patientContact','$bookingPerson','$status','$TotalFees','$paymentType','$cardNo')";
            $run=mysqli_query($connect,$insert);
            if($run)
            {
                unset($_SESSION['Appointment']);
                echo "<script> window.alert('Successfully booked.Your token number is $token on $date for $docName. Please view the details in your account.')</script>";
                echo "<script>window.location='DoctorDisplay.php'</script>";
        
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
<form action="appointment.php" method="post">
<?php
  

if(isset($_SESSION['Appointment']))
{   $AppointmentID=$_SESSION['Appointment'][0]['AppointmentID'];
    $AppType=$_SESSION['Appointment'][0]['AppType'];
    $schedule=$_SESSION['Appointment'][0]['Schedule'];
    $AppDate =$_SESSION['Appointment'][0]['AppDate'];
    $DocID=$_SESSION['Appointment'][0]['DocID'];
    $DocName=$_SESSION['Appointment'][0]['DocName'];
    $DocFees= $_SESSION['Appointment'][0]['Fees'];
    $ClinicFees= $_SESSION['Appointment'][0]['ClinicFees'];
    $TotalFees=$DocFees + $ClinicFees;
    $PatID=$_SESSION['Appointment'][0]['PatientID'];
    $PatientName=$_SESSION['Appointment'][0]['PatientName'];
    $PatientContact=$_SESSION['Appointment'][0]['PatientContact'];
    $PatientGender=$_SESSION['Appointment'][0]['PatientGender'];
    $PatientAge=$_SESSION['Appointment'][0]['PatientAge'];
    $symptoms=$_SESSION['Appointment'][0]['Symptoms'];


    $select="SELECT * FROM `Schedules` WHERE `ScheduleID`='$schedule'";
    $run= mysqli_query($connect,$select);
    $data=mysqli_fetch_array($run);
    $start=$data['StartTime'];
    $end =$data['EndTime'];
    ?>
    <div class="card justify-content-center my-2">
        <div class="card-header">
            <div class="card-title">
            <h3 class="card-title py-2 text-primary my-2 text-center">Confirm Patient Information</h3>
            </div>
        </div>
       
        <div class="col-sm-6 offset-sm-4">
        <div class="card-body">
        <div class="table-responsive">
        
        <table class="table">
            <tr>
                <td><b>Appointment ID:</b></td>
                <td><input type="text" class="form-control" name="txtAppID" value="<?php echo $AppointmentID ?>"></td>
            </tr>

            <tr>
                <td><b>Appointment Type :</b></td>
                <td><input type="text" name="txtAppType" value="<?php echo $AppType ?>"></td>
            </tr>

            <tr>
                <td><b>Appointment Date:</b> </td>
                <td><input type="text" name="txtAppDate" value="<?php echo $AppDate ?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="txtSchedule" value="<?php echo $schedule ?>"></td>
            </tr>

            <tr>
                <td><b>Appointment Time: </b></td>
                <td><input type="text" value="<?php echo $start."-". $end; ?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="txtDocID" value="<?php echo $DocID ?>"></td>
            </tr>

            <tr>
                <td><b>Doctor Name: </b></td>
                <td><input type="text" name="txtDocName" value="<?php echo $DocName ?>"></td>
            </tr>

            <tr>
                <td><b> Fees: </b></td>
                <td><input type="text" name="txtFees" value="<?php echo $TotalFees ?> " MMK></td>
            </tr>


            <tr>
                <td> <input type="hidden" name="txtPatID" value="<?php echo $PatID ?>"></td>
            </tr>

            <tr>
                <td><b>Patient Name :</b></td>
                <td><input type="text" name="txtPatName" value="<?php echo $PatientName ?>"></td>
            </tr>

            <tr>
                <td> <b>Contact Number:</b> </td>
                <td> <input type="text" name="txtPatContact" value="<?php echo $PatientContact ?>"></td>
            </tr>

            <tr>
                <td><b>Patient Gender: </b></td>
                <td><input type="text" name="txtPatGender" value="<?php echo $PatientGender ?>"></td>
            </tr>

            <tr>
                <td><b>Patient Age: </b></td>
                <td><input type="text" name="txtPatAge" value="<?php echo $PatientAge ?>"></td>
            </tr>


            <tr>
                <td><b>Symptoms (Optional) </b></td>
                <td><textarea type="text" name="txtsymptoms"><?php echo $symptoms ?></textarea></td>
            </tr>

            <tr>
            <td><b><u>Payment Details :</u></b> </td>
            <td>
            <input type="radio" name="rdoPaymentType" value="COD" checked onclick="COD()" />In person |
            <input type="radio" name="rdoPaymentType" value="CARD" onclick="CARD()" />Card Payment |
            <input type="radio" name="rdoPaymentType" value="KPAY" onclick="KPAY()" />Kpay</td>
            </tr>

            </table>
                
        </div>


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
        <?php echo "<a href='DoctorDisplay.php' class='btn btn-secondary'>Cancel </a>" ?>
        </div>
        </div>
    </div>
    </div>
    <?php
}
?>
</form>


</body>
</html>