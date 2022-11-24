<?php
include ('Connect.php');

$docID= $_GET['DocID']; 
$schID=$_GET['ScheduleID'];

$delete= "DELETE FROM DoctorSchedule WHERE DocID='$docID' AND ScheduleID='$schID'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Doctor Schedule Successfully Deleted!');
    window.location='ScheduleList.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>