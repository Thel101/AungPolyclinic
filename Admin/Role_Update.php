<?php

include ('Connect.php');
include ('Autoid.php');

if(isset($_POST['btnUpdate']))
{
    $roleID=$_POST['txtRoleID'];
    $roleName=$_POST['txtRoleName'];
    
    $update= "UPDATE `Position` 
            SET `RoleName`='$roleName' 
            WHERE RoleID='$roleID'";
        $run= mysqli_query($connect,$update);
        if ($run)
        {
        echo "<script>
        window.alert('Staff Role list  Successfully Updated!');
        window.location='Role_entry.php';
        </script>";
        }
    
        else
        {
        echo "<p>Something went wrong!" . mysqli_error($connect) . "</p>";
        }

}
    $rid=$_GET['RoleID'];
    
    $select= "SELECT * FROM Position WHERE RoleID='$rid'";
    $result=mysqli_query($connect,$select);
    $row=mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Staffs' Role</title>
</head>
<body>
    <h1 class="text-center">Staffs' Role</h1>
    <div class="row pt-3 justify-content-center">
    <form action="Role_Update.php" method="POST" enctype="multipart/form-data" class="col-md-5">
                
        <div class="form-group">
            <label for="roleName">Role Name</label>
            <input type="text" name="txtRoleName" class="form-control" value="<?php echo $row['RoleName']; ?>" id="roleName">

        </div>

        <input type="hidden" name="txtRoleID" value="<?php echo $row['RoleID'];?>"? >
        <button type="submit" class="btn btn-secondary justify-content-center mt-3" name="btnUpdate">Update</button>
        <button type="reset" class="btn btn-secondary justify-content-center mt-3">Cancel</button>
    </form>
    </div>

    
</body>
</html>