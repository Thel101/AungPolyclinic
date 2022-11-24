<?php
$page='Help';
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
    <div class="row">
 
    <div class="col-md-6">
    <p class="lead mt-3">General</p>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
        <a data-toggle="collapse" href="#What" role="button" aria-expanded="false" aria-controls="collapseExample">
            What is Aung Polyclinic?
        </a>
        <div class="collapse" id="What">
        <div class="card card-body">
         Aung Polyclinic is a specialist clinic, offering specialists' consultaiton and check up medical services.
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#Opening" role="button" aria-expanded="false" aria-controls="collapseExample">
            What is the clinic's opening hours?
        </a>
        <div class="collapse" id="Opening">
        <div class="card card-body">
         Aung Polyclinic provides quality medical service 24/7 round the clock. 
         Specialist consultations are accepted between 7 am to 9 pm.
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#Ambulance" role="button" aria-expanded="false" aria-controls="collapseExample">
            Does Aung Polyclinic provides ambulance service?
        </a>
        <div class="collapse" id="Ambulance">
        <div class="card card-body">
         Aung Polyclinic provides ambulance service for critical and emergency patient. Call <a href="#" class="text-success">+01-522537 </a> for more details.
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#inPatient" role="button" aria-expanded="false" aria-controls="collapseExample">
            Does Aung Polyclinic accepts in-patients?
        </a>
        <div class="collapse" id="inPatient">
        <div class="card card-body">
         Aung Polyclinic provides ambulance service for critical and emergency patient. Call <a href="#" class="text-success">+01-522537 </a> for more details.
        </div>
        </div>
        </li>
    </ul>
    </div>
    <div class="col-md-6">
    <p class="lead mt-3">Booking appointments for doctors</p>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
        <a data-toggle="collapse" href="#doc1" role="button" aria-expanded="false" aria-controls="collapseExample">
            Is online consultation available?
        </a>
        <div class="collapse" id="doc1">
        <div class="card card-body">
         Yes. Aung polyclinic does provide online consultation via various channels such as telegram, vibers,skype and signal.
         You can book <a href="SpecialtyDisplay.php">here</a> for various specialties depending on your symptoms.
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#Booking" role="button" aria-expanded="false" aria-controls="collapseExample">
            How do I book for doctors?
        </a>
        <div class="collapse" id="Booking">
        <div class="card card-body">
        You first need to know your specific symptoms to choose specialists. 
        If you don't know which specialty to choose, we recomment you to see 
        'General Practitioner' first. The doctor will then refer you to corresponding doctor.
        To book appointments, you need to log in first to your account.
<pre class="mt-3" >
Step 1: Log in <a href="Patient_login.php">here</a>. If you haven't registered, create account <a href="Patient_Registration.php">here</a>
Step 2: Select Specialty <a href="SpecialtyDisplay.php">here</a>.
Step 3: Click 'Book Appointment' button.
Step 4: If you book for yourself, the system will automatically fill in
        your registered data.
        If you are booking for someone else, click 'Book for someone else'
        and fill in the required data.
Step 5: Click 'Confirm Appointment' if you are sure to book for the doctor.
</pre>
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#Delete" role="button" aria-expanded="false" aria-controls="collapseExample">
            Can I cancel my booked Appointments?
        </a>
        <div class="collapse" id="Delete">
        <div class="card card-body">
        Unfortunately, you cannot cancel the booked appointment by yourself. You will have to contact to the clinic via sending messages <a href="ContactUs.php">here</a>
        or you can call <a href="#">555-666-7777</a>. 
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#Details" role="button" aria-expanded="false" aria-controls="collapseExample">
          Where can I view my Appointment details?
        </a>
        <div class="collapse" id="Details">
        <div class="card card-body">
        You can see all of your appointments and upload your old medical records <a href="PatientDashboard.php">here</a> 
        </div>
        </div>
        </li>

    </ul>
    </div>

    <div class="col-md-6">
    <p class="lead mt-3">Booking appointments for medical services</p>
        <ul class="list-group list-group-flush">
        <li class="list-group-item">
        <a data-toggle="collapse" href="#Service" role="button" aria-expanded="false" aria-controls="collapseExample">
           How can I know the available services?
        </a>
        <div class="collapse" id="Service">
        <div class="card card-body">
         Aung Polyclinic provides a wide variety of medical services both in clinic and with home service.
         You can view the available services 
         <a href="MedicalServiceDisplay.php">here</a>
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#serviceBooking" role="button" aria-expanded="false" aria-controls="collapseExample">
           How do I book for medical services?
        </a>
        <div class="collapse" id="serviceBooking">
        <div class="card card-body">
        To book appointments, you need to log in first to your account.
<pre class="mt-3" >
Step 1: Log in <a href="Patient_login.php">here</a>. If you haven't registered, create account <a href="Patient_Registration.php">here</a>
Step 2: Select Services <a href="MedicalServiceDisplay.php">here</a>.

</pre>
        </div>
        </div>
        </li>

        <li class="list-group-item">
        <a data-toggle="collapse" href="#What" role="button" aria-expanded="false" aria-controls="collapseExample">
            
        </a>
        <div class="collapse" id="What">
        <div class="card card-body">
         Aung Polyclinic is a specialist clinic, offering specialists' consultaiton and check up medical services.
        </div>
        </div>
        </li>

    </ul>
    </div>
           
    </div>
    </div>

<?php
include('footer.php');
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>