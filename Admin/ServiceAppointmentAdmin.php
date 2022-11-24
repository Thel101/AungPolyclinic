<?php
session_start();
if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='SA';
include ('Dashboard.php');
include ('Connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Appointment</title>
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="DB.css">
</head>
<body>
    <main>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title text-center">View Appointments</h3>
                </div>
                <div class="card-body">
                <form class="form-inline my-2 my-lg-0 justify-content-center" action="ServiceAppointmentAdmin.php" method="POST">
                    <label>Enter date to search : </label>
                    <input type="text" name="txtSearchDate" value="<?php echo date('Y-m-d') ?>" />
                    <input type="submit" name="btnSearch" value="Search" class="btn btn-success">
                </form>
                </div>
                <?php
                if(isset($_POST['btnSearch']))
                {
                    $date=$_POST['txtSearchDate'];
                    $selectSearch="SELECT * FROM Appointments
                    WHERE AppointmentType like '%Service%'
                    AND Scheduledate='$date'";
                    $querySearch=mysqli_query($connect,$selectSearch);
                    $countSearch=mysqli_num_rows($querySearch);
                    if($countSearch<1)
                    {
                        echo "<script>window.alert('No Result Found!')</script>";
                        echo "<script>window.location='ServiceAppointmentAdmin.php'</script>";
                    }
                    else
                    {
                ?>
                <div class="table-responsive">
                <table class="table justify-content-center mt-3">
                <tr>
                    <th>Booking Date</th>
                    <th>Booking ID</th>
                    <th>Booking Type</th>
                    <th>Patient Name</th>
                    <th>Token Number</th>
                    <th>Service Name</th>
                    <th>Service Quantity</th>
                    <th>Action</th>
                </tr>  
                <?php
                
                for ($i=0; $i < $countSearch; $i++)
                {
                
                    $runSearch=mysqli_fetch_array($querySearch);
                    $AppID=$runSearch['AppointmentID'];

                    $AppDate= $runSearch['Scheduledate'];
                    $Type= $runSearch['AppointmentType'];
                    $PtName= $runSearch['PatientName'];
                    $token=$runSearch['TokenNumber'];
                    $serviceName=$runSearch['ServiceName'];
                    $quantity=$runSearch['ServiceQuantity'];
                    $cost=$runSearch['ServiceCost'];
                    $fees=$runSearch['TotalFees'];
                    $contact= $runSearch['Contact'];

                    echo "<tr>";
                    echo "<td>" . $AppDate . "</td>";
                    echo "<td>" . $AppID . "</td>";
                    echo "<td>" . $Type. "</td>";
                    echo "<td>" . $PtName . "</td>";
                    echo "<td>" . $token . "</td>";
                    echo "<td>" . $serviceName . "</td>";
                    echo "<td>" . $quantity . "</td>";
                    echo "<td>" . $runSearch['PaymentType'] . "</td>";

                    echo "<td><a class='btn btn-primary btn-sm' href='AppointmentDetailsSer.php?AppID=$AppID'>See Details</a></td>";
                    echo "<td><a class='btn btn-secondary' href='DeleteAppointment.php?AppID=$AppID'>Delete</a></td>";
                
                    echo "</tr>"; 
                }
                }
                ?>
                    
            </table>
            </div>

                <?php

                }
                else
                {
                    $selectAll="SELECT * FROM Appointments 
                    WHERE AppointmentType like '%Service%'";
                    $queryAll=mysqli_query($connect,$selectAll);
                    $count=mysqli_num_rows($queryAll);
                    ?>
                    <div class="table-responsive">
                <table class="table justify-content-center mt-3">
                <tr>
                    <th>Booking Date</th>
                    <th>Booking ID</th>
                    <th>Booking Type</th>
                    <th>Patient Name</th>
                    <th>Token Number</th>
                    <th>Service Name</th>
                    <th>Service Quantity</th>
                    <th>Action</th>
                </tr>  
                <?php
                for ($i=0; $i < $count; $i++)
                {
                
                    $runAll=mysqli_fetch_array($queryAll);
                    $AppID=$runAll['AppointmentID'];

                    $AppDate= $runAll['Scheduledate'];
                    $Type= $runAll['AppointmentType'];
                    $PtName= $runAll['PatientName'];
                    $token=$runAll['TokenNumber'];
                    $serviceName=$runAll['ServiceName'];
                    $quantity=$runAll['ServiceQuantity'];
                    $cost=$runAll['ServiceCost'];
                    $fees=$runAll['TotalFees'];
                    $contact= $runAll['Contact'];

                    echo "<tr>";
                    echo "<td>" . $AppDate . "</td>";
                    echo "<td>" . $AppID . "</td>";
                    echo "<td>" . $Type. "</td>";
                    echo "<td>" . $PtName . "</td>";
                    echo "<td>" . $token . "</td>";
                    echo "<td>" . $serviceName . "</td>";
                    echo "<td>" . $quantity . "</td>";
                    echo "<td><a class='btn btn-primary btn-sm' href='AppointmentDetailsSer.php?AppID=$AppID'>See Details</a></td>";
                    echo "<td><a class='btn btn-secondary' href='DeleteAppointment.php?AppID=$AppID'>Delete</a></td>";
                
                    echo "</tr>"; 
                }
                ?>
                    
            </table>
            </div>
            <?php
            }
            ?>
           
               
                
                </div>
            </div>
        
    </main>
</body>
</html>
