<?php
session_start();

//echo $_SESSION['active_individual_patient_ID'];
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=1){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}

$con=null;
require 'php/DB_Connect.php';

$sql = "SELECT * FROM `medinventory` WHERE stock <= 100 AND expdate > NOW()";
$countres = mysqli_query($con,$sql);
$count = mysqli_num_rows($countres);
$sql2 = "SELECT * FROM `medinventory` WHERE stock = 0";
$countres2 = mysqli_query($con,$sql2);
$count4 = mysqli_num_rows($countres2);
$exptab = "Select * from `medinventory`  where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY";
$expire = "Select * from `medinventory` where `expdate` < NOW()";
$res1 = mysqli_query($con,$expire);
$res2 = mysqli_query($con,$exptab);
$count2 = mysqli_num_rows($res1);
$count3 = mysqli_num_rows($res2);
$critstocks = "There ".$count." Critical Stocks in our Inventory";
$toexp = "There ".$count3." To Expire Medicine in our Inventory";
$exp = "There ".$count2." Expired Medicine in our Inventory";
$ofs = "There ".$count4." Out of Stocks in our Inventory";


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
       <link rel="stylesheet" href="scss/notif.css">
       <!--Table sortable-->
       <script src="js/table-sortable.js"></script>
       <script>
           //<!--Get admin info from session-->
           $(document).ready(function () {
               Notif();
               $.post('php/admin_session.php').done(
                   function (data) {
                       let result = JSON.parse(data)
                       $("#name-sidebar").html(result.admin_name)
                   }
               )



               function Notif(){
                   var data = true;
                   $.ajax({
                       url:"php/inventoryProcesses/Notif_function.php",
                       method: "POST",
                       data: {data},
                       success:function(data){
                           $('.count').html(data);

                       }
                   })
               }
               setInterval(Notif,1000);

           $(function() {
               $(".navbar").click(function() {
                   $(".dropdown").toggle();
               });
           });
               function setPatientInfo() {

               }
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
                           $("#address").html("Purok "+arrayOfObjectElement.purok +", "+ arrayOfObjectElement.house_no +" "+arrayOfObjectElement.address)
                           $("#occupation").html(arrayOfObjectElement.occupation)
                           $("#blood-type").html(arrayOfObjectElement.blood_type)
                           $("#height").html(arrayOfObjectElement.height)
                           $("#weight").html(arrayOfObjectElement.weight)

                           //ung nasa hidden input sa modal
                           $("#purok").val(arrayOfObjectElement.purok)
                       }
                   }
               )

           });//document ready
       </script>
       <script src="evo-calendar-master/evo-calendar/js/evo-calendar.min.js"></script>
       <script src="js/individual-patient.js"></script>
        <style>
            /*override css of calendar*/
            .calendar-events{
                /*default is 0*/
               z-index: 999;
                box-shadow: -7px 1px 16px 0px rgba(0,0,0,0.36);
                -webkit-box-shadow: -7px 1px 16px 0px rgba(0,0,0,0.36);
                -moz-box-shadow: -7px 1px 16px 0px rgba(0,0,0,0.36);

            }
            .event-header{
                transition: 1s;
            }
            .event-container,p{
                /*transition: transform 500ms;*/
            }
            .event-container:hover{
                margin-top: 1.5rem;
                transform: scale(1.1);
            }
            #eventListToggler{
                /*default is 1*/
                z-index: 1000;
            }
            .ui-tooltip {
                padding: 10px 20px;
                color: black;
                border-radius: 20px;
                background-color: white;
                font: bold 14px "Helvetica Neue", Sans-Serif;
                text-transform: uppercase;
            }
        </style>
