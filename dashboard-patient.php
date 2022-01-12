<?php
session_start();
if(!isset($_SESSION['email'])){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
else{
    $isPatient=false;
   foreach (array(2,3) as $item){

       if($item==$_SESSION['account_type']){
           $isPatient=true;
           break;
       }
   }
   if(!$isPatient){
       header("location:php/loginProcesses/redirect.php");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
      <!--Bootstrap-->
      <link rel="stylesheet" href="scss/bootstrap-grid.css">
       <!--Custom CSS-->
       <link rel="stylesheet" href="scss/main.css">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link
         href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
         rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="evo-calendar-master/evo-calendar/css/evo-calendar.css">
      <link rel="stylesheet" href="evo-calendar-master/evo-calendar/css/evo-calendar.midnight-blue.min.css">
       <!--Jquery-->
       <script src="js/jquery-3.6.0.js"></script>
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
       <!--EVO Calendar Script-->
       <script src="js/evo-calendar.js"></script>
       <!--Table sortable
       <script src="js/table-sortable.js"></script>-->
      <title>Dashboard Patient</title>
       <script>
           $(document).ready(function () {
               $.post("php/patientSide/patientSession.php").done(function (data){
                   let result = JSON.parse(data)
                    $(".patient-name").html(result.patient_name)
                    $("#age").html(result.age)
                   $("#gender").html(result.gender)
                   $("#bday").html(result.birthday)
                   if(result.contact_no.includes("none")){
                       $("#contact").html("none")
                   }
                   else {
                       $("#contact").html(result.contact_no)
                   }
                   $("#address").html(result.address)
               })
           })

       </script>
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
       </style>
   </head>
   <body>
      <section class="global">
         <div class="global__container">
            <div class="global__main-content">
               <div class="inner-page-content">
                  <div class="col-sm-12 p-0">
                     <div class="inner-page-nav">
                        <div class="logo">
                            <img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
                            <img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
                        </div>
                        <div class="settings">
                            <a href="profile-patient.php"><i class="fas fa-user-circle"></i></a>
                            <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a> 
                            <a id="close-dropdown"><i id="close-dropdown-2" class="fas fa-times"></i></a>
                            <!--
                            <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"></i></a>
                           <a id="close-mobile-menu"><i class="fas fa-times"></i></a>
                               
                                <div class="menu-mobile " id="menu">
                                   <ul>
                                    <li><a href="dashboard-admin.html"><i class="fas fa-columns"></i>Dashboard</a></li>
                                    <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                                    <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                                    <li><a href="track-map.html"><i class="fas fa-map-marker"></i>Track Map</a></li>
                                    <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
                                   </ul>
                                </div>
                                 -->
                          
                            <!--DROPDOWN SETTINGS-->
                            <div class="drop-down-settings" id="dropdown">
                               <ul>
                                  <li><a id="request_emr" href="#">Request EMR</a></li>
                                  <li id="logout"><a>Logout</a></li>
                               </ul>
                            </div>
                         </div>
                     </div>
                  </div>
                  <div class="dashboard-content">
                     <div class="row-container">
                        <div class="col-md-12 col-lg-8">

                           <div class="greetings-container">
                              <div class="text">
                                <div class="text-wrap">
                                    <h1 class="title">Welcome Back, <span class="patient-name" style=" color: #0c6893;">Name!</span></h1>
                                    <p>This is your online patient account link to your patient record on the admin side.
                                    </p>
                                    <p class="modal-p"><span style="color: darkred">Important Note: </span> If you cannot see any record on this online account, it means that you do not have any patient record on the admin side</p>
                                </div>
                              </div>
                              <img class="greetings-img" src="img/Icons/dashboard-img.png" alt="">
                               <style>
                                   .greetings-img{
                                       max-width: 10rem !important;
                                   }
                               </style>
                           </div>

                           <div class="calendar-container">
                               <h3>Calendar</h3>
                               <div id="calendar"></div>
                                 <script>
                                
const events = document.querySelector('.calendar-events');
const trigger = document.querySelector('.icon-button');//Event Listener
trigger.addEventListener('click',function(){//Conditions
if(events.classList.contains('open')){ // Close Mobile Menu
   events.classList.remove('open');
}
else{ // Open Mobile Menu
   events.classList.add('open');
}});

                                 </script>
                          </div>
                          
                           <div class="current-medication-container">
                            <h3>Current Medication</h3>
                            <table id="curr-med">
                                <tr>
                                   <th>Name</th>
                                   <th>Times per day</th>
                                   <th>Duration</th>
                                </tr>
                                <tr>
                                   <td>Jay</td>
                                   <td>4</td>
                                   <td>11/20/2021</td>
                                </tr>
                             </table>
                           </div>

                           <div class="vaccination-schedule-container">
                            <h3>Vaccination Schedule</h3>
                           
                            <table id="vacc-sched">
                                <tr>
                                   <th>Name</th>
                                   <th>Date</th>
                                </tr>
                                <tr>
                                   <td>Jay</td>
                                   <td>11/20/2021</td>
                                </tr>
                             </table>
                          
                           </div>

                        </div>
                        <div class="col-md-12 col-lg-4">
                           <div class="patient-details-container">
                              <div class="profile-image">
                                <img src="img/user3.png" alt=""><br>
                                  <h4 class="margin-top-1">Patient Information</h4>
                                <h2 class="patient-name">SURNAME, First Name, Middle Name</h2>
                              </div>

                              <div class="details-table">
                                 <table class="det-table">
                                    <tr>
                                       <td>Age</td>
                                       <td id="age">XXy/o</td>
                                    </tr>
                                    <tr>
                                       <td>Gender</td>
                                       <td id="gender">Male</td>
                                    </tr>
                                    <tr>
                                       <td>Birthday</td>
                                       <td id="bday">MM/DD/YY</td>
                                    </tr>
                                    <tr>
                                       <td>Phone Number</td>
                                       <td id="contact">09123456789</td>
                                    </tr>
                                    <tr>
                                       <td>Address</td>
                                       <td id="address">Street</td>
                                    </tr>
                                 </table>
                              </div>
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
      <script src="evo-calendar-master/evo-calendar/js/evo-calendar.min.js"></script>
      <script src="js/dashboard-patient.js">
      </script>
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
      <!--modal for error-->
      <div id="pop-up-error" class="modal">
          <div class="flex-box-row justify-content-center align-items-center">
              <img src="img/Icons/exclamation-mark.png" class="modal-header-icon"/>
              <p class="modal-p" id="pop-up-error-message" style="display: flex;justify-content: center;">
                  Cannot request an EMR. You do not have any medical record.
              </p>
          </div>
          <div class="flex-box-row justify-content-end align-items-center">
              <a href="#pop-up-error" rel="modal:close"><button class="modal-primary-button">Okay</button></a>
          </div>

      </div>

<!--      --><?php //include 'change-password-patient.php'?>

      <script>
          // $("#change-pwd-btn").click(function (data) {
          //     $(".modal-p-error").css("visibility","hidden")
          //     $("#close-dropdown-2").trigger("click")
          //     $("#pop-up-change-pwd").modal({})
          // })
          $("#logout").click(function () {
              location.href = "php/sessionDestroy.php";
          })
          $("#request_emr").click(function (data) {
              $(".modal-p-error").css("visibility","hidden")
              $("#close-dropdown-2").trigger("click")
              $.post("php/patientSide/isLinked.php").done(function (data) {
                  let result = JSON.parse(data);
                  if(result.status=="ok"){
                      $("#pop-up-req-emr").modal({
                          showClose:false
                      })
                  }
                  else {
                      $("#pop-up-error").modal({
                          showClose:false
                      })
                      $("#pop-up-error-message").html(result.err_msg)
                      // Cannot request an EMR. You do not have any medical record.

                  }
              })
          })
      </script>

      <!--modal for REQUEST EMR-->
      <div id="pop-up-req-emr" class="modal">
          <div class="flex-box-row justify-content-center align-items-center">
             <img src="img/HIS%20logo%20blue.png" width="250" height="90">
          </div>
          <p class="modal-title-2">Request for an EMR</p>
          <p class="modal-p" style="text-align: center!important;">(Electronic Medical Record)</p>
          <p class="modal-p-2" style="text-align: center!important;">Please Re-enter your Password Again</p>
          <div class="flex-box-column align-items-center margin-top-2">
              <input id="pwd-for-emr-req" type="password" class="search-bar" placeholder="password" style="width: 60%">
              <p class="modal-p-error">Invalid Password</p>
              <button id="req-emr-btn" class="modal-primary-button-2 margin-top-2" disabled style="opacity: 0.5">
                Request EMR
              </button>
          </div>
          <script>
              //request emr
              $("#pwd-for-emr-req").keyup(function (data) {

                  let char = $(this).val().trim();

                  $.post("php/patientSide/checkPatientOnlineAccountPassword.php",{pwd:char}).done(
                      function (data) {
                          if(data==1){
                              $("#req-emr-btn").css("opacity","1").prop("disabled",false)
                          }
                          else {
                              $("#req-emr-btn").css("opacity","0.5").prop("disabled",true)
                          }
                      }
                  )
              })
              $("#req-emr-btn").click(function () {
                    $("#pop-up-loading").modal({
                        showClose:false,clickClose:false,escapeClose:false
                    })
                  setTimeout(()=>{
                      $.post("php/patientSide/requestEMR.php").done(function (data) {
                          $('[href="#pop-up-loading"]').trigger("click");
                          $("#pop-up-success").modal({
                              showClose:false
                          })
                          if(data==2){//no existing request
                              $("#pop-up-success-message").html("Your EMR request is waiting to approve!")
                          }
                          if(data==1){//there is existing request that is replaced by new one
                              $("#pop-up-success-message").html("Your last EMR request had been replaced by this new request.")
                          }
                      })
                  },2000)

              })
          </script>
      </div>


      <!--Modal for loading-->
      <div id="pop-up-loading" class="modal">
          <div style="display: flex;align-items: center;justify-content: center">
              <div class="loader"></div>
              <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
                  Requesting...
              </p>
              <a href="#pop-up-loading" rel="modal:close" id="close-loading" style="display: none">
              </a>
          </div>
      </div>

      <!--Modal for success-->
      <div class="modal" id="pop-up-success">
          <div class="flex-box-row justify-content-center align-items-center">
              <img class="modal-header-icon" src="img/check.png">
              <p class="modal-p" id="pop-up-success-message" style="text-align: center!important;">Your EMR request is waiting to approve!</p>
          </div>

          <div class="flex-box-row justify-content-end align-items-end margin-top-1">
              <a href="#pop-up-success" rel="modal:close">
                  <button class="modal-primary-button" id="pop-up-success-ok-btn" style="margin-right: 0.5rem">Okay</button>
              </a>
              <script>
                  $("#pop-up-success-ok-btn").on('click',function () {
                      // location.href = 'dashboard-patient.php'
                  })
              </script>
          </div>
      </div>
   </body>
</html>