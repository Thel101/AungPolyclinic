<?php
session_start();
$page='DS';
include('Connect.php');
include('Autoid.php');
include('Dashboard.php');
include('Schedule_Function.php');

if(isset($_POST['btnSave']))
{
   
	$size=count($_SESSION['Schedule_Function']);

	for($i=0;$i<$size;$i++) 
	{ 
 
        $docID=$_SESSION['DocID'];
        $scheduleID=$_SESSION['Schedule_Function'][$i]['ScheduleID'];
        $maxPatient=$_SESSION['Schedule_Function'][$i]['MaxPatient'];
        $examRoom=$_SESSION['Schedule_Function'][$i]['ExamRoom'];
       
        $check= "SELECT * FROM DoctorSchedule WHERE ScheduleID='$scheduleID' AND RoomNo='$examRoom'";
        $run=mysqli_query($connect,$check);
        $data=mysqli_fetch_array($run);
        $num=mysqli_num_rows($run);

    
        if($num>0)
        {
            $date=$data['ScheduleID'];
            $selectDay="SELECT * FROM Schedules WHERE ScheduleID='$date'";
            $queryDay=mysqli_query($connect,$selectDay);
            $resultDay=mysqli_fetch_array($queryDay);
            $Day=$resultDay['scheduleDate'];

            echo "<script>window.alert('$Day for  Room - $examRoom has has been occupied! Try different schedule or room!')</script>";
            echo "<script>window.location='Schedule.php'</script>";
        }

        else 
        {

		$insertDS= "INSERT INTO `DoctorSchedule`(`DocID`, `ScheduleID`, `MaxPatient`, `RoomNo`) 
        VALUES ('$docID','$scheduleID','$maxPatient','$examRoom')";

        $result=mysqli_query($connect,$insertDS);
        }
	}

	if($result) //True 
	{
		unset($_SESSION['Schedule_Function']);
		
		echo "<script>window.alert('Successfully Save!')</script>";
		echo "<script>window.location='ScheduleList.php'</script>";
	}
	else
	{
		echo "<p>Something Went Wrong in Schedule adding " . mysqli_error($connection) .  "</p>";
	}
   
  
    

}
if(isset($_GET['action']))
{
    $action=$_GET['action'];

    if($action=="remove")
    {
        $scheduleID=$_GET['ScheduleID'];
        RemoveSchedule($scheduleID);
    }
    elseif($action == "clearall")
	{
		ClearAll();
        
	}
}
if(isset($_POST['btnAdd']))
{
   
    $scheduleID= $_POST['cboSchedule'];
    $maxPatient= $_POST['maxPatient'];
    $examRoom= $_POST['cboRoom'] ;
    
    AddSchedule($scheduleID,$maxPatient,$examRoom);
   
   
    
}
    if(isset($_GET['DocID']))
    {
    $docid= $_GET['DocID'];
    $select= "Select * From Doctor WHERE DocID='$docid'";
    $run= mysqli_query($connect,$select);
    $row=mysqli_fetch_array($run);
    $_SESSION['DocID']=$docid;
    $_SESSION['DocName']=$row['DocName'];
    
    }
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
<!--- store as monday, tuesday, instead of date -->
<main>
<div class="container-fluid">
    <div class="card">

    <div class="card-header">
        <h2 class="fw-bold text-center">Assigning Doctor Schedule</h2>
    </div>
    <div class="card-body offset-md-4">
    <form class="form my-2 my-lg-0 justify-content-center" action="Schedule.php" method="POST" enctype="multipart/form-data">

        <div class="col-sm-5">
        <label>Doctor's Name</label>
        <input type="text" class="form-control" name="docID" value="<?php if((isset($_SESSION['DocID']))) { echo $_SESSION['DocName'];}

        else { echo $_SESSION['DocName'] ;}?>" />
                
        </div> 
        
            <div class="col-sm-5">
                    <label> Select Schedule</label>
                    <select class="form-control col-sm-12" name="cboSchedule">
                        <option>-Select Schedule-</option>
                        <?php
                        $select= "SELECT * FROM Schedules ORDER BY scheduleDate";
                        $query=mysqli_query($connect,$select);
                        $count=mysqli_num_rows($query);
                        for ($i=0; $i<$count; $i++)
                        {
                            $data=mysqli_fetch_array($query);
                            $schID= $data['ScheduleID'];
                            $schDate= $data['scheduleDate'];
                            $start= $data['StartTime'];
                            $end=$data ['EndTime'];
                            echo "<option value='$schID'> $schDate : $start   </option>";
                        }
                    
                        ?>
                        
                    </select>
                </div>

                <div class="col-sm-5">
                    <label>Select Examination Room</label>
                    <select class="form-control col-sm-12" name="cboRoom">
                        <option value="1">Room 1</option>
                        <option value="2">Room 2</option>
                        <option value="3">Room 3</option>
                        <option value="4">Room 4</option>
                    </select>
                </div> 

                <div class="col-sm-5">
                    <label>Max: patients</label>
                    <input class="form-control" type="number" min="1" max="12" name="maxPatient" placeholder="Maximum patients"/>
                </div>
       
       
            
        <div class="col-sm-5">
        
        <a href="Schedule.php?"><input type="submit" class="btn btn-outline-success mt-4" name="btnAdd" value='Add Schedule' />
        </a> 
        <a href="SearchDoctor.php" class="btn btn-outline-secondary mt-4">Cancel</a>
      
        </div>
        <div class="col-sm-5">
  
        <a href="SearchDoctor.php" class="badge badge-primary d-flex justify-content-center mt-5">Select Doctor To Assign</a>
        
        </div>
        
         
        </div>
     
        <?php
