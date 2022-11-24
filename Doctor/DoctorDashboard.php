<?php
session_start();

include('Connect.php');

if(!isset($_SESSION['did']))
{
  header("Location:Doctor_Login.php");
}

$Did=$_SESSION['did'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
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
                if(!isset($_SESSION['did']))
                {
                  echo "<p>Doctor</p>";
                }
                else {
                  echo $_SESSION['DocName'];
                }
                ?>
              </div>
            </li>
            <li>
              <?php echo "<a href='Doctor_Update_DD.php?docID=$Did' class='nav-link px-3 my-2 active'>" ?>
              <i class="fa-solid fa-stethoscope me-2"></i>
              <b><span type="button">Edit Profile</span></b>
              </a>
            </li>
            <li class="my-2">
              <hr class="dropdown-divider"></hr>
            </li>
            
            <li>
              <a href="DoctorDashboard.php" class='nav-link px-3 my-2 navlink active '>
              <i class="fa-regular fa-calendar-days me-2"></i>
              <b><span>My Schedules</span></b>
              </a>
            </li>

            <li>
              <a href="DDAppointment.php" class='nav-link px-3 my-2 navlink <?php if($page=='Appointments') {echo 'active';} ?>'>
              <i class="fa-solid fa-calendar-check me-2"></i>
              <b><span>My Appointments</span></b>
              </a>
            </li>

            <li>
              <a href="DDMedicalRecords.php" class="nav-link px-3 my-2 navlink <?php if($page=='Records') {echo 'active';} ?>">
              <i class="fa-solid fa-file-prescription me-2"></i>
              <span>Medical Records</span>
              </a>
            </li>

                   
            <li>
              <?php
              if(isset($_SESSION['did']))
              {
                echo " <a href='Doctor_logout.php' class='nav-link px-3 my-2 navlink'>
                <i class='fa-solid fa-right-from-bracket me-2'></i>
                <span>Log out</span>
                </a>";
              }
             
              ?>
            </li>

            <li>
              <a href="Home.php" class="nav-link px-3 my-2 navlink ">
              <i class="fa-solid fa-house me-2"></i>
              <span>Website HomePage</span>
              </a>
            </li>
          </ul>
        </nav>
        
      </div>
    </div>

  <!-- content -->
      
      <main class="mt-5 pt-3 ">
          <div class="container-fluid">
     
              <div class="row mt-3">
                    <!-- section1 -->

                    <div class="row">
                        <div class="col-sm-4">
                        <?php 
                        $did=$_SESSION['did'];
                        $selectDB="SELECT * FROM Doctor 
                        WHERE DocID='$did'";
                        $rundB=mysqli_query($connect,$selectDB);
                        $resultDB=mysqli_fetch_array($rundB);
                        ?>
                        <img src="<?php echo $resultDB['DocProfile']; ?>"
                        alt="Doctor Profile" width="200" height="200" class="rounded-circle">
                        </div>

                        <div class="col-sm-8">
                        <h5 class="mt-0"><?php echo $resultDB['DocName'];?></h5>
                            <p><?php echo $resultDB['DocDegree'];  ?></p>
                            

                            <!-- schedule time -->
                           
                            <div class="table-responsive">
                            <table class="table">
                            <tr>
                              <th>Available Time</th>
                              <th>Maximum Patient</th>
                              <th>Examination Room</th>
                            </tr>
                            <?php

                            $did= $_SESSION['did'];

                            $query= "SELECT d.DocProfile, d.DocName, d.DocDegree, s.scheduleDate, s.StartTime, s.EndTime, ds.MaxPatient, ds.RoomNo
                            FROM Doctor d, DoctorSchedule ds, Schedules s
                            WHERE ds.DocID='$did'
                            AND d.DocID= ds.DocID AND s.ScheduleID= ds.ScheduleID";
                            $ret=mysqli_query($connect,$query);
                            $count=mysqli_num_rows($ret);
                            if($ret)

                            {
                            ?>
                            <?php
                            for ($i=0; $i < $count; $i++)
                            {
                                $row = mysqli_fetch_array($ret);    
                                echo "<tr>";
                                echo  "<td class='font-weight-bold'>" .$row['scheduleDate']." -- " .$row['StartTime'].'-'.$row['EndTime']. "</td>";
                                echo "<td>". $row['MaxPatient']."</td>";
                                echo "<td>". "Room-" .$row['RoomNo']."</td>";
                                echo "</tr>";

                            }
                            ?>
                            <?php
                            }
                            ?>
                            </table>
                            </div>
                        </div>
                    </div>
                

                </div>
                    <!-- section1 -->

              </div>
                       
          </div>
              
          </main>
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
</body>
</html>