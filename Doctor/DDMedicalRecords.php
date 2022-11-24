<?php

$page='Records';
include('DoctorDashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Medical Records</title>
</head>
<body>
<main>
    <div class="card mx-2">
                
    <div class="row">
    <div class="col-md-5">
    <h3 class="mx-2">Medical Records of Patients</h3> 
    </div>
    <div class="col-md-4 offset-md-3">
    <form action="DDMedicalRecords.php" method="POST" class="form">
        <input type="text" name="txtSearchPatient" placeholder="Enter Patient's Name">
        <input type="submit" name="btnSearch" value="Search" class="btn btn-success">
    </form>
    </div>
   
    </div>

    <?php
    if(isset($_POST['btnSearch']))
    {
        $patientName=$_POST['txtSearchPatient'];
        $did= $_SESSION['did'];
        $query= "SELECT * FROM MedicalRecords 
        WHERE DocID='$did'
        AND PatientName like '%$patientName%'";
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
            <th>Patient Name</th>
            <th>Record Date</th>
            <th>Diagnosis</th>
            <th>Treatment</th>
            <th>Notes</th>
            <th>Action</th>
            
        </tr>
        <?php
        for ($i=0; $i < $count; $i++)
        {
            $row = mysqli_fetch_array($ret); 
            $rid=$row['RecordID'];

            echo "<tr>";
            echo "<td>". $row['PatientName']. "</td>";
            echo "<td>". $row['RecordDate']. "</td>";
            echo "<td>". $row['Diagnosis']. "</td>";
            echo "<td>". $row['Treatment']. "</td>";
            echo "<td>". $row['Notes']. "</td>";
            echo "<td>"."<a href='DDRecordDetails.php?ReID=$rid'>See Details</a>"."</td>";
            echo "</tr>";
        }
        ?>
        <?php
        }
        
        }
        else
        {
            $did= $_SESSION['did'];
            $query= "SELECT * FROM MedicalRecords WHERE DocID='$did'";
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
                <th>Patient Name</th>
                <th>Record Date</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Notes</th>
                <th>Action</th>
                
            </tr>
            <?php
            for ($i=0; $i < $count; $i++)
            {
                $row = mysqli_fetch_array($ret); 
                $rid=$row['RecordID'];
    
                echo "<tr>";
                echo "<td>". $row['PatientName']. "</td>";
                echo "<td>". $row['RecordDate']. "</td>";
                echo "<td>". $row['Diagnosis']. "</td>";
                echo "<td>". $row['Treatment']. "</td>";
                echo "<td>". $row['Notes']. "</td>";
                echo "<td>"."<a class='btn btn-primary' href='DDRecordDetails.php?ReID=$rid'>See Details</a>"."</td>";
                echo "</tr>";
            }
            
            
            }

        
        }
        ?>
        </table>
        </div>
    </div>
    </main>
</body>
</html>
