<?php
$page='Specialty';
include ('Connect.php');
include ('Autoid.php');
include('Dashboard.php');

if(isset($_POST['btnUpdate']))
{
    $specialtyID=$_POST['txtspecialtyID'];
    $specialtyName=$_POST['txtSpecialty'];

    $specialtyImage= $_FILES['SpecialtyImage']['name'];
    $folderName="../Images/";
    $fileName=$folderName .'_'. $specialtyImage;

    $update= "UPDATE `Specialty` 
              SET
            `SpecialtyID`='$specialtyID',
            `SpecialtyName`='$specialtyName' ,
            `SpecialtyImage`='$fileName' 
            WHERE SpecialtyID='$specialtyID'";
        $run= mysqli_query($connect,$update);
        if ($run)
        {
        echo "<script>
        window.alert('Specialty list  Successfully Updated!');
        window.location='Specialty.php';
        </script>";
        }
    
        else
        {
        echo "<p>Something went wrong!" . mysqli_error($connect) . "</p>";
        }

}
    $SPid= $_GET['SPID'];

    $select="SELECT * FROM Specialty WHERE SpecialtyID='$SPid'";
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
    <title>Available Specialty</title>
</head>
<body>
    <main>
    <h1 class="text-center">Available Specialty in Aung Polyclinic</h1>
    <div class="row pt-3 justify-content-center">
    <form action="Specialty_Update.php" method="POST" enctype="multipart/form-data" class="col-md-5">
                
        <div class="form-group">
            <label for="specialtyName">Specialty Name</label>
            <input type="text" name="txtSpecialty" class="form-control" value= <?php echo $row['SpecialtyName'] ;?> id="specialtyName">

        </div>

        <div class="form-group">
                    <label for="specialtyImage">Specialty Image</label>
                    <input type="file" name="SpecialtyImage" class="form-control" value= <?php echo $row['SpecialtyImage'] ;?>id="specialtyImage">

        </div>

        <input type="hidden" name="txtspecialtyID" value="<?php echo $row['SpecialtyID']?>">
        <button type="submit" class="btn btn-secondary ml-5 mr-5 mt-3" name="btnUpdate">Update</button>
        <button type="reset" class="btn btn-secondary mt-3">Cancel</button>
    </form>
    </div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>