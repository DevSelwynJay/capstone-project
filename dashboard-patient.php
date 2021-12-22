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
       <!--EVO Calendar Script-->
       <script src="js/evo-calendar.js"></script>
      <title>Dashboard Patient</title>
       <script>
           $(document).ready(function () {
               $.post("php/patientSide/patientSession.php").done(function (data){
                   let result = JSON.parse(data)
                    $(".patient-name").html(result.patient_name)
                    $("#age").html(result.age)
                   $("#gender").html(result.gender)
                   $("#bday").html(result.birthday)
                   $("#contact").html(result.contact_no)
                   $("#address").html(result.address)
               })
           })
       </script>
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
                                  <li><a href="">Request EMR</a></li>
                                  <li id="logout"><a>Logout</a></li>
                                   <script>
                                       $("#logout").click(function () {
                                           location.href = "php/sessionDestroy.php";
                                       })
                                   </script>
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
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat nostrum
                                       totam omnis repudiandae ullam, dolor nemo dolores corporis quo delectus quam
                                       ut iste similique illo quod vero eveniet sapiente molestiae! 
                                    </p>
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
                          </div>
                          
                           <div class="current-medication-container">
                            <h3>Current Medication</h3>
                            <table>
                                <tr>
                                   <th>Name</th>
                                   <th>Dosage</th>
                                   <th>No. of time</th>
                                   <th>Duration</th>
                                </tr>
                                <tr>
                                   <td>Jay</td>
                                   <td>Vaccination</td>
                                   <td>4</td>
                                   <td>11/20/2021</td>
                                </tr>
                             </table>
                           </div>

                           <div class="vaccination-schedule-container">
                            <h3>Vaccination Schedule</h3>
                           
                            <table>
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
                                <img src="img/jay.jpg" alt=""><br>
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
   </body>
</html>