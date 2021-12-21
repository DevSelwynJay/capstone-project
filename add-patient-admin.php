<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!--CSS Grid Bootstrap-->
       <link rel="stylesheet" href="scss/bootstrap-grid.css">
      <!--Custom CSS-->
      <link rel="stylesheet" href="scss/style.css">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <title>Add Patient</title>
       <!--Jquery-->
       <script src="js/jquery-3.6.0.js"></script>
       <!--Jquery UI css and js-->
       <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
       <script src="jquery-ui/jquery-ui.js"></script>
       <!--Get admin info from session-->
       <script>
           $.post('php/admin_session.php').done(
               function (data) {
                   let result = JSON.parse(data)
                   $("#name-sidebar").html(result.admin_name)
               }
           )
       </script>
       <link rel="stylesheet" href="scss/modal.css"/>
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
                        <h4 id="name-sidebar">Your Name</h4>
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
                  <div class="col-sm-12 p-0">
                     <div class="inner-page-nav">
                        <div class="logo">
<img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
<img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
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
                     <div class="search-tab margin-top-2 row justify-content-sm-around">
                         <div class="button-container col-11 flex-box-row justify-content-start align-items-center">
                             <a href="patient.php">
                                 <button class="modal-primary-button">
                                     <i class="fas fa-arrow-circle-left" style="margin-right: 0.3rem"></i>
                                     Go Back to Patient List
                                 </button>
                             </a>

                         </div>
                     </div>

                     <div class="content patients-view-container">
                         <h3 style="color: var(--third-color)"class="margin-top-2">Add Patient</h3>
                             <form id="reg-form" method="post" autocomplete="off" enctype="multipart/form-data" action="#">
                                 <div class="">

                                     <div class="row">
                                         <div class="col-sm-4 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>First Name</p>
                                             <input class="search-bar" type="text" name="fname" placeholder="First Name" data-toggle="tooltip" data-placement="top" title="First Name" data-container="body" required/>
                                         </div>
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Middle Name</p>
                                             <input class="search-bar" type="text" name="mname" placeholder="Middle Name" data-toggle="tooltip" data-placement="top" title="Middle Name" data-container="body" required/>
                                         </div>
                                         <div class="col-sm-4 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Last Name</p>
                                             <input  class="search-bar"type="text" name="lname" placeholder="Last Name" data-toggle="tooltip" data-placement="top" title="Last Name" data-container="body" required/>
                                         </div>
                                         <div class="col-sm-1 margin-top-2">
                                             <p class="modal-p">Suffix</p>
                                             <input  class="search-bar"type="text" name="suffix" placeholder="Suffix" data-toggle="tooltip" data-placement="top" title="Suffix (ex. Jr. Sr.)" data-container="body"/>
                                         </div>
                                         <div class="col-sm-12 margin-top-2">
                                             <p class="modal-p" style="text-align:  center!important;margin-bottom: 0.3rem!important;"><span style="color: red">*</span>Patient Type</p>
                                             <div class="flex-box-row justify-content-around" style="padding-top: 0.5rem;border-top: 1px solid var(--light-grey)">
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2" style="margin-right: 0.2rem!important;">Infant</p>
                                                     <input type="radio" name="patient-type" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2" style="margin-right: 0.2rem!important;">Minor</p>
                                                     <input type="radio" name="patient-type" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2" style="margin-right: 0.2rem!important;">Adult</p>
                                                     <input type="radio" name="patient-type" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2" style="margin-right: 0.2rem!important;">Pregnant</p>
                                                     <input type="radio" name="patient-type" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2" style="margin-right: 0.2rem!important;">PWD</p>
                                                     <input type="radio" name="patient-type" required>
                                                 </div>
                                             </div>
                                         </div>
                                         <style>
                                             [type="radio"]{
                                                 max-width: 1rem;
                                                 max-height: 1rem;
                                             }
                                         </style>
                                     </div>
                                     <div class="row">
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Gender</p>
                                             <select class="search-bar" type="text" name="gender" placeholder="Gender" value="" data-toggle="tooltip" data-placement="top" title="Gender" data-container="body">
                                                 <option>Male</option>
                                                 <option>Female</option>
                                             </select>
                                         </div>
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Birthday</p>
                                             <input  class="search-bar" type="text"  name="bday" inputmode="none" placeholder="Birthday"  data-toggle="tooltip" data-placement="left" title="Birthday" data-container="body" required readonly/>
                                         </div>
                                         <script>
                                             $("[name=\"bday\"]").datepicker({
                                                 changeMonth: true,
                                                 changeYear: true,
                                                 yearRange:'1900:new Date()',
                                                 maxDate: new Date()
                                             }).datepicker("option", "dateFormat", "yy-mm-dd")
                                             $("[name=\"bday\"]").focus(function () {
                                                 $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem")
                                                 $(".ui-datepicker-year").css("padding","1px")
                                                 console.log($(this).val())
                                             })
                                         </script>
                                         <style>
                                             /*override th color*/
                                             th{
                                                 background: none !important;
                                             }
                                         </style>
                                         <div class="col-sm-2 margin-top-2">
                                             <p class="modal-p">Blood Type</p>
                                             <input  class="search-bar" type="text"  name="blood-type" placeholder="x" id="blood-type" data-toggle="tooltip" data-placement="left" title="Blood Type" data-container="body" required readonly/>
                                         </div>
                                         <div class="col-sm-2 margin-top-2">
                                             <p class="modal-p">Height</p>
                                             <input class="search-bar" type="text"  name="height" placeholder="x" id="height" data-toggle="tooltip" data-placement="top" title="Height" data-container="body"/>
                                         </div>
                                         <div class="col-sm-2 margin-top-2">
                                             <p class="modal-p">Weight</p>
                                             <input class="search-bar" type="text"  name="weight" placeholder="x" id="weight" data-toggle="tooltip" data-placement="top" title="Weight" data-container="body"/>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p">Occupation</p>
                                             <input class="search-bar" type="text" name="occupation" placeholder="Optional" data-toggle="tooltip" data-placement="top" title="Occupation" data-container="body"/>
                                         </div>
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p">Civil Status</p>
                                             <select class="search-bar" type="text" name="civil_status" placeholder="Civil Status" value="" data-toggle="tooltip" data-placement="top" title="Civil Status (Married, Single, etc.)" data-container="body">
                                                 <option>Single</option>
                                                 <option>Married</option>
                                                 <option>Divorced</option>
                                                 <option>Widowed</option>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="row">

                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Purok</p>
                                             <select class="search-bar" data-toggle="tooltip" name="purok" data-placement="top" title="Purok" data-container="body" required>
                                                 <option value="" disabled selected>Purok</option>
                                                 <?php
                                                 for($a=1;$a<=7;$a++){
                                                     echo "<option>$a</option>";
                                                 }
                                                 ?>
                                             </select>
                                         </div>
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>House #</p>
                                             <input class="search-bar" type="number" inputmode="tel" name="house_no" placeholder="House #" id="num" data-toggle="tooltip" data-placement="top" title="House #" data-container="body"/>
                                         </div>
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p">Barangay</p>
                                             <input class="search-bar" type="text" placeholder="" value="Sto. Rosario of Paombong Bulacan" readonly/>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p">Email</p>
                                             <input class="search-bar" type="text" name="email" inputmode="email"  placeholder="Optional" data-toggle="tooltip" data-placement="top" title="E-mail (name@gmail.com)" data-container="body" />
                                         </div>
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p">Contact No.</p>
                                             <input class="search-bar" type="number" name="contact" inputmode="tel" placeholder="Optional" data-toggle="tooltip" data-placement="top" title="Contact no (11-digit number)" data-container="body" />
                                         </div>
                                     </div>
                                     <div style="display: flex;justify-content: center">
                                         <button class="primary-btn" id="trigger-reg-modal" type="submit" style="width: 100%">Register</button>
                                     </div>

                                 </div>
                                 <!--testing button only
                                 <button id="test-btn" type="button" class="btn btn-primary"data-toggle="modal" data-target="#pop-up-error">
                                     test modal only-->
                                 </button>
                             </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

<!--Dropdown Script-->
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
<!--Table sortable script-->
<script src="js/table-sortable.js"></script>
      <script>

          //alert($(document).width())
      </script>
      <style>
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
      </style>
<script>

   jQuery(document).ready(function() {
    // $(".clickable-row").click(function() {
    //     window.location = $(this).data("href");
    // });

});//end of document ready
</script>

   </body>
</html>