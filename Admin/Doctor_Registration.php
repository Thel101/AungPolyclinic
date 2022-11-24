<?php
$page='Doctor';
include('Connect.php');
include('Autoid.php');
include('Dashboard.php');


if(isset($_POST['btnRegister']))
{
    $DocID=AutoID('Doctor','DocID','D-',6);
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
   

    //Image Upload-----------
    $docImage= $_FILES['DocProfile']['name'];
    $folderName="../Images/";
    $fileName=$folderName .'_'. $docImage;

    $copied= copy($_FILES['DocProfile']['tmp_name'],$fileName);

    if(!$copied)
    {
        echo "<script>window.alert('Image cannot be uploaded!')</script>";
        exit();
    }

    //--------------
    
    $check= "Select * from Doctor Where DocEmail='$docEmail'";
    $query=mysqli_query($connect,$check);
    $count=mysqli_num_rows($query);
    if($count>0)
    {
        echo "<script>window.alert('Account with $docEmail has already existed! Please try with different email account.')</script>";
    }
    else
    {
        $uppercase = preg_match('@[A-Z]@', $docPassword);
        $lowercase = preg_match('@[a-z]@', $docPassword);
        $number    = preg_match('@[0-9]@', $docPassword);
        $specialChars = preg_match('@[^\w]@', $docPassword);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($docPassword) < 8)
        {
         echo "<script>window.alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character')
                window.location='Doctor_Registration.php';
                </script>";
        }else
        {
            $insert= "INSERT INTO `Doctor`(`DocID`, `DocProfile`, `DocName`, `DocDegree`, `SpecialtyID`, `DocPhone`, `DocEmail`, `DocGender`, `DocStatus`, `ConsultationTime`, `ConsultationFees`,`ClinicFees`, `Password`)
        VALUES ('$DocID','$fileName','$docName','$docDegree','$docSpecialty','$docPhone','$docEmail','$docGender','$docStatus','$consultTime','$fees',$clinicFees,'$docPassword')";
        $run=mysqli_query($connect,$insert);
        if($run)
        {
            echo "<script>
            window.alert('Docotr Account Successfully Created!');
            window.location='Doctor_list.php';
            </script>";
        }
        else{
            echo "<p>Something went wrong in registration!" . mysqli_error($connect) . "</p>";
        }
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
    <title>Doctor Registration</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
   
</head>

<body>
<main>
    <div class="container-fluid">
    
        <div class="row pt-3 justify-content-center">
            <div class="card col-md-12">
            <div class="card-header">
            <div class="card-title">
             <h2 class="text-center fw-bold">Doctor Registration</h2>
            </div>
            </div>
            <div class="card-body offset-md-2">
            <form class="form" action="Doctor_Registration.php" method="POST" enctype="multipart/form-data">
                
            <div class="form-group">
                    <label for="DocProfile">Doctor Profile</label>
                    <input type="file" name="DocProfile" id="DocProfile" required/>

            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="DocName">Doctor Name</label>
                <input type="text" class="form-control" id="DocName" name="txtDocName" placeholder="Enter name here" required>
                </div>

                <div class="form-group col-md-6">
                <label for="password">Account Password</label>
                <input type="password" name="txtDPassword" class="form-control" id="password" placeholder="Password" required>
                </div>
            </div>
            
  
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="DocDegree">Doctor Degree</label>
                <input type="text" name="txtDegree" class="form-control" id="DocDegree" required>
                </div>

                <div class="form-group col-md-6">
                <label for="specialty">Specialty</label>
                <select id="specialty" class="form-control" name="cboSpecialty" required>
                    <option>--Select Specialty--</option>
                    
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
                <input type="text" class="form-control" id="DocPhone" name="txtPhone" placeholder="Enter doctor's phone" required>
                </div>
                
                <div class="form-group col-md-6">
                <label for="DocEmail">Doctor Email </label>
                <input type="email" name="txtDocEmail" class="form-control" id="DocEmail" placeholder="Enter email here" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="gender">Doctor Gender</label>
                <select class="form-control mt" id="gender" name="cbogender" required>
                        <option>--Choose gender--</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="status">Status : </label>
                    <select class="form-control" id="status" name="cbostatus" required>
                        <option>--Choose status--</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                <label for="fees">Consultation Fees</label>
                <div class="input-group">
                    <input type="text" name="txtFees" class="form-control" placeholder="Enter fees for each patient" id="fees" required/> 
                    <div class="input-group-append">
                        <span class="input-group-text">MMK</span>
                    </div>
                </div>

                </div>

                <div class="form-group col-md-4">
                <label for="clinicFees">Clinic Service Fees</label>
                <div class="input-group">
                    <input type="text" name="txtClinicFees" class="form-control" placeholder="Enter clinic service fees" id="clinicFees" required/> 
                    <div class="input-group-append">
                        <span class="input-group-text">MMK</span>
                    </div>
                </div>

                </div>

                <div class="form-group col-md-4">
                <label for="ConsultTime">Average Consultation time</label>
                    <div class="input-group">
                        
                        <input type="time" min="5 min" name="txtTime" class="form-control" placeholder="Enter doctor's average consultation time" 
                        id="ConsultTime" required/>
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                        
                    </div>
                </div>
            </div>

 
            <button type="submit" class="btn btn-primary mt-3 justify-content-center" name="btnRegister">Register</button>
            <a href="Dashboard.php" class="btn btn-secondary mt-3">Cancel</a>
            </form>
            
            </div>
            </div>
            
        </div>

    </div>
</main>
</body>

</html>