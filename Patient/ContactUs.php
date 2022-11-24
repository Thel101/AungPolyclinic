<?php

include ('Autoid.php');
include ('Connect.php');

if(isset($_POST['btnFeedback']))
{
    $messageID=AutoID('Messages','MessageID','MD-', 6);
    $name=$_POST['txtName'];
    $email=$_POST['txtEmail'];
    $contact=$_POST['txtContact'];
    $comment=$_POST['txtComments'];
    $replymethod=$_POST['checkEmail'];

    $insert="INSERT INTO `Messages`(`MessageID`, `UserName`, `UserEmail`, `Contact`, `Subject`, `ReplyMethod`, `MessageDate`) 
    VALUES ('$messageID','$name','$email','$contact','$comment','$replymethod',now())";
    $query=mysqli_query($connect,$insert);

    if ($query)
    {
        echo "<script>window.alert('Thank you for your enquiry. Your message will be replied soon!')</script>";
        echo "<script>window.location='Home.php'</script>";
    }
    else
    {
        echo "<p>Something Went Wrong in Sending message " . mysqli_error($connect) .  "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<?php
$page='Contact';
include('header.php');
?>
<div class="container-fluid">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
    </ol>
    </nav>
    <div class="row">
        <div class="col-sm-6">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="card-title">
                        <h4>We like to hear from you!</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="ContactUs.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                        <label >Name</label>
                        <input type="text" name="txtName" class="form-control" placeholder="Enter name here">
                        </div>

                        <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="txtEmail" class="form-control" placeholder="example@gmail.com">
                        </div>

                        <div class="form-group">
                        <label>Contact number</label>
                        <input type="text" name="txtContact" class="form-control" placeholder="Enter your phone number">
                        </div>

                        <div class="form-group">
                        <label for="comments">Your comments</label>
                        <textarea name="txtComments" id="comments" class="form-control"> Your comments here </textarea>
                        </div>
                        <!-- check box -->
                        <input type="checkbox" id="emailCheck" name="checkEmail" value="email">
                        <label for="emailCheck"> Receive information with email</label>
                        <p class="text-success font-weight-bold">(If you want to receive reply from our clinic via email, check this box.)</p>

                        <!-- check box -->

                        <button class="btn btn-primary" type="submit" name="btnFeedback">Submit feedback</button>
                        

                    </form>
                    <div class="alert alert-danger my-3" role="alert">
                    You can send suggestion or enquires to the clinic by clicking 'Submit feedback'.
                    We will contact you within the office hour via phone call.</p>
                    </div>
                    </div>
                   
            </div>
        </div>

        <div class="col-sm-6" >
            <div class="card mt-3" >
                <div class="card-body py-3" style="height: 300px;" id="Contact">
                    <p class="font-weight-bold my-2">For further inquires you can contact us via</p>
                    <a class="my-2" href="#"><i class="fa-solid fa-phone px-2 py-2"></i>09-44022321</a> <br>
                    <p class="font-weight-bold mt-2">For general enquires</p>
                    <a class="mt-2" href="#"><i class="fa-regular fa-envelope px-2 py-2"></i>aungpolyclinic@gmail.com</a>
                    <p class="my-2">within office hour 9 am to 9 pm</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>
</body>
</html>