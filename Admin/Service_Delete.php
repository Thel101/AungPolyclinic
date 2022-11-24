<?php
include ('Connect.php');

$serviceID= $_GET['ServiceID']; 

$delete= "DELETE FROM MedicalServices WHERE ServiceID='$serviceID'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Medical Service Successfully Deleted!');
    window.location='MedicalServicesReg.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>