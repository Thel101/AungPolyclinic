<?php
include ('Connect.php');

$specialtyid= $_GET['SPID']; 

$delete= "DELETE FROM Specialty WHERE SpecialtyID='$specialtyid'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Specialty Successfully Deleted!');
    window.location='Specialty.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>