<?php
include ('Connect.php');

$docID= $_GET['docID']; 

$delete= "DELETE FROM Doctor WHERE DocID='$docID'";
$run= mysqli_query($connect,$delete);

if($run)
{
    echo "<script>
    window.alert('Doctot Account Successfully Deleted!');
    window.location='Doctor_list.php';
    </script>";

}
else
{
    echo "<p>Something went wrong in account deletion!" . mysqli_error($connect) . "</p>";
}

?>