<?php
include('Connect.php');
include('Autoid.php');

if(isset($_POST['btnUpdate']))
{
    $patientID=$_POST['txtPatientID'];
    $patientName=$_POST['txtUserName'];
    $patientPhone=$_POST['txtPatientPhone'];
    $patientAddress=$_POST['txtPatientAddress'];
    $patientEmail=$_POST['txtPatientEmail'];
    $patientPassword=$_POST['txtPatientPassword'];
    $patientGender=$_POST['cbogender'];
    $patientAge=$_POST['txtPatientAge'];
    $patientDOB=$_POST['txtPatientDOB'];

    $patientImage= $_FILES['patientProfile']['name'];
    $folderName="../Images/";
    $fileName=$folderName .'_'. $patientImage;
 
    $uppercase = preg_match('@[A-Z]@', $patientPassword);
    $lowercase = preg_match('@[a-z]@', $patientPassword);
    $number    = preg_match('@[0-9]@', $patientPassword);
    $specialChars = preg_match('@[^\w]@', $patientPassword);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($patientPassword) < 8)
        {
         echo "<script>window.alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character')
                window.location='Patient_Registration.php';
                </script>";
        }else
        {
        $update= "UPDATE `Patient` 
        SET `PatientID`='$patientID',
        `patientProfile`='$fileName',
        `patientName`='$patientName',
        `patientPhone`='$patientPhone',
        `patientAddress`='$patientAddress',
        `patientEmail`='$patientEmail',
        `patientPassword`='$patientPassword',
        `patientGender`='$patientGender',
        `DateOfBirth`='$patientDOB',
        `patientAge`='$patientAge' WHERE PatientID='$patientID'";
        $run=mysqli_query($connect,$update);
        if($run)
        {
            echo "<script>
            window.alert('Patient Account Successfully Updated!');
            window.location='PatientDashboard.php';
            </script>";
        }
        else{
            echo "<p>Something went wrong in registration!" . mysqli_error($connect) . "</p>";
        }
    }
}

$pid=$_GET['PatID'];
$select="SELECT * FROM Patient 
WHERE PatientID='$pid'";
$run=mysqli_query($connect,$select);
$data=mysqli_fetch_array($run);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile Update</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
</head>

<body>
    <h2 class="text-center">Aung polyclinic</h2>
    <div class="container">
    
        <div class="row pt-3 justify-content-center">
            <div class="col-md-6">

            <div class="card">
            <div class="card-header">
                <a href="Patient_login.php" class="float-right btn btn-outline-primary">Log in</a>
                <h4 class="card-title mt-2">Update Profile</h4>  
            </div>
            <div class="card-body">

            <form action="Patient_Update.php" method="POST" enctype="multipart/form-data"ß>
                
                <input type="hidden" name="txtPatientID" value="<?php echo $data['PatientID']?>">

                <div class="form-group">
                    <label for="PatientProfile">Profile picture</label>
                    <input type="file" name="patientProfile" id="PatientProfile" required/>

                </div>

                <div class="form-group">
                    <label for="userName">Name</label>
                    <input type="text" name="txtUserName" class="form-control" placeholder="Enter name here" value="<?php echo $data['patientName']?>" id="userName" required/>

                </div>

                <div class="form-group">
                    <label for="patientPhone">Phone number</label>
                    <input type="text" name="txtPatientPhone" class="form-control" placeholder="Enter phone number" value="<?php echo $data['patientPhone']?>" id="patientPhone" required/>

                </div>
              
                <div class="form-group">
                    <label for="patientAddress">Address</label>
                    <input type="text" name="txtPatientAddress" class="form-control" placeholder="Room No/ Street/ Ward/ Township/City" value="<?php echo $data['patientAddress']?>" id="patientAddress" />

                </div>

                <label for="patientEmail">Email</label>
                <div class="input-group">
                    <input type="text" name="txtPatientEmail" class="form-control" placeholder="example@gmail.com" value="<?php echo $data['patientEmail']?>" id="patientEmail" required/>

                </div>


                <div class="form-group mt-3">
                    <label for="password">Password for account</label>
                    <input type="password" name="txtPatientPassword" class="form-control" pvalue="<?php echo $data['patientPassword']?>" id="password" required/>

                </div>
                
                <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="gender">Gender : </label>
                    <select class="form-control" id="gender" name="cbogender" required>
                    <option><?php echo $data['patientGender']?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>

                    </select>
                </div>

                <div class="form-group col-md-4">
                <label for="DOB">Patient DOB</label>
                <input type="text" name="txtPatientDOB" class="form-control" placeholder="e.g. 23/09/1999" value="<?php echo $data['DateOfBirth']?>" id="DOB" required/>

                </div>

                <div class="form-group col-md-4">
                <label for="age">Patient age</label>
                <input type="text" name="txtPatientAge" class="form-control" placeholder="e.g. 80" value="<?php echo $data['patientAge']?>" id="age" required/>

                </div>
                </div>

                <div class="form-group ">
                <button type="submit" class="btn btn-success justify-content-center" name="btnUpdate">Update Profile</button>
                <button type="reset" class="btn btn-secondary me-auto"><a href="PatientDashboard.php" class="text-white">Cancel</a></button>
                </div>
               
                
            </form>
            </div>
            </div>
            </div>
        </div>

    </div>
    

</body>

</html>