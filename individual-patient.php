<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <title>Patient</title>
      <!--Jquery-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!--Custom CSS-->
      <link rel="stylesheet" href="scss/style.css">
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
                           <img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
                           <img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
                        </div>
                        <div class="settings">
                           <a href="/"><i class="fas fa-user-circle"></i></a> 
                           <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a> 
                           <a id="close-dropdown"><i class="fas fa-times"></i></a>
                           <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"></i></a>
                           <a id="close-mobile-menu"><i class="fas fa-times"></i></a>
                           <!--MOBILE MENU-->
                           <div class="menu-mobile " id="menu">
                              <ul>
                              </ul>
                           </div>
                           <!--DROPDOWN SETTINGS-->
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
                     <div class="content">
                        <div class="patient-content__ctas">
                           <div class="back-button">
                              <a href="" class="back-btn"><i class="fas fa-arrow-circle-left"></i></a>
                           </div>
                           <div class="add-prescription">
                              <a href=""><i class="fas fa-plus"></i>Add Prescriptions</a>
                           </div>
                        </div>
                        <div class="patient-content__container">
                           <div class="patient-content__name holder">
                              <div class="patient-content__name-container">
                                 <i class="fas fa-user-circle" aria-hidden="true"></i>
                                 <p>Selwyn Jay D. Faustino</p>
                                 <a href="/">View</a>
                              </div>
                           </div>
                           <div class="patient-content__information holder">
                              <p>Information</p>
                              <table>
                                 <tr>
                                    <td><strong>Gender</strong></td>
                                    <td>M</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Age</strong></td>
                                    <td>21</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Address</strong></td>
                                    <td>Address</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Postal Code</strong></td>
                                    <td>3002</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Occupation</strong></td>
                                    <td>n/a</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Blood Type</strong></td>
                                    <td>O</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Height</strong></td>
                                    <td>6'1</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Weight</strong></td>
                                    <td>70</td>
                                 </tr>
                              </table>
                           </div>
                           <div class="patient-content__celendar holder">
                              <p>Calendar</p>
                           </div>
                           <div class="patient-content__medical-history holder">
                              <p>Medical History</p>
                              <div class="patient-content__medical-history-container">
                                 <table>
                                    <tr>
                                       <th>Name</th>
                                       <th>Type</th>
                                       <th>Date</th>
                                       <th>Description</th>
                                    </tr>
                                    <tr>
                                       <td>Jay</td>
                                       <td>Vaccination</td>
                                       <td>11/20/2021</td>
                                       <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque, quasi.</td>
                                    </tr>
                                    <tr>
                                       <td>Jay</td>
                                       <td>Vaccination</td>
                                       <td>11/20/2021</td>
                                       <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque, quasi.</td>
                                    </tr>
                                 </table>
                              </div>
                              <!--
                                 <div class="cta-prescription-container">
                                    <a class="cta-prescription" href="/"><i class="fas fa-plus"></i>Add Prescriptions</a>
                                 </div>
                                   -->
                           </div>
                        </div>
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