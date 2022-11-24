<?php
include('Connect.php');
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">


 <?php

 if(isset($_POST['btnSearch']))
 
 {
  $text=$_POST['txtSearch'];      

  $select="SELECT * FROM Doctor d, Specialty s
  WHERE s.SpecialtyName like '%$text%'
  AND d.SpecialtyID=s.SpecialtyID";
  $query=mysqli_query($connect,$select);
  $count=mysqli_num_rows($query);

  $select1="SELECT * FROM MedicalServices
  WHERE ServiceName like '%$text%'";
  $query1=mysqli_query($connect,$select1);
  $count1=mysqli_num_rows($query1);

  $select2="SELECT * FROM Doctor d,Specialty s
  WHERE DocName like '%$text%'
  AND d.SpecialtyID=s.SpecialtyID";
  $query2=mysqli_query($connect,$select2);
  $count2=mysqli_num_rows($query2);

  if($count>0)
  {
   
    for($i=0; $i<$count; $i++)
    {

      $data=mysqli_fetch_array($query);
      $docid=$data['DocID'];
      ?>
      <div class="table-responsive">
        <table class="table">
        <tr>
        <td class='table-light'>
           <p class='text-success lead'><?php echo $count . ' Result found' ;?></p>
           <img src='<?php echo $data['DocProfile'];?>'width='300px' height='300px'/>
           <p><?php echo $data['DocName']  ?></p>
           <p><?php echo $data['SpecialtyName'] ?></p>
        <?php echo "<a href='AppointmentSelf.php?DocID=$docid' class='btn btn-primary btn-sm'>Book Appointment</a>"; ?>
            

        </td>
        </tr>
        <table></table>
    
    <?php
    }
  
  }

 elseif($count1>0)
 {
    for($x=0; $x<$count1; $x++)
    {

      $data1=mysqli_fetch_array($query1);
      $serviceID=$data1['ServiceID'];
      ?>
      <div class="table-responsive">
        <table class="table">
        <tr>
        <td class='table-light'>
           <p class='text-success lead'><?php echo $count1 . ' Result found' ;?></p>
           <img src='<?php echo $data1['ServiceImage'];?>'width='300px' height='300px'/>
           <p><?php echo $data1['ServiceName']  ?></p>
           <p><?php echo $data1['Cost'] ?></p>
            <?php echo "<a href='MedicalServiceShopping.php?ServiceID=$serviceID' class='btn btn-primary btn-sm'>Book Appointment</a>" ?>
            

        </td>
        </tr>
        <table></table>
    
    <?php
    }
  
  }
  elseif($count2>0)
    {
    for($y=0; $y<$count2; $y++)
    {

      $data2=mysqli_fetch_array($query2);
      $docid=$data2['DocID'];
      ?>
      <div class="table-responsive">
        <table class="table">
        <tr>
        <td class='table-light'>
           <p class='text-success lead'><?php echo $count2 . ' Result found' ;?></p>
           <img src='<?php echo $data2['DocProfile'];?>'width='300px' height='300px'/>
           <p><?php echo $data2['DocName']  ?></p>
           <p><?php echo $data2['SpecialtyName'] ?></p>
        <?php echo "<a href='AppointmentSelf.php?DocID=$docid' class='btn btn-primary btn-sm'>Book Appointment</a>"; ?>
            

        </td>
        </tr>
        <table></table>
    
    <?php
    }
  
  }
 else
 {

   echo "<script>window.alert('No result found!')</script>";
   echo "<script>window.location='Home.php'</script>";
 }
}
?>
</div>    

<?php
include('footer.php');
?>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>