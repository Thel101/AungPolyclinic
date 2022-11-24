<?php

include ('Connect.php');
include ('Autoid.php');
include('Dashboard.php');

if(isset($_POST['btnUpdate']))
{
    $serviceID=$_POST['txtServiceID'];
    $serviceName=$_POST['txtService'];
    $components=$_POST['serviceComponents'];
    $description=$_POST['txtServiceDesx'];
    $serviceCost=$_POST['txtServiceCost'];
    $serviceImage= $_FILES['serviceImage']['name'];
    $folderName="../Images/";
    $fileName=$folderName .'_'. $serviceImage;
    
    $updateS= "UPDATE `MedicalServices` 
              SET
            `ServiceName`='$serviceName',
            `ServiceImage`='$fileName',
            `Components`='$components',
            `Description`='$description',
            `Cost`='$serviceCost' WHERE ServiceID='$serviceID'";
        $run= mysqli_query($connect,$updateS);
        if ($run)
        {
        echo "<script>
        window.alert('Medical Services Successfully Updated!');
        window.location='MedicalServicesList.php';
        </script>";
        }
    
        else
        {
        echo "<p>Something went wrong!" . mysqli_error($connect) . "</p>";
        }

}
    $SerID= $_GET['ServiceID'];

    $select="SELECT * FROM MedicalServices WHERE ServiceID='$SerID'";
    $result=mysqli_query($connect,$select);
    $row=mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="DB.css">
    <title>Medical Services</title>
</head>
<body>
<main>
<div class="card">
        <div class="card-header">
            <div class="card-title">
                <h2 class="text-center">Available Medical Serviex in Aung Polyclinic</h2>
            </div>
        </div>

        <div class="card-body">

            <div class="row pt-3 justify-content-center">
            <form action="Service_Update.php" method="POST" enctype="multipart/form-data" class="col-md-5">
                        
                <div class="form-group">
                    <label for="serviceName">Medical Servies</label>
                    <input type="text" name="txtService" class="form-control" value="<?php echo $row['ServiceName']; ?>">

                </div>

                <div class="form-group">
                    <label for="servicePic">Service Image</label>
                    <input type="file" name="serviceImage" id="servicePic" value="<?php echo $row['ServiceImage']; ?>" required/>

                </div>

                <div class="form-group">
                    <label for="serviceComponents">Service Components</label>
                    <pre>
                    <textarea class="form-control" id="serviceDescription" rows="3" name="serviceComponents" ><?php echo $row['Components']; ?></textarea>
                    </pre>
                    
                </div>

                <div class="form-group">
                    <label for="serviceDescription">Servie Description</label>
                    <textarea class="form-control" id="serviceDescription" rows="3" name="txtServiceDesx" ><?php echo $row['Description']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="serviceCost">Service Cost</label>
                    <input type="number" name="txtServiceCost" class="form-control" value="<?php  echo $row['Cost'];?>">

                </div>

                <input type="hidden" name="txtServiceID" value="<?php echo $row['ServiceID']?>">
                <button type="submit" class="btn btn-secondary ml-5 mr-5 mt-3" name="btnUpdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-3">Cancel</button>
            </form>
            </div>

           
            </div>
</main>
</body>
</html>