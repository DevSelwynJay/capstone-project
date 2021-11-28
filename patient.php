<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--Custom CSS-->
      <link rel="stylesheet" href="scss/main.css">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <title>Patient</title>
       <!--Jquery-->
       <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

   </head>
   <body>
      <section class="global">
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
                           <img src="img/HIS logo blue.png" alt="">
                        </div>
                        <div class="settings">
                           <a><i class="fas fa-user-circle"></i></a> 
                           <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a> 
                           <a id="close-dropdown"><i class="fas fa-times"></i></a>

                           <div class="drop-down-settings" id="dropdown">
                               <ul>
                               <li><a href="">Approve EMR</a></li>
                                        <li><a href="settings.php">settings</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="php/sessionDestroy.php">Logout</a></li>
                               </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="search-tab">
                        <div class="search-container col-sm-4">
                           <input type="text" class="search-bar">
                           <a href="/"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="details-settings">
                           <a href="/">View Details</a>
                           <a href="/">Edit Details</a>
                        </div>
                     </div>
                     <div class="content patients-view-container">


                       
                        <table class="patients-view">
            <tbody>
                <tr class="patients-view-title">
                    <th>Patient Id</th>
                    <th>Patient Name</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Gender</th>
                </tr>

                <tr class='clickable-row' data-href='http://localhost/capstone-project/individual-patient.php'>

                   <td>01</td>
                    <td>Name</td>
                    <td>Hagonoy</th>
                    <td>21</td>
                    <td>M</td>


                </tr>

                <tr>
                    <td>02</td>
                    <td>Name</td>
                    <td>Hagonoy</th>
                    <td>21</td>
                    <td>M</td>

                </tr>
              
               
              
               
               
            </tbody>
        </table>


                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      
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
   jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

   </body>
</html>