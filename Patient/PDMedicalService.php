<?php
include('Connect.php');
include('PatientDashboard.php');
if(!isset($_SESSION['PatientID']))
{
    header("Location:Home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Medical Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="DB.css" >
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
<main>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
        <h3 class="text-center mt-3">Recent Booked Medical Services</h3>
        </div>
   
     
        <div class="col-sm-3">
        <form action="<?php $_PHP_SELF ?>" method="POST">
            
            <button type="submit" name="btSeeAllService" class="btn btn-secondary mt-3">
            <i class="fa-regular fa-square-plus mx-2"></i>See All Appointments</button>
                
        </form>
        </div>
    </div>
      <?php 
        if(isset($_POST['btSeeAllService']))
        {
        $pid=$_SESSION['PatientID'];
        $name=$_SESSION['patientName'];
        $select1="SELECT * FROM Appointments
        WHERE PatientID='$pid'
        AND AppointmentType IN ('ClinicService','HomeService')";
        $run1=mysqli_query($connect,$select1);
        $count1=mysqli_num_rows($run1);
        
        if ($count1<1)
        {
          echo "<script>window.alert('No result found!')</script>";
        }
        else
        {
        
        ?>
        <div class="table-responsive">
        <table class="table table-hover justify-content-center mt-3">
            <tr>
                <th>Appointment Date</th>
                <th>Booked Service</th>
                <th>Service Type</th>
                <th>Service Cost</th>
                <th>Quantity</th>
                <th>Fees</th>
            </tr>  
            <?php
            for ($i=0; $i < $count1; $i++)
            {
               
                $data1=mysqli_fetch_array($run1);
               
                echo "<tr>";
                echo "<td>" . $data1 ['Scheduledate']. "</td>";
                echo "<td>" . $data1 ['ServiceName']. "</td>";
                echo "<td>" . $data1 ['AppointmentType'] . "</td>";
                echo "<td>" . $data1 ['ServiceCost'] . "</td>";
                echo "<td>" . $data1 ['ServiceQuantity'] . "</td>";
                echo "<td>" . $data1 ['TotalFees'] . "</td>";
                echo "</tr>"; 
            }
          }
                   
        echo "</table>";
        } 
        else
        {
            $pid=$_SESSION['PatientID'];
            $name=$_SESSION['patientName'];
            $select1="SELECT * FROM Appointments
            WHERE PatientID='$pid'
            AND AppointmentType IN ('ClinicService','HomeService') LIMIT 3";
            $run1=mysqli_query($connect,$select1);
            $count1=mysqli_num_rows($run1);
            
            if ($count1<1)
            {
              echo "<script>window.alert('No result found!')</script>";
            }
            else
            {
            
            ?>
            <div class="table-responsive">
            <table class="table table-hover justify-content-center mt-3">
                <tr>
                    <th>Appointment Date</th>
                    <th>Booked Service</th>
                    <th>Service Type</th>
                    <th>Service Cost</th>
                    <th>Quantity</th>
                    <th>Fees</th>
                </tr>  
                <?php
                for ($i=0; $i < $count1; $i++)
                {
                   
                    $data1=mysqli_fetch_array($run1);
                  
                    echo "<tr>";
                    echo "<td>" . $data1 ['Scheduledate']. "</td>";
                    echo "<td>" . $data1 ['ServiceName']. "</td>";
                    echo "<td>" . $data1 ['AppointmentType'] . "</td>";
                    echo "<td>" . $data1 ['ServiceCost'] . "</td>";
                    echo "<td>" . $data1 ['ServiceQuantity'] . "</td>";
                    echo "<td>" . $data1 ['TotalFees'] . "</td>";
                    echo "</tr>"; 
                }
              }
        echo "</table>";
      
        }
        ?>
        </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>