<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/49e8b61c53.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style.css">
    

</head>
<body>
  
<!-- navbar start -->
<div class="jumbotron jumbotron-fluid">
  <div class="container-fluid">
    <div class="row">
    <img src="../Images/clinic_logo.png"  width="100" height="100">
    <h1 class="mt-4 px-3">Aung Polyclinic</h1>

    <div class="offset-md-5 mt-3">
    <a href=“#” class="text-success"><i class="fa-solid fa-phone px-2 py-2"></i>555-666-7777</a>
    <div class="col w-100"></div>
    <a href="#" class="text-success"><i class="fa-regular fa-envelope px-2 py-2"></i>aungpolyclinic@gmail.com</a>
    <div class="col w-100"></div>
    <form class="form-inline my-2 my-lg-0 px-2" action="Search.php" method="POST" enctype="multipart/form-data">
      <input class="form-control mr-sm-2" type="text" name="txtSearch" placeholder="Search here">
      <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btnSearch" value="Search" />
       
    </form>
    </div>
    </div>
  
    <p class="lead mt-2 pl-3">Offering the best medical services and consultations</p>
   
   
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-success px-5 mt-0">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  
    <ul class="nav nav-pills nav-fill mx-auto justify-content-center  ">
      <li class="nav-item active px-2">
        <a class="nav-link header font-weight-bold text-white px-2 <?php if($page=='Home') {echo 'active';} ?>" href="Home.php">Home</span></a>
      </li>
      <li class="nav-item px-2">
        <a class="nav-link header font-weight-bold text-white <?php if($page=='AboutUs') {echo 'active';} ?>" href="AboutUs.php">About Us</a>
      </li>
     
      <li class="nav-item px-2">

        <a class="nav-link header font-weight-bold text-white <?php if($page=='Consultation') {echo 'active';} ?>" href="SpecialtyDisplay.php">Find Doctor</a>
      </li>

      <li class="nav-item px-2">
        <a class="nav-link header font-weight-bold text-white <?php if($page=='MedicalService') {echo 'active';} ?>" href="MedicalServiceDisplay.php">Medical Services</a>
      </li>

      <li class="nav-item px-2">
        <a class="nav-link header font-weight-bold text-white <?php if($page=='Contact') {echo 'active';} ?>" href="ContactUs.php">Contact Us</a>
      </li>

      <li class="nav-item px-2">
        <a class="nav-link header font-weight-bold text-white <?php if($page=='Help') {echo 'active';} ?>" href="Help.php">Help</a>
      </li>

      
    </ul>

    <div class="text-muted fw-bold text-uppercase ms-auto">
  
          <?php 
          if(!isset($_SESSION['PatientID']))
          {
            echo "<span class='navbar-text'>";
            echo "<a class='nav-link ms-auto font-weight-bold' href='Patient_login.php'>Sign Up/ Login</a>";
            echo "</span>";
          }
          else {
           
            echo "<a class='nav-link ms-auto font-weight-bold text-white' href='PatientDashboard.php'><i class='fa-solid fa-user'></i>Profile</a>";
          }
          ?>
    
              </div>
    
   
  </div>
</nav>
<!---navbar end-->

</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"></script>


</body>
</html>