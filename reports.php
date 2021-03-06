<?php
session_start();
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=1){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
$con=null;
require 'php/DB_Connect.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/favicon-sto.png" />
 <!--Bootstrap-->
 <link rel="stylesheet" href="scss/bootstrap-grid.css">
  <!--Custom CSS-->
  <link rel="stylesheet" href="scss/main.css">

    <!--Font Awesome-->
<script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
<!-- Font Family Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<title>Reports</title>
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.js"></script>
    <link rel="stylesheet" href="scss/notif.css">
    <style>
        .drop-down-settings,.drop-down-settings open{
            z-index: 1000;
        }
    </style>
    <!--Get admin info from session-->
    <script>
        $(document).ready(function () {
            $.post('php/admin_session.php').done(
                function (data) {
                    let result = JSON.parse(data)
                    $("#name-sidebar").html(result.admin_name)
                }
            )

        });
    </script>

<!--==========FOR NOTIFICATION SCRIPT ===========================-->
<script src="notif/notif.js"></script>
<!--==========Notification Style ===========================-->
<link rel="stylesheet" href="notif/notif.css">



</head>
<body>
   <section class="global">
      <div class="global__container">
         <div class="global__sidenav">
            <div class="inner-sidenav">
               <div class="spacer">
                  <div class="profile">
                     <div class="profile-img">
                        <img src="img/user3.png" alt="">
                     </div>
                     <h4 id="name-sidebar">Your Name</h4>
                  </div>
                  <ul class="menu">
                     <li><a href="dashboard-admin.php" class="dashboard">Dashboard</a></li>
                     <li><a href="patient.php" class="patient" >Patient</a></li>
                     <li><a href="reports.php" class="reports" style="background: var(--hover-color)">Reports</a></li>
                     <li><a href="track-map.php" class="trackMap">Vaccine Graph</a></li>
                     <li><a href="inventory.php" class="inventory">Inventory</a></li>
                     <?php include 'sidebarFix.html' ?>
                  </ul>
               </div>
            </div>
         </div>
         <div class="global__main-content">
            <div class="inner-page-content">
               <div class="col-sm-12 p-0">
                  <div class="inner-page-nav">
                     <div class="logo">
                        <img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
                        <img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
                     </div>
                     <div class="settings">
                        <a class="notification-toggle">
                        <i style="cursor: pointer" class="fa fa-bell-o"></i>
                        <span class="counter">3+</span>
                        </a>
                        <!--START UPDATED NOTIF STYLING-->
                        <ul class="notification-dropdown">
                           <li>Lorem ipsum dolor sit amet consectetur </li>
                           <li>Lorem ipsum dolor sit amet consectetur </li>
                           <li>Lorem ipsum dolor sit amet consectetur </li>
                        </ul>
                        <!--END UPDATED NOTIF STYLING-->
                        <a href="profile.php"><i class="fas fa-user-circle"></i></a>
                        <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
                        <a id="close-dropdown"><i class="fas fa-times"></i></a>
                        <div class="drop-down-settings" id="dropdown">
                           <ul>
                              <li><a href="approveEMR.php">Approve EMR</a></li>
                              <li><a href="settings.php">settings</a></li>
                              <li><a href="about.php">About</a></li>
                              <li><a href="php/sessionDestroy.php">Logout</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <!--MOBILE MENU-->
                  <div class="menu-mobile " id="menu">
                     <ul>
                        <li><a href="dashboard-admin.php"><i class="fas fa-columns"></i></a></li>
                        <li><a href="patient.php"><i class="fas fa-user"></i></a></li>
                        <li class="active"><a href="reports.php"><i class="fas fa-chart-bar"></i></a></li>
                        <li><a href="track-map.php"><i class="fas fa-map-marker"></i></a></li>
                        <li><a href="inventory.php"><i class="fas fa-box"></i></a></li>
                     </ul>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="reports_content">
                     <div class="row-container">
                        <div class="left-column col-md-12 order-md-2 col-lg-8">
                           <div class="reports__left-col">
                              <h2 style="color:var(--third-color);font-weight: bold">Today&#39;s Patients</h2>
                              <h2 style="color:var(--third-color);font-weight: bold">Medical Consultation</h2>
                              <div class="reports__left-col-container">
                                 <button id="nakatagoreport" style="display: none"></button>
                                    <?php
                                    include "reportMain.html";
                                    ?>
                              </div>
                           </div>
                           <div class="reports__left-col">
                              <h2 style="color:var(--third-color);font-weight: bold">Vaccination Consultation</h2>
                              <div class="reports__left-col-container">
                                 <button id="nakatagoreport2" style="display: none"></button>
                                   <?php
                                    include "reportMain2.html";
                                    ?>
                              </div>
                           </div>
                        </div>
                        <div class="right-column col-md-12  order-md-1 col-lg-4">
                           <div class="reports__right-col">
                              <div class="reports__right-col_links">
                                 <a href="medicine-reports.php">Medicine</a>
                                 <a href="consultation-reports.php">Consulted</a>
                                 <a href=vaccination-reports.php>Vaccinated Patient</a>
                              </div>
                              <div class="mobile-select">
                                 <select id="tab-mobile" onchange="javascript:handleSelect(this)">
                                    <option selected="selected">Choose options</option>
                                    <option value="medicine-reports.php">Medicine</option>
                                    <option value="consultation-reports.php">Consulted</option>
                                    <option value="vaccination-reports.php">Vaccinated Patient</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <script type="text/javascript">
      function handleSelect(elm)
      {
      window.location = elm.value;
      }
   </script>
   <script>
      $(document).ready(function(){
          $('#nakatagoreport').trigger("click");
          $('#nakatagoreport2').trigger("click");
      })
      
   </script>
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
      const toggle = document.querySelector('.notification-toggle');
      const drop = document.querySelector('.notification-dropdown');
      
      
      toggle.addEventListener('click', function () {//Conditions
          if (drop.classList.contains('notification--show')) { // Close Mobile Menu
              drop.classList.remove('notification--show');
          }
          else {
              drop.classList.add('notification--show');
          }
      });
   </script>
   <script src="js/table-sortable.js"></script>
   <style>
      .active{
      background: var(--primary-color)!important;
      color: var(--secondary-color)!important;
      border:none!important;
      padding: 0.5em 0.5rem!important;
      }
      .btn-default{
      border:1px solid var(--light-grey)!important;
      padding: 0.5em 0.5rem!important;
      }
      .gs-pagination{
      margin-top: 0.5em;
      }
      .gs-pagination .row .col-md-6 span{
      font-size: clamp(0.4rem,0.8rem,1rem);
      }
      .gs-button,.gs-button span{
      color: var(--secondary-color);
      }
      th{
      background: var(--primary-color);
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
      .gs-table-head tr th span {
      color: white!important;
      }
      #updatebtn{
      background-color: var(--primary-color);
      color: #f8f8f8 !important;
      padding: 0.6rem;
      border-radius: 0.4rem;
      -webkit-transition: all 200ms ease-in-out;
      transition: all 200ms ease-in-out;
      }
      #exclamation{
      color: #ff1515 !important;
      padding: 0.6rem;
      border-radius: 0.4rem;
      font-size: 1.4rem !important;
      cursor: unset !important;
      }
   </style>
</body>
</html>