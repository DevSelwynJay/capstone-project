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
    <style>
        .drop-down-settings,.drop-down-settings open{
            z-index: 1000;
        }
    </style>
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
                       <h4>Your Name</h4>
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
                        " title="There is a Critical Stock in our Inventory" ><?php echo $total; ?></span></a></li>
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
                 <div class="col-sm-12  p-0">
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
                        " title="There is a Critical Stock in our Inventory" ><?php echo $total; ?></span></a></li>
                                  </ul>
                               </div>
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
                    <div class="reports_content">
                        <div class="reports_nav row-container">
                           <div class="reports-title col-lg-3">
                            <h4>Medicine Reports</h4>
                           </div>
                           <ul class="reports-menu col-lg-9">
                               <li><a id="medicine-link" class="active">Medicine Released</a></li>
                               <li><a id="added-link">Added</a></li>
                               <li><a id="expired-link">Expired</a></li>
                               <li><a id="update-link">Updated</a></li>
                               <li><a id="vaccine-link">Vaccine Released</a></li>
                           </ul>
                        </div>
                       <div class="row-container">
                         <div class="col-lg-3 left-reports">
                             <div class="row-container">
                                 <div class="col-lg-12 reports_upper-col">
                                  <div class="reports_individual-report-links">
                                    <a id="daily-link" class="active">Daily</a>
                                    <a id="weekly-link" >Weekly</a>
                                    <a id="monthly-link">Monthly</a>
                                    <a id="quarterly-link">Quarterly</a>
                                    <a id="anually-link">Annually</a>
                                  </div>
                                 </div>
                                 <div class="col-lg-12 reports_lower-col">
                                    <div class="reports_individual-report-download">
                                        <a id="excel-link">Download Report (csv)</a>
                                        <a id="pdf-link">Dowload Report (pdf)</a>
                                        <a href="">Print Report</a>
                                      </div>
                                </div>
                             </div>
                         </div>
                         <div class="col-lg-9 table-reports">
                           <div class="reports__individual-container" id="tablediv">
                            <table class="reports__individual-reports-table">
                                <tbody>
                                   <tr>
                                      <th>Medicine Id</th>
                                      <th>Medicine Name</th>
                                      <th>Category</th>
                                      <th>No. of Stocks</th>
                                      <th>Mfg. Date</th>
                                      <th>EXP. Date</th>
                                   </tr>
                                   <tr>
                                      <td>Name</td>
                                      <td>Illness</td>
                                      <td>Illness</td>
                                      <td>Illness</td>
                                      <td>Illness</td>
                                      <td>Illness</td>
                                   </tr>
                                   <tr>
                                    <td>Name</td>
                                    <td>Illness</td>
                                    <td>Illness</td>
                                    <td>Illness</td>
                                    <td>Illness</td>
                                    <td>Illness</td>
                                 </tr>
                                   
                                </tbody>
                             </table>
                           </div>
                         </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>

    <script>
        //Attribute
        //for PDF
        //href='php/reportProcesses/pdf_gen.php?type="type-name"'
        //$_GET['type']
        //Display Expired Table
        $(document).ready(function(){
            displayMedRelTab();
            $('#expired-link').on("click", function (){
                $('#medicine-link').attr('class','');
                $('#update-link').attr('class','');
                $('#expired-link').attr('class','active');
                $('#vaccine-link').attr('class','');
                $('#added-link').attr('class','');
                displayExpTab();
            });
            $('#added-link').on("click", function(){
                $('#medicine-link').attr('class','');
                $('#update-link').attr('class','');
                $('#expired-link').attr('class','');
                $('#vaccine-link').attr('class','');
                $('#added-link').attr('class','active');
                displayAddedTab();
            });
            $('#update-link').on("click", function(){
                $('#medicine-link').attr('class','');
                $('#update-link').attr('class','active');
                $('#expired-link').attr('class','');
                $('#vaccine-link').attr('class','');
                $('#added-link').attr('class','');
                displayUpdateTab();
            });
            $('#medicine-link').on("click", function(){
                $('#medicine-link').attr('class','active');
                $('#update-link').attr('class','');
                $('#expired-link').attr('class','');
                $('#vaccine-link').attr('class','');
                $('#added-link').attr('class','');
                displayMedRelTab();
            });
            $('#vaccine-link').on("click", function(){
                $('#medicine-link').attr('class','');
                $('#update-link').attr('class','');
                $('#expired-link').attr('class','');
                $('#vaccine-link').attr('class','active');
                $('#added-link').attr('class','');
                displayUpdateTab();
            });
            $('#daily-link').on("click", function(){
                $('#weekly-link').attr('class','');
                $('#daily-link').attr('class','active');
                $('#monthly-link').attr('class','');
                $('#quarterly-link').attr('class','');
                $('#anually-link').attr('class','');
                var getadd = $('#added-link').attr('class');
                var getexpired = $('#expired-link').attr('class');
                var getmedicine = $('#medicine-link').attr('class');
                var getupdate = $('#update-link').attr('class');
                var getvaccine = $('#vaccine-link').attr('class');
                if(getadd=="active"){
                    displayAddedTab()
                }
                else if(getupdate=="active"){
                    displayUpdateTab();
                }
                else if(getexpired=="active"){
                    displayExpTab();
                }
                else if(getmedicine=="active"){
                    displayMedRelTab();

                }
                else if(getvaccine=="active"){
                    displayVacRelTab();
                }
            });
            $('#weekly-link').on("click", function(){
                $('#weekly-link').attr('class','active');
                $('#daily-link').attr('class','');
                $('#monthly-link').attr('class','');
                $('#quarterly-link').attr('class','');
                $('#anually-link').attr('class','');
                var getadd = $('#added-link').attr('class');
                var getexpired = $('#expired-link').attr('class');
                var getmedicine = $('#medicine-link').attr('class');
                var getupdate = $('#update-link').attr('class');
                var getvaccine = $('#vaccine-link').attr('class');
                if(getadd=="active"){
                    displayAddedTab()
                }
                else if(getupdate=="active"){
                    displayUpdateTab();
                }
                else if(getexpired=="active"){
                    displayExpTab();
                }
                else if(getmedicine=="active"){
                    displayMedRelTab();

                }
                else if(getvaccine=="active"){
                    displayVacRelTab();
                }
            });
            $('#monthly-link').on("click", function(){
                $('#weekly-link').attr('class','');
                $('#daily-link').attr('class','');
                $('#monthly-link').attr('class','active');
                $('#quarterly-link').attr('class','');
                $('#anually-link').attr('class','');
                var getadd = $('#added-link').attr('class');
                var getexpired = $('#expired-link').attr('class');
                var getmedicine = $('#medicine-link').attr('class');
                var getupdate = $('#update-link').attr('class');
                var getvaccine = $('#vaccine-link').attr('class');
                if(getadd=="active"){
                    displayAddedTab()
                }
                else if(getupdate=="active"){
                    displayUpdateTab();
                }
                else if(getexpired=="active"){
                    displayExpTab();
                }
                else if(getmedicine=="active"){
                    displayMedRelTab();

                }
                else if(getvaccine=="active"){
                    displayVacRelTab();
                }
            });
            $('#quarterly-link').on("click", function(){
                $('#weekly-link').attr('class','');
                $('#daily-link').attr('class','');
                $('#monthly-link').attr('class','');
                $('#quarterly-link').attr('class','active');
                $('#anually-link').attr('class','');
                var getadd = $('#added-link').attr('class');
                var getexpired = $('#expired-link').attr('class');
                var getmedicine = $('#medicine-link').attr('class');
                var getupdate = $('#update-link').attr('class');
                var getvaccine = $('#vaccine-link').attr('class');
                if(getadd=="active"){
                    displayAddedTab()
                }
                else if(getupdate=="active"){
                    displayUpdateTab();
                }
                else if(getexpired=="active"){
                    displayExpTab();
                }
                else if(getmedicine=="active"){
                    displayMedRelTab();

                }
                else if(getvaccine=="active"){
                    displayVacRelTab();
                }
            });
            $('#anually-link').on("click", function(){
                $('#weekly-link').attr('class','');
                $('#daily-link').attr('class','');
                $('#monthly-link').attr('class','');
                $('#quarterly-link').attr('class','');
                $('#anually-link').attr('class','active');
                var getadd = $('#added-link').attr('class');
                var getexpired = $('#expired-link').attr('class');
                var getmedicine = $('#medicine-link').attr('class');
                var getupdate = $('#update-link').attr('class');
                var getvaccine = $('#vaccine-link').attr('class');
                if(getadd=="active"){
                    displayAddedTab()
                }
                else if(getupdate=="active"){
                    displayUpdateTab();
                }
                else if(getexpired=="active"){
                    displayExpTab();
                }
                else if(getmedicine=="active"){
                    displayMedRelTab();

                }
                else if(getvaccine=="active"){
                    displayVacRelTab();
                }
            });
            $('#pdf-link').on("click", function(){
                var getadd = $('#added-link').attr('class');
                var getexpired = $('#expired-link').attr('class');
                var getmedicine = $('#medicine-link').attr('class');
                var getupdate = $('#update-link').attr('class');
                var getvaccine = $('#vaccine-link').attr('class');
                var getdaily = $('#daily-link').attr('class');
                var getweekly = $('#weekly-link').attr('class');
                var getmonthly = $('#monthly-link').attr('class');
                var getquarterly = $('#quarterly-link').attr('class');
                var getannually = $('#anually-link').attr('class');
                if(getmedicine == 'active'){
                    if(getdaily == 'active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?daily=1&type=Medicine');




                    }
                    else if(getweekly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?weekly=1&type=Medicine');



                    }
                    else if(getmonthly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?monthly=1&type=Medicine');


                    }
                    else if(getquarterly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?quarterly=1&type=Medicine');


                    }
                    else if(getannually=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?annually=1&type=medicine');


                    }

                }
                else if(getadd=='active'){
                    if(getdaily == 'active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?daily=1&type=Add');


                    }
                    else if(getweekly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?weekly=1&type=Add');


                    }
                    else if(getmonthly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?monthly=1&type=Add');


                    }
                    else if(getquarterly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?quarterly=1&type=Add');


                    }
                    else if(getannually=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?annually=1&type=Add');


                    }

                }
                else if(getexpired == 'active'){
                    if(getdaily == 'active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?daily=1&type=Delete');


                    }
                    else if(getweekly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?weekly=1&type=Delete');


                    }
                    else if(getmonthly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?monthly=1&type=Delete');


                    }
                    else if(getquarterly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?quarterly=1&type=Delete');


                    }
                    else if(getannually=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?annually=1&type=Delete');


                    }

                }
                else if(getupdate=='active'){
                    if(getdaily == 'active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?daily=1&type=Update');


                    }
                    else if(getweekly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?weekly=1&type=Update');


                    }
                    else if(getmonthly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?monthly=1&type=Update');

                    }
                    else if(getquarterly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?quarterly=1&type=Update');

                    }
                    else if(getannually=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?annually=1&type=Update');

                    }

                }
                else if(getvaccine=='active'){
                    if(getdaily == 'active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?daily=1&amp;type=Vaccine');

                    }
                    else if(getweekly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?weekly=1&amp;type=Vaccine');

                    }
                    else if(getmonthly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?monthly=1&amp;type=Vaccine');

                    }
                    else if(getquarterly=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?quarterly=1&amp;type=Vaccine');

                    }
                    else if(getannually=='active'){
                        $('#pdf-link').attr('href','php/reportProcesses/pdf_gen.php?annually=1&amp;type=Vaccine');

                    }

                }

            });



        $('#excel-link').on("click", function(){
            var getadd = $('#added-link').attr('class');
            var getexpired = $('#expired-link').attr('class');
            var getmedicine = $('#medicine-link').attr('class');
            var getupdate = $('#update-link').attr('class');
            var getvaccine = $('#vaccine-link').attr('class');
            var getdaily = $('#daily-link').attr('class');
            var getweekly = $('#weekly-link').attr('class');
            var getmonthly = $('#monthly-link').attr('class');
            var getquarterly = $('#quarterly-link').attr('class');
            var getannually = $('#anually-link').attr('class');
            if(getmedicine == 'active'){
                if(getdaily == 'active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?daily=1&type=Medicine');




                }
                else if(getweekly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?weekly=1&type=Medicine');



                }
                else if(getmonthly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?monthly=1&type=Medicine');


                }
                else if(getquarterly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?quarterly=1&type=Medicine');


                }
                else if(getannually=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?annually=1&type=medicine');
                }

            }
            else if(getadd=='active'){
                if(getdaily == 'active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?daily=1&type=Add');


                }
                else if(getweekly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?weekly=1&type=Add');


                }
                else if(getmonthly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?monthly=1&type=Add');


                }
                else if(getquarterly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?quarterly=1&type=Add');


                }
                else if(getannually=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?annually=1&type=Add');


                }

            }
            else if(getexpired == 'active'){
                if(getdaily == 'active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?daily=1&type=Delete');


                }
                else if(getweekly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?weekly=1&type=Delete');


                }
                else if(getmonthly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?monthly=1&type=Delete');


                }
                else if(getquarterly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?quarterly=1&type=Delete');


                }
                else if(getannually=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?annually=1&type=Delete');


                }

            }
            else if(getupdate=='active'){
                if(getdaily == 'active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?daily=1&type=Update');


                }
                else if(getweekly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?weekly=1&type=Update');


                }
                else if(getmonthly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?monthly=1&type=Update');

                }
                else if(getquarterly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?quarterly=1&type=Update');

                }
                else if(getannually=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?annually=1&type=Update');

                }

            }
            else if(getvaccine=='active'){
                if(getdaily == 'active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?daily=1&amp;type=Vaccine');

                }
                else if(getweekly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?weekly=1&amp;type=Vaccine');

                }
                else if(getmonthly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?monthly=1&amp;type=Vaccine');

                }
                else if(getquarterly=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?quarterly=1&amp;type=Vaccine');

                }
                else if(getannually=='active'){
                    $('#excel-link').attr('href','php/reportProcesses/excel_gen.php?annually=1&amp;type=Vaccine');

                }

            }

        });


        });





        function displayExpTab(page){
            var getdaily = $('#daily-link').attr('class');
            var getweekly = $('#weekly-link').attr('class');
            var getmonthly = $('#monthly-link').attr('class');
            var getquarterly = $('#quarterly-link').attr('class');
            var getannually = $('#anually-link').attr('class');
            var interval = '';
            if(getdaily == 'active'){
                interval = 'daily';

            }
            else if(getweekly=='active'){
                interval = 'weekly';

            }
            else if(getmonthly=='active'){
                interval = 'monthly';

            }
            else if(getquarterly=='active'){
                interval = 'quarterly';

            }
            else if(getannually=='active'){
                interval = 'annually';

            }
            $.ajax({
                url: 'php/reportProcesses/displayExpTab.php',
                type: 'POST',
                data:{
                    page:page,
                    interval:interval
                },
                success: function (data, status){
                    $('#tablediv').html(data);
                }
            })
        };
        $(document).on("click",".pagination_linkexp",function (){
            var page = $(this).attr("id");
            displayExpTab(page);
        });
        function displayAddedTab(page){
            var getdaily = $('#daily-link').attr('class');
            var getweekly = $('#weekly-link').attr('class');
            var getmonthly = $('#monthly-link').attr('class');
            var getquarterly = $('#quarterly-link').attr('class');
            var getannually = $('#anually-link').attr('class');
            var interval = '';
            if(getdaily == 'active'){
                interval = 'daily';

            }
            else if(getweekly=='active'){
                interval = 'weekly';

            }
            else if(getmonthly=='active'){
                interval = 'monthly';

            }
            else if(getquarterly=='active'){
                interval = 'quarterly';

            }
            else if(getannually=='active'){
                interval = 'annually';

            }
            $.ajax({
                url: 'php/reportProcesses/displayAddedTab.php',
                type: 'POST',
                data:{
                    page:page,
                    interval:interval
                },
                success: function (data, status){
                    $('#tablediv').html(data);
                }
            })
        };
        $(document).on("click",".pagination_linkadd",function (){
            var page = $(this).attr("id");
            displayAddedTab(page);
        });
        function displayUpdateTab(page){
            var getdaily = $('#daily-link').attr('class');
            var getweekly = $('#weekly-link').attr('class');
            var getmonthly = $('#monthly-link').attr('class');
            var getquarterly = $('#quarterly-link').attr('class');
            var getannually = $('#anually-link').attr('class');
            var interval = '';
            if(getdaily == 'active'){
                interval = 'daily';

            }
            else if(getweekly=='active'){
                interval = 'weekly';

            }
            else if(getmonthly=='active'){
                interval = 'monthly';

            }
            else if(getquarterly=='active'){
                interval = 'quarterly';

            }
            else if(getannually=='active'){
                interval = 'annually';

            }

            $.ajax({
                url: 'php/reportProcesses/displayUpdateTab.php',
                type: 'POST',
                data:{
                    page:page,
                    interval:interval
                },
                success: function (data, status){
                    $('#tablediv').html(data);
                }
            })
        };
        $(document).on("click",".pagination_linkup",function (){
            var page = $(this).attr("id");
            displayUpdateTab(page);
        });

        function displayMedRelTab(page){
            var getdaily = $('#daily-link').attr('class');
            var getweekly = $('#weekly-link').attr('class');
            var getmonthly = $('#monthly-link').attr('class');
            var getquarterly = $('#quarterly-link').attr('class');
            var getannually = $('#anually-link').attr('class');
            var interval = '';
            if(getdaily == 'active'){
                interval = 'daily';

            }
            else if(getweekly=='active'){
                interval = 'weekly';

            }
            else if(getmonthly=='active'){
                interval = 'monthly';

            }
            else if(getquarterly=='active'){
                interval = 'quarterly';

            }
            else if(getannually=='active'){
                interval = 'annually';

            }

            $.ajax({
                url: 'php/reportProcesses/displayMedReleasedTab.php',
                type: 'POST',
                data:{
                    page:page,
                    interval:interval
                },
                success: function (data, status){
                    $('#tablediv').html(data);
                }
            })
        };
        $(document).on("click",".pagination_linkmed",function (){
            var page = $(this).attr("id");
            displayMedRelTab(page);
        });
        function displayVacRelTab(page){
            var getdaily = $('#daily-link').attr('class');
            var getweekly = $('#weekly-link').attr('class');
            var getmonthly = $('#monthly-link').attr('class');
            var getquarterly = $('#quarterly-link').attr('class');
            var getannually = $('#anually-link').attr('class');
            var interval = '';
            if(getdaily == 'active'){
                interval = 'daily';

            }
            else if(getweekly=='active'){
                interval = 'weekly';

            }
            else if(getmonthly=='active'){
                interval = 'monthly';

            }
            else if(getquarterly=='active'){
                interval = 'quarterly';

            }
            else if(getannually=='active'){
                interval = 'annually';

            }

            $.ajax({
                url: 'php/reportProcesses/displayVacReleasedTab.php',
                type: 'POST',
                data:{
                    page:page,
                    interval:interval
                },
                success: function (data, status){
                    $('#tablediv').html(data);
                }
            })
        };
        $(document).on("click",".pagination_linkvac",function (){
            var page = $(this).attr("id");
            displayVacRelTab(page);
        });




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