<!--       <script>-->
<!--           $(document).mousemove(function(){-->
<!--               if($(".event-container:hover").length != 0){-->
<!--                   $(".event-header").css("display","none")-->
<!--               } else{-->
<!--                   $(".event-header").css("display","block")-->
<!--               }-->
<!--           });-->
<!--       </script>-->
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
                        <li><a href="dashboard-admin.php" class="dashboard">Dashboard</a></li>
                        <li><a href="patient.php" class="patient">Patient</a></li>
                        <li><a href="reports.php" class="reports">Reports</a></li>
                        <li><a href="track-map.php" class="trackMap">Track Map</a></li>
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
                            <div class="navbar">
                                <ul class="notif" >
                                    <li>

                                        <a href="#">

                                            <i style="cursor: pointer" class="fa fa-bell-o"></i>

                                            <span class="count">3</span>
                                        </a>

                                        <ul class="dropdown">
                                            <?php
                                            if($count >= 0){
                                                ?><li><?php
                                                echo $critstocks;
                                                ?></li><?php
                                            }
                                            ?>
                                            <?php
                                            if($count > 0){
                                                ?><li><?php
                                                echo $toexp;
                                                ?></li><?php
                                            }
                                            ?>
                                            <?php
                                            if($count > 0){
                                                ?><li><?php
                                                echo $exp;
                                                ?></li><?php
                                            }
                                            ?>
                                            <?php
                                            if($count > 0){
                                                ?><li><?php
                                                echo $ofs;
                                                ?></li><?php
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                </ul>

                            </div>
                           <a href="profile.php"><i class="fas fa-user-circle"></i></a>
                           <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a> 
                           <a id="close-dropdown"><i class="fas fa-times"></i></a>
                            <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"></i></a>
                           <a id="close-mobile-menu"><i class="fas fa-times"></i></a>
                                <!--MOBILE MENU-->
                                <div class="menu-mobile " id="menu">
                                   <ul>
                                    <li><a href="dashboard-admin.php"><i class="fas fa-columns"></i>Dashboard</a></li>
                                    <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                                    <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                                    <li><a href="track-map.php"><i class="fas fa-map-marker"></i>Track Map</a></li>
                                       <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
                                   </ul>
                                </div>
                           <!--DROPDOWN SETTINGS-->
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
                                 <a href="#" id="trigger-view-edit-btn">Update Info</a>
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
                               <div class="search-container flex-box-row justify-content-end margin-top-1">
                                   <input type="text" id="search-med-history" class="search-bar" style="width: 40%"> <a href="/"><i class="fas fa-search"></i></a>
                               </div>
                               <div id="history-filter" class="row margin-top-1">

                                   <div class="col-sm-12 align-items-center justify-content-start flex-box-row">
                                       <div class="flex-box-row">
                                           <input type="radio" name="med-filter" value="All" checked><p class="modal-p med-filter-p">View All</p>
                                       </div>
                                       <div class="flex-box-row">
                                           <input type="radio" name="med-filter" value="Active"><p class="modal-p med-filter-p">Currently Taking</p>
                                       </div>
                                       <div class="flex-box-row">
                                           <input type="radio" name="med-filter" value="Finished"><p class="modal-p med-filter-p">Finished Medication/Vaccination</p>
                                       </div>
                                   </div>
                                   <style>
                                       #history-filter{
                                           padding:1rem;
                                       }
                                       #history-filter div div{
                                          margin: 0 1em;
                                           align-items: center;
                                       }
                                       .med-filter-p{
                                           display: inline-block;
                                           padding-right: 0.2rem!important;
                                       }
                                       input[name="med-filter"]{
                                       margin-right: 0.6rem;
                                       }
                                   </style>
                               </div>
                              <div class="patient-content__medical-history-container" id="pagination">
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
                               <style>
                                   .gs-pagination{
                                       margin: 1em;
                                   }
                                   .gs-pagination .row .col-md-6 span{
                                       font-size: clamp(0.4rem,0.8rem,1rem);
                                   }
                                   .gs-button,.gs-button span{
                                      color:#383838;
                                   }
                                   .btn-group button,.btn-group button span{/*sa pagination na button*/
                                       outline: none;
                                       padding: 0.2em 0.3rem;
                                       margin: 0.2%;
                                       word-wrap: normal;
                                   }
                                   @media(max-width: 1150px) {
                                       td{
                                           font-size: clamp(0.4rem,0.8rem,1rem);
                                       }
                                   }
                               </style>

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
require 'updateMedication.html';
require 'edit-patient-info.html';
require 'edit-patient-info-script.html';
?>

   <input type="hidden" id="hidden-refresh-button">

      <!--Modal for loading-->
      <div id="pop-up-loading" class="modal">
          <div style="display: flex;align-items: center;justify-content: center">
              <div class="loader"></div>
              <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
                  Loading...
              </p>
              <a href="#pop-up-loading" rel="modal:close" id="close-loading" style="display: none">
              </a>
          </div>
      </div>

      <!--Modal for error-->
      <div class="modal" id="pop-up-error">
          <div class="flex-box-row justify-content-center align-items-center">
              <img class="modal-header-icon" src="img/Icons/exclamation-mark.png">
              <p class="modal-p" id="pop-up-error-message">Please fill all the required fields!</p>
          </div>

          <div class="flex-box-row justify-content-end align-items-end">
              <a href="#pop-up-error" rel="modal:close">
                  <button class="modal-primary-button" style="margin-right: 0.5rem">Okay</button>
              </a>
          </div>
      </div>

      <!--Modal for success-->
      <div class="modal" id="pop-up-success">
          <div class="flex-box-row justify-content-center align-items-center">
              <img class="modal-header-icon" src="img/check.png">
              <p class="modal-p" id="pop-up-success-message">Patient information successfully modified</p>
          </div>

          <div class="flex-box-row justify-content-end align-items-end">
              <a href="#pop-up-success" rel="modal:close">
                  <button class="modal-primary-button" id="pop-up-success-ok-btn" style="margin-right: 0.5rem">Okay</button>
              </a>
              <script>
                  $("#pop-up-success-ok-btn").on('click',function () {
                      //location.reload()
                  })
              </script>
          </div>
      </div>

      <!--Modal for loading-->
      <div id="pop-up-loading" class="modal">
          <div style="display: flex;align-items: center;justify-content: center">
              <div class="loader"></div>
              <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
                  Processing Request...
              </p>
          </div>
      </div>
   </body>
</html>