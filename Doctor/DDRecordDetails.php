<?php
include ('Connect.php');
$RecordID=$_GET['ReID']; 
$View="SELECT * FROM MedicalRecords WHERE RecordID='$RecordID'";
$run=mysqli_query($connect,$View);
$result=mysqli_fetch_array($run);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
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
                   
                <form action="DDRecordDetails.php" method="POST">
                <div class="form-group row my-2">
                    <label for="patientName" class="col-sm-2 col-form-label">Patient Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="patientName" name="txtPatName" value="<?php echo $result['PatientName']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="age" class="col-sm-2 col-form-label">Patient Age</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="age" name="txtAge" value=" <?php echo $result['PatientName']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="blood" class="col-sm-2 col-form-label">Patient Blood Type</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="blood" name="BloodType" value=" <?php echo "Type - ". $result['PatientBloodType']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Symptoms" class="col-sm-2 col-form-label">Symptoms</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="txtSymptoms" id="Symptoms" value="<?php echo $result['Symptoms']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Symptoms" class="col-sm-2 col-form-label">Record Date</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Symptoms" name="txtDate" value="<?php echo $result['RecordDate']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="Doc" class="col-sm-2 col-form-label">Attending Doctor</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Doc" name="txtDoc" value="<?php echo $result['Doctor']; ?>" readonly>
   
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="disease" class="col-sm-2 col-form-label">Underlying disease</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="disease" name="txtDisease" value="<?php echo $result['UnderlyingDisease']; ?>" readonly >
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="surgery" class="col-sm-2 col-form-label">Past surgery history</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="txtSurgery" id="surgery" value="<?php echo $result ['SurgeryHistory']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis for recent illness</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="diagnosis" name="txtDiagnosis" value="<?php echo $result['Diagnosis']; ?>" readonly>
                    </div>
                </div>



                <div class="form-group row my-2">
                    <label for="treatment" class="col-sm-2 col-form-label">Treatment</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="treatment" name="txtTreatment" value="<?php echo $result['Treatment']; ?>" readonly >
                    </div>
                </div>

                <div class="form-group row my-2">
                    <label for="note" class="col-sm-2 col-form-label">Doctor's Note</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="note" name="txtNotes" value="<?php echo $result['Notes']; ?>" readonly>
                    </div>
                </div>

                <a href="DDMedicalRecords.php" class="btn btn-secondary btn-block">Close</a>
         
                </form>
                <div class="table-responsive">
                    <h4 class="mt-3">
                        Patient's Previous Medical Records
                    </h4>
                    <?php 
                    
                        $patientID=$result['PatientName'];
                        $select= "SELECT * FROM SelfMedicalRecord
                        Where PatientName='$patientID'";
                        $query=mysqli_query($connect,$select);
                        $count=mysqli_num_rows($query);


                    ?>
                    <table class="table">
                        <tr>
                        <th>PatientName</th>
                        <th>Record Image</th>
                        <th>Uploaded Date</th>
                        </tr>
 
                   
                    <?php
                    for($x=0; $x<$count; $x++)
                    {
                        $ret=mysqli_fetch_array($query);
                        echo "<tr>"; 
                        echo "<td>" . $ret['PatientName']. "</td>";
                        echo "<td><img src='".$ret['Record']."' width='100px' height='100px'/> </td>";
                        echo "<td>" . $ret['uploadedOn']. "</td>";
                        echo "</tr>";
                    }

                    
                    ?>
                     </table>
                </div>
                </div>
            
        </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>  
</body>
</html>