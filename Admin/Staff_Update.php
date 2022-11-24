<?php
session_start();
if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='Specialty';
include('Connect.php');
include('Autoid.php');
include('Dashboard.php');

if(isset($_POST['btnUpdate']))
{
    $txtStaffID= $_POST['txtStaffID'];
    $staffName=$_POST['txtStaffName'];
    $staffEmail=$_POST['txtStaffEmail'];
    $staffPhone=$_POST['txtStaffPhone'];
    $staffPassword=$_POST['txtSPassword'];
    $staffPosition=$_POST['cboposition'];
    $staffStatus=$_POST['cbostatus'];
   
        $update= "UPDATE `Staff`
        SET `staffName`='$staffName',
            `staffEmail`='$staffEmail',
            `staffPhone`='$staffPhone',
            `Password`='$staffPassword',
            `staffPosition`='$staffPosition',
            `staffStatus`='$staffStatus' WHERE StaffID='$txtStaffID'";
        $run=mysqli_query($connect,$update);
        if($run)
        {
            echo "<script>
            window.alert('Staff Account Successfully Updated!');
            window.location='StaffList.php';
            </script>";
        }
        else{
            echo "<p>Something went wrong!" . mysqli_error($connect) . "</p>";
        }
    }


    $staffID=$_GET['StaffID'];

    $select="SELECT * FROM Staff WHERE StaffID='$staffID'";
    $result=mysqli_query($connect,$select);
    $row=mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Update</title>
    <link rel="stylesheet" href="DB.css">
</head>

<body>
<main>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                <h2 class="text-center">Staff Update</h2>
                </div>
            </div>
            <div class="card-body">
            <div class="row pt-3 justify-content-center">
           <form action="Staff_Update.php" method="POST" enctype="multipart/form-data" class="col-md-5">
               
               <div class="form-group">
                   <label for="staffName">Staff Name</label>
                   <input type="text" name="txtStaffName" class="form-control" value="<?php echo $row['staffName']?>" id="staffName" required/>

               </div>

               <div class="form-group">
                   <label for="staffEmail">Staff Email</label>
                   <input type="text" name="txtStaffEmail" class="form-control" value="<?php echo $row['staffEmail']?>" id="staffEmail" required/>

               </div>

               <div class="form-group">
                   <label for="staffPhone">Staff Phone</label>
                   <input type="text" name="txtStaffPhone" class="form-control" value="<?php echo $row['staffPhone']?>" id="staffPhone" required/>

               </div>

               <div class="form-group">
                   <label for="password">Password</label>
                   <input type="password" name="txtSPassword" class="form-control" value="<?php echo $row['Password']?>" id="password" required/>

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
                       <option><?php echo $row['staffStatus']?></option>
                       <option value="active">Active</option>
                       <option value="inactive">Inactive</option>
                   </select>
               </div>
               
               <input type="hidden" name="txtStaffID" value="<?php echo $row['StaffID']?>">
               <button type="submit" class="btn btn-secondary mr-5 mt-3" name="btnUpdate">Update</button>
               <a href="StaffList.php" class="btn btn-secondary mt-3" >Cancel</a>
         
               
           </form>
         
       </div>
            </div>
        </div>
        

    </div>

</body>
</main>

</html>