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
    <title>My Appointments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="DB.css" >
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
    <main>
    <div class="container-fluid">
     
        <div class="row">

            <div class="col-sm-9">
            <h3 class="text-center mt-3">Recent Self Appointments</h3>
            </div>
            <div class="col-sm-3">
            <form action="<?php $_PHP_SELF ?>" method="POST">
            <button type="submit" name="btSeeAllSelf" class="btn btn-secondary mt-3">
                <i class="fa-regular fa-square-plus mx-2"></i>See All Appointments</button>
            </form>
            </div>
            
       
        </div>

        <?php 
        if(isset($_POST['btSeeAllSelf']))
        {
            $pid=$_SESSION['PatientID'];
        $name=$_SESSION['patientName'];
        $select1="SELECT * FROM Appointments
        WHERE PatientID='$pid'
        AND BookingPerson='$pid'
        AND AppointmentType IN ('ClinicConsult','VideoConsult') ORDER BY Scheduledate ASC";


        $run1=mysqli_query($connect,$select1);
        $count1=mysqli_num_rows($run1);
        
        if ($count1<0)
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
                <th>Attending Doctor</th>
                <th>Appointment Time</th>
                <th>Type</th>
                <th>Token Number</th>
                <th>Fees</th>
            </tr>  
            <?php
            for ($i=0; $i < $count1; $i++)
            {
               
                $data1=mysqli_fetch_array($run1);
                $time=$data1['scheduleID'];
                
                $select2= "Select * From Schedules
                WHERE ScheduleID='$time'";
                $run2=mysqli_query($connect,$select2);
                $result2=mysqli_fetch_array($run2);
                $start=$result2['StartTime'];
                $end=$result2['EndTime'];
                $timeRange=$start."-".$end;

                echo "<tr>";
                echo "<td>" . $data1 ['Scheduledate']. "</td>";
                echo "<td>" . $data1 ['DocName']. "</td>";
                echo "<td>" . $timeRange. "</td>";
                echo "<td>" . $data1 ['AppointmentType'] . "</td>";
                echo "<td>" . $data1 ['TokenNumber'] . "</td>";
                echo "<td>" . $data1 ['TotalFees'] . "</td>";
                echo "</tr>"; 
            }
          }
          echo "</table> "; 
        }    
    
        else
        {
        
        $pid=$_SESSION['PatientID'];
        $name=$_SESSION['patientName'];
        $select1="SELECT * FROM Appointments
        WHERE PatientID='$pid'
        AND BookingPerson='$pid'
        AND AppointmentType IN ('ClinicConsult','VideoConsult') ORDER BY  Scheduledate LIMIT 3";


        $run1=mysqli_query($connect,$select1);
        $count1=mysqli_num_rows($run1);
        
        if ($count1<0)
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
                <th>Attending Doctor</th>
                <th>Appointment Time</th>
                <th>Type</th>
                <th>Token Number</th>
                <th>Fees</th>
            </tr>  
            <?php
            for ($i=0; $i < $count1; $i++)
            {
               
                $data1=mysqli_fetch_array($run1);
                $time=$data1['scheduleID'];
                
                $select2= "Select * From Schedules
                WHERE ScheduleID='$time'";
                $run2=mysqli_query($connect,$select2);
                $result2=mysqli_fetch_array($run2);
                $start=$result2['StartTime'];
                $end=$result2['EndTime'];
                $timeRange=$start."-".$end;

                echo "<tr>";
                echo "<td>" . $data1 ['Scheduledate']. "</td>";
                echo "<td>" . $data1 ['DocName']. "</td>";
                echo "<td>" . $timeRange. "</td>";
                echo "<td>" . $data1 ['AppointmentType'] . "</td>";
                echo "<td>" . $data1 ['TokenNumber'] . "</td>";
                echo "<td>" . $data1 ['TotalFees'] . "</td>";
                echo "</tr>"; 
            }
          }
        ?>         
        </table>  
       
        <?php
        }
        ?>
        </div>
    </div>
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
        <h3 class="text-center mt-3">Recent Booking for Other Person</h3>
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
        WHERE BookingPerson='$pid'
        AND PatientID!='$pid'
        AND AppointmentType IN ('ClinicConsult','VideoConsult') ORDER BY Scheduledate ASC";
        $run1=mysqli_query($connect,$select1);
        $count1=mysqli_num_rows($run1);
        
        if ($count1<0)
        {
          echo "<script>window.alert('No result found!')</script>";
        }
        else
        {
        
        ?>
        <div class="table-responsive">
        <table class="table table-hover justify-content-center mt-3">
            <tr>
                <th>Patient Name</th>
                <th>Appointment Date</th>
                <th>Attending Doctor</th>
                <th>Appointment Time</th>
                <th>Type</th>
                <th>Token Number</th>
                <th>Fees</th>
            </tr>  
            <?php
            for ($i=0; $i < $count1; $i++)
            {
               
                $data1=mysqli_fetch_array($run1);
                $time=$data1['scheduleID'];
                
                $select2= "Select * From Schedules
                WHERE ScheduleID='$time'";
                $run2=mysqli_query($connect,$select2);
                $result2=mysqli_fetch_array($run2);
                $start=$result2['StartTime'];
                $end=$result2['EndTime'];
                $timeRange=$start."-".$end;
            
                echo "<tr>";
                echo "<td>" . $data1 ['PatientName'] . "</td>";
                echo "<td>" . $data1 ['Scheduledate']. "</td>";
                echo "<td>" . $data1 ['DocName']. "</td>";
                echo "<td>" . $timeRange . "</td>";
                echo "<td>" . $data1 ['AppointmentType'] . "</td>";
                echo "<td>" . $data1 ['TokenNumber'] . "</td>";
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
            WHERE BookingPerson='$pid'
            AND PatientID!='$pid'
            AND AppointmentType IN ('ClinicConsult','VideoConsult') ORDER BY Scheduledate LIMIT 3";
            $run1=mysqli_query($connect,$select1);
            $count1=mysqli_num_rows($run1);
            
            if ($count1<0)
            {
              echo "<script>window.alert('No result found!')</script>";
            }
            else
            {
            
            ?>
            <div class="table-responsive">
            <table class="table table-hover justify-content-center mt-3">
                <tr>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Attending Doctor</th>
                    <th>Appointment Time</th>
                    <th>Type</th>
                    <th>Token Number</th>
                    <th>Fees</th>
                </tr>  
                <?php
                for ($i=0; $i < $count1; $i++)
                {
                   
                    $data1=mysqli_fetch_array($run1);
                    $time=$data1['scheduleID'];
                    
                    $select2= "Select * From Schedules
                    WHERE ScheduleID='$time'";
                    $run2=mysqli_query($connect,$select2);
                    $result2=mysqli_fetch_array($run2);
                    $start=$result2['StartTime'];
                    $end=$result2['EndTime'];
                    $timeRange=$start."-".$end;
                
                    echo "<tr>";
                    echo "<td>" . $data1 ['PatientName'] . "</td>";
                    echo "<td>" . $data1 ['Scheduledate']. "</td>";
                    echo "<td>" . $data1 ['DocName']. "</td>";
                    echo "<td>" . $timeRange . "</td>";
                    echo "<td>" . $data1 ['AppointmentType'] . "</td>";
                    echo "<td>" . $data1 ['TokenNumber'] . "</td>";
                    echo "<td>" . $data1 ['TotalFees'] . "</td>";
                    echo "</tr>"; 
                }
              }
        echo "</table>";
      
        }
        ?>
        </div>
    </div>

    
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>