<?php
include('Connect.php');
include('Autoid.php');

if(isset($_POST['btnRegister']))
{
    $patientID=AutoID('Patient','PatientID','P-',6);
    $patientName=$_POST['txtUserName'];
    $patientPhone=$_POST['txtPatientPhone'];
    $patientAddress=$_POST['txtPatientAddress'];
    $patientEmail=$_POST['txtPatientEmail'];
    $patientPassword=$_POST['txtPatientPassword'];
    $patientGender=$_POST['cbogender'];
    $patientAge=$_POST['txtPatientAge'];
    $patientDoB=$_POST['txtPatientDOB'];

    $patientImage= $_FILES['patientProfile']['name'];
    $folderName="../Images/";
    $fileName=$folderName .'_'. $patientImage;

    $copied= copy($_FILES['patientProfile']['tmp_name'],$fileName);

    if(!$copied)
    {
        echo "<script>window.alert('Image cannot be uploaded!')</script>";
        exit();
    }

    $check= "Select * from Patient Where patientEmail='$patientEmail'";
    $query=mysqli_query($connect,$check);
    $count=mysqli_num_rows($query);
    if($count>0)
    {
        echo "<script>window.alert('Email account has already been taken by other user!Try with different email')</script>";
    }
    else
    {
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
        $insert= "INSERT INTO `Patient`(`PatientID`, `patientProfile`, `patientName`, `patientPhone`, `patientAddress`, `patientEmail`, `patientPassword`, `patientGender`, `DateOfBirth`,`patientAge`) 
                VALUES ('$patientID','$fileName','$patientName','$patientPhone','$patientAddress','$patientEmail','$patientPassword','$patientGender','$patientDoB','$patientAge')";
        $run=mysqli_query($connect,$insert);
        if($run)
        {
            echo "<script>
            window.alert('Patient Account Successfully Created!');
            window.location='Home.php';
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
    <title>Patient Registration</title>

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
                <h4 class="card-title mt-2">Sign up</h4>  
            </div>
            <div class="card-body">

            <form action="Patient_Registration.php" method="POST" enctype="multipart/form-data"ß>
                
                <div class="form-group">
                    <label for="PatientProfile">Profile picture</label>
                    <input type="file" name="patientProfile" id="PatientProfile" required/>

                </div>

                <div class="form-group">
                    <label for="userName">Name</label>
                    <input type="text" name="txtUserName" class="form-control" placeholder="Enter name here" id="userName" required/>

                </div>

                <div class="form-group">
                    <label for="patientPhone">Phone number</label>
                    <input type="text" name="txtPatientPhone" class="form-control" placeholder="Enter phone number" id="patientPhone" required/>

                </div>
              
                <div class="form-group">
                    <label for="patientAddress">Address</label>
                    <input type="text" name="txtPatientAddress" class="form-control" placeholder="Room No/ Street/ Ward/ Township/City" id="patientAddress" />

                </div>

                <label for="patientEmail">Email</label>
                <div class="input-group">
                    <input type="email" name="txtPatientEmail" class="form-control" placeholder="example@gmail.com" id="patientEmail" required/>

                </div>


                <div class="form-group mt-3">
                    <label for="password">Password for account</label>
                    <input type="password" name="txtPatientPassword" class="form-control" placeholder="At least 8 characters" id="password" required/>

                </div>
                
                <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="gender">Gender : </label>
                    <select class="form-control" id="gender" name="cbogender" required>
                    <option>--Select gender--</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>

                    </select>
                </div>

                <div class="form-group col-md-4">
                <label for="DoB">Patient DOB</label>
                <input type="text" name="txtPatientDOB" class="form-control" placeholder="<?php echo date('Y-m-d')?>" id="DoB" required/>

                </div>

                <div class="form-group col-md-4">
                <label for="age">Patient age</label>
                <input type="text" name="txtPatientAge" class="form-control" placeholder="e.g. 80" id="age" required/>

                </div>
                </div>

                <div class="form-group ">
                <button type="submit" class="btn btn-success justify-content-center" name="btnRegister">Create Account</button>
                <button type="reset" class="btn btn-secondary me-auto">Cancel</button>
                </div>
               
                
            </form>
            </div>
            </div>
            </div>
        </div>

    </div>
    

</body>

</html>