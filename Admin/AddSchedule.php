<?php
session_start();
if(!isset($_SESSION['staffID']))
{
    header("Location:Staff_Login.php");
}
$page='Schedule';
include ('Connect.php');
include ('Autoid.php');
include('Dashboard.php');

if(isset($_POST['btnAdd']))
{
    $scheduleID=AutoID('Schedules','ScheduleID','Sc-',6);
    $scheduleDate=$_POST['txtDate'];


    $startTime=$_POST['start_time'];
    $endTime=$_POST['end_time'];

    //$dt = strtotime('06/22/2009');

    $check= "SELECT * FROM `Schedules` 
    WHERE scheduleDate='$scheduleDate' AND StartTime='$startTime'";
    $query =mysqli_query($connect,$check);
    $nums= mysqli_num_rows($query);

    if ($nums >0)
    {
        echo "<script>
        window.alert('This section is already registered!')
        window.location='AddSchedule.php';
        </script>";
        
    }
    else
    {
        
        $insert= "INSERT INTO `Schedules`(`ScheduleID`, `scheduleDate`, `StartTime`, `EndTime`) 
        VALUES ('$scheduleID','$scheduleDate','$startTime','$endTime')";
        $run=mysqli_query($connect,$insert);

        if ($run)
        {
            echo "<script>
            window.alert('Schedule has been added!');
            window.location='AddSchedule.php';
            </script>";
        }
    }
   


}


function create_time_range($start, $end, $interval = '30 mins', $format = '14') 
    {
        $startTime = strtotime($start); 
        $endTime   = strtotime($end);
        $returnTimeFormat = ($format == '14')?'g:i A':'G:i';
    
        $current   = time(); 
        $addTime   = strtotime('+'.$interval, $current); 
        $diff      = $addTime - $current;
    
        $times = array(); 
        while ($startTime < $endTime) { 
            $times[] = date($returnTimeFormat, $startTime); 
            $startTime += $diff; 
        } 
        $times[] = date($returnTimeFormat, $startTime); 
        return $times; 
    }
        
    // create array of time ranges 
    $times = create_time_range('7:00', '20:00', '2 hours');
    $times1 = create_time_range('9:00', '22:00', '2 hours');
    
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="DB.css">
</head>
<body>
    <main>
    <div class="container-fluid">

    <div class="col-md-8">
    <div class="card offset-sm-3 my-5">
        <div class="card-header">
            <div class="card-title">
            <h2 class="fw-bold text-center">Add Schedule</h2>

            </div>
        </div>
    <div class="card-body">


      <form action="AddSchedule.php" method="POST" enctype="multipart/form-data" class="form">

        <div class="form-group row">
                <label for="ScheduleDate" class="col-sm-5 col-form-label">Date</label>
                <div class="col-sm-7">
                <select class="form-control" name="txtDate">
                    <option>Choose Day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
                </div>
        </div>


        <div class="form-group row">
        <label for="hour" class="col-sm-5">Schedule Hour</label>
        <div class="col-sm-7 row">
            <select name="start_time" id="hour" class="form-control col-sm-6" required>
                <option>Start Time</option>
                <?php 
                    foreach($times as $key=>$val){ ?>
                    <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                    <?php } ?>
            </select>

            <select class="form-control col-sm-6" name="end_time" required>
            <option>End time</option>
            <?php 
                foreach($times1 as $key=>$val){ ?>
                <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                <?php } ?>
            </select>
              
        </div>
        
        </div>

    
        <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-primary mr-2" name="btnAdd" value="Add Schedule">
        <input type="reset" class="btn btn-secondary " value="Cancel">
        </div>
        
        </form>
    </div>

    </div>


    </div>

    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table table-sm table-bordered justify-content-center mt-3">
             
                <tr class="table-dark">
                    <th scope="col">Schedule Day</th>
                    <th scope="col">Start Time</th>
                    <th scope="col">End Time</th>
                    <th scope="col">Action</th>
                </tr>
              
                <tbody>
                    <?php
                    $select="SELECT * FROM Schedules ORDER BY scheduleDate";
                    $ret=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($ret);
                    for($i=0; $i<$count;$i++)
                    {
                        $data=mysqli_fetch_array($ret);
                        $SchID=$data['ScheduleID'];
                        echo "<tr>";
                        echo "<td>".$data['scheduleDate']."</td>";
                        echo "<td>".$data['StartTime']."</td>";
                        echo "<td>".$data['EndTime']."</td>";
                        echo "<td> <a class='btn btn-secondary' href='DeleteSchedule.php?SchID=$SchID'>Delete</a></td>";
                       

                        ?>
                                            
                    <?php } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </main>

</body>
</html>