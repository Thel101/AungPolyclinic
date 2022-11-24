<?php
session_start();
if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='DA';
include ('Dashboard.php');
include ('Connect.php');



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Admin</title>
    
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="DB.css">
</head>
<body>
    
<main>
<div class="container-fluid">
    <div class="card">

    <div class="card-header">
        <h3 class="card-title text-center">View Appointments</h3>
    </div>
    <div class="card-body">
    <form class="form-inline my-2 my-lg-0 justify-content-center" action="AppointmentAdminView.php" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-5">
           
    
           <input type="radio" name="rdoSearchType" value="1"required /> Search by Date
           <input type="text" name="txtDateSearch" value="<?php echo date('Y-m-d')?>">
   
       </div>
            
            <div class="col-sm-5">
           
    
                <input type="radio" name="rdoSearchType" value="2"required /> Search by Doctor
                <input type="text" name="txtDocNameSearch" placeholder="Type Doc's name">
        
            </div>

            <div class="col-sm-2">
                <input type="submit" class="btn btn-outline-success" name="btnSearch" value="Search" />
            </div>

           
        </div>
    </div>
     
    </form>
    </div>

    </div>

</div>


<?php

 if (isset($_POST['btnSearch']))
 {
    $searchType= $_POST['rdoSearchType'];
    if($searchType==1)
    {
        $searchDate=$_POST['txtDateSearch'];
        $select= "SELECT a.*,s.StartTime,s.EndTime FROM Appointments a, Schedules s
        WHERE a.Scheduledate like '%$searchDate%'
        AND a.scheduleID=s.ScheduleID";
    }
    elseif($searchType==2)
    {
        $searchDoc=$_POST['txtDocNameSearch'];
        $select="SELECT a.*,s.StartTime, s.EndTime FROM Appointments a, Schedules s
        WHERE a.DocName like '%$searchDoc%'
        AND a.scheduleID=s.ScheduleID"; 
    }
   
 $query=mysqli_query($connect,$select);
 $count=mysqli_num_rows($query);

if ($count<1)
{
  echo "<script>window.alert('No result found!')</script>";
  echo "<script>window.location='AppointmentAdminView.php'</script>";
}
else
{

?>
<div class="table-responsive">
<table class="table justify-content-center mt-3">
    <tr>
        <th>Booking Date</th>
        <th>Booking ID</th>
        <th>Booking Type</th>
        <th>Doctor Name</th>
        <th>Patient Name</th>
        <th>Appointment Time</th>
        <th>Token Number</th>
        <th>Action</th>
    </tr>  
    <?php
    for ($i=0; $i < $count; $i++)
    {
       
        $row=mysqli_fetch_array($query);
        $AppDate= $row['Scheduledate'];
        $docName= $row['DocName'];
        $AppType= $row['AppointmentType'];
        $PtName= $row['PatientName'];
        $startTime= $row['StartTime'];
        $endTime= $row['EndTime'];
        $contact= $row['Contact'];

        echo "<tr>";
        echo "<td>" . $AppDate . "</td>";
        echo "<td>" . $AppType. "</td>";
        echo "<td>" . $docName . "</td>";
        echo "<td>" . $PtName . "</td>";
        echo "<td>" . $startTime . "-".$endTime. "</td>";
        echo "<td>" . $row['TokenNumber'] . "</td>";
        echo "<td><a class='btn btn-primary btn-sm' href='DeleteAppointment.php?AppID=$AppID'>See Details</a></td>";
        echo "<td><a class='btn btn-secondary' href='DeleteAppointment.php?AppID=$AppID'>Delete</a></td>";
        echo "</tr>"; 
    }
    ?>         
</table>
</div>
<?php
}
    
}
else
{
    $selectAll="SELECT a.*, s.StartTime, s.EndTime
    FROM Appointments a, Schedules s
    WHERE a.scheduleID=s.ScheduleID ORDER BY a.Scheduledate";
    $queryAll=mysqli_query($connect,$selectAll);
    $count=mysqli_num_rows($queryAll);
   
    ?>
    <div class="table-responsive">
    <table class="table justify-content-center mt-3">
    <tr>
      
        <th>Booking Date</th>
        <th>Booking ID</th>
        <th>Booking Type</th>
        <th>Doctor Name</th>
        <th>Patient Name</th>
        <th>Appointment Time</th>
        <th>Token Number</th>
        <th>Action</th>
    </tr>  
    <?php
    for ($i=0; $i < $count; $i++)
    {
       
        $runAll=mysqli_fetch_array($queryAll);
        $AppID=$runAll['AppointmentID'];
        $AppDate= $runAll['Scheduledate'];
        $docName= $runAll['DocName'];
        $AppType= $runAll['AppointmentType'];
        $PtName= $runAll['PatientName'];
        $token=$runAll['TokenNumber'];
        $startTime= $runAll['StartTime'];
        $endTime= $runAll['EndTime'];
        $contact= $runAll['Contact'];

        echo "<tr>";
        echo "<td>" . $AppDate . "</td>";
        echo "<td>" . $AppID . "</td>";
        echo "<td>" . $AppType. "</td>";
        echo "<td>" . $docName . "</td>";
        echo "<td>" . $PtName . "</td>";
        echo "<td>" . $startTime . "-".$endTime. "</td>";
        echo "<td>" . $token . "</td>";
        echo "<td><a class='btn btn-primary btn-sm' href='AppointmentDetails.php?AppID=$AppID'>See Details</a></td>";
        echo "<td><a class='btn btn-secondary' href='DeleteAppointment.php?AppID=$AppID'>Delete</a></td>";
     
        echo "</tr>"; 
    }
    ?>
        
</table>
</div>
<?php
} 
 
?>
</main>


</body>
</html>