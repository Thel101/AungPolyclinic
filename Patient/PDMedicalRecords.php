<?php
include('Connect.php');
include('PatientDashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medical Records</title>
</head>
<body>
<main>
    <div class="card mx-2">
                
    <h3 class="mx-2 mt-2">Medical Records For Patients</h3> 
    <?php

        $pname= $_SESSION['patientName'];
        $query= "SELECT * FROM MedicalRecords WHERE PatientName='$pname'";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);
        

        if($count < 0)
        {
        echo "<p>No appointment found!</p>";
        }
        else

        {
        ?>
    <div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Doctor Name</th>
            <th>Record Date</th>
            <th>Diagnosis</th>
            <th>Treatment</th>
            <th>Notes</th>
            
        </tr>
        <?php
        for ($i=0; $i < $count; $i++)
        {
            $row = mysqli_fetch_array($ret); 
            $rid=$row['RecordID'];

            echo "<tr>";
            echo "<td>". $row['Doctor']. "</td>";
            echo "<td>". $row['RecordDate']. "</td>";
            echo "<td>". $row['Diagnosis']. "</td>";
            echo "<td>". $row['Treatment']. "</td>";
            echo "<td>". $row['Notes']. "</td>";
            echo "</tr>";
        }
        ?>
        <?php
        }
        ?>
        </table>
        </div>
    </div>
    </main>
</body>
</html>
