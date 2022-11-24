<?php
session_start();
include('Connect.php');
if(!isset($_SESSION['PatientID']))
{
    header("Location:Home.php");
}


$pid=$_SESSION['PatientID'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="DB.css" >
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
    <!-- navbar -->
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
  <div class="container-fluid">
    <!--offcanvas trigger-->
    
      <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon"></span>
      </button>

    <!-- offcanvas trigger-->
    <a class="navbar-brand fw-bold me-auto" href="#">Aung Polyclinic</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    
      <ul class="navbar-nav mb-2 mb-lg-0 d-flex ms-auto">
      
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         <i class="fa-solid fa-user"></i>
         </a>
         <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
           <li><a class="dropdown-item" href="Patient_Update.php">Profile</a></li>
         </ul>
       </li>
      
     </ul>
    </div>
  </div>
  </nav>

  <!-- navbar end-->
  
  <!-- offcanvas -->
      
    <div class="offcanvas offcanvas-start bg-success text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-dark fw-bold text-uppercase px-3">
                <?php 
                if(!isset($_SESSION['PatientID']))
                {
                  echo "<p>Admin</p>";
                }
                else {
                  echo $_SESSION['patientName'];
                }
                ?>
              </div>
            </li>
            <li>
              <?php echo "<a href='Patient_Update.php?PatID=$pid' class='nav-link px-3 my-2 active'>" ?>
              <i class="fa-solid fa-stethoscope me-2"></i>
              <b><span type="button">Edit Profile</span></b>
              </a>
            </li>
            <li class="my-2">
              <hr class="dropdown-divider"></hr>
            </li>
            

            <li>
              <a href="PDAppointments.php" class='nav-link px-3 my-2 navlink'>
              <i class="fa-regular fa-calendar-check me-2"></i>
              <b><span>My Appointments</span></b>
              </a>
            </li>

            <li>
              <a href='PDMedicalService.php' class='nav-link px-3 my-2 navlink'>
              <i class="fa-solid fa-briefcase-medical me-2"></i>
              <span>My Medical Services</span>
              </a>
            </li>

            <li>
              <a href="MedicalRecords.php" class="nav-link px-3 my-2 navlink">
              <i class="fa-solid fa-file-prescription me-2"></i>
              <span>Medical Records</span>
              </a>
            </li>
                   
            <li>
              <?php
              if(isset($_SESSION['PatientID']))
              {
                echo " <a href='PatientLogOut.php' class='nav-link px-3 my-2 navlink'>
                <i class='fa-solid fa-right-from-bracket me-2'></i>
                <span>Log out</span>
                </a>";
              }
             
              ?>
            </li>

            <li>
              <a href="Home.php" class="nav-link px-3 my-2 navlink ">
              <i class="fa-solid fa-calendar-check me-2"></i>
              <span>Back to HomePage</span>
              </a>
            </li>
          </ul>
        </nav>
        
      </div>
    </div>

  <!-- content -->
      
      <main class="mt-5 pt-3 ">
        <?php
        $pid=$_SESSION['PatientID'];
        $select="SELECT * FROM Patient 
        WHERE PatientID='$pid'";
        $query=mysqli_query($connect,$select);
        $data=mysqli_fetch_array($query);
        ?>
        <div class="row">
          <div class="col-sm-4">
          <img src="<?php echo $data['patientProfile']?>" alt="Patient Profile" width="200" height="200" class="rounded-circle">
          </div>

          <div class="col-sm-8">
          <h5 class="mt-5"><?php echo $data['patientName']?></h5>
          <h5 class="mt-5"><?php echo $data['patientPhone']?></h5>
          <h5 class="mt-5"><?php echo $data['patientAddress']?></h5>
          </div>
        </div>
       
                            
          </main>
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>