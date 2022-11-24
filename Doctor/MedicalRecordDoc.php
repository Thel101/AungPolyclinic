<?php
include('Connect.php');
include('Autoid.php');

if(isset($_POST['btnRecord']))
{
    $RecordID=AutoID('MedicalRecords','RecordID','MR-',6);
    $appointID=$_POST['txtAppointid'];
    $patientName=$_POST['txtPatName'];
    $pateintAge=$_POST['txtAge'];
    $bloodType=$_POST['BloodType'];
    $symptoms=$_POST['txtSymptoms'];
    $recordDate=$_POST['txtDate'];
    $docID=$_POST['txtDocID'];
    $doctor=$_POST['txtDoc'];
    $disease=$_POST['txtDisease'];
    $surgeryHistory=$_POST['txtSurgery'];
    $diagnosis=$_POST['txtDiagnosis'];
    $treatment=$_POST['txtTreatment'];
    $notes=$_POST['txtNotes'];

    $status="Complete";

    $insert="INSERT INTO `MedicalRecords`(`RecordID`,`AppointID`, `PatientName`, `PatientAge`, `PatientBloodType`, `Symptoms`, `RecordDate`, `DocID`,`Doctor`, `UnderlyingDisease`, `SurgeryHistory`, `Diagnosis`, `Treatment`, `Notes`) 
    VALUES ('$RecordID','$appointID','$patientName','$pateintAge','$bloodType','$symptoms','$recordDate','$docID','$doctor','$disease','$surgeryHistory','$diagnosis','$treatment','$notes')";
    $query=mysqli_query($connect,$insert);
    if($query)
    {
        $update="UPDATE Appointments 
        SET Status='$status'
        WHERE AppointmentID='$appointID'";
        $queryUpdate=mysqli_query($connect,$update);
       
        echo "<script>window.alert('Record Successfully Saved!')</script>";
        echo "<script>window.location='DoctorDashboard.php'</script>";
    }
    else
    {
        echo "<p>Something went wrong in saving medical records!" . mysqli_error($connect) . "</p>";
    }

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Medical Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
    <main>
        <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="row">
                    <h3 class="text-center">Medical Records</h3>
                    <a href="DoctorDashboard.php"><p class="me-auto">Back to doctor dashboard</p></a>
                    </div>
                </div>
            </div>
                <div class="card-body">
                    <?php
                    $AppointmentID=$_GET['AppID'];
                    $select="SELECT * From Appointments
                    WHERE AppointmentID='$AppointmentID'";
                    $run=mysqli_query($connect,$select);
                    $result=mysqli_fetch_array($run);

                    ?>
                <form action="MedicalRecordDoc.php" method="POST">
                    <input type="hidden" name="txtAppointid" value="<?php if(isset($_GET['AppID'])) { echo $result['AppointmentID'];} else echo "" ?>">
                <div class="form-group row my-2">
                    <label for="patientName" class="col-sm-2 col-form-label">Patient Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="patientName" name="txtPatName" value="<?php if(isset($_GET['AppID'])) { echo $result['PatientName'];} else echo "" ?>">
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="age" class="col-sm-2 col-form-label">Patient Age</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="age" name="txtAge" value="<?php if(isset($_GET['AppID'])) { echo $result['Age']. " years"; } else {echo ""; }  ?>">
                    </div>
                </div>

                <fieldset class="form-group">
                    <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Blood Type</legend>
                    <div class="col-sm-10">
   
                        <input class="form-check-input mx-2" type="radio" name="BloodType" id="TypeA" value="A" checked >
                        <label class="form-check-label" for="TypeA">
                            A
                        </label>    

                        <input class="form-check-input mx-2" type="radio" name="BloodType" id="TypeB" value="B">
                        <label class="form-check-label" for="TypeB">
                            B
                        </label>

                        <input class="form-check-input mx-2" type="radio" name="BloodType" id="TypeAB" value="AB">
                        <label class="form-check-label" for="TypeAB">
                            AB
                        </label>
        
                        <input class="form-check-input mx-2" type="radio" name="BloodType" id="TypeO" value="O" >
                        <label class="form-check-label" for="TypeO">
                            O
                        </label>
                     
                    </div>
                    </div>
                </fieldset>

                <div class="form-group row my-2">
                    <label for="Symptoms" class="col-sm-2 col-form-label">Symptoms</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="txtSymptoms" id="Symptoms" value="<?php if(isset($_GET['AppID'])) { echo $result['Symptoms']; } else {echo "";}?>" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Symptoms" class="col-sm-2 col-form-label">Appointment Date</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Symptoms" name="txtDate" value="<?php echo $result['Scheduledate']; ?>" >
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Doc" class="col-sm-2 col-form-label">Attending Doctor</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Doc" name="txtDoc" value="<?php echo $result['DocName']; ?>">
                    <input type="hidden" name="txtDocID" value="<?php echo $result['DocID']?>">
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="disease" class="col-sm-2 col-form-label">Underlying disease</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="disease" name="txtDisease" placeholder="Enter underlying disease"required ></textarea>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="surgery" class="col-sm-2 col-form-label">Past surgery history</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="txtSurgery" id="surgery" placeholder="If absent, type 'None'" required>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis for recent illness</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="diagnosis" name="txtDiagnosis" placeholder="Enter Diagnosis" required>
                    </div>
                </div>



                <div class="form-group row my-2">
                    <label for="treatment" class="col-sm-2 col-form-label">Treatment</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="treatment" name="txtTreatment" placeholder="Enter treatment here" required></textarea>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="note" class="col-sm-2 col-form-label">Doctor's Note</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" id="note" name="txtNotes" placeholder="Enter additional notes here" ></textarea>
                    </div>
                </div>
                
               
                    
                
                <div class="form-group row">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="btnRecord">Save Record</button>
                    <a href="DDAppointment.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
                </form>
                </div>
            
        </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>