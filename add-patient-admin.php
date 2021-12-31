<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!--CSS Grid Bootstrap-->
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
      <title>Add Patient</title>
       <!--Jquery-->
       <script src="js/jquery-3.6.0.js"></script>
       <!--Jquery UI css and js-->
       <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
       <script src="jquery-ui/jquery-ui.js"></script>
       <!-- jQuery Modal-->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
       <!--Custom CSS-->
       <link rel="stylesheet" href="scss/scrollbar_loading.css">
       <!--Custom Modal Design-->
       <link rel="stylesheet" href="scss/modal.css">
       <!--Get admin info from session-->
       <script>
           $(document).ready(function () {
               $.post('php/admin_session.php').done(
                   function (data) {
                       let result = JSON.parse(data)
                       $("#name-sidebar").html(result.admin_name)
                   }
               )
           })
       </script>
       <script src="js/add-patient-admin.js"></script>
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
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>First Name</p>
                                             <input class="search-bar" type="text" name="fname" placeholder="First Name" data-toggle="tooltip" data-placement="top" title="First Name" data-container="body" required/>
                                         </div>
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Middle Name</p>
                                             <input class="search-bar" type="text" name="mname" placeholder="Middle Name" data-toggle="tooltip" data-placement="top" title="Middle Name" data-container="body" required/>
                                         </div>
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Last Name</p>
                                             <input  class="search-bar"type="text" name="lname" placeholder="Last Name" data-toggle="tooltip" data-placement="top" title="Last Name" data-container="body" required/>
                                         </div>
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p">Suffix</p>
                                             <input  class="search-bar"type="text" name="suffix" placeholder="Suffix" data-toggle="tooltip" data-placement="top" title="Suffix (ex. Jr. Sr.)" data-container="body"/>
                                         </div>
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p" style="text-align:  start!important;margin-bottom: 0.3rem!important;"><span style="color: red">*</span>Patient Type</p>
                                             <div id="radio-button" class="row flex-box-row justify-content-center">
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2">Infant</p>
                                                     <input type="radio" name="patient-type" value="Infant" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2">Minor</p>
                                                     <input type="radio" name="patient-type" value="Minor" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2">Adult</p>
                                                     <input type="radio" name="patient-type" value="Adult" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2" >Pregnant</p>
                                                     <input type="radio" name="patient-type" value="Pregnant" required>
                                                 </div>
                                                 <div class="flex-box-row align-content-center">
                                                     <p class="modal-p-2" >PWD</p>
                                                     <input type="radio" name="patient-type" value="PWD" required>
                                                     <input type="radio" name="patient-type" value="" required checked style="display: none">
                                                 </div>
                                             </div>
                                             <script>
                                                 // //pang debug lang ng radio button
                                                 // alert( $('[name="patient-type"]:checked').val())
                                                 // $("[type='radio']").click(function () {
                                                 //     alert( $('[name="patient-type"]:checked').val())
                                                 // })

                                             </script>
                                         </div>
                                         <style>
                                             [type="radio"]{
                                                 max-width: 1rem;
                                                 max-height: 1rem;
                                             }
                                             #radio-button div{
                                                 margin: 0.3rem!important;
                                             }
                                             #radio-button div p{
                                                 margin-right: 0.3rem !important;
                                             }
                                         </style>
                                         <div class="col-sm-2 margin-top-2">
                                             <p class="modal-p">Blood Type</p>
                                             <input  class="search-bar" type="text"  name="blood-type" placeholder="x" id="blood-type" data-toggle="tooltip" data-placement="left" title="Blood Type" data-container="body"  />
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
                                             <p class="modal-p"><span style="color: red">*</span>Civil Status</p>
                                             <select class="search-bar" type="text" name="civil_status" placeholder="Civil Status" value="" data-toggle="tooltip" data-placement="top" title="Civil Status (Married, Single, etc.)" data-container="body">
                                                 <option>Single</option>
                                                 <option>Married</option>
                                                 <option>Divorced</option>
                                                 <option>Widowed</option>
                                             </select>
                                         </div>
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p">Occupation</p>
                                             <input class="search-bar" type="text" name="occupation" placeholder="Optional" data-toggle="tooltip" data-placement="top" title="Occupation" data-container="body"/>
                                         </div>
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



                                     </div>
                                     <div class="row">

                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Purok</p>
                                             <select class="search-bar" data-toggle="tooltip" name="purok" data-placement="top" title="Purok" data-container="body" required>
                                                 <?php
                                                 for($a=1;$a<=7;$a++){
                                                     echo "<option>$a</option>";
                                                 }
                                                 ?>
                                             </select>
                                         </div>
                                         <div class="col-sm-3 margin-top-2">
                                             <p class="modal-p">House #</p>
                                             <input class="search-bar" type="number" inputmode="tel" name="house_no" placeholder="House #" id="num" data-toggle="tooltip" data-placement="top" title="House #" data-container="body"/>
                                         </div>
                                         <div class="col-sm-6 margin-top-2">
                                             <p class="modal-p"><span style="color: red">*</span>Barangay</p>
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
                                         <button class="primary-btn" id="trigger-add-patient-modal" type="button" style="width: 100%">Register</button>
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

      <!--Modal for loading-->
      <div id="pop-up-loading" class="modal">
          <div style="display: flex;align-items: center;justify-content: center">
              <div class="loader"></div>
              <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
                  Processing Request...
              </p>
          </div>
      </div>
      <!--modal for confirm-->
      <div id="pop-up-confirm-add-patient" class="modal">
          <div class="flex-box-row justify-content-center align-items-center">

              <p class="modal-p flex-box-row justify-content-center align-items-center">
                  <img class="modal-header-icon" src="img/question.png" style="margin-right: 0.3rem">
                  Add this patient account?
              </p>
          </div>

          <div class="flex-box-row justify-content-end align-items-end">
              <a href="#pop-up-confirm-add-patient" rel="modal:close">
                  <button class="modal-cancel-button"  style="margin-right: 0.5rem">Cancel</button>
              </a>
              <button class="modal-primary-button" id="final-confirm-add-patient-btn" style="margin-left: 0.5rem">Add</button>
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
              <p class="modal-p" id="pop-up-success-message">Patient successfully added</p>
          </div>

          <div class="flex-box-row justify-content-end align-items-end">
              <a href="#pop-up-success" rel="modal:close">
                  <button class="modal-primary-button" id="pop-up-success-ok-btn" style="margin-right: 0.5rem">Okay</button>
              </a>
              <script>
                  $("#pop-up-success-ok-btn").on('click',function () {
                      location.href = 'patient.php'
                  })
              </script>
          </div>
      </div>
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

    <script>
        //UX on pressing enter
        // $('[name="fname"]').trigger(function () {
        //     alert()
        // })
        $('[name="fname"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="mname"]').trigger("focus")
            }
        })
        $('[name="mname"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="lname"]').trigger("focus")
            }
        })
        $('[name="lname"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="suffix"]').trigger("focus")
            }
        })
        $('[name="suffix"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="patient-type"]').trigger("focus")
            }
        })
        $('[name="patient-type"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="blood-type"]').trigger("focus")
            }
        })
        $('[name="blood-type"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="height"]').trigger("focus")
            }
        })
        $('[name="height"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="weight"]').trigger("focus")
            }
        })
        $('[name="weight"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="civil_status"]').trigger("focus")
            }
        })
        $('[name="civil_status"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="occupation"]').trigger("focus")
            }
        })
        $('[name="occupation"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="gender"]').trigger("focus")
            }
        })
        $('[name="gender"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="bday"]').trigger("focus")
            }
        })
        $('[name="bday"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="purok"]').trigger("focus")
            }
        })
        $('[name="purok"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="house_no"]').trigger("focus")
            }
        })
        $('[name="house_no"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="email"]').trigger("focus")
            }
        })
        $('[name="email"]').keydown(function (e) {
            let key = e.which;
            if(key == 13)  // the enter key code
            {
                $('[name="contact"]').trigger("focus")
            }
        })
    </script>
   </body>
</html>