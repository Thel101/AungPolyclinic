<?php

if(isset($_SESSION['staffID']))
{
  $staffID=$_SESSION['staffID'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aung polyclinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="DB.css" >
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>

<body>
 
  <!-- navbar -->
  
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
           <li><?php echo "<a class='dropdown-item' href='Staff_Update.php?StaffID=$staffID'>Profile</a>" ?></li>
         </ul>
       </li>
      
     </ul>
    </div>
  </div>
  </nav>

  <!-- navbar end-->
  
  <!-- offcanvas -->
      
    <div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted fw-bold text-uppercase px-3">
                <?php 
                if(!isset($_SESSION['staffID']))
                {
                  echo "<p>Admin</p>";
                }
                else {
                  echo $_SESSION['staffName'];
                }
                ?>
              </div>
            </li>
          
            <li>
              <a href="StaffList.php" class="nav-link px-3 my-2 <?php if($page=='Staffs') {echo 'active';} ?>">
              <i class="fa-solid fa-person me-2"></i>
              <span>Staffs</span>
              </a>
            </li>
            <li class="my-2">
              <hr class="dropdown-divider"></hr>
            </li>
            <li>
              <a href="Specialty.php" class="nav-link px-3 my-2 navlink <?php if($page=='Specialty') {echo 'active';} ?>">
              <i class="fa-solid fa-stethoscope me-2"></i>
              <span type="button">Specialities</span>
              </a>
            </li>

           

            <li>
              <a href="Doctor_list.php" class="nav-link px-3 my-2 navlink <?php if($page=='Doctor') {echo 'active';} ?>">
              <i class="fa-solid fa-user-doctor me-2"></i>
              <span>Doctors</span>
              </a>
            </li>

            <li>
              <a href="MedicalServicesList.php" class="nav-link px-3 my-2 navlink <?php if($page=='MedicalServiceAdmin') {echo 'active';} ?>">
              <i class="fa-solid fa-vial-circle-check me-2"></i>
              <span>Medical Services</span>
              </a>
            </li>

            <li>
              <a href="Patient_list.php" class="nav-link px-3 my-2 navlink <?php if($page=='Patient') {echo 'active';} ?>">
              <i class="fa-solid fa-user me-2"></i>
              <span>Patients</span>
              </a>
            </li>
            
            <li>
              <a href="AddSchedule.php" class="nav-link px-3 my-2 navlink <?php if($page=='Schedule') {echo 'active';} ?>">
              <i class="fa-solid fa-calendar-check me-2"></i>
              <span>Schedules</span>
              </a>
            </li>

            <li>
              <a href="ScheduleList.php" class="nav-link px-3 my-2 navlink <?php if($page=='DS') {echo 'active';} ?> ">
              <i class="fa-solid fa-calendar-check me-2"></i>
              <span>Doctor Schedules</span>
              </a>
            </li>

            <li>
              <a href="AppointmentAdminView.php" class="nav-link px-3 my-2 navlink <?php if($page=='DA') {echo 'active';} ?>">
              <i class="fa-sharp fa-solid fa-calendar-days me-2"></i>
              <span>Doctor Appointments</span>
              </a>
            </li>

            <li>
              <a href="ServiceAppointmentAdmin.php" class="nav-link px-3 my-2 navlink <?php if($page=='SA') {echo 'active';} ?>">
              <i class="fa-sharp fa-solid fa-calendar-days me-2"></i>
              <span>Service Appointments</span>
              </a>
            </li>

            <li>
              <a href="MessageAdminView.php" class="nav-link px-3 my-2 navlink <?php if($page=='Enquiry') {echo 'active';} ?>">
              <i class="fa-solid fa-square-envelope me-2"></i>
              <span>Patient's enquiry</span>
              </a>
            </li>

            
            <li>
              <?php
              if(isset($_SESSION['staffID']))
              {
                echo " <a href='Staff_logout.php' class='nav-link px-3 my-2 navlink'>
                <i class='fa-solid fa-right-from-bracket me-2'></i>
                <span>Log out</span>
                </a>";
              }
              else
              {
                echo " <a href='Staff_Login.php' class='nav-link px-3 my-2 navlink'>
                <i class='fa-solid fa-right-from-bracket me-2'></i>
                <span>Log in</span>
                </a>";
              }
             
              ?>
            </li>
          </ul>
        </nav>
        
      </div>
    </div>

  <!-- content -->
      
          <main class="mt-5 pt-3 ">
          
          </main>
       
  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>