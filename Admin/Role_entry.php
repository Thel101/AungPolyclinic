<?php

include ('Connect.php');
include ('Autoid.php');

if(isset($_POST['btnRegister']))
{
    $roleID=AutoID('Position','RoleID','R-',6);
    $roleName=$_POST['txtRoleName'];
    
    $check= "Select * from Position Where RoleName='$roleName'";
    $query=mysqli_query($connect,$check);
    $count=mysqli_num_rows($query);
    if($count>0)
    {
        echo "<script>window.alert('Role already been registered!')</script>";
    }
    else
    {
        $insert= "INSERT INTO `Position`(`RoleID`, `RoleName`) VALUES ('$roleID','$roleName')";
        $run=mysqli_query($connect,$insert);
        if($run)
        {
            echo "<script>
            window.alert('Role successfully registered!');
            window.location='Role_entry.php';
            </script>";
        }
        else{
            echo "<p>Something went wrong in registration!" . mysqli_error($connect) . "</p>";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Staffs' Role</title>
</head>
<body>
    <h1 class="text-center">Staffs' Role</h1>
    <div class="row pt-3 justify-content-center">
    <form action="Role_entry.php" method="POST" enctype="multipart/form-data" class="col-md-5">
                
        <div class="form-group">
            <label for="roleName">Role Name</label>
            <input type="text" name="txtRoleName" class="form-control" placeholder="Enter availabel specialty here" id="roleName">

        </div>

        <button type="submit" class="btn btn-secondary justify-content-center mt-3" name="btnRegister">Register</button>
        <button type="reset" class="btn btn-secondary justify-content-center mt-3">Cancel</button>
    </form>
    </div>

    <div class="container-fluid">
        <?php
        $query= "SELECT * FROM Position";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

        if($count <1)
        {
            echo "<script>window.alert('No Result found!')</script>";
        }
        else
        {
        ?>
        <table class="table justify-content-center mt-3">
            <tr>
                <th>Role ID</th>
                <th>Role </th>
                <th>Action</th>
            </tr>
            <?php
            for ($i=0; $i < $count; $i++)
            {
                $row = mysqli_fetch_array($ret);

                $roleID = $row['RoleID'];

                echo "<tr>";
                echo "<td>" . $roleID . "</td>";
                echo "<td>" . $row['RoleName'] . "</td>";
                echo "<td>
                    <a href='Role_Update.php?RoleID=$roleID'>Edit</a> | 
                    <a href='Role_Delete.php?RoleID=$roleID'>Delete</a>
                    </td>";
                echo "</tr>";

            }
            ?>
        </table>
        <?php
        }
        ?>
        
    </div>
</body>
</html>