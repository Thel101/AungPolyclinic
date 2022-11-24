<?php
$page='Home';
include('header.php');
include('Connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/49e8b61c53.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style.css">
</head>
<body>

<!-- carousel ---->

  	<div class="row justify-content-center mt-3">
		<div class="carousel slide " data-ride="carousel" data-interval="2000" >
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active bg-primary"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" ></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2" ></li>
        </ol>
			<div class="carousel-inner" >
		
				<div class="carousel-item active slide-pic">
					<img src="../Images/_Doc4.jpeg" alt="" class="img-fluid image1" >
				</div>

				<div class="carousel-item slide-pic" id="treadmill">
					<img src="../Images/_Servie1.jpeg" alt="" class="img-fluid image1" >
				</div>

				<div class="carousel-item slide-pic" id="bench">
					<img src="../Images/_x-ray.jpeg" alt="" class="img-fluid image1" >
				</div>
			</div>
		</div>
      
	</div>
</div>
 

<!-- carousel ---->


<!---card --> 
<div>
<div class="row my-2 py-2 px-2">

  <div class="col-sm-4">
    <div class="card consult">
      <div class="card-body" id="ConsultDiv">
        <h5 class="card-title">Consult with Specialist Doctor</h5>
        <p class="card-text">Consult with our specialist doctors and relieve your worries.</p>
        <a href="SpecialtyDisplay.php" class="btn btn-primary">Consult now</a>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card">
      <div class="card-body" id="VaccinationDiv">
        <h5 class="card-title">Book Vaccination</h5>
        <p class="card-text">The best way to prevent infections and communicable diseases is vaccination. Book yours here.</p>
        <a href="MedicalServiceDisplay.php" class="btn btn-primary">Get your vaccination </a>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card">
      <div class="card-body" id="Screening">
        <h5 class="card-title">Book Medical Packages</h5>
        <p class="card-text">Regular health screening is essential to maintain good health and fit body.</p>
        <a href="MedicalServiceDisplay.php" class="btn btn-primary">Receive services</a>
      </div>
    </div>
  </div>
</div>

</div>

<!---card -->

<div class="card mb-3">
  <img class="card-img-top" src="../Images/HomeNew.png" alt="Card image cap" height="400px">
  <div class="card-body">
    <h5 class="card-title text-center">Govern your health at one place</h5>
    <p class="card-text text-center lead">We offer a wide range of medical services from <a href="SpecialtyDisplay.php" class="text-success"> specialist consultation</a> to 
      <a href="MedicalServiceDisplay.php" class="text-danger text-center lead">routine blood examination</a>,
      <p class="text-warning text-center lead" >imaging examination and vaccination programs</p> 
    </p>

  </div>
</div>
<!---featurette -->

<hr class="featurette-divider">
<div class="row featurette">
<div class="col-md-5">
    <img class="featurette-image img-fluid mx-auto" src="../Images/HomePic1.png" alt="Generic placeholder image">
  </div>
  <div class="col-md-7 mt-5">
    <h2 class="featurette-heading mx-2 ">Our well-experienced consultants </h2>
    <p class="lead ml-2">If you have any concern about your health, our qualified and highly skilled consultatns are here to help you.</p>
  </div>
  
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 mt-5">
    <h2 class="featurette-heading mx-2 align-center ">Receive our latest services</h2>
    <?php
    $select="SELECT * FROM MedicalServices ORDER BY ServiceID DESC";
    $query=mysqli_query($connect,$select);
    $data=mysqli_fetch_array($query);
    $serviceID=$data['ServiceID'];
    ?>
    <p class="lead ml-2 align-center"><?php echo $data['Description'];?><?php echo "<a href='MedicalServiceShopping.php?ServiceID=$serviceID'> Click here for more details.</a>" ?></p> 
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-fluid mx-auto" src="<?php echo $data['ServiceImage']?>" alt="Generic placeholder image">
  </div>
</div>

<!---featurette -->

<?php
include('footer.php');
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"  ></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>

</body>
</html>