if(!isset($_SESSION['Schedule_Function']))
{
   echo " <div class='offset-md-4 col-md-4 alert alert-danger' role='alert'>
   No Schedules found!
    </div>" ;
    exit();
  
   
}
else{
    echo "<table class='table table-bordered'>";
    echo "<tr>";
    echo "<th> ScheduleID</th>";
    echo "<th> MaxPatient</th>";
    echo "<th> ExamRoom</th>";
    echo "<th> ScheduleDate</th>";
    echo "<th> StartTime</th>";
    echo "<th> EndTime</th>";
    echo "<th> Action</th>";
    echo "</tr>";

    $size = count($_SESSION['Schedule_Function']);
    for($i=0;$i <$size; $i++)
    {  
        $scheduleID=$_SESSION['Schedule_Function'][$i]['ScheduleID'];
        $maxPatient=$_SESSION['Schedule_Function'][$i]['MaxPatient'];
        $examRoom=$_SESSION['Schedule_Function'][$i]['ExamRoom'];
        $schDate=$_SESSION['Schedule_Function'][$i]['ScheduleDate'];
        $start=$_SESSION['Schedule_Function'][$i]['StartTime'];
        $end=$_SESSION['Schedule_Function'][$i]['EndTime'];

        echo "<tr>";
        echo "<td> $scheduleID</td>";
        echo "<td> $maxPatient</td>";
        echo "<td>" ."Room-". "$examRoom"."</td>";
        echo "<td> $schDate</td>";
        echo "<td> $start</td>";
        echo "<td> $end</td>";
        echo "<td> <a class='text-white btn btn-secondary'  href='Schedule.php?action=remove&ScheduleID=$scheduleID'>Remove</a></td>";
        echo "</tr>";
    }
        echo "<tr>";
        echo "<td colspan='7' align='right'>";
        echo "<input type='submit' name='btnSave' value='Save' />";
        echo "|";
        echo "<a href='Schedule.php?action=clearall'>Clear All</a>";
        echo "</tr>";
    echo "</table>";
}
?>
    </form>
    </div>
    </div>

</div>



</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>

</body>
</html>