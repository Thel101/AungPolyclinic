<?php
include('Connect.php');
include('PatientDashboard.php');
include('Autoid.php');

 
if(isset($_POST['btnUpload']))
{
    $ID=AutoID('SelfMedicalRecord','SelfMRID','SMR-',6);
    $ptid=$_SESSION['PatientID'];
    $ptname=$_SESSION['patientName'];
    $type=$_POST['cboType'];
    $totalFiles=count($_FILES['files']['name']);

  for($i=0; $i<$totalFiles; $i++)
  { $fileName=$_FILES['files']['name'][$i];
    $folderName="../Images/";
    $file=$folderName.'_'.$fileName;
  
      if(copy($_FILES['files']['tmp_name'][$i],$file))
      {
          $insert="INSERT INTO `SelfMedicalRecord`(`SelfMRID`,`PatientID`, `PatientName`, `RecordType`, `Record`, `uploadedOn`) 
          VALUES ('$ID','$ptid','$ptname','$type','$file',now())";
          if(mysqli_query($connect,$insert))
          {
              echo 'Data inserted successfully!';
          }
      }
      else{
          echo 'Error in uploading file-'. $_FILES['files']['name'][$i].'<br/>';
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
    <title>My Medical Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="DB.css" >
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
    <main>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                <div class="mt-3 ">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="text-center">Upload Medical Records</h3>
                            <p><a href="PDMedicalRecords.php">See Current Medical records</a></p>
                        </div>
                    </div>
                    <div class="card-body">
                    <form action="MedicalRecords.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Name">Patient Name</label>
                        <input type="text" class="form-control" id="Name" value="<?php echo $_SESSION['patientName']?>">
                    </div>

                    <div class="form-group">
                        <label for="types">Types of Record</label>
                        <select class="form-select" name="cboType">
                            <option>--Choose Type of Record--</option>
                            <option value="Blood">Blood Reports</option>
                            <option value="Imaging">Imaging Reports</option>
                            <option value="ConsultationNotes">Past Consultation Notes</option>
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Medical Record</label>
                        <input type="file" class="form-control" name="files[]" multiple>
                    </div>

                    <button type="submit" class="btn btn-primary" name="btnUpload">Upload Record</button>
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    </form>
                    </div>
                </div>
                </div>
        </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Record Type</th>
                    <th>Record</th>
                    <th>Uploaded Date</th>
                </tr>
           
            <?php
            $ptid=$_SESSION['PatientID'];
            $query = $connect->query("SELECT * FROM SelfMedicalRecord WHERE PatientID='$ptid'");

            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    $imageURL = $row['Record'];
                    $mrid=$row['SelfMRID'];
            ?>
            <tr>
                <td><?php echo $row['RecordType'];?></td>
                <td> <img src="<?php echo $imageURL ;?>" alt="" width="200px" height="200px"/>
                </td>
                <td><p><?php echo $row['uploadedOn']; ?></p></td>
                <td><?php echo "<a href='RecordsDelete.php?MRID=$mrid' class='btn btn-secondary'>Delete</a>"; ?></td>
            </tr>
            
            <?php }
            }else
            { ?>
                <p>No records(s) found...</p>
            <?php
            }
                ?>
            </table>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>