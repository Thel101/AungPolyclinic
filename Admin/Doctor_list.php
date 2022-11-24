<?php
session_start();

if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='Doctor';
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
    <title>Document</title>
</head>
<body>
<main>

        <div class="card">
            <div class="card-header">
                <div class="card-titile">
                    <h2 class="fw-bold text-center">Available doctors in Aung Polyclinic</h2>
                </div>
            </div>
            <diiv class="card-body">
            <div class="container-fluid">
            <div>
            
            <a href="Doctor_Registration.php" id='AD'>
            <button class="btn btn-secondary offset-10"> 
            <i class='fa-solid fa-square-plus mr-1'></i>Add Doctors</button></a>

        </div>
        
        <?php
        $query= "SELECT * FROM Doctor";
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
                <th scope="col">Doctor ID</th>
                <th scope="col">Profile picture</th>
                <th scope="col">Name</th>
                <th scope="col"> Degree</th>
                <th scope="col">Status</th>
                <th scope="col">Duration</th>
                <th scope="col">Consultation Fees</th>
                <th scope="col">Clinic Fees</th>
                <th scope="col">Action</th>
            </tr>
            </thead>

            <?php
            for ($i=0; $i < $count; $i++)
            {
                $row = mysqli_fetch_array($ret);

                $docid = $row['DocID'];

                echo "<tr>";
                echo "<td>" . $docid . "</td>";
                echo "<td><img src='".$row['DocProfile']."' width='100px' height='100px'/> </td>";
                echo "<td>" . $row['DocName'] . "</td>";
                echo "<td>" . $row['DocDegree'] . "</td>";
                echo "<td>" . $row['DocStatus'] . "</td>";
                echo "<td>" . $row['ConsultationTime'] . " min". "</td>";
                echo "<td>" . $row['ConsultationFees'] ." MMK". "</td>";
                echo "<td>" . $row['ClinicFees'] ." MMK". "</td>";
            
                echo "<td>
                    <a class='btn btn-primary' href='Doctor_Update.php?docID=$docid'>Update</a>
                    <a class='btn btn-secondary' href='Doctor_Delete.php?docID=$docid'>Delete</a>
                    </td>";
                echo "</tr>";

            }
            ?>
        </table>
        </div>
        
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