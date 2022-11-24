<?php
include ('Connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Display</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<?php
$page='Consultation';
include('header.php');
?>
<form action="DoctorDisplay.php" method="POST" enctype="multipart/form-data" class="form-inline my-2 my-lg-0 justify-content-center">
<div class="container-fluid">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
    <li class="breadcrumb-item"><a href="SpecialtyDisplay.php">Find Doctor</a></li>
    <li class="breadcrumb-item active" aria-current="page">Doctor Display</li>
</ol>
</nav>
        <div class="row">
            <div class="col-sm-10 py-3">
            <div class="input-group">
                <select class="form-control" id="inputGroupSelect04" name="cboSpecialty">
                    <option selected>Search Specialty, Doctors</option>
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
                <div class="input-group-append">
                <input type="submit" class="btn btn-outline-success" name="btnSearch" value="Search" />    
              
                </div>

            </div>
            </div>
            
            <div class="col-sm-2 py-3">
                <input type="submit" class="btn btn-outline-success" name="btnSeeAll" value="See All Doctors" />
               
            </div>

           
        </div>
    </div>

</form>

 

<div class="table-responsive">

<table class="table table-bordered">
<?php

if (isset($_GET['SPID']))
{

    $spid=$_GET['SPID'];
    $docQuery= "SELECT d.DocProfile, d.DocName, s.SpecialtyName, d.DocDegree 
    FROM Doctor d, Specialty s
    WHERE s.SpecialtyID= '$spid' 
    AND d.SpecialtyID= s.SpecialtyID";
    $docRet=mysqli_query($connect,$docQuery);
    $docCount=mysqli_num_rows($docRet);

    if(($docCount) <1)
    {
        echo "<script>window.alert('No Result Found!')</script>";
        echo "<script>window.location='DoctorDisplay.php'</script>";
    }
    else
    {

    for($i=0; $i < $docCount; $i+=4)
    {
        $docQuery2="SELECT d.DocProfile, d.DocID, d.DocName, s.SpecialtyName,
        d.DocDegree , d.ConsultationFees, d.ClinicFees
        FROM Doctor d, Specialty s
        WHERE s.SpecialtyID= '$spid' 
        AND d.SpecialtyID= s.SpecialtyID LIMIT $i,3";
        $docRet2=mysqli_query($connect,$docQuery2);
        $docCount2=mysqli_num_rows($docRet2);

        echo "<tr class='table-light'>";
        for($x=0; $x <$docCount2; $x++)
        {
            $row= mysqli_fetch_array($docRet2);
            $docid=$row['DocID'];
            $docProfile=$row['DocProfile'];
            $docName= $row['DocName'];
            $docSpecialty= $row['SpecialtyName'];
            $docDegree= $row['DocDegree'];
            $docFees=$row['ConsultationFees'];
            $clinicFees=$row['ClinicFees'];

            $_SESSION['DocID']=$docid;
            $_SESSION['DocProfile']=$docProfile;
            $_SESSION['DocName']=$docName;
            $_SESSION['DocSpecialty']=$docSpecialty;
            $_SESSION['DocDegree']=$docDegree;
            $_SESSION['Fees']=$docFees;
            $_SESSION['ClinicFees']=$clinicFees;

            list($width,$height)= getimagesize($docProfile);
            $w=$width/2;
            $h=$height/2;

            ?>
            <td class="table-success">
                <img src="<?php  echo $docProfile?>" width="300px" height="300px"/>
                <p><?php echo $docName ;?></p>
                <p><?php echo $docSpecialty ;?></p>
                <p><?php echo $docDegree  ;?></p>
                
                <?php 
                echo "<a href='AppointmentSelf.php?DocID=$docid' class='btn btn-primary btn-sm'>Book Appointment</a>
                <a href='SpecialtyDisplay.php' class='text-dark btn btn-secondary btn-sm'>Cancel</a>";
                ?>
            </td>
            <?php
        }
        echo "</tr>";

    }

    }
}

elseif (isset($_POST['btnSearch']))
{
 
   $searchSpecialty=$_POST['cboSpecialty'];

  
$docQuery= "SELECT d.DocProfile, d.DocName, s.SpecialtyName, d.DocDegree,
d.ConsultationFees, d.ClinicFees
FROM Doctor d, Specialty s
WHERE s.SpecialtyID= '$searchSpecialty' 
AND d.SpecialtyID= s.SpecialtyID";
$docRet=mysqli_query($connect,$docQuery);
$docCount=mysqli_num_rows($docRet);

if(($docCount) <1)
{
    echo "<script>window.alert('No Result Found!')</script>";
    echo "<script>window.location='SpecialtyDisplay.php'</script>";
}
else
{

for($i=0; $i < $docCount; $i+=4)
{
    $docQuery2="SELECT d.DocProfile, d.DocID, d.DocName, s.SpecialtyName, d.DocDegree,
    d.ConsultationFees, d.ClinicFees
    FROM Doctor d, Specialty s
    WHERE s.SpecialtyID= '$searchSpecialty' 
    AND d.SpecialtyID= s.SpecialtyID LIMIT $i,3";
    $docRet2=mysqli_query($connect,$docQuery2);
    $docCount2=mysqli_num_rows($docRet2);

    echo "<tr class='table-light'>";
    for($x=0; $x <$docCount2; $x++)
    {
        $row= mysqli_fetch_array($docRet2);
        $docid=$row['DocID'];
        $docProfile=$row['DocProfile'];
        $docName= $row['DocName'];
        $docSpecialty= $row['SpecialtyName'];
        $docDegree= $row['DocDegree'];
        $docFees=$row['ConsultationFees'];
        $clinicFees=$row['ClinicFees'];

        $_SESSION['DocID']=$docid;
        $_SESSION['DocProfile']=$docProfile;
        $_SESSION['DocName']=$docName;
        $_SESSION['DocSpecialty']=$docSpecialty;
        $_SESSION['DocDegree']=$docDegree;
        $_SESSION['Fees']=$docFees;
        $_SESSION['ClinicFees']=$clinicFees;


        list($width,$height)= getimagesize($docProfile);
        $w=$width/2;
        $h=$height/2;

        ?>
         <td class="table-success">
             <img src="<?php  echo $docProfile?>" width="300px" height="300px"/>
             <p><?php echo $docName ;?></p>
             <p><?php echo $docSpecialty ;?></p>
             <p><?php echo $docDegree ;?></p>
             <?php 
            echo "<a href='AppointmentSelf.php?DocID=$docid' class='btn btn-primary btn-sm'>Clinic Appointment</a>
            <a href='AppointmentSelf.php?DocID=$docid' class='btn btn-secondary btn-sm'>Video Appointment</a>
            <a href='SpecialtyDisplay.php' class='text-dark btn btn-secondary btn-sm'>Cancel</a> ";
            ?>
         </td>
        <?php
    }
    echo "</tr>";

}

}
}
else
{

$docQuery= "SELECT d.DocProfile, d.DocName, s.SpecialtyName, d.DocDegree 
FROM Doctor d, Specialty s
WHERE d.SpecialtyID= s.SpecialtyID";
$docRet=mysqli_query($connect,$docQuery);
$docCount=mysqli_num_rows($docRet);

for($i=0; $i < $docCount; $i+=3)
{
    $docQuery2="SELECT d.DocProfile, d.DocID, d.DocName, s.SpecialtyName, d.DocDegree, 
    d.ConsultationFees, d.ClinicFees
    FROM Doctor d, Specialty s
    WHERE d.SpecialtyID= s.SpecialtyID LIMIT $i,3";
    $docRet2=mysqli_query($connect,$docQuery2);
    $docCount2=mysqli_num_rows($docRet2);

    echo "<tr>";
    for($x=0; $x <$docCount2; $x++)
    {
        $row= mysqli_fetch_array($docRet2);
        $docid=$row['DocID'];
        $docProfile=$row['DocProfile'];
        $docName= $row['DocName'];
        $docSpecialty= $row['SpecialtyName'];
        $docDegree= $row['DocDegree'];
        $docFees=$row['ConsultationFees']; 
        $clinicFees=$row['ClinicFees'];

        $_SESSION['DocID']=$docid;
        $_SESSION['DocProfile']=$docProfile;
        $_SESSION['DocName']=$docName;
        $_SESSION['DocSpecialty']=$docSpecialty;
        $_SESSION['DocDegree']=$docDegree;
        $_SESSION['Fees']=$docFees;
        $_SESSION['ClinicFees']=$clinicFees;
        

        list($width,$height)= getimagesize($docProfile);
        $w=$width/2;
        $h=$height/2;

       
        ?>
         <td class="table-light">
             <img src="<?php  echo $docProfile?>" width="300px" height="300px"/>
             <p><?php echo $docName ;?></p>
             <p><?php echo $docSpecialty ;?></p>
             <p><?php echo $docDegree ;?></p>
            <?php
            echo "<a href='AppointmentSelf.php?DocID=$docid' class='btn btn-primary btn-sm'>Clinic Appointment</a>
            <a href='AppointmentSelf.php?DocID=$docid' class='btn btn-secondary btn-sm'>Video Appointment</a>";
            ?>
            

         </td>
        <?php
    }
    echo "</tr>";

}

}


?>
</table>
</div>
<?php
include('footer.php');
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>