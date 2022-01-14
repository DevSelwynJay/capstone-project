<?php

session_start();
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
<html>
<head>
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Custom CSS-->
    <link rel="stylesheet" href="scss/main.css">
    <link rel="stylesheet" href="scss/track.css">
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
    <!-- Font Family Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
            rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">

    <!-- Font Family Lato-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <script src="jquery-ui/jquery-ui.js"></script>
    <style>
        .drop-down-settings,
        .drop-down-settings open {
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
        })
    </script>
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
                        <li><a href="dashboard-admin.php" class="dashboard">Dashboard</a></li>
                        <li><a href="patient.php" class="patient" >Patient</a></li>
                        <li><a href="reports.php" class="reports" >Reports</a></li>
                        <li><a href="track-map.php" class="trackMap" style="background: var(--hover-color)">Track Map</a></li>
                        <li><a href="inventory.php" class="inventory">Inventory</a></li>
                        <?php include 'sidebarFix.html'?>
                    </ul>
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
                            <a href="profile.php"><i class="fas fa-user-circle"></i></a>
                            <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
                            <a id="close-dropdown"><i class="fas fa-times"></i></a>
                            <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"></i></a>
                            <a id="close-mobile-menu"><i class="fas fa-times"></i></a>
                            <!--MOBILE MENU-->
                            <div class="menu-mobile " id="menu">
                                <ul>
                                    <li><a href="dashboard-admin.html"><i class="fas fa-columns"></i>Dashboard</a>
                                    </li>
                                    <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                                    <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                                    <li><a href="track-map.html"><i class="fas fa-map-marker"></i>Track Map</a></li>
                                    <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
                                </ul>
                            </div>

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
                </div>

                <div class="tab">
                    <button id="tab1" class="tablinks" onclick="openOPV();">OPV</button>
                    <button id="tab2" class="tablinks" onclick="openIPV();">IPV</button>
                    <button id="tab3" class="tablinks" onclick="openBCG();">BCG</button>
                    <button id="tab4" class="tablinks" onclick="openMMR();">MMR</button>
                    <button id="tab5" class="tablinks" onclick="openCovid();">Covid Vaccine</button>
                </div>
                <div class="gridd">
                    <div id="framecont"><iframe frameborder = "0" id="myframe" src="php/testingCode/opv.php" style="-webkit-transform:scale(0.9);"></iframe></div>
                </div>
                <script>
                    document.getElementById("tab1").focus();

                    function openOPV() {
                        document.getElementById("myframe").src = "php/testingCode/opv.php";
                    }
                    function openIPV() {
                        document.getElementById("myframe").src = "php/testingCode/ipv.php";

                    }
                    function openBCG() {
                        document.getElementById("myframe").src = "php/testingCode/bcg.php";

                    }
                    function openMMR() {
                        document.getElementById("myframe").src = "php/testingCode/mmr.php";

                    }
                    function openCovid() {
                        document.getElementById("myframe").src = "php/testingCode/covid.php";

                    }

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

</body>
</html>