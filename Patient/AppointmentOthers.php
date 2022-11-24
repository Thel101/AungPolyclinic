<?php
$page='Consultation';
include('header.php');
include('Autoid.php');
include ('Connect.php');
include('appointment_function.php');

if(!isset($_SESSION['PatientID']))
{
    header("Location:Patient_login.php");
}
if(isset($_REQUEST['btnAppointment']))
    {
        
        $appointID= AutoID('Appointments','AppointmentID','AP-',6);
        $type=$_POST['txtAppType'];
        $schedule=$_POST['cboSchedule'];
        $date=$_POST['cboAppointmentDate'];
        $docid=$_SESSION['DocID'];
        $docName=$_SESSION['DocName'];
        $fees=$_SESSION['Fees'];
        $clinicFees=$_SESSION['ClinicFees'];
        $patientid=$_POST['PatientID'];   
        $patientName=$_POST['txtPatientName'];
        $patientContact=$_POST['txtPatientContact'];
        $patientGender=$_POST['cboPatientGender'];
        $patientAge=$_POST['txtPatientAge'];
        $patientDOB=$_POST['txtPatientDOB'];
        $bookingPerson=$_SESSION['PatientID'];
        $symptoms =$_POST['txtSymptoms2'];
            
       
        AddAppointment($appointID,$type,$schedule,$date,$fees,$clinicFees,$docid,$docName,$patientid,$patientName,$patientContact,$patientGender,$patientAge,$patientDOB,$symptoms);

    }

    $did= $_GET['DocID'];
    $select="SELECT * FROM Doctor WHERE DocID='$did'";
    $query=mysqli_query($connect,$select);
    $result=mysqli_fetch_array($query);
    $_SESSION['DocID']= $did;
    $_SESSION['DocProfile']=$result['DocProfile'];
    $_SESSION['DocName']=$result['DocName'];
    $doc=$_SESSION['DocID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>

</head>
<body>

<div class="container-fluid">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
    <li class="breadcrumb-item"><a href="SpecialtyDisplay.php">Find Doctor</a></li>
    <li class="breadcrumb-item"><a href="DoctorDisplay.php">Doctor Display</a></li>
    <li class="breadcrumb-item active" aria-current="page">Appointment</li>
</ol>
</nav>
    <div class="row">
        <div class="col-sm-7">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                        <img src="<?php if(isset($_SESSION['DocID'])) { echo $_SESSION['DocProfile']; }  else { echo "";}?>"
                        alt="Doctor Profile" width="200" height="200" class="rounded-circle">
                        </div>

                        <div class="col-sm-8">
                        <h5 class="mt-0"><?php if(isset($_SESSION['DocID'])) { echo $_SESSION['DocName']; }  else { echo "";}?></h5>
                            <p><?php if(isset($_GET['DocID'])) { echo $result['DocDegree']; }  else { echo "";}?></p>
                            <b class="text-info"><?php if(isset($_GET['DocID'])) 
                            {   
                                $docid=$_GET['DocID'];
                                $select="SELECT s.* 
                                FROM Specialty s, Doctor d
                                WHERE s.SpecialtyID= d.SpecialtyID
                                AND d.DocID='$docid'";
                                $query=mysqli_query($connect,$select);
                                $ret=mysqli_fetch_array($query);
                                echo $ret['SpecialtyName']; } 
                             else { echo "";}?></b>
                             <br>
                             <b class="mt-2"><?php if(isset($_GET['DocID'])) { echo 'Average Consultation time: '.$result['ConsultationTime']; }  else { echo "";}?></b>
                            <!-- schedule time -->
                            <h5 class="mt-3">Availabe Time</h5>
                            <div class="table-responsive">
                            <table class="table">
                            <?php

                            $did= $_GET['DocID'];

                            $query= "SELECT d.DocProfile, d.DocName, d.DocDegree, s.scheduleDate, s.StartTime, s.EndTime, ds.MaxPatient
                            FROM Doctor d, DoctorSchedule ds, Schedules s
                            WHERE ds.DocID='$did'
                            AND d.DocID= ds.DocID AND s.ScheduleID= ds.ScheduleID";
                            $ret=mysqli_query($connect,$query);
                            $count=mysqli_num_rows($ret);
                            if($ret)

                            {
                            ?>
                            <?php
      
                            for ($i=0; $i < $count; $i++)
                            {
                                $row = mysqli_fetch_array($ret);    
                                echo "<tr>"; 
                                echo "<td>". $row['scheduleDate'] .  "</td>";
                                echo "<td>".$row['StartTime'].'-'. $row['EndTime']. "</td>";
                                echo  "<td>" .'Maximum Appointments: '. $row['MaxPatient']. "</td>"; 
                                echo "</tr>" ;
                                
                            }
                            ?>
                            <?php
                            }
                            ?>
                            </table>
                            </div>
                        </div>
                    </div>
                

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                        <i class="fa-regular fa-star text-warning"></i>
                        <small>Highly recommended</small>
                        </div>

                        <div class="col-sm-6">
                        <i class="fa-regular fa-clock text-warning"></i>
                        <small >Excellent waiting time</small>
                        </div>
                    </div>
            
                </div>
                <div class="card">
                    <div class="card-body">
                        <b>Please make the appointment 3 days ahead.</b> <br><br>
                        <b class="text-danger">After booking is confirmed, appointment can only be cancelled by contacting to the clinic via phone call.</b>
                    
                    </div>
                </div>
            </div>
        </div>
        <!--  Appointment choice -->  
        
        <div class="col-sm-5">
            <div class="card mt-3">
                <div class="card-body">
                <form action="AppointmentOthers.php" method="POST">
                <h5 class="card-title text-primary my-2">Step 1: Choose Appointment Type</h5>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="txtAppType" id="clinic" value="ClinicConsult" required>
                <label class="form-check-label" for="clinic"><i class="fa-solid fa-house-medical-flag px-2"></i>Clinic</label>
                </div>
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="txtAppType" id="video" value="VideoConsult" required>
                <label class="form-check-label" for="video"><i class="fa-solid fa-video px-2"></i>Video</label>
                </div>

                <h5 class="card-title py-2 text-primary my-2">Step 2: Choose Appointment Date</h5>
               
                <div class="col-md-12">

                <label class="pr-2 mr-4">Schedule Day</label>
                <select class="form-select px-2 form-select-lg" name="cboSchedule" required>
                <option>--Choose Schedule Day--</option>
                <?php
                    $did= $_SESSION['DocID'];

                    $query= "SELECT  s.*
                    FROM Doctor d, DoctorSchedule ds, Schedules s
                    WHERE ds.DocID='$did'
                    AND d.DocID= ds.DocID AND s.ScheduleID= ds.ScheduleID";
                    $ret=mysqli_query($connect,$query);
                    $count=mysqli_num_rows($ret);
                    if($ret)

                    {
                    ?>
                    <?php
                    for ($i=0; $i < $count; $i++)
                    {
                        $row = mysqli_fetch_array($ret); 
                        $schday=$row['scheduleDate'] ;
                        $schid=$row['ScheduleID'];
                        $schStart=$row['StartTime'];
                        $schEnd=$row['EndTime'];
                        echo "<option class='col-md-12' value=$schid>$schday </option required>";

                    }
                    ?>
                    
                    <?php
                    }
                    ?>
             
                </select>
                </div>

                <div class="col-md-12">
                    <label class="pr-2">Appointment Date</label>
                    <select class="form-select form-select-lg px-2" name="cboAppointmentDate" required>
                        <option>--Choose Date--</option>
                            <?php
                            $did= $_SESSION['DocID'];

                            $query= "SELECT  s.scheduleDate
                            FROM Doctor d, DoctorSchedule ds, Schedules s
                            WHERE ds.DocID='$did'
                            AND d.DocID= ds.DocID AND s.ScheduleID= ds.ScheduleID";
                            $ret=mysqli_query($connect,$query);
                            $count=mysqli_num_rows($ret);
                            if($ret)

                            {
                            ?>
                            <?php
                            for ($i=0; $i < $count; $i++)
                            {
                                $row = mysqli_fetch_array($ret); 
                                $schday=$row['scheduleDate'] ;
                                $firstday = date('d/m/Y', strtotime("$schday 0 week"));
                                $secondday = date('d/m/Y', strtotime("$schday 1 week"));
                                $firstdayl = date('l-', strtotime("$schday 0 week"));
                                $seconddayl = date('l-', strtotime("$schday 1 week"));
                                echo "<option value='$firstday'> $firstdayl $firstday </option>"; 
                                echo "<option value='$secondday'> $seconddayl $secondday </option>";   
                             
                            }
                            ?>
                           
                            <?php
                            }
                            ?>
            
                    </select>
                    </div>

                    <div>
                        
                        <!--Same Patient -->
                        <h5 class="card-title py-2 text-primary my-2">Step 3: Fill Patient Information</h5>
                        <table cellpadding="5px" class="table">
                        <tr>
                                <td>Patient Name :</td>
                                <td>
                                    <input type="text" name="txtPatientName" placeholder="Enter Patient Name" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>Patient Phone :</td>
                                <td>
                                    <input type="text" name="txtPatientContact" placeholder="Enter Patient Phone" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>Gender :</td>
                                <td>
                                    <select class="form-select" name="cboPatientGender" required>
                                        <option>--Select Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Patient Age :</td>
                                <td>
                                    <input type="text" name="txtPatientAge" placeholder="Enter Patient Age" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Patient DOB :</td>
                                <td>
                                    <input type="date" name="txtPatientDOB"  required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Symptoms</td>
                                <td>
                                    <textarea name="txtSymptoms2" required></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td>Booked by:</td>
                                <td>
                                    <input type="text" name="txtBookingPerson"  value="<?php echo $_SESSION['patientName'] ; ?>" required readonly></textarea>
                                </td>
                            </tr>

                        </table>
         
                        </div>

                        <!-- Other Patients -->
            
                

                <input type="submit" class="btn btn-primary mt-3 justify-content-center" name="btnAppointment" value="Book Appointment">
                <button class="btn btn-secondary mt-3"><?php echo "<a href='AppointmentSelf.php?DocID=$doc' class='text-dark'>Cancel</a>"; ?></button>
                </form>
                </div>
            </div>
        </div>
        <!--  appointment confirmation form -->
    
    </div>

   
        
            </div>

        </div>
<?php
include('footer.php');
?>
</body>
</html>

