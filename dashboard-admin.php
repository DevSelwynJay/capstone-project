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
    <link rel="stylesheet" href="scss/notif.css">
    <!-- Font Family Lato-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon-sto.png" />

    <title>Dashboard</title>
    <!--    &lt;!&ndash;Jquery&ndash;&gt;-->
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>
<!--    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
<!--    <script type="text/javascript">-->
<!--        google.charts.load('current', { 'packages': ['bar'] });-->
<!--        google.charts.setOnLoadCallback(drawChart);-->

<!--        function drawChart() {-->
<!--            var data = google.visualization.arrayToDataTable([-->
<!--                ['Month', 'Measles Vaccine', 'Anti-Rabies', 'Anti-Tetanus'],-->
<!--                ['July', 200, 150, 20],-->
<!--                ['August', 400, 200, 25],-->
<!--                ['September', 660, 50, 10],-->
<!--                ['October', 300, 100, 20]-->
<!--            ]);-->

<!--            var options = {-->
<!--                chart: {-->
<!--                    title: 'Vaccine Tracking',-->
<!--                    subtitle: 'as of July - October 2021',-->
<!--                },-->
<!--                bars: 'vertical' // Required for Material Bar Charts.-->
<!--            };-->

<!--            var chart = new google.charts.Bar(document.getElementById('barchart_material'));-->

<!--            chart.draw(data, google.charts.Bar.convertOptions(options));-->
<!--        }-->
<!--    </script>-->

    <style>
        .drop-down-settings,
        .drop-down-settings open {
            z-index: 1000;
        }
    </style>

    <!--Notif Styling--->
    <style>
        .notification-dropdown li{
            padding: 0.4rem;
            text-align: justify-all;
            border-radius: 0.5rem;
            cursor: pointer;
        }
        .notification-dropdown li span{
            color: #2b2b2b;
            font-weight: 600;
        }
        .notification-dropdown li a{
            text-decoration: none;
            all: inherit;
        }
        .notification-dropdown li:hover{
            background: #e5e7ec;
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
            $.post("dashboard-admin-backend.php").done(function (data) {
                let result = JSON.parse(data);
                $("#senior-count").html(result.Senior)
                $("#adult-count").html(result.Adult)
                $("#minor-count").html(result.Minor)
                $("#infant-count").html(result.Infant)
                $("#PWD").html(result.PWD)
                $("#pregnant-count").html(result.Pregnant)
                $("#total-patient-count").html(result.patientCount)
                $("#total-vaccinated-count").html(result.vaccinated)
            })
            $.post("dashboard-admin-get-admin.php").done(function (data) {
                let result = JSON.parse(data);
                $("#admin-list").html("")
                for (const resultElement of result) {
                    $("#admin-list").append("" +
                        "<li>" +
                        '<div class="name-list"><img src="img/user3.png" alt="">' +
                        "<p>"+resultElement.first_name + " " +resultElement.middle_name +" "+resultElement.last_name +"</p>"+
                        "<p>"+resultElement.role+"</p>"+
                        "" +
                        "</li>")
                }

                // <li>
                //     <div class="name-list"><img src="img/jay.jpg" alt="">
                //         <p>Juan Dela Cruz</p>
                //         <p>Midwife</p>
                //     </div>
                // </li>
            })

        });
    </script>

    <!--==========FOR NOTIFICATION SCRIPT ===========================-->
    <script src="notif/notif.js"></script>
    <!--==========Notification Style ===========================-->
    <link rel="stylesheet" href="notif/notif.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js">
    </script>
    <script type="text/javascript">
        google.charts.load('current', { packages: ['corechart'] });     
    </script>
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
                            <li><a href="dashboard-admin.php" class="dashboard" style="background: var(--hover-color)">Dashboard</a></li>
                            <li><a href="patient.php" class="patient">Patient</a></li>
                            <li><a href="reports.php" class="reports">Reports</a></li>
                            <li><a href="track-map.php" class="trackMap">Track Map</a></li>
                            <li><a href="inventory.php" class="inventory">Inventory</a></li>
                            <?php include 'sidebarFix.html'?>
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
                                <!--UPDATED NOTIF STYLING-->
                                <ul class="notification-dropdown">
                                <li>Lorem ipsum dolor sit amet consectetur </li>
                                <li>Lorem ipsum dolor sit amet consectetur </li>
                                <li>Lorem ipsum dolor sit amet consectetur </li>
                                </ul>
                                <!--UPDATED NOTIF STYLING-->

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
                                <li><a href="reports.php"><i class="fas fa-chart-bar"></i></a></li>
                                <li><a href="track-map.php"><i class="fas fa-map-marker"></i></a></li>
                                <li><a href="inventory.php"><i class="fas fa-box"></i></a></li>
                            </ul>
                        </div>

                    </div>


                    <div class="dashboard-admin-content">
                        <div class="admin-upper">
                            <div class="admin-upper-left">
                                <div class="dashboard-cards card1">
                                    <i class="fas fa-syringe"></i>
                                    <div class="dashboard-cards-text text1">
                                        <p id="total-vaccinated-count">3,008</p>
                                        <p>Total Number of Vaccinated Patients</p>
                                    </div>
                                </div>
                                <div class="dashboard-cards card2">
                                    <i class="fas fa-user-injured"></i>
                                    <div class="dashboard-cards-text text2">
                                        <p id="total-patient-count">186</p>
                                        <p>Total Number of Patients</p>
                                    </div>
                                </div>
                            </div>
                            <div class="admin-upper-right">
                                <div class="dashboard-small-cards">
                                    <i class="fas fa-user-tie"></i>
                                    <div class="small-cards-text">
                                        <p id="senior-count">129</p>
                                        <p>Senior Citizen Patients</p>
                                    </div>
                                </div>
                                <div class="dashboard-small-cards">
                                    <i class="fas fa-male"></i>
                                    <div class="small-cards-text">
                                        <p id="adult-count">63</p>
                                        <p>Adult Patients</p>
                                    </div>
                                </div>
                                <div class="dashboard-small-cards">
                                    <i class="fas fa-child"></i>
                                    <div class="small-cards-text">
                                        <p id="minor-count">98</p>
                                        <p>Minor Patients</p>
                                    </div>
                                </div>
                                <div class="dashboard-small-cards">
                                    <i class="fas fa-baby"></i>
                                    <div class="small-cards-text">
                                        <p id="infant-count">12</p>
                                        <p>Infant Patients</p>
                                    </div>
                                </div>
                                <div class="dashboard-small-cards">
                                    <i class="fas fa-wheelchair"></i>
                                    <div class="small-cards-text">
                                        <p id="PWD">31</p>
                                        <p>PWD Patients</p>
                                    </div>
                                </div>
                                <div class="dashboard-small-cards">
                                    <i class="fas fa-hand-holding-heart"></i>
                                    <div class="small-cards-text">
                                        <p id="pregnant-count">109</p>
                                        <p>Pregnant Patients</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="admin-lower">
                            <div class="workers-list-container">
                                <div class="worker-header">
                                    <h1>Workers</h1>
                                </div>
                                <div class="list-header">
                                     <li>
                                        <div class="name-list">
                                            <img src="img/jay.jpg" style="opacity:0">
                                            <p>Name</p>
                                            <p>Position</p>
                                        </div>
                                    </li>
                                </div>
                                <ul id="admin-list">
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>Midwife</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>BHW</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>BHW</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>BHW</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>BHW</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>BHW</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>BHW</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="name-list"><img src="img/jay.jpg" alt="">
                                            <p>Juan Dela Cruz</p>
                                            <p>BHW</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="popular-vaccines-container">
                                <div id="container">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>


    </section>


    <!--  graph   -->
    <script language="JavaScript">
        // let arr = []
        // arr.push([1,2,3,4,5]);arr.push([1,2,3,4,5])
        // alert(arr[0])
     $(document).ready(function () {
         function drawChart() {

             $.get("dashboard-chart-backend.php").done(function (data) {

                 let result = JSON.parse(data)
               
                 var data = google.visualization.arrayToDataTable(result);

                 var options = {
                     title: 'Popular Vaccines (as of 2015 - 2021)',
                     titleTextStyle: {
                         color: "#FFFFFF",
                         fontSize: 20,
                         fontName: "Lato, sans-serif",
                     },
                     animation: {
                         startup: true,
                         duration: 1000,
                         easing: 'out',
                     },
                     bar: { groupWidth: "70%" },
                     legend: { position: "bottom" },
                     backgroundColor: "#22809b",
                     isStacked: true,
                     width: 800,
                     height: 450,
                     is3D: true,
                     legendTextStyle: { color: '#FFF' },
                     tooltip: {isHtml: true},
                     hAxis: {
                         format: '#\'%\'',
                         textStyle: { color: '#FFF' }

                     },
                     vAxis: {
                         textStyle: { color: '#FFF' }
                     },

                 }

                 // Instantiate and draw the chart.
                 var chart = new google.visualization.BarChart(document.getElementById('container'));
                 document.onload(chart.draw(data, options));

             })

         }//function
         google.charts.setOnLoadCallback(drawChart);
     })

    </script>


    <!--Drop down script-->
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


</body>

</html>