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
        });
        $(function() {
            $(".navbar").click(function() {
                $(".dropdown").toggle();
            });
        });

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
                                <img src="img/jay.jpg" alt="">
                            </div>
                            <h4 id="name-sidebar">Your Name</h4>
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
                    <div class="col-sm-12 p-0">
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


                    <div class="dashboard-admin-content">
                        <div class="admin-upper">
                            <div class="admin-upper-left">
                                <div class="dashboard-cards card1">
                                    <i class="fas fa-syringe"></i>
                                    <div class="dashboard-cards-text text1">
                                        <p id="total-vaccinated-count">3,008</p>
                                        <p>Total Number of Vaccinated Persons</p>
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
                                    <p>Name</p>
                                    <p>Position</p>
                                </div>
                                <ul>
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
                                <div id="container" style="width: 43vw; height: 64vh; font-style: Lato, sans-serif; margin-left: 5px; margin-top: 5px;">
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

        function drawChart() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
                ['Year', 'MMR(Measles)', 'BCG(Tuberculosis)', 'DTP(Tetanus)', 'COVID-19'],
                ['2015', 8, 25, 10, 0],
                ['2016', 55, 25, 0, 0],
                ['2017', 30, 30, 6, 0],
                ['2018', 15, 10, 8, 0],
                ['2019', 55, 20, 10, 0],
                ['2020', 5, 10, 5, 10],
                ['2021', 3, 2, 2, 93],
            ]);

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
                backgroundColor: "#192734",
                isStacked: true,
                width: 620,
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
            
        }
        google.charts.setOnLoadCallback(drawChart);
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