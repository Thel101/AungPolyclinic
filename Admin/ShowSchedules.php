<?php
$page='DS';
include('Dashboard.php');
include ('Connect.php');

$dID=$_GET['DocID'];
$select= "SELECT * FROM Doctor 
WHERE DocID='$dID'";
$query=mysqli_query($connect,$select);
$data=mysqli_fetch_array($query);

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
</head>
<body>
<main>
    <div class="card">
       
        <div class="card-body">
        <form action="ShowSchedules.php" method="POST" enctype="multipart/form-data">
      
            <div class="form-group">
               
                <img src="<?php echo $data['DocProfile'] ?>">
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Doctor ID</label>
                <input type="text" class="form-control" id="inputEmail4" value="<?php echo $data['DocID']?>">
                </div>

                <div class="form-group col-md-6">
                <label for="inputPassword4">Doctor Name</label>
                <input type="text" class="form-control" id="inputPassword4" value="<?php  echo $data ['DocName'] ?>">
                </div>
            </div>

            <div class="container-fluid">
            <?php

            $dID=$_GET['DocID'];
            $query= "SELECT ds.*, s.scheduleDate, s.StartTime, s.EndTime
            FROM DoctorSchedule ds, Schedules s
            WHERE ds.DocID='$dID' and ds.ScheduleID= s.ScheduleID";
            $ret=mysqli_query($connect,$query);
            $count= mysqli_num_rows ($ret);

            if($count<1)
            {
                echo "<script>window.alert('No Schedule for this doctor!')</script>";
                echo "<script>window.location='Schedule.php?DocID=$dID'</script>";

            }
            else
            {
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>Schedule Date</th>
                    <th>Schedule Period</th>
                </tr>
                <?php
                    for ($i=0; $i < $count; $i++)
                    {
                        $row = mysqli_fetch_array($ret);
                        $dID= $row['DocID'];
                    
                        echo "<tr>";
                        echo "<td>" . $row['scheduleDate'] . "</td>";
                        echo "<td>" . $row['StartTime'] .'-'. $row['EndTime']. "</td>";
                        echo "</tr>";

                    }
                    ?>

                <?php
            }
            ?>
            </table>
            <?php echo "<a href='Schedule.php?DocID=$dID' class='btn btn-secondary'>Go to Scheduleing Page</a>"
            ?>
            <?php echo "<a href='SearchDoctor.php?DocID=$dID' class='btn btn-secondary'>Back</a>"
            ?>
            
  
            </div>
  

</form>
        </div>
    </div>

</main>
</body>
</html>