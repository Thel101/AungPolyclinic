<?php

function AddSchedule($scheduleID,$maxPatient,$examRoom)
{
  
    $query= "Select * from Schedules Where ScheduleID ='$scheduleID'";
    $connect=mysqli_connect('localhost','root','','Project');
    $ret=mysqli_query($connect,$query);
    $count=mysqli_num_rows($ret);
    $row=mysqli_fetch_array($ret);

    if($count <1)
    {
        echo "<script>window.alert('No Schedule Found!')</script>";
       
    }
    if(isset($_SESSION['Schedule_Function']))
    {
        $index=IndexOf($scheduleID);
        if($index == -1)
        {
            $size=count($_SESSION['Schedule_Function']);

            $_SESSION ['Schedule_Function'][$size]['ScheduleID'] = $scheduleID;
            $_SESSION ['Schedule_Function'][$size]['MaxPatient'] = $maxPatient;
            $_SESSION ['Schedule_Function'][$size]['ExamRoom'] = $examRoom;
            $_SESSION ['Schedule_Function'][$size]['ScheduleDate'] = $row['scheduleDate'];
            $_SESSION ['Schedule_Function'][$size]['StartTime'] = $row['StartTime'];
            $_SESSION ['Schedule_Function'][$size]['EndTime'] = $row['EndTime'];
        }
       
    }
    else
    {
        $_SESSION ['Schedule_Function']= array();

        $_SESSION ['Schedule_Function'][0]['ScheduleID'] = $scheduleID;
        $_SESSION ['Schedule_Function'][0]['MaxPatient'] = $maxPatient;
        $_SESSION ['Schedule_Function'][0]['ExamRoom'] = $examRoom;
        $_SESSION ['Schedule_Function'][0]['ScheduleDate'] = $row['scheduleDate'];
        $_SESSION ['Schedule_Function'][0]['StartTime'] = $row['StartTime'];
        $_SESSION ['Schedule_Function'][0]['EndTime'] = $row['EndTime'];
    }

    
}
function RemoveSchedule($scheduleID)
{
    $index=IndexOf($scheduleID);

    unset($_SESSION['Schedule_Function'][$index]);

    $_SESSION['Schedule_Function']=array_values($_SESSION['Schedule_Function']);
}
function ClearAll()
{
	unset($_SESSION['Schedule_Function']);
	echo "<script>window.location='Schedule.php'</script>";
}
function IndexOf($scheduleID)
{
    if(!isset($_SESSION['Schedule_Function']))
    {
        return -1;
    }
    $size= count(($_SESSION['Schedule_Function']));
    if($size <1)
    {
        return -1;
    }
    else 
    {
      
        for ($i=0; $i<$size; $i++)
        {
            if ($scheduleID==$_SESSION['Schedule_Function'][$i]['ScheduleID'])
            {
                return $i; 
            }
        }
        return -1;
    }
}

?>