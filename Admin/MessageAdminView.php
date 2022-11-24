<?php
session_start();

if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='Enquiry';
include ('Dashboard.php');
include ('Connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients' Messages </title>
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="DB.css">
</head>
<body>
    
<main>
<div class="container-fluid">
    <div class="card">

    <div class="card-header">
        <h3 class="card-title text-center fw-bold">View Messages</h3>
    </div>
    <div class="card-body">
    
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>MessageID</th>
                <th>User Name</th>
                <th>Email</th></th>
                <th>Phone</th>
                <th>Message</th>
                <th>Reply Method</th>
                <th>Message Date</th>
            </tr>
            <?php
            $select="SELECT * FROM `Messages`";
            $query=mysqli_query($connect,$select);
           
            $count=mysqli_num_rows($query);
         
            for ($i=0; $i < $count; $i++)
            {
            
                $data=mysqli_fetch_array($query);
                echo "<tr>";
                echo "<td>" . $data['MessageID']. "</td>";
                echo "<td>" . $data['UserName'] . "</td>";
                echo "<td>" . $data['UserEmail']. "</td>";
                echo "<td>" . $data['Contact'] . "</td>";
                echo "<td>" . $data['Subject'] . "</td>";
                echo "<td>" . $data['ReplyMethod'] . "</td>";
                echo "<td>" . $data['MessageDate'] . "</td>";
            
                echo "</tr>"; 
            }
            ?>      
            
        </table>
    
       
    </div>
     
 
    </div>

    </div>

</div>

</main>

</body>
</html>