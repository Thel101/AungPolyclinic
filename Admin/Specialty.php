<?php
session_start();
if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='Specialty';
include('Dashboard.php');
include ('Connect.php');
include ('Autoid.php');

if(isset($_POST['btnRegister']))
{
    $specialtyID=AutoID('Specialty','SpecialtyID','SP-',6);
    $specialtyName=$_POST['txtSpecialty'];
    $file=$_FILES['txtSpecialtyImage']['name'];
    $folder="../Images/";
    $fileName=$folder.'_'.$file;

    $copied=copy ($_FILES['txtSpecialtyImage']['tmp_name'],$fileName);

    if(!$copied)
    {
        echo "<script>window.alert('Image cannot be uploaded!')</script>";
        exit();
    }
    
    $check= "Select * from Specialty Where SpecialtyName='$specialtyName'";
    $query=mysqli_query($connect,$check);
    $count=mysqli_num_rows($query);
    if($count>0)
    {
        echo "<script>window.alert('Specialty already been registered!')</script>";
    }
    else
    {
        $insert= "INSERT INTO `Specialty`(`SpecialtyID`, `SpecialtyName`,`SpecialtyImage`) 
        VALUES ('$specialtyID','$specialtyName','$fileName')";
        $run=mysqli_query($connect,$insert);
        if($run)
        {
            echo "<script>
            window.alert('Specialty successfully registered!');
            window.location='Specialty.php';
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
    <title>Available Specialty</title>
    <link rel="stylesheet" href="DB.css">
</head>
<body>
    <main>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2 class="text-center">Available Specialty in Aung Polyclinic</h2>
            </div>
        </div>

        <div class="card-body">

            <div class="row pt-3 justify-content-center">
            <form action="Specialty.php" method="POST" enctype="multipart/form-data" class="col-md-5">
                        
                <div class="form-group">
                    <label for="specialtyName">Specialty Name</label>
                    <input type="text" name="txtSpecialty" class="form-control" placeholder="Enter availabel specialty here" id="specialtyName">

                </div>

                <div class="form-group">
                    <label for="specialtyImage">Specialty Image</label>
                    <input type="file" name="txtSpecialtyImage" class="form-control" id="specialtyImage">

                </div>

                <button type="submit" class="btn btn-secondary mr-5 mt-3" name="btnRegister">Register</button>
                <button type="reset" class="btn btn-secondary mt-3">Cancel</button>
            </form>
            </div>

            <div class="container-fluid">
                <?php
                $query= "SELECT * FROM Specialty";
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
                        <th>Specialty ID</th>
                        <th>Specialty Name</th>
                        <th>Specialty Image</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    for ($i=0; $i < $count; $i++)
                    {
                        $row = mysqli_fetch_array($ret);

                        $specialtyID = $row['SpecialtyID'];

                        echo "<tr>";
                        echo "<td>" . $specialtyID . "</td>";
                        echo "<td>" . $row['SpecialtyName'] . "</td>";
                        echo "<td><img src='".$row['SpecialtyImage']."' width='100px' height='100px'/> </td>";
                        echo "<td>
                            <a class='btn btn-primary' href='Specialty_Update.php?SPID=$specialtyID'>Update</a>
                            <a class='btn btn-secondary' href='Specialty_Delete.php?SPID=$specialtyID'>Delete</a>
                            </td>";
                        echo "</tr>";

                    }
                    ?>
                </table>
                <?php
                }
                ?>
                
            </div>
            </div>
    </div>
    
    </main>

</body>
</html>