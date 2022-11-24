<?php
include ('Connect.php');

$recordid= $_GET['MRID']; 

$delete= "DELETE FROM SelfMedicalRecord WHERE SelfMRID='$recordid'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Record Successfully Deleted!');
    window.location='MedicalRecords.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in record deletion!" . mysqli_error($connect) . "</p>";
}

?>