<?php
	if (isset($_POST['btnLogin'])) 
	{
		session_start();
		include('Connect.php');
	
		$docEmail= $_POST['txtDocMail'];
		$Password = $_POST['txtPassword'];
	
	
	$select="SELECT * FROM Doctor where DocEmail='$docEmail' and Password='$Password'";
	$query=mysqli_query($connect,$select);
	$count=mysqli_num_rows($query);
	
	if($count>0)
	{
	
	$data=mysqli_fetch_array($query);
	$Did=$data['DocID'];
	$_SESSION['did']=$Did;
	$_SESSION['DocName']=$data['DocName'];

	echo "<script>alert('Doctor Login Successful')</script>";
	echo "<script>window.location='DoctorDashboard.php'</script>";

	if(isset($_POST['remember']))
	{
	setcookie('email',$docEmail, time()+3600);
	setcookie('pass',$Password, time()+3600);
	}

	}
	else
	{
		{
		$_SESSION['loginError']=1;
		echo "<script>window.alert('Email or password is incorrect!')</script>";
		echo "<script>window.location='Doctor_Login.php'</script>";
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
	<title>Doctor Log In</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="Style.css">
</head>
<body>
<div class="container-fluid">
	<div class="card">
	
	<img class="card-img" src="../Images/BackLog.jpeg" alt="Card image cap">
	<div class="card-img-overlay">
	
	<div class="row mt-5 justify-content-center align-middle">
           
		   <form action="Doctor_Login.php" class="form bg-light rounded col-sm-4 mt-5 pb-3 " method="POST" enctype="multipart/form-data" class="col-md-5">
		   <div class="card-title mt-5">
				<h2 class="text-center">Doctor Log In</h2>
					<?php if(isset($_SESSION["error"])) { ?>
						<p style="color:crimson"><?php $_SESSION["error"]; ?></p>
					<?php unset($_SESSION["error"]); } ?>
			</div>

			   <div class="form-group">
				   <label for="docMail">Doctor Email</label>
				   <input type="text" name="txtDocMail" class="form-control" placeholder="Enter email account" id="docMail" required/>

			   </div>

			   <div class="form-group">
				   <label for="password">Password</label>
				   <input type="password" name="txtPassword" class="form-control" placeholder="Enter password" id="password" required/>

			   </div>

			   <div class="form-group">
				   <input type="checkbox" name="remember" value="1"> Remember Me
			   </div>
			   
			   <button type="submit" class="btn btn-secondary ml-5 mr-5 mt-3" name="btnLogin">Log In</button>
			   <button type="reset" class="btn btn-secondary mt-3">Cancel</button>
			   
			   <span>
				   <?php
					   if(isset($_SESSION['message'])){
						   echo $_SESSION['message'];
					   }
					   unset($_SESSION['message']);
				   ?>
			   </span>
		   </form>

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
    
        
</body>
</html>