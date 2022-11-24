<?php
session_start();

if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='MedicalServiceAdmin';
include ('Dashboard.php');
include('Connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DB.css">
    <title>Medical Services</title>
</head>
<body>
<main>

        <div class="card">
            <div class="card-header">
                <div class="card-titile">
                    <h2 class="fw-bold text-center">Available Services in Aung Polyclinic</h2>
                </div>
            </div>
            <diiv class="card-body">
            <div class="container-fluid">
            <div>
            
            <a href="MedicalServicesReg.php" id='AD'>
            <button class="btn btn-secondary offset-10"> 
            <i class='fa-solid fa-square-plus'></i>Add Medical Services</button></a>

        </div>
        
        <?php
                $query= "SELECT * FROM MedicalServices";
                $ret=mysqli_query($connect,$query);
                $count=mysqli_num_rows($ret);

                if($count <1)
                {
                    echo "<script>window.alert('No Result found!')</script>";
                }
                else
                {
                ?>
                 <div class="table-responsive">
       
                <table class="table table-sm  table-bordered justify-content-center mt-3">
                
                    <tr class="table-dark">
                        <th>Service ID</th>
                        <th>Specialty Name</th>
                        <th>Service Image</th>
                        <th>Components</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    for ($i=0; $i < $count; $i++)
                    {
                        $row = mysqli_fetch_array($ret);

                        $serviceID = $row['ServiceID'];

                        echo "<tr>";
                        echo "<td>" . $serviceID . "</td>";
                        echo "<td>" . $row['ServiceName'] . "</td>";
                        echo "<td><img src='".$row['ServiceImage']."' width='100px' height='100px'/> </td>";
                        echo "<td>" . $row['Components'] . "</td>";
                        echo "<td>" . $row['Description'] . "</td>";
                        echo "<td>" . $row['Cost']. "</td>";
                        echo "<td>
                            <a class='btn btn-primary btn-sm' href='Service_Update.php?ServiceID=$serviceID'>Update</a> |
                            <a class='btn btn-secondary btn-sm' href='Service_Delete.php?ServiceID=$serviceID'>Delete</a>
                            </td>";
                        echo "</tr>";

                    }
                    ?>
                </table>
                 </div>
                <?php
                }
                ?>
        
    </div>
            </diiv>
        </div>
        
    </main>
</body>
</html>