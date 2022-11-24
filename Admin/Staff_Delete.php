<?php
include ('Connect.php');

$StaffID= $_GET['StaffID']; 

$delete= "DELETE FROM Staff WHERE StaffID='$StaffID'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Staff Account Successfully Deleted!');
    window.location='StaffRegistration.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>