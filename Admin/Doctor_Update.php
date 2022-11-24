<?php
$page='Doctor';
include('Connect.php');
include('Autoid.php');
include('Dashboard.php');

if(isset($_POST['btnUpdate']))
{
    $docID=$_POST['txtDocID'];
    $docName=$_POST['txtDocName'];
    $docDegree=$_POST['txtDegree'];
    $docSpecialty=$_POST['cboSpecialty'];
    $docPhone=$_POST['txtPhone'];
    $docEmail=$_POST['txtDocEmail'];
    $docGender=$_POST['cbogender'];
    $docStatus=$_POST['cbostatus'];
    $consultTime=$_POST['txtTime'];
    $fees=$_POST['txtFees'];
    $clinicFees=$_POST['txtClinicFees'];
    $docPassword=$_POST['txtDPassword'];

    $docImage= $_FILES['DocProfile']['name'];
    $folderName="../Images/";
    $fileName=$folderName .'_'. $docImage;
   
        $update= "UPDATE `Doctor` 
        SET 
        `DocProfile`='$fileName',
        `DocName`='$docName',
        `DocDegree`='$docDegree',
        `SpecialtyID`='$docSpecialty',
        `DocPhone`='$docPhone',
        `DocEmail`='$docEmail',
        `DocGender`='$docGender',
        `DocStatus`='$docStatus',
        `ConsultationTime`='$consultTime',
        `ConsultationFees`='$fees',
        `ClinicFees`='$clinicFees',
        `Password`='$docPassword' WHERE DocID='$docID'";

        $run=mysqli_query($connect,$update);
        if($run)
        {
            echo "<script>
            window.alert('Doctor Account Successfully Updated!');
            window.location='Doctor_list.php';
            </script>";
        }
        else{
            echo "<p>Something went wrong!" . mysqli_error($connect) . "</p>";
        }
    }
    $docid= $_GET['docID'];

    $select="SELECT * FROM Doctor WHERE DocID='$docid'";
    $result=mysqli_query($connect,$select);
    $row=mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Update</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="DB.css">
</head>

<body>
<main>
    <div class="container">
    
        <div class="row pt-3 justify-content-center">
           <div class="card col-md-12">
               <div class="card-header">
                   <div class="card-title">
                   <h2 class="text-center fw-bold">Doctor Update</h2>
                   </div>
               </div>

               <div class="card-body offset-md-2">
               <form action="Doctor_Update.php" method="POST" enctype="multipart/form-data" class="form">
                
                <div class="form-group">
                    <label for="DocProfile">Doctor Profile</label>
                    <input type="file" name="DocProfile" id="DocProfile" required/>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="DocName">Doctor Name</label>
                    <input type="text" class="form-control" id="DocName" name="txtDocName" value="<?php echo $row['DocName'] ?>" id="DocName" required>
                    </div>

                    <div class="form-group col-md-6">
                    <label for="password">Account Password</label>
                    <input type="password" name="txtDPassword" class="form-control" id="password" value="<?php echo $row['Password'] ?>" required>
                    </div>
                </div>
             

                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="DocDegree">Doctor Degree</label>
                <input type="text" name="txtDegree" class="form-control" value="<?php echo $row['DocDegree'] ?>" id="DocDegree" required>
                </div>

                <div class="form-group col-md-6">
                <label for="specialty">Specialty</label>
                <select id="specialty" class="form-control" name="cboSpecialty" required>
                    <?php 
                    $spid=$row['SpecialtyID'];
                    $select= "SELECT * FROM Specialty
                    WHERE SpecialtyID='$spid'";
                    $run=mysqli_query($connect,$select);
                    $result=mysqli_fetch_array($run);
                    $specialtyName=$result['SpecialtyName'];
                    $specialtyId=$result['SpecialtyID'];
                    ?>
                    <option value="<?php $specialtyId ?>"><?php echo $specialtyName ?></option>
                    
                    <?php 
                                $select="SELECT * FROM Specialty";
                                $query=mysqli_query($connect,$select);
                                $count=mysqli_num_rows($query);
                                for ($i=0; $i < $count ; $i++) 
                                { 
                                    $data=mysqli_fetch_array($query);
                                    $specialtyId= $data ['SpecialtyID'];
                                    $specialtyName= $data ['SpecialtyName'];

                                    echo "<option value='$specialtyId'> $specialtyName </option>";
                                    
                                }
                            ?>
                </select>

            </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="DocPhone">Doctor Phone</label>
                <input type="text" class="form-control" id="DocPhone" name="txtPhone" value="<?php echo $row['DocPhone'] ?>" required>
                </div>
                
                <div class="form-group col-md-6">
                <label for="DocEmail">Doctor Email </label>
                <input type="text" name="txtDocEmail" class="form-control" id="DocEmail" value="<?php echo $row['DocEmail'] ?>" required>
                </div>
            </div>
                
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="gender">Doctor Gender</label>
                <select class="form-select mt" id="gender" name="cbogender" required>
                        <option><?php echo $row['DocGender'] ?></option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="status">Status : </label>
                    <select class="form-select" id="status" name="cbostatus" required>
                        <option><?php echo $row['DocStatus'] ?></option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

            </div>
            
            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="fees">Consultation Fees</label>
                <div class="input-group">
                    <input type="text" name="txtFees" class="form-control" value="<?php echo $row['ConsultationFees'] ?>" id="fees" required/> 
                    <div class="input-group-append">
                        <span class="input-group-text">MMK</span>
                    </div>
                </div>

                </div>

                <div class="form-group col-md-4">
                <label for="clinicFees">Clinic Service Fees</label>
                <div class="input-group">
                    <input type="text" name="txtClinicFees" class="form-control" value="<?php echo $row['ClinicFees'] ?>" id="clinicFees" required/> 
                    <div class="input-group-append">
                        <span class="input-group-text">MMK</span>
                    </div>
                </div>

                </div>

                <div class="form-group col-md-4">
                <label for="ConsultTime">Average Consultation time</label>
                    <div class="input-group">
                        
                        <input type="time" min="5 min" name="txtTime" class="form-control" value="<?php echo $row['ConsultationTime'] ?>" 
                        id="ConsultTime" required/>
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                        
                    </div>
                </div>
            </div>


                <input type="hidden" name="txtDocID" value="<?php echo $row['DocID']?>" >
                <button type="submit" class="btn btn-secondary mt-3 justify-content-center" name="btnUpdate">Update</button>
                <button type="reset" class="btn btn-secondary me-auto mt-3">Cancel</button>
                
            </form>
               </div>
           </div>
            
        </div>

    </div>
    
</main>
</body>

</html>