<?php
session_start();
$page='DS';
include ('Dashboard.php');
include ('Connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="DB.css">
</head>
<body>
    
<main>
<div class="container-fluid">
    <div class="card">

    <div class="card-header">
        <p class="card-title text-center fw-bold">Select Doctor to Assign Schedules</p>
    </div>
    <div class="card-body">
    <form class="form-inline my-2 my-lg-0 justify-content-center" action="SearchDoctor.php" method="POST" enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5">
            <input type="radio" name="rdoSearchType" value="1" required/> Search by Specialty
            <select class="custom-select" id="inputGroupSelect04" name="cboSpecialty">
                <option selected>-Search Specialty-</option>
                <?php
                $select= "SELECT * FROM Specialty";
                $query=mysqli_query($connect,$select);
                $count=mysqli_num_rows($query);
                for ($i=0; $i<$count; $i++)
                {
                    $data=mysqli_fetch_array($query);
                    $specialtyId= $data ['SpecialtyID'];
                    $specialtyName= $data ['SpecialtyName'];

                    echo "<option value='$specialtyId'> $specialtyName </option>";
                }
              
                ?>
                
            </select>
            </div>
            
            <div class="col-sm-5">
           
    
                <input type="radio" name="rdoSearchType" value="2"requierd /> Search by Doctor's name
                <input type="text" name="txtDocNameSearch" placeholder="Type Doc's name">
        
            </div>

            <div class="col-sm-2">
                <input type="submit" class="btn btn-outline-success" name="btnSearch" value="Search" />
            </div>

           
        </div>
    </div>
     
    </form>
    </div>

    </div>

</div>


<?php

 if (isset($_POST['btnSearch']))
 {
    $searchType= $_POST['rdoSearchType'];
    if($searchType==1)
    {
        $searchSpecialty=$_POST['cboSpecialty'];
        $select= "SELECT * FROM Doctor 
        WHERE SpecialtyID='$searchSpecialty'";
    }
    elseif($searchType==2)
    {
        $searchDoc=$_POST['txtDocNameSearch'];
        $select="SELECT * FROM Doctor
        WHERE DocName like '%$searchDoc%'"; 
    }
   
 $query=mysqli_query($connect,$select);
 $count=mysqli_num_rows($query);

if ($count<1)
{
  echo "<script>window.alert('No result found!')</script>";
}
else
{

?>
<div class="table-responsive">

<table class="table justify-content-center mt-3">
    <tr>
        <th>Doctor ID</th>
        <th>Profile picture</th>
        <th>Name</th>
        <th>Consultation Time</th>
        <th>Consultation Fees</th>
        <th>Action</th>
    </tr>  
    <?php
    for ($i=0; $i < $count; $i++)
    {
       
        $row=mysqli_fetch_array($query);
        $docID= $row['DocID'];
        $docName= $row['DocName'];
        $_SESSION['DocID']=$docID;
        $_SESSION['DocName']=$docName;
        $dID= $_SESSION['DocID'];

        echo "<tr>";
        echo "<td>" . $row ['DocID']. "</td>";
        echo "<td><img src='".$row['DocProfile']."' width='100px' height='100px'/> </td>";
        echo "<td>" . $row['DocName'] . "</td>";
        echo "<td>" . $row['ConsultationTime'] . "</td>";
        echo "<td>" . $row['ConsultationFees'] . "</td>";
        echo "<td>
        <a href='Schedule.php?DocID=$dID' class='btn btn-secondary btn-sm'>Add Schedule
        <i class='fa-solid fa-square-plus'></i>
        </a>
        <a href='ShowSchedules.php?DocID=$dID' class='btn btn-secondary btn-sm'>Show Schedule</a>
        </td>";
        echo "</tr>"; 
    }
    ?>         
</table>
    
</div>
<?php
}
    
 }
 else
 {
    $selectAll= "SELECT * FROM Doctor";
    $queryAll=mysqli_query($connect,$selectAll);
  
    $countAll=mysqli_num_rows($queryAll);
?>
<div class="table-responsive">
<table class="table justify-content-center mt-3">
    <tr>
        <th>Doctor ID</th>
        <th>Profile picture</th>
        <th>Name</th>
        <th>Consultation Time</th>
        <th>Consultation Fees</th>
        <th>Action</th>
    </tr>  
    <?php
    for($y=0; $y <$countAll; $y++)
    {

        $dataAll=mysqli_fetch_array($queryAll);
        $docID= $dataAll['DocID'];
        $docName= $dataAll['DocName'];
        $_SESSION['DocID']=$docID;
        $_SESSION['DocName']=$docName;
        $dID= $_SESSION['DocID'];

        echo "<tr>";
        echo "<td>" . $dataAll ['DocID']. "</td>";
        echo "<td><img src='".$dataAll['DocProfile']."' width='100px' height='100px'/> </td>";
        echo "<td>" . $dataAll['DocName'] . "</td>";
        echo "<td>" . $dataAll['ConsultationTime'] . "</td>";
        echo "<td>" . $dataAll['ConsultationFees'] . "</td>";
        echo "<td>
        <a href='Schedule.php?DocID=$dID' class='btn btn-secondary btn-sm'>Add Schedule
        <i class='fa-solid fa-square-plus'></i>
        </a>
        <a href='ShowSchedules.php?DocID=$dID' class='btn btn-secondary btn-sm'>Show Schedule</a>
        </td>";
        echo "</tr>"; 
    }
    ?>
    </table>
</div>
<?php
 }
 
 
?>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>

</body>
</html>