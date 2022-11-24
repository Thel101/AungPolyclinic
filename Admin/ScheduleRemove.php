<?php
include ('Connect.php');

$ScID= $_GET['ScID']; 

$delete= "DELETE FROM Schedules WHERE ScheduleID='$ScID'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Schedule has been removed!');
    window.location='Schedule.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>