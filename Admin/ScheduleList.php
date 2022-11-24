<?php
session_start();

if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='DS';
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
            <a href="AddSchedule.php">Go to Schedules Page</a>
            <a href="SearchDoctor.php" id='AD'>
            <button class="btn btn-secondary offset-10"> 
            <i class='fa-solid fa-square-plus mr-1'></i>Add Schedules</button></a>

            </div>
        
        <?php
                $query= "SELECT s.scheduleDate,ds.DocID,ds.ScheduleID, d.DocName,s.StartTime, s.EndTime, ds.MaxPatient, ds.RoomNo
                FROM Doctor d, DoctorSchedule ds, Schedules s
                WHERE d.DocID= ds.DocID 
                AND s.ScheduleID = ds.ScheduleID
                ORDER BY s.scheduleDate, s.StartTime ASC";
                $retDS=mysqli_query($connect,$query);
                $count=mysqli_num_rows($retDS);

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
                        <th scope="col">Schedule Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Name</th>
                        <th scope="col">DoctorID</th>
                        <th scope="col">Max Patient</th>
                        <th scope="col">Room No</th>
                        <th scope="col">Action</th>
                    </tr>
                    

                    <?php
                    for ($i=0; $i < $count; $i++)
                    {
                        $rowDS = mysqli_fetch_array($retDS);

                        $docid = $rowDS['DocID'];
                        $scheduleid= $rowDS['ScheduleID'];

                        echo "<tr>";
                        echo "<td>" . $rowDS['scheduleDate'] . "</td>";
                        echo "<td>" . $rowDS['StartTime'] . "</td>";
                        echo "<td>" . $rowDS['EndTime'] . "</td>";
                        echo "<td>" . $rowDS['DocName'] . "</td>";
                        echo "<td>" . $rowDS['DocID'] . "</td>";
                        echo "<td>" . $rowDS['MaxPatient'] . "</td>";
                        echo "<td>" . $rowDS['RoomNo'] . "</td>";
                        echo "<td> <a href='DoctorScheduleDelete.php?DocID=$docid&ScheduleID=$scheduleid'>Delete</a> </td>";
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
            </div>
        </div>
        
    </main>
</body>
</html>