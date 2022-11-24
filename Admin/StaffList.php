<?php
session_start();

$page='Staffs';
include ('Dashboard.php');
include('Connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DB.css">
    <title>Document</title>
</head>
<body>
<main>
<div class="card-group my-4">
            <!--- card 1 -->
            <div class="card bg-success">
              <div class="card-body">
                <h5 class="card-title">Doctors</h5>
   
                <?php
                $selectDoc="SELECT * FROM Doctor";
                $queryDoc=mysqli_query($connect,$selectDoc);
                $countDoc=mysqli_num_rows($queryDoc);

                ?>
                <div class="row">
                <div class="col-md-3">
                <i class="fa-solid fa-user-doctor fa-3x mr-2 text-warning"></i>
                </div>
                <div class="col-md-9">
                <h1 class="text-warning font-weight-bold"><?php echo $countDoc ?></h1>
                </div>
                
                </div>
                
              </div>
            </div>
            <!-- card 2 -->
            <div class="card bg-light">
            
              <div class="card-body">
                <h5 class="card-title">Specialities</h5>
                <?php 
                $selectSpec= "SELECT * From Specialty";
                $runSpec=mysqli_query($connect,$selectSpec);
                $countSpec=mysqli_num_rows($runSpec);
                ?>
                 <div class="row">
                <div class="col-md-3">
                <i class="fa-solid fa-stethoscope fa-3x text-success"></i>
                </div>
                <div class="col-md-9">
                <h1 class="text-success font-weight-bold"><?php echo $countSpec ?></h1>
                </div>
                
                </div>
              </div>
              
            </div>
            <!--- card 3 -->
            <div class="card bg-primary">
              <div class="card-body">
                <h5 class="card-title">Total Appointment</h5>
                <?php
                $selectAppoint= "SELECT * From Appointments";
                $runAppoint=mysqli_query($connect,$selectAppoint);
                $countAppoint=mysqli_num_rows($runAppoint);
                ?>
                <div class="row">
                <div class="col-md-3">
                <i class="fa-solid fa-calendar-check fa-3x"></i>
                </div>
                <div class="col-md-9">
                <h1 class="font-weight-bold"><?php echo $countAppoint ?></h1>
                </div>
                
                </div>
              </div>
            </div>

            <!-- card 4 --->
            <div class="card bg-danger">
              <div class="card-body">
                <h5 class="card-title">Patients</h5>
                <?php
                $selectPatient= "SELECT * From Patient";
                $runPatient=mysqli_query($connect,$selectPatient);
                $countPatient=mysqli_num_rows($runPatient);
                ?>
                <div class="row">
                <div class="col-md-3">
                <i class="fa-solid fa-hospital-user fa-3x"></i>
                </div>
                <div class="col-md-9">
                <h1 class="font-weight-bold"><?php echo $countPatient ?></h1>
                </div>
                
                </div>
              </div>
            </div>
          </div>

        <div class="card">
            <div class="card-header">
                <div class="card-titile">
                    <h2 class="fw-bold text-center">Staffs in Aung Polyclinic</h2>
                </div>
            </div>
            <diiv class="card-body">
            <div class="container-fluid">
            <div>
            
            <a href="StaffRegistration.php" id='AD'>
            <button class="btn btn-secondary offset-10"> 
            <i class='fa-solid fa-square-plus mr-1'></i>Add Staffs</button></a>

        </div>
        
        <?php
        $query= "SELECT s.*, p.*
        FROM Staff s, Position p
        WHERE s.staffPosition= p.RoleID ";
        $ret=mysqli_query($connect,$query);
        $count=mysqli_num_rows($ret);

        if($count <1)
        {
            echo "<script>window.alert('No Result found!')</script>";
        }
        else
        {
        ?>
        
        <div class="table-responsive">
       
        <table class="table table-sm  table-bordered justify-content-center mt-3">

            <tr class="table-dark">
                <th scope="col">StaffID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Password</th>
                <th scope="col">Position</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>

            <?php
            for ($i=0; $i < $count; $i++)
            {
                $row = mysqli_fetch_array($ret);

                $staffID = $row['StaffID'];

                echo "<tr>";
                echo "<td>" . $staffID . "</td>";
                echo "<td>" . $row['staffName'] . "</td>";
                echo "<td>" . $row['staffEmail'] . "</td>";
                echo "<td>" . $row['staffPhone'] . "</td>";
                echo "<td>" . $row['Password'] . "</td>";
                echo "<td>" . $row['RoleName'] . "</td>";
                echo "<td>" . $row['staffStatus'] . "</td>";
                echo "<td>
                    <a href='Staff_Update.php?StaffID=$staffID''>Edit</a> | 
                    <a href='Staff_Delete.php?StaffID=$staffID''>Delete</a>
                    </td>";
                echo "</tr>";

            }
            ?>
        </table>
        </div>
        
        </div>
        <?php
        }
        ?>
        
    </div>
            </diiv>
        </div>
        
    </main>
</body>
</html>