<?php
$page='Staffs';
include('Connect.php');
include('Autoid.php');
include('Dashboard.php');

if(isset($_POST['btnRegister']))
{
    $staffID=AutoID('Staff','StaffID','S-',6);
    $staffName=$_POST['txtStaffName'];
    $staffEmail=$_POST['txtStaffEmail'];
    $staffPhone=$_POST['txtStaffPhone'];
    $staffPassword=$_POST['txtSPassword'];
    $staffPosition=$_POST['cboposition'];
    $staffStatus=$_POST['cbostatus'];

    $check= "Select * from Staff Where staffEmail='$staffEmail'";
    $query=mysqli_query($connect,$check);
    $count=mysqli_num_rows($query);
    if($count>0)
    {
        echo "<script>window.alert('Staff account has already been registered!')</script>";
    }
    else
    {
        $uppercase = preg_match('@[A-Z]@', $staffPassword);
        $lowercase = preg_match('@[a-z]@', $staffPassword);
        $number    = preg_match('@[0-9]@', $staffPassword);
        $specialChars = preg_match('@[^\w]@', $staffPassword);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($staffPassword) < 8)
        {
         echo "<script>window.alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character')
                window.location='StaffRegistration.php';
                </script>";
        }
        else
        {
        $insert= "INSERT INTO 
        `Staff`(`StaffID`, `staffName`, `staffEmail`, `staffPhone`, `Password`, `staffPosition`, `staffStatus`) 
        VALUES ('$staffID','$staffName','$staffEmail','$staffPhone','$staffPassword','$staffPosition','$staffStatus')";
        $run=mysqli_query($connect,$insert);
        if($run)
        {
            echo "<script>
            window.alert('Staff Account Successfully Created!');
            window.location='StaffRegistration.php';
            </script>";
        }
        
        {
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
    <title>Staff Registration</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="DB.css">
</head>

<body>
<main>
    <div class="container-fluid">
    
        <div class="row pt-3 justify-content-center">
            <div class="card bg-light border-secondary col-md-6">

            <div class="card-header">
                <div class="card-title">
                    <h2 class="text-center fw-bold">Staff Registration</h2>
                </div>
            </div>

            <div class="card-body d-flex justify-content-center">
           
            <form action="StaffRegistration.php" method="POST" enctype="multipart/form-data" class="form">
                
                <div class="form-group">
                    <label for="staffName">Staff Name</label>
                    <input type="text" name="txtStaffName" class="form-control" placeholder="Enter staff name" id="staffName" required/>

                </div>

                <div class="form-group">
                    <label for="staffEmail">Staff Email</label>
                    <input type="email" name="txtStaffEmail" class="form-control" placeholder="Enter staff email" id="staffEmail" required/>

                </div>

                <div class="form-group">
                    <label for="staffPhone">Staff Phone</label>
                    <input type="text" name="txtStaffPhone" class="form-control" placeholder="Enter staff phone" id="staffPhone" required/>

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="txtSPassword" class="form-control" placeholder="At least 8 characters" id="password" required/>

                </div>

                <div class="form-group">
                    <label for="position">Position : </label>
                    <select class="form-select mt" id="position" name="cboposition" required>
                        <option>Choose staff's position</option>
                        <?php
                        $select= "SELECT * FROM Position";
                            $query=mysqli_query($connect,$select);
                            $count=mysqli_num_rows($query);
                            for ($i=0; $i < $count ; $i++) 
                            { 
                                $data=mysqli_fetch_array($query);
                                $roleID= $data ['RoleID'];
                                $roleName= $data ['RoleName'];

                                echo "<option value='$roleID'> $roleName </option>";
                                
                            }
                        ?>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="status">Status : </label>
                    <select class="form-select" id="status" name="cbostatus" required>
                    <option>Choose staff's stauts</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-secondary ml-5 mr-5 mt-3" name="btnRegister">Register</button>
                <button type="reset" class="btn btn-secondary mt-3">Cancel</button>
                
            </form>
            </div>
        </div>

    </div>


</main>
</body>

</html>