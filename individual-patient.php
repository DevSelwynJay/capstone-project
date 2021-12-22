<?php
session_start();
//echo $_SESSION['active_individual_patient_ID'];
?>
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
      <title>Individual Patient</title>
       <!--CSS Grid Bootstrap-->
       <link rel="stylesheet" href="scss/bootstrap-grid.css">
       <style>
           .col-sm-12{
               padding: 0;
           }
       </style>
       <!--Custom CSS-->
       <link rel="stylesheet" href="scss/main.css">
      <link rel="stylesheet" href="evo-calendar-master/evo-calendar/css/evo-calendar.css">
      <link rel="stylesheet" href="evo-calendar-master/evo-calendar/css/evo-calendar.midnight-blue.min.css">
       <!--Custom Modal Design-->
       <link rel="stylesheet" href="scss/modal.css">
       <!--Jquery-->
       <!--      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
       <script src="js/jquery-3.6.0.js"></script>
       <!--EVO Calendar Script-->
       <script src="js/evo-calendar.js"></script>
       <!-- jQuery Modal-->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
       <!--Jquery UI css and js-->
       <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
       <script src="jquery-ui/jquery-ui.js"></script>
       <link rel="stylesheet" href="scss/tooltip.css">
       <!--Custom CSS-->
       <link rel="stylesheet" href="scss/scrollbar_loading.css">
       <!--Custom Modal Design-->
       <link rel="stylesheet" href="scss/modal.css">

       <script>
           //<!--Get admin info from session-->
           $(document).ready(function () {
               $.post('php/admin_session.php').done(
                   function (data) {
                       let result = JSON.parse(data)
                       $("#name-sidebar").html(result.admin_name)
                       $("#modal-admin-name").html("Given by: "+result.admin_name)
                   }
               )
               ///<!--Set patient info to page-->
               $.post('php/patientProcesses/retrieveIndivPatient.php').done(
                   function (data) {
                       let arrayOfObject = JSON.parse(data);//row info ni patient
                       //let size = arrayOfObject.length;
                       for (let arrayOfObjectElement of arrayOfObject) {//one time lang aandar
                           ///alert(arrayOfObjectElement.first_name)
                           let name = arrayOfObjectElement.first_name+" "+arrayOfObjectElement.middle_name+
                               " "+arrayOfObjectElement.last_name
                           $("#name").html(name);
                           $("#modal-patient-name").html("To: "+name);
                           $("#patient-type").html(arrayOfObjectElement.patient_type)
                           $("#modal-patient-type").html("Type: "+arrayOfObjectElement.patient_type)
                           $("#gender").html(arrayOfObjectElement.gender)
                           $("#age").html(arrayOfObjectElement.age)
                           $("#address").html("Purok "+arrayOfObjectElement.purok +" #"+arrayOfObjectElement.address)
                           $("#occupation").html(arrayOfObjectElement.occupation)
                           $("#blood-type").html(arrayOfObjectElement.blood_type)
                           $("#height").html(arrayOfObjectElement.height+" "+"cm")
                           $("#weight").html(arrayOfObjectElement.weight+" "+"kg")

                           //ung nasa hidden input sa modal
                           $("#purok").val(arrayOfObjectElement.purok)
                       }
                   }
               )
           })//document ready

       </script>
       <script src="evo-calendar-master/evo-calendar/js/evo-calendar.min.js"></script>
       <script src="js/individual-patient.js"></script>
   </head>
   <body>
      <?php require 'add-prescription.html'?>
      <section class="global">
         <div class="global__container">
            <div class="global__sidenav">
               <div class="inner-sidenav">
                  <div class="spacer">
                     <div class="profile">
                        <div class="profile-img">
                           <img src="img/jay.jpg" alt="">
                        </div>
                        <h4 id="name-sidebar"></h4>
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
                                    <li><a href="dashboard-admin.html"><i class="fas fa-columns"></i>Dashboard</a></li>
                                    <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                                    <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                                    <li><a href="track-map.html"><i class="fas fa-map-marker"></i>Track Map</a></li>
                                    <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
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
                              <a class="back-btn"><i class="fas fa-arrow-circle-left"></i></a>
                           </div>
                           <div class="add-prescription">
                              <a id="add-prescription-modal-caller"><i class="fas fa-plus"></i>Add Prescription</a>
                               <script>
                                   $("#add-prescription-modal-caller").click(function () {
                                       $("#add-pres-modal").modal({
                                           //showClose:false
                                       })
                                   })
                               </script>
                           </div>
                        </div>
                        <div class="patient-content__container">
                           <div class="patient-content__name holder">
                              <div class="patient-content__name-container">
                                 <i class="fas fa-user-circle" aria-hidden="true"></i>
                                 <p id="name">Selwyn Jay D. Faustino</p>
                                 <a href="/">View</a>
                              </div>
                           </div>
                           <div class="patient-content__information holder">
                              <p>Information</p>
                              <table>
                                  <tr>
                                      <td><strong>Type</strong></td>
                                      <td id="patient-type">Senior</td>
                                  </tr>
                                 <tr>
                                    <td><strong>Gender</strong></td>
                                    <td id="gender">M</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Age</strong></td>
                                    <td id="age">21</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Address</strong></td>
                                    <td id="address">Address</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Occupation</strong></td>
                                    <td id="occupation">n/a</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Blood Type</strong></td>
                                    <td id="blood-type">O</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Height</strong></td>
                                    <td id="height">6'1</td>
                                 </tr>
                                 <tr>
                                    <td><strong>Weight</strong></td>
                                    <td id="weight">70</td>
                                 </tr>
                              </table>
                           </div>
                           <div class="patient-content__calendar holder">
                              <p>Medication/Vaccination Calendar</p>
                              <div id="calendar"></div>
                           </div>
                           <div class="patient-content__medical-history holder">
                              <p>Medication/Vaccination History</p>
                              <div class="patient-content__medical-history-container">
                                 <table id="patient-history-table">
                                    <tr>
                                       <th>Name</th>
                                       <th>Type</th>
                                       <th>Date Given</th>
                                       <th>Description</th>
                                    </tr>
<!--                                    <tr>-->
<!--                                       <td>Jay</td>-->
<!--                                       <td>Vaccination</td>-->
<!--                                       <td>11/20/2021</td>-->
<!--                                       <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque, quasi.</td>-->
<!--                                    </tr>-->
<!--                                    <tr>-->
<!--                                       <td>Jay</td>-->
<!--                                       <td>Vaccination</td>-->
<!--                                       <td>11/20/2021</td>-->
<!--                                       <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque, quasi.</td>-->
<!--                                    </tr>-->
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
<?php
require 'add-prescription-script.html';
?>

   <input type="hidden" id="hidden-refresh-button">
   </body>
</html>