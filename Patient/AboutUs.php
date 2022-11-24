<?php
$page='AboutUs';
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/49e8b61c53.js"></script>
</head>
<body>
    <div class="container-fluid">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About Us</li>
    </ol>
    </nav>
    <!-- youtube video -->
    <div class="col-md-4 offset-md-4">
    <iframe width="560" height="315" 
    src="https://www.youtube.com/embed/KmYm6zphh_A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    </iframe>
    </div>
    <!-- youtube video -->
    <div class="row mt-3">
        <div class="col-md-6">
        <div class="card">
       
        <div class="card-body">
        <h3 class="card-title">A better way to quality healthcare</h3>
        <p class="card-text">
        “Aung” polyclinic is a 24/7 specialist clinic in Mayangone Township, Yangon. 
        It has a pretty good reputation for quality services, a wide range of fields for medical consultations, 
        and the use of advanced technologies in imaging and blood testing services. 
        </p>
        <p><i class="fa-solid fa-location-pin"></i>
    Our clinic location :<pre> 
    64/ Middle Baho Road,
    Mayangone Township, Yangon (Near Muditar Housing)
    </pre></p>
        
      </div>
           
      </div>

        </div>
        <div class="col-md-6">
        <div class="card">
        <div class="card-body">
        <h3 class="card-title">The services we offer</h3>
        <p class="card-text">Aung polyclinic has been offering quality medical service since 2018.
            Aung Polyclinic offers families, individuals, and corporate clients trusted medical 
            care with the highest international standards. Our practitioners are experienced leaders in  
            healthcare industry.
        </p>
        <p>
    The services we provide include: <pre> 
    <i class="fa-solid fa-heart-pulse mr-2"></i><b>Routine medical check-up services</b>
    <i class="fa-solid fa-syringe mr-2"></i><b>Vaccination programs</b>
    <i class="fa-solid fa-truck-medical mr-2"></i><b>Home medical services</b>
    </pre></p>
        
      </div>

        </div>
        </div>
    </div>

<!--- featurette -->
<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 mt-5">
    
    <p class="lead ml-2 align-center">
    Providing the best medical service to you is our top priority. To make sure you
receive the best healthcare service, our board-certified 
doctors have to go through a very strict on-boarding process. 

Aung Polyclinic does not compromise on privacy and applies 
industry standard safety procedures and protocols for TeleHealth services.
    </p>
  </div>
  <div class="col-md-5">
    <img class="featurette-image img-fluid mx-auto" src="../Images/AboutUs2.jpeg" alt="Generic placeholder image">
  </div>
</div>

<!--- featurette -->
                
            </div>
            
        </div>
    </div>
   
    </div>
  <?php 
  include('footer.php');
  ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"  ></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
</body>
</html>