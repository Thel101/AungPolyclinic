<?php

	if (isset($_POST['btnLogin'])) 
	{	session_start();
		include('Connect.php');
		
		$patientEmail= $_POST['txtPatientMail'];
		$PatientPassword = $_POST['txtPassword'];
        	
	$select="SELECT * FROM `Patient` WHERE patientEmail='$patientEmail' and patientPassword='$PatientPassword'";
	$query=mysqli_query($connect,$select);
	$count=mysqli_num_rows($query);
	
	if($count>0)
	{
	
	$data=mysqli_fetch_array($query);
	$_SESSION['PatientID']=$data['PatientID'];
	$_SESSION['patientName']=$data['patientName'];
	$_SESSION['patientPhone']=$data['patientPhone'];
	$_SESSION['patientGender']=$data['patientGender'];
	$_SESSION['patientAge']=$data['patientAge'];
	$_SESSION['DateOfBirth']=$data['DateOfBirth'];

	echo "<script>alert('Login Successful')</script>";
	echo "<script>window.location='Home.php'</script>";

	if(isset($_POST['remember']))
	{
	setcookie('email',$patientEmail, time()+3600);
	setcookie('pass',$PatientPassword, time()+3600);
	}

	}
	else
	{
		if (isset($_SESSION['loginError']))
		{
		$countError=$_SESSION['loginError'];
			if ($countError==1)
			{
			$_SESSION['loginError']=2;
			echo "<script>window.alert('Login failed! Please try again! Error Attempt 2')</script>";
			}
			if ($countError==2)
			{
			echo "<script>window.alert('Login failed! Error Attempt 3! Account is locked for 10mins! Please try again later.')</script>";
			echo "<script>window.location='LogIn_Timer.php'</script>";
			}

		}
		else
		{
		$_SESSION['loginError']=1;
		echo "<script>window.alert('User Not Found')</script>";
		echo "<script>window.location='Patient_Registration.php'</script>";
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
	<title>Patient Log In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="Style.css">
</head>
<body id="patientLogIn">


<?php if(isset($_SESSION["error"])) { ?>
	<p style="color:crimson"><?php $_SESSION["error"]; ?></p>
 <?php unset($_SESSION["error"]); } ?>
    <div class="container">
    
        <div class="row pt-3 justify-content-center">
        <div class="col-md-8">

            <div class="card mt-5  bg-light bg-success">

            <div class="card-header">
			
                <div class="card-title">
				<h1 class="text-center mt-5">Welcome from Aung Polyclinic</h1>
                <a href="Patient_Registration.php" class="float-right btn btn-outline-primary">Sign up</a>
                
                </div>
            </div>
            <div class="card-body">

            <form action="Patient_login.php" method="POST" enctype="multipart/form-data" class="justify-content-center">
                
                <div class="form-group">
                    <label for="patEmail">Email</label>
                    <input type="text" name="txtPatientMail" class="form-control" placeholder="Enter email account" id="patEmail" required/>

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="txtPassword" class="form-control" placeholder="Enter password" id="password" required/>

                </div>

				<div class="form-group">
					<input type="checkbox" name="remember" value="1"> Remember Me
				</div>
                
                <div class="form-group">
                <button type="submit" class="btn btn-success" name="btnLogin">Log In</button>
				<button class="btn btn-secondary"><?php echo "<a href='Home.php' class='text-white'>Cancel</a>"; ?></button>
 
                
                </div>
               
				<span>
					<?php
						if(isset($_SESSION['message'])){
							echo $_SESSION['message'];
						}
						unset($_SESSION['message']);
					?>
				</span>
            </form>
            </div>

			<?php
   			 if(isset($_COOKIE['email']) and isset($_COOKIE['pass']))
			{
      		$email = $_COOKIE['email'];
       		$pass  = $_COOKIE['pass'];
            
       		$_COOKIE['email'];

    		}
			?>

        </div>
        </div>
        </div>
</body>
</html>