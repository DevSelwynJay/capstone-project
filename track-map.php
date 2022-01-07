<?php
$con=null;
require 'php/DB_Connect.php';

            $sql = "SELECT * FROM `medinventory` WHERE stock <= 100 AND expdate > NOW()";
$countres = mysqli_query($con,$sql);
$count = mysqli_num_rows($countres);
$exptab = "Select * from `medinventory`  where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY";
$expire = "Select * from `medinventory` where `expdate` < NOW()";
$res1 = mysqli_query($con,$expire);
$res2 = mysqli_query($con,$exptab);
$count2 = mysqli_num_rows($res1);
$count3 = mysqli_num_rows($res2);
$total = $count + $count2 + $count3;
if($total <=8){
$total = $total ;
}
else{
$total = 9 ."&#8314;";
}
?>
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
   <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
      rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <title>Patient</title>
   <!--Jquery-->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <!--Jquery UI css and js-->
   <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
   <script src="jquery-ui/jquery-ui.js"></script>
   <!--Line Chart-->
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <!--Get admin info from session-->
   <script>
      $(document).ready(function () {
         Notif();
         $.post('php/admin_session.php').done(
                 function (data) {
                    let result = JSON.parse(data)
                    $("#name-sidebar").html(result.admin_name)
                 }
         )




         if(<?php echo $count; ?> > 0){

            var content = "<div>There is a Critical Stock on our Inventory</div>";
            if(<?php echo $count2; ?> > 0){

               content += "<div style='border-top: solid 1px black '>There is an Expired Medicine on our Inventory</div>"
               if(<?php echo $count2; ?> > 0){

                  content += "<div style='border-top: solid 1px black'>There is a To Expire Medicine on our Inventory</div>"

                  $(function() {
                     $("#badge").tooltip({
                        content:content
                     });
                  });

               }

            }

         }
         function Notif(){
            var data = true;
            $.ajax({
               url:"php/inventoryProcesses/Notif_function.php",
               method: "POST",
               data: {data},
               success:function(data){
                  $('#badge').html(data);

               }
            })
         }
         setInterval(Notif,1000);



      });
   </script>
   <style>

      .ui-tooltip {
         padding: 10px 20px;
         color: black;
         border-radius: 20px;
         background-color: white;
         font: bold 14px "Helvetica Neue", Sans-Serif;
         text-transform: uppercase;
      }
   </style>
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
                     <li><a href="dashboard-admin.php" class="dashboard">Dashboard</a></li>
                     <li><a href="patient.php" class="patient">Patient</a></li>
                     <li><a href="reports.php" class="reports">Reports</a></li>
                     <li><a href="track-map.php" class="trackMap">Track Map</a></li>
                     <li><a href="inventory.php" class="inventory">Inventory<span id="badge" class="badge" style="
                            position: relative;
                            top: -10px;
                            right: -2px;
                            padding: 0px 7px;
                            border-radius: 100%;
                            background: #ff0d31;
                            font-size: small;
                            color: white;
                        " title="There is a Critical Stock in our Inventory" ></span></a></li>
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
                        <a href="profile.php"><i class="fas fa-user-circle"></i></a>
                        <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
                        <a id="close-dropdown"><i class="fas fa-times"></i></a>
                        <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"><span id="badge" class="badge" style="
                            position: relative;
                            top: -7px;
                            right: 4px;
                            padding: 0px 2px;
                            border-radius: 100%;
                            background: #ff0d31;
                            color: white;
                        ">&nbsp;</span></i></a>
                        <a id="close-mobile-menu"><i class="fas fa-times"></i></a>
                        <!--MOBILE MENU-->
                        <div class="menu-mobile " id="menu">
                           <ul>
                              <li><a href="dashboard-admin.php"><i class="fas fa-columns"></i>Dashboard</a></li>
                              <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                              <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                              <li><a href="track-map.php"><i class="fas fa-map-marker"></i>Track Map</a></li>
                              <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory<span id="badge" class="badge" style="
                            position: relative;
                            top: -10px;
                            right: -2px;
                            padding: 0px 7px;
                            border-radius: 100%;
                            background: #ff0d31;
                            font-size: small;
                            color: white;
                        " title="There is a Critical Stock in our Inventory" ></span></a></li>
                           </ul>
                        </div>

                        <div class="drop-down-settings" id="dropdown">
                           <ul>
                              <li><a href="">Approve EMR</a></li>
                              <li><a href="">settings</a></li>
                              <li><a href="">About</a></li>
                              <li><a href="">Logout</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>

               <!--MAIN CONTENT-->
               <div class="col-sm-12">
                  <div class="track-map-content">
                     <div class="covid-container">
                        <div id="chart_div" style="margin-left: -30px; padding: 15px; border-radius: 10px;"></div>
                     </div>
                     <div class="track-map-second">
                        <div class="medicine-released-container tm-container">
                           <div id="chart_div2" style="margin-left:-35px; margin-top: 10px;border-radius: 10px;"></div>
                        </div>
                        <div class="immunization-container tm-container">
                           <div id="chart_div3" style="margin-left:-35px; margin-top: 10px;border-radius: 10px;"></div>
                        </div>
                     </div>
                     <div class="track-map-third">
                        <div class="pregnant-vaccine-container tm-container">
                           <div id="chart_div4" style="margin-left:-35px; margin-top: 10px;border-radius: 10px;"></div>
                        </div>
                        <div class="other-vaccine-container tm-container">
                           <div id="chart_div5" style="margin-left:-35px; margin-top: 10px;border-radius: 10px;"></div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </section>

   <script type="text/javascript">
      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
         var data = google.visualization.arrayToDataTable
            ([['Purok', 'Doses Released', { 'type': 'string', 'role': 'style' }],
            ['Purok 1', 570, null],
            ['Purok 2', 800, null],
            ['Purok 3', 760, null],
            ['Purok 4', 240, null],
            ['Purok 5', 580, null],
            ['Purok 6', 420, null],
            ['Purok 7', 910, null],
            ]);

         var options = {
            title: 'Covid-19 Vaccine Released per Purok',
            titleTextStyle: {
               color: "#FFFFFF",
               fontSize: 20,
               fontName: "Lato, sans-serif",
            },
            animation: {
               startup: true,
               duration: 1000,
               easing: 'inAndOut',
            },
            legend: 'none',
            hAxis: {
               textStyle: {
                  color: '#fff',
                  fontName: "Lato, sans-serif",
               }
            },
            vAxis: {
               textStyle: { color: 'fff', fontName: "Lato, sans-serif", }
            },
            curveType: 'function',
            backgroundColor: "transparent",
            pointSize: 15,
            dataOpacity: 1,
            width: 1080,
            height: 310,
            is3D: true,
         };

         var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
         chart.draw(data, options);
      }

      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
         var data = google.visualization.arrayToDataTable
            ([['Purok', 'Medicine Released', { 'type': 'string', 'role': 'style' }],
            ['Purok 1', 440, null],
            ['Purok 2', 810, null],
            ['Purok 3', 370, null],
            ['Purok 4', 110, null],
            ['Purok 5', 150, null],
            ['Purok 6', 95, null],
            ['Purok 7', 180, null],
            ]);

         var options = {
            title: 'Medicine Released',
            titleTextStyle: {
               color: "#FFFFFF",
               fontSize: 20,
               fontName: "Lato, sans-serif",
            },
            animation: {
               startup: true,
               duration: 1000,
               easing: 'inAndOut',
            },
            legend: 'none',
            hAxis: {
               textStyle: {
                  color: '#fff',
                  fontName: "Lato, sans-serif",
               }
            },
            vAxis: {
               textStyle: { color: 'fff', fontName: "Lato, sans-serif", }
            },
            curveType: 'function',
            backgroundColor: "transparent",
            pointSize: 15,
            dataOpacity: 1,
            width: 600,
            height: 330,
            is3D: true,
         };

         var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
         chart.draw(data, options);
      }

      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawChart3);
      function drawChart3() {
         var data = google.visualization.arrayToDataTable
            ([['Purok', 'Doses Released', { 'type': 'string', 'role': 'style' }],
            ['Purok 1', 910, null],
            ['Purok 2', 220, null],
            ['Purok 3', 390, null],
            ['Purok 4', 460, null],
            ['Purok 5', 150, null],
            ['Purok 6', 870, null],
            ['Purok 7', 550, null],
            ]);

         var options = {
            title: 'Immunization Vaccine Released',
            titleTextStyle: {
               color: "#FFFFFF",
               fontSize: 20,
               fontName: "Lato, sans-serif",
            },
            animation: {
               startup: true,
               duration: 1000,
               easing: 'inAndOut',
            },
            legend: 'none',
            hAxis: {
               textStyle: {
                  color: '#fff',
                  fontName: "Lato, sans-serif",
               }
            },
            vAxis: {
               textStyle: { color: 'fff', fontName: "Lato, sans-serif", }
            },
            curveType: 'function',
            backgroundColor: "transparent",
            pointSize: 15,
            dataOpacity: 1,
            width: 600,
            height: 330,
            is3D: true,
         };

         var chart = new google.visualization.LineChart(document.getElementById('chart_div3'));
         chart.draw(data, options);
      }

      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawChart4);
      function drawChart4() {
         var data = google.visualization.arrayToDataTable
            ([['Purok', 'Doses Released', { 'type': 'string', 'role': 'style' }],
            ['Purok 1', 630, null],
            ['Purok 2', 440, null],
            ['Purok 3', 90, null],
            ['Purok 4', 110, null],
            ['Purok 5', 550, null],
            ['Purok 6', 810, null],
            ['Purok 7', 220, null],
            ]);

         var options = {
            title: 'Pregnant Vaccines Released',
            titleTextStyle: {
               color: "#FFFFFF",
               fontSize: 20,
               fontName: "Lato, sans-serif",
            },
            animation: {
               startup: true,
               duration: 1000,
               easing: 'inAndOut',
            },
            legend: 'none',
            hAxis: {
               textStyle: {
                  color: '#fff',
                  fontName: "Lato, sans-serif",
               }
            },
            vAxis: {
               textStyle: { color: 'fff', fontName: "Lato, sans-serif", }
            },
            curveType: 'function',
            backgroundColor: "transparent",
            pointSize: 15,
            dataOpacity: 1,
            width: 600,
            height: 330,
            is3D: true,
         };

         var chart = new google.visualization.LineChart(document.getElementById('chart_div4'));
         chart.draw(data, options);
      }

      google.charts.load('current', { 'packages': ['corechart'] });
      google.charts.setOnLoadCallback(drawChart5);
      function drawChart5() {
         var data = google.visualization.arrayToDataTable
            ([['Purok', 'Doses Released', { 'type': 'string', 'role': 'style' }],
            ['Purok 1', 220, null],
            ['Purok 2', 800, null],
            ['Purok 3', 340, null],
            ['Purok 4', 920, null],
            ['Purok 5', 120, null],
            ['Purok 6', 360, null],
            ['Purok 7', 200, null],
            ]);

         var options = {
            title: 'Other Vaccine Released',
            titleTextStyle: {
               color: "#FFFFFF",
               fontSize: 20,
               fontName: "Lato, sans-serif",
            },
            animation: {
               startup: true,
               duration: 1000,
               easing: 'inAndOut',
            },
            legend: 'none',
            hAxis: {
               textStyle: {
                  color: '#fff',
                  fontName: "Lato, sans-serif",
               }
            },
            vAxis: {
               textStyle: { color: 'fff', fontName: "Lato, sans-serif", }
            },
            curveType: 'function',
            backgroundColor: "transparent",
            pointSize: 15,
            dataOpacity: 1,
            width: 600,
            height: 330,
            is3D: true,
         };

         var chart = new google.visualization.LineChart(document.getElementById('chart_div5'));
         chart.draw(data, options);
      }
   </script>

   <script>
      const dropdown = document.querySelector('#dropdown');
      const dropdownToggle = document.querySelector('#dropdown-toggle');
      const Closedropdown = document.querySelector('#close-dropdown');

      dropdownToggle.addEventListener('click', function () {//Conditions
         if (dropdown.classList.contains('open')) { // Close Mobile Menu
            dropdown.classList.remove('open');
         }
         else { // Open Mobile Menu
            dropdown.classList.add('open');
         }
      });


      dropdownToggle.addEventListener('click', function () {
         dropdown.classList.add('open');
         dropdownToggle.style.display = "none";
         Closedropdown.style.display = "block"
      });

      Closedropdown.addEventListener('click', function () {
         dropdown.classList.remove('open');
         Closedropdown.style.display = "none"
         dropdownToggle.style.display = "block";
      });

   </script>
   <script>
      const menu = document.querySelector('#menu');
      const mobileMenu = document.querySelector('#mobile-menu');
      const closeMobileMenu = document.querySelector('#close-mobile-menu');

      mobileMenu.addEventListener('click', function () {//Conditions
         if (menu.classList.contains('open')) { // Close Mobile Menu
            menu.classList.remove('open');
         }
         else {
            menu.classList.add('open');
         }
      });


      mobileMenu.addEventListener('click', function () {
         menu.classList.add('open');
         mobileMenu.style.display = "none";
         closeMobileMenu.style.display = "block"
      });

      closeMobileMenu.addEventListener('click', function () {
         menu.classList.remove('open');
         closeMobileMenu.style.display = "none"
         mobileMenu.style.display = "block";
      });
   </script>
</body>

</html>