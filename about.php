<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--CSS Bootstrap-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!--custom CSS-->
<link rel="stylesheet" href="scss/main.css">
<!--Font Awesome-->
<script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
<!-- Font Family Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<title>About</title>
<!--Jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .drop-down-settings,.drop-down-settings open{
            z-index: 1000;
        }
    </style>
</head>
<body>


<section>

<div class="global__container">
<div class="global__sidenav">
<div class="inner-sidenav">
<div class="spacer">
<div class="profile">
<div class="profile-img">
<img src="img/jay.jpg" alt="">
</div>
<h4>Your Name</h4>
</div>
<ul class="menu">
<li><a href="dashboard-admin.html" class="dashboard">Dashboard</a></li>
<li><a href="patient.php" class="patient">Patient</a></li>
<li><a href="reports.php" class="reports">Reports</a></li>
<li><a href="track-map.html" class="trackMap">Track Map</a></li>
<li><a href="inventory.php" class="inventory">Inventory</a></li>
</ul>
</div>
<div class="social-media-links">
<i class="fab fa-facebook"></i>
<i class="fab fa-twitter"></i>
<i class="fab fa-instagram"></i>
</div>
</div>    
</div>
<div class="global__main-content">
<div class="inner-page-content">
<div class="col-sm-12">
<div class="inner-page-nav">
<div class="logo">
    <img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
    <img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
</div>
<div class="settings">
    <a href="profile.php"><i class="fas fa-user-circle"></i></a>
    <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
    <a id="close-dropdown"><i class="fas fa-times"></i></a>
    <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"></i></a>
    <a id="close-mobile-menu"><i class="fas fa-times"></i></a>
         <!--MOBILE MENU-->
         <div class="menu-mobile " id="menu">
            <ul>
             <li><a href="dashboard-admin.html"><i class="fas fa-columns"></i>Dashboard</a></li>
             <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
             <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
             <li><a href="track-map.html"><i class="fas fa-map-marker"></i>Track Map</a></li>
             <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
            </ul>
         </div>

    <div class="drop-down-settings" id="dropdown">
        <ul>
            <li><a href="">Approve EMR</a></li>
            <li><a href="settings.php">settings</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="php/sessionDestroy.php">Logout</a></li>
        </ul>
    </div>
</div>
</div>
</div>
<div class="col-sm-12">
<div class="content">
<h1>About Us</h1>
<div>
<div class="heading-holder">
<div class="line"></div>
<h2>our vision</h2>
<div class="line"></div>
</div>
</div>
<br>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis voluptates, qui quis corrupti, porro numquam quod nihil laborum dolor praesentium minus maiores! Illum magnam eum eaque necessitatibus praesentium sunt natus!</p>
<br><br>
<div>
<div class="heading-holder">
<div class="line"></div>
<h2>our mission</h2>
<div class="line"></div>
</div>
</div>
<br>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perspiciatis voluptates, qui quis corrupti, porro numquam quod nihil laborum dolor praesentium minus maiores! Illum magnam eum eaque necessitatibus praesentium sunt natus!</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!--Drop down script-->
<script>
    const dropdown = document.querySelector('#dropdown');
    const dropdownToggle = document.querySelector('#dropdown-toggle');
    const Closedropdown = document.querySelector('#close-dropdown');

    dropdownToggle.addEventListener('click',function(){//Conditions
        if(dropdown.classList.contains('open')){ // Close Mobile Menu
            dropdown.classList.remove('open');
        }
        else{ // Open Mobile Menu
            dropdown.classList.add('open');
        }});


    dropdownToggle.addEventListener('click',function(){
        dropdown.classList.add('open');
        dropdownToggle.style.display = "none";
        Closedropdown.style.display = "block"
    });

    Closedropdown.addEventListener('click',function(){
        dropdown.classList.remove('open');
        Closedropdown.style.display = "none"
        dropdownToggle.style.display = "block";
    });

</script>
<script>
    const menu = document.querySelector('#menu');
    const mobileMenu = document.querySelector('#mobile-menu');
    const closeMobileMenu = document.querySelector('#close-mobile-menu');
    
    mobileMenu.addEventListener('click',function(){//Conditions
    if(menu.classList.contains('open')){ // Close Mobile Menu
    menu.classList.remove('open');
    }
    else{ 
    menu.classList.add('open');
    }});
    
    
    mobileMenu.addEventListener('click',function(){
        menu.classList.add('open');
        mobileMenu.style.display = "none";
        closeMobileMenu.style.display = "block"
    });
    
    closeMobileMenu.addEventListener('click',function(){
       menu.classList.remove('open');
       closeMobileMenu.style.display = "none"
       mobileMenu.style.display = "block";
    });
 </script>
</body>
</html>