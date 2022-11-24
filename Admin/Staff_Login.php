<?php
session_start();
include ('Connect.php');
	if (isset($_POST['btnLogin'])) 
	{
	
		$staffEmail= $_POST['txtStaffMail'];
		$Password = $_POST['txtPassword'];
	
	
	$select="SELECT * FROM Staff where staffEmail='$staffEmail' and Password='$Password'";
	$query=mysqli_query($connect,$select);
	$count=mysqli_num_rows($query);
	$row=mysqli_fetch_array($query);
		if($count < 1)
		{
		echo "<script>alert('Staff Login Fail!')</script>";
		echo "<script>window.location='Staff_Login.php'</script>";
		}
		else
		{
			$_SESSION['staffID']= $row['StaffID'];
			$_SESSION['staffName'] =$row['staffName'];
			echo "<script>alert('Staff Login Success!')</script>";
			echo "<script>window.location='Dashboard.php'</script>";
		}

	}		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Staff Log In</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container">
    
        <div class="row pt-3 justify-content-center">
			<div class="col-md-4">
           <div class="card text-white bg-secondary">
			   <div class="card-header">
				<div class="card-title"><h3 class="text-center">Staff log-in</h3></div>
			   </div>
			   <div class="card-body">
			   <form action="Staff_Login.php" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="staffMail">Staff Email</label>
                    <input type="text" name="txtStaffMail" class="form-control" placeholder="Enter staff email account" id="staffMail" required/>

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="txtPassword" class="form-control" placeholder="Enter password" id="password" required/>

                </div>

				<div class="form-group">
					<input type="checkbox" name="remember" value="1"> Remember Me
				</div>
                
                <button type="submit" class="btn btn-primary ml-4 mr-4 mt-3" name="btnLogin">Log In</button>
				<a href="Dashboard.php" class="btn btn-secondary btn-light mt-3">Cancel</a>
                
                
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
		   </div>
          
</body>
</html>