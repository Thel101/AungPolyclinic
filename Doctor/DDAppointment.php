<?php
$page='Appointments';
include('DoctorDashboard.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="DB.css" >
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
    <main>
    <div class="card mx-2">
    <div class="row">
    <div class="col-md-4">
    <h3 class="mx-2">My Appointments</h3> 
    </div>
    <div class="col-md-5 offset-md-3">
    <form action="DDAppointment.php" method="POST" class="form">
        <label>Enter date to search : </label>
        <input type="text" name="txtSearchDate" value="<?php echo date('Y-m-d') ?>" />
        <input type="submit" name="btnSearch" value="Search" class="btn btn-success">
    </form>
    </div>
   
    </div>
   

    <?php
    if(isset($_POST['btnSearch']))
    {
        $did= $_SESSION['did'];
        $date=$_POST['txtSearchDate'];

        $query= "SELECT * FROM Appointments 
        WHERE DocID='$did'
        AND Scheduledate='$date'";
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
            <th>Appointment Date</th>
            <th>Total Patient</th>
            
        </tr>
        <?php
        for ($i=0; $i < $count; $i++)
        {
            $row = mysqli_fetch_array($ret); 
            echo "<tr>"; 
            echo "<td>". $row['Scheduledate']."</td>";
            echo "<td> $count </td>";
            echo "<td> <a href='DDAppointment.php'>View Details</a> </td>";
            echo "</tr>";
        }
        ?>
        <?php
        }

    }
    else
    {
        $did= $_SESSION['did'];

        $query= "SELECT * FROM Appointments WHERE DocID='$did' ORDER BY Scheduledate DESC";
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
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Type</th>
            <th>Patient Name</th>
            <th>Age</th>
            <th>Symptoms</th>
            <th>Token No</th>
            <th>Examination Room</th>
            <th>Action</th>
            
        </tr>
        <?php
        for ($i=0; $i < $count; $i++)
        {
            $row = mysqli_fetch_array($ret); 

            $timeID=$row['scheduleID'];

            $selectTime="SELECT * FROM Schedules 
            WHERE ScheduleID='$timeID'";
            $runTime=mysqli_query($connect,$selectTime);
            $resultTime=mysqli_fetch_array($runTime);
            $Time=$resultTime['StartTime']. "-". $resultTime['EndTime'];

            $querySch= "SELECT d.DocProfile, d.DocName, d.DocDegree, s.scheduleDate, s.StartTime, s.EndTime, ds.RoomNo
            FROM Doctor d, DoctorSchedule ds, Schedules s
            WHERE ds.DocID='$did'
            AND d.DocID= ds.DocID AND s.ScheduleID= ds.ScheduleID";
            $retSch=mysqli_query($connect,$querySch);
            $dataSch=mysqli_fetch_array($retSch);
            $room=$dataSch['RoomNo'];
            
            $appID=$row['AppointmentID'];
            $patID=$row['PatientID'];
            $patName=$row['PatientName'];
            echo "<tr>";
            echo "<td class='font-weight-bold'>" .$row['Scheduledate'].  "</td>";
            echo "<td>" .$Time. "</td>";
            echo "<td>". $row['AppointmentType']. "</td>";
            echo "<td>". $row['PatientName']. "</td>";
            echo "<td>". $row['Age']. "</td>";
            echo "<td>". $row['Symptoms']. "</td>";
            echo "<td>". $row['TokenNumber']. "</td>";
            echo "<td>". $room. "</td>";
           
            if($row['Status']=='Complete')
            {
                echo "<td><a href='DDMedicalRecords.php' class='btn btn-outline-primary btn-sm'>View Record</a></td>";
            }
            else
            {
                echo "<td><a href='MedicalRecordDoc.php?AppID=$appID' class='btn btn-outline-primary btn-sm'>See Patient</a></td>";
            }
            
            echo "</tr>";
        }
        ?>
        <?php
        }
        ?>
        <?php
        }
        ?>
        </table>
        </div>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>