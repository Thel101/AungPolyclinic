<?php
include ('Connect.php');

$AppID= $_GET['AppID']; 

$delete= "DELETE FROM Appointments WHERE AppointmentID='$AppID'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Appointment Successfully Deleted!');
    window.location='AppointmentAdminView.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>