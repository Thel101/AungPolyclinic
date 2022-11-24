<?php
include ('Connect.php');

$schID= $_GET['SchID']; 

$delete= "DELETE FROM Schedules WHERE ScheduleID='$schID'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Schedule Successfully Deleted!');
    window.location='AddSchedule.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>