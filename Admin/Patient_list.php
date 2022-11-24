<?php
session_start();
if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='Patient';
include ('Dashboard.php');
include ('Connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h2 class="fw-bold text-center">
                        Registered Patients
                    </h2>
                </div>
            </div>
            <div class="card-body">
            <div class="container-fluid">
            <div>
            
            <a href="Patient_Registration.php" id='AD'>
            <button class="btn btn-secondary offset-10"> 
            <i class='fa-solid fa-square-plus mr-1'></i>Add Patients</button></a>

            </div>
                <?php
                $query= "SELECT * FROM Patient";
                $ret=mysqli_query($connect,$query);
                $count=mysqli_num_rows($ret);

                if($count <1)
                {
                    echo "<script>window.alert('No Result found!')</script>";
                }
                else
                {
                ?>
                <table class="table table-sm table-bordered justify-content-center mt-3">
                    <tr class="table-dark">
                        <th>Patient ID</th>
                        <th>Profile </th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    for ($i=0; $i < $count; $i++)
                    {
                        $row = mysqli_fetch_array($ret);

                        $docid = $row['PatientID'];

                        echo "<tr>";
                        echo "<td>" . $docid . "</td>";
                        echo "<td><img src='".$row['patientProfile']."' width='100px' height='100px'/> </td>";
                        echo "<td>" . $row['patientName'] . "</td>";
                        echo "<td>" . $row['patientPhone'] . "</td>";
                        echo "<td>" . $row['patientAddress'] . "</td>";
                        echo "<td>" . $row['patientEmail'] . "</td>";
                        echo "<td>" . $row['patientGender'] . "</td>";
                        echo "<td>" . $row['patientAge'] . "</td>";
                    
                        echo "<td>
                            <a class='btn btn-secondary' href='Doctor_Delete.php?docID=$docid''>Delete</a>
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