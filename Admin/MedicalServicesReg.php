<?php
$page='MedicalServiceAdmin';
include('Autoid.php');
include('Connect.php');
include('Dashboard.php');
if(isset($_POST['btnRegister']))
{
    $serviceID=AutoID('MedicalServices','ServiceID','S-',6);
    $serviceName=$_POST['txtService'];
    $components=$_POST['serviceComponents'];
    $description=$_POST['txtServiceDesx'];
    $serviceCost=$_POST['txtServiceCost'];
   //---Image upload

   $serviceImage= $_FILES['serviceImage']['name'];
   $folderName="../Images/";
   $fileName=$folderName .'_'. $serviceImage;

    $copied= copy($_FILES['serviceImage']['tmp_name'],$fileName);

    if(!$copied)
    {
        echo "<script>window.alert('Image cannot be uploaded!')</script>";
        exit();
    }
    //--------------
    $check= "Select * from MedicalServices Where ServiceName='$serviceName'";
    $query=mysqli_query($connect,$check);
    $count=mysqli_num_rows($query);
    if($count>0)
    {
        echo "<script>window.alert('Service already been registered!')</script>";
    }
    else
    {
        $insert= "INSERT INTO `MedicalServices`(`ServiceID`, `ServiceName`, `ServiceImage`,`Components`,`Description`,`Cost`) 
        VALUES ('$serviceID','$serviceName','$serviceImage','$components','$description','$serviceCost')";
        $run=mysqli_query($connect,$insert);
        if($run)
        {
            echo "<script>
            window.alert('Medical service successfully registered!');
            window.location='MedicalServicesList.php';
            </script>";
        }
        else{
            echo "<p>Something went wrong in registration!" . mysqli_error($connect) . "</p>";
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical servies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="DB.css">
  
</head>
<body>
<main>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2 class="text-center">Available Medical Services in Aung Polyclinic</h2>
            </div>
        </div>

        <div class="card-body">

            <div class="row pt-3 justify-content-center">
            <form action="MedicalServicesReg.php" method="POST" enctype="multipart/form-data" class="col-md-5">
                        
                <div class="form-group">
                    <label for="serviceName">Medical Servies</label>
                    <input type="text" name="txtService" class="form-control" placeholder="Service Name" id="serviceName" required>

                </div>

                <div class="form-group">
                    <label for="servicePic">Service Image</label>
                    <input type="file" name="serviceImage" id="servicePic" required/>

                </div>

                <div class="form-group">
                    <label for="serviceComponents">Service Components</label>
                    <pre>
                    <textarea class="form-control" id="serviceDescription" rows="3" name="serviceComponents" required></textarea>
                    </pre>
                    
                </div>

                <div class="form-group">
                    <label for="serviceDescription">Servie Description</label>
                    <textarea class="form-control" id="serviceDescription" rows="3" name="txtServiceDesx" required></textarea>
                </div>

                <div class="form-group">
                    <label for="serviceCost">Service Cost</label>
                    <input type="number" name="txtServiceCost" class="form-control" placeholder="Enter cost" id="serviceCost" required

                </div>

                <button type="submit" class="btn btn-secondary mr-5 mt-3" name="btnRegister">Register</button>
                <button class="btn btn-secondary mt-3"><?php echo "<a href='Dashboard.php' class='text-white'>Cancel</a>"; ?></button>
   
            </form>
            </div>

           
            </div>
    </div>
    
    </main>
    
</body>
</html>