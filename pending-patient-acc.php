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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pending Patient</title>
    <link rel="shortcut icon" href="img/favicon-sto.png" />
    <!--Carousel CSS-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity-fullscreen@1/fullscreen.css">
    <!--CSS Grid Bootstrap-->
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
    <!--Custom Carousel Design-->
    <link rel="stylesheet" href="scss/carousel.css">
    <link rel="stylesheet" href="scss/notif.css">
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
                        <li><a href="patient.php" class="patient" style="background: var(--hover-color)">Patient</a></li>
                        <li><a href="reports.php" class="reports">Reports</a></li>
                        <li><a href="track-map.php" class="trackMap">Vaccine Graph</a></li>
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
                <div class="col-sm-12">
                    <div class="search-tab margin-top-2 row justify-content-sm-between patients-view-container">
                        <div class="button-container col-lg-6 col-md-6 col-sm-6 col-xs-6 flex-box-row justify-content-start align-items-center">
                            <a href="patient.php">
                                <button class="modal-primary-button">
                                    <i class="fas fa-arrow-circle-left" style="margin-right: 0.3rem"></i>
                                    Go Back to Patient List
                                </button>
                            </a>
                            <button id="acc-req-logs-btn" class="modal-primary-button" style="background: darkslategray!important;margin-left: 0.3rem"><i class="fas fa-history"></i>View Logs</button>

                        </div>
                        <div class="search-container col-lg-4 col-md-6 col-sm-5 col-xs-6 margin-top-2">
                            <input type="text" class="search-bar" id="pending-search">
                            <a href="#"><i class="fas fa-search"></i></a>
                            <style>
                                @media ( max-width: 575px) {
                                    .search-bar{
                                        width: 50% !important;
                                    }
                                    .search-container{
                                        justify-content: flex-end;
                                        margin-top: 2rem !important;
                                    }
                                    .button-container{
                                        justify-content: flex-start !important;
                                    }
                                }
                            </style>
                        </div>
                        <!--                        <div class="details-settings">-->
                        <!--                           <a href="/">View Details</a>-->
                        <!--                           <a href="/">Edit Details</a>-->
                        <!--                        </div>-->
                    </div>
                    <div class="content patients-view-container">


                        <h3 style="color: var(--third-color)" class="margin-top-2">Pending Online Account Request for Patient</h3>
                        <table class="patients-view">
                            <p class="modal-p" style="margin: .5rem 0 0 0 !important;padding: 0 !important;"><span style="color: darkred">Note: </span>You can sort out the table by clicking on its header.</p>
                            <tbody id="pending-patient-table">
                            <tr class="patients-view-title">
                                <th>Patient Id</th>
                                <th>Patient Name</th>
                                <th>Address</th>
                                <th>Age</th>
                                <th>Gender</th>
                            </tr>

                            <tr class='clickable-row' data-href='http://localhost/capstone-project/individual-patient.php'>

                                <td>01</td>
                                <td>Name</td>
                                <td>Hagonoy</th>
                                <td>21</td>
                                <td>M</td>


                            </tr>

                            <tr>
                                <td>02</td>
                                <td>Name</td>
                                <td>Hagonoy</th>
                                <td>21</td>
                                <td>M</td>

                            </tr>





                            </tbody>
                        </table>

                    </div>
                    <?php
                    include 'pending-patient-logs.php';
                    ?>

                    <!--Floating-->
                    <div id="draggable" class="ui-widget-content" style="">
                        <div class="flex-box-column align-items-center">
                            <div class="flex-box-row justify-content-center align-items-start">
                                <p class="modal-p-2 flex-box-row align-items-start" style="padding: 0!important;"> <img src="img/swipe.png" width="25" height="25">Draggable Window</p>
                            </div>
                            <div class="flex-box-row justify-content-center align-items-start margin-top-1">
                                <h4>Account Information</h4>

                            </div>
                            <button class="modal-primary-button" id="expand-shrink" style="width: 50%;padding: 0.2rem!important;">Show All Info</button>
                            <script>
                                $("#expand-shrink").click(function () {
                                    if($(this).html()=="Show All Info"){
                                        $(this).html("Minimize")
                                        $(".min").css("display","revert")
                                    }
                                    else {
                                        $(this).html("Show All Info")
                                        $(".min").css("display","none")
                                    }
                                })
                            </script>
                            <table id="float-table" class="margin-top-1">
                                <tr>
                                    <td class="modal-p">First Name</td>
                                    <td class="modal-p-2 fname" id="">Alfredo</td>
                                </tr>
                                <tr>
                                    <td class="modal-p">Middle Name</td>
                                    <td class="modal-p-2 mname" id="">Bas</td>
                                </tr>
                                <tr>
                                    <td class="modal-p">Last Name</td>
                                    <td class="modal-p-2 lname" id="">Benitez</td>
                                </tr>
                                <tr>
                                    <td class="modal-p">Birthday</td>
                                    <td class="modal-p-2 bday" id="">1999/01/11</td>
                                </tr>
                                <tr class="min">
                                    <td class="modal-p">Purok</td>
                                    <td class="modal-p-2 purok" id="">7</td>
                                </tr>
                                <tr class="min">
                                    <td class="modal-p">Occupation</td>
                                    <td class="modal-p-2 occu" id="">7</td>
                                </tr>
                                <tr class="min">
                                    <td class="modal-p">Civil Status</td>
                                    <td class="modal-p-2 civil" id="">7</td>
                                </tr>
                                <tr class="min">
                                    <td class="modal-p">Email Used</td>
                                    <td class="modal-p-2 email-used" id="">7</td>
                                </tr>
                                <tr class="min">
                                    <td class="modal-p">Contact No.</td>
                                    <td class="modal-p-2 contact-used" id="">7</td>
                                </tr>
                                <style>
                                    .min{
                                        display: none;
                                    }
                                    #draggable{
                                        width: fit-content;padding: 1rem!important;z-index: 999999!important;border-radius: 0.5rem;display: none;box-shadow: 4px 4px 21px 9px rgba(0,0,0,0.75);
                                        -webkit-box-shadow: 4px 4px 21px 9px rgba(0,0,0,0.75);
                                        -moz-box-shadow: 4px 4px 21px 9px rgba(0,0,0,0.75);
                                    }
                                </style>
                            </div>
                        </div>
                    </div>
                    <script>
                        $("#draggable").draggable({ containment: "parent" })
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<table>-->
<!--  <tr>-->
<!--    <th>fullname</th>-->
<!--    <th>email</th>-->
<!--    <th>contact</th>-->
<!--    <th>address</th>-->
<!--    <th>Action</th>-->
<!--  </tr>-->
<!--  --><?php
//  $con=null;
//  require 'php/DB_Connect.php';
//  $res = mysqli_query($con,"SELECT*FROM pending_patient");
//  while ($row = mysqli_fetch_array($res)){
//      echo "<tr>";
//        echo "<td>".$row[1].", ".$row[2]." ".$row[3]."</td>";
//        echo "<td>".$row[10]."</td>";
//      echo "<td>".$row[12]."</td>";
//      echo "<td>".$row[6]."</td>";
//      echo "<td><button class='view' id='$row[0]' >View</button></td>";
//
//      echo "<tr>";
//  }
//  ?>
<!--</table>-->
<!--<a href="#view-pending-patient" rel="modal:open">fdfd</a>-->

<!--Modal for loading-->
<div id="pop-up-loading" class="modal">
    <div style="display: flex;align-items: center;justify-content: center">
        <div class="loader"></div>
        <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
            Retrieving Info...
        </p>
    </div>
</div>
<!--Modal for success-->
<div class="modal" id="pop-up-success">
    <div class="flex-box-row justify-content-center align-items-center">
        <img class="modal-header-icon" src="img/check.png">
        <p class="modal-p" id="pop-up-success-message">Account successfully added</p>
    </div>

    <div class="flex-box-row justify-content-end align-items-end">
        <a href="#pop-up-success" rel="modal:close">
            <button class="modal-primary-button" id="pop-up-success-ok-btn" style="margin-right: 0.5rem">Okay</button>
        </a>
        <script>
            $("#pop-up-success-ok-btn").on('click',function () {
                location.reload()
            })
        </script>
    </div>
</div>
<!--Modal for error-->
<div class="modal" id="pop-up-error">
    <div class="flex-box-row justify-content-center align-items-center">
        <img class="modal-header-icon" src="img/Icons/exclamation-mark.png">
        <p class="modal-p" id="pop-up-error-message">Cannot add account</p>
    </div>

    <div class="flex-box-row justify-content-end align-items-end">
        <a href="#pop-up-success" rel="modal:close">
            <button class="modal-primary-button" id="pop-up-success-ok-btn" style="margin-right: 0.5rem">Okay</button>
        </a>
    </div>
</div>



<a href="#" class="float" id="close-pic" style="display: none">
    <i class="fa fa-sign-out my-float" id="exit-fs" style="color: aliceblue;"></i>
</a>

<!--modal for individual view-->
<div class="modal modal-full-width" id="view-pending-patient">

    <div class="flex-box-row justify-content-center align-items-center">
        <img src="img/user.png" class="modal-header-icon">
        <p class="modal-title-2" id="modal-title" style="width: fit-content">View</p>
    </div>

    <!--    <div id="personal-cont" class="flex-box-column align-items-start margin-top-1">-->
    <!---->
    <!--        <p class="modal-p"><i class="fas fa-envelope-open-text fa-lg"></i>Email: alfred@gamil.com</p>-->
    <!--        <p class="modal-p"><i class="fas fa-id-card fa-lg"></i>Contact: 09422697900</p>-->
    <!--        <p class="modal-p"><i class="fas fa-map-marked-alt fa-lg"></i>Address: 1 poblacion Paombong  Bulacan</p>-->
    <!--        <p class="modal-p"><i class="fas fa-birthday-cake fa-lg"></i></i>Birthday: January 11, 1999</p>-->
    <!--        <p class="modal-p"><i class="fas fa-sort-numeric-up-alt fa-lg"></i>Age: 22</p>-->
    <!--        <p class="modal-p"><i class="fas fa-building fa-lg"></i></i>Occupation: Driver</p>-->
    <!--        <p class="modal-p"><i class="fas fa-users fa-lg"></i>Civil Status: Single</p>-->
    <!--    </div>-->
    <style>
        #personal-cont p{
            margin-top: 0.5rem;
        }
        .fas{
            margin-right: 0.3rem;
        }
    </style>

    <div id="overflow-x-div" style="max-height: 50vh;overflow-y: auto; overflow-x: hidden">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="flex-box-row justify-content-lg-center justify-content-sm-end align-items-end" style="margin-bottom: clamp(0.2em,0.3em,5em)">
                    <a id="fs" class="modal-p-lighter"><i class="fas fa-compress-arrows-alt"></i></i>View ID in Fullscreen</a>
                </div>
                <div class="gallery" style="margin-bottom: 1.5rem;">
                    <!--        <div class="gallery-cell"></div>-->
                    <!--        <div class="gallery-cell"></div>-->
                    <!--        <div class="gallery-cell"></div>-->
                    <!--        <div class="gallery-cell"></div>-->
                    <!--        <div class="gallery-cell"></div>-->
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 row">
                <div class="col-sm-12 justify-content-center">
                    <h5 style="text-align: center;color: var(--third-color)">Online Account Information</h5>
                    <div class="padding-all-15" id="info-cont">
                        <div>
                            <p class="modal-p">First Name</p>
                            <p class="modal-p-2 fname" id="">Alfredo</p>
                        </div>
                        <div>
                            <p class="modal-p">Middle Name</p>
                            <p class="modal-p-2 mname" id="">Bas</p>
                        </div>
                        <div>
                            <p class="modal-p">Last Name</p>
                            <p class="modal-p-2 lname" id="">Benitez</p>
                        </div>
                        <div>
                            <p class="modal-p">Birthday</p>
                            <p class="modal-p-2 bday" id="">1999/01/11</p>
                        </div>
                        <div>
                            <p class="modal-p">Purok</p>
                            <p class="modal-p-2 purok" id="">7</p>
                        </div>
                        <div>
                            <p class="modal-p">Occupation</p>
                            <p class="modal-p-2 occu" id="occu">7</p>
                        </div>
                        <div>
                            <p class="modal-p">Civil Status</p>
                            <p class="modal-p-2 civil" id="civil">7</p>
                        </div>
                        <div>
                            <p class="modal-p">Email Used</p>
                            <p class="modal-p-2 email-used" id="">7</p>
                        </div>
                        <div>
                            <p class="modal-p">Contact No.</p>
                            <p class="modal-p-2 contact-used" id="">7</p>
                        </div>
                    </div>
                    <style>
                        #info-cont div{

                        }
                        #info-cont div{
                            margin-bottom: 0.2rem;
                            display: flex;
                            flex-direction: row;
                            border-bottom: 1px solid var(--light-grey);
                        }
                        #info-cont div p{
                            flex: 0 1 50%;
                        }
                        #info-cont div .modal-p{
                           text-align: center;
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>




<!--    <div class="flex-box-row justify-content-center">-->
<!--        <button class="modal-p-lighter margin-top-2 text-center" style="padding: 0.5rem;border:1px solid var(--dark-grey);cursor: pointer;border-radius: 0.2rem;"><i class="fas fa-info-circle fa-lg"></i>Show All Info</button>-->
<!--    </div>-->

    <div class="row margin-top-1">
        <div class="col-sm-12">
            <div class="flex-box-row justify-content-center align-items-end" style="margin: 1rem">
                <button class="modal-cancel-button" id="decline" style="margin-right: 0.5rem"><i class="fas fa-times fa-lg"></i>Decline</button>
                <button class="modal-primary-button" id="accept" style="margin-left: 0.5rem"><i class="fas fa-user-check fa-lg"></i>Accept</button>
            </div>
        </div>
    </div>
</div>

<!--modal for confirm-->
<div id="pop-up-confirm-add" class="modal">
    <div class="flex-box-row justify-content-center align-items-center">

        <p class="modal-p flex-box-row justify-content-center align-items-center">
            <img class="modal-header-icon" src="img/question.png" style="margin-right: 0.3rem">
            Accept this online account request?
        </p>
    </div>

    <div class="flex-box-row justify-content-end align-items-end">
        <a href="#pop-up-confirm-add" rel="modal:close">
            <button class="modal-cancel-button"  style="margin-right: 0.5rem">Cancel</button>
        </a>
        <button class="modal-primary-button" id="final-accept" style="margin-left: 0.5rem">Accept</button>
    </div>
</div>

<!--modal for decline-->
<div id="pop-up-decline" class="modal">
    <div class="flex-box-row justify-content-center align-items-center">
        <p class="modal-title-2 flex-box-row align-items-center justify-content-start">
            <img class="modal-header-icon" src="img/decline.png">
            Decline Account Request
        </p>
    </div>
    <div class="flex-box-column justify-content-center align-items-start  margin-top-3">
        <p class="modal-smaller-p " id="to" style="font-weight: 400;width: 100%;color: var(--third-color)">To: Alfredo B. Benitez</p>
        <p class="modal-smaller-p " id="email" style="font-weight: 400;width: 100%;color: var(--third-color)">Email: alfredogie@gmail.com</p>
    </div>
    <div class="flex-box-row justify-content-start align-items-center margin-top-1" style="margin-bottom: clamp(0.2em,0.3em,5em);">
        <a class="modal-smaller-p" style="cursor: inherit">Please type a reason</a>
    </div>

    <div class="flex-box-column justify-content-center align-items-start" style="margin-bottom: clamp(0.2em,0.3em,5em)">
        <textarea id="decline-reason" placeholder="Message" style="font-family: Poppins;letter-spacing: 1px">
        </textarea>
        <p class="modal-p-error">Please input reason!</p>
        <script>
            $("#decline-reason").val("")
        </script>
        <style>
            #decline-reason{
                resize: none;width: 97%;max-width: 100%;border: none;
                padding: 0.5rem;outline: none;margin: 0 0.3rem 0 0.3rem;
                height: 25vh;
                border-top: 0.1rem solid var(--light-grey);
            }
        </style>
    </div>
    <div class="flex-box-row justify-content-end align-items-end margin-top-1" style="margin: 0.5rem">
        <a href="#pop-up-decline" rel="modal:close">
            <button class="modal-cancel-button"  style="margin-right: 0.5rem">Cancel</button>
        </a>
        <button class="modal-primary-button" id="final-decline" style="margin-left: 0.5rem">Decline</button>
    </div>
</div>

<!--Table sortable script-->
<script src="js/table-sortable.js"></script>
<script>
    let pic_count=0;
    let carouselInstance=false
    $(document).ready(function(){
        /*
        ===============call % destroy the carousel======================
        */
        function call_carousel() {
            $( '.gallery' ).flickity( {
                cellAlign: 'center',
                autoplay:true,
                lazyLoad: true
                //contain: true,
                //prevNextButtons: false,
                //groupCells: 2,
            } );
            $(".flickity-slider").prop('id','flickity-slider')
            $('#fs').on( 'click', function() {
                $( '.gallery' ).flickity('viewFullscreen');
                window.dispatchEvent(new Event('resize'));
                $("#close-pic").css("display","inline")
                $("#draggable").css("display","block")
                $(".gallery-cell img").css("max-height","80vh")
                $("#draggable").position({
                    my: "right bottom",
                    at: "right bottom",
                    of: ".flickity-viewport"
                });
                window.dispatchEvent(new Event('resize'));
            });
            $("#exit-fs").off("click")
            $("#exit-fs").on( 'click', function() {
                exit_fullscreen()
            });
            function exit_fullscreen() {
                $("#close-pic").css("display","none")
                $("#draggable").css("display","none")
                $(".gallery-cell img").css("max-height","100%")
                $( '.gallery' ).flickity('exitFullscreen')
                window.dispatchEvent(new Event('resize'));
            }
            $(document).keyup(function(e) {
                if (e.key === "Escape") { // escape key maps to keycode `27`
                    window.dispatchEvent(new Event('resize'));
                    exit_fullscreen()
                }
            });
            $(document).on('click',function (e) {//close fullscreen when black bg was clicked
                if(e.target.id=='flickity-slider'){
                    // exit_fullscreen()
                }
            })

        }
        function destroy_carousel() {
            $( '.gallery' ).flickity('destroy')
            $("#fs").off('click')
            $("#exit-fs").off('click')
            $(".gallery").html("")
        }

//=====================action====================
        let data ="";
        let id="";
        let name="" ;
        let email = "";


        function click_view_button() {
            $(".view").click(function () {
                if(carouselInstance){
                    destroy_carousel()
                }
                call_carousel();
                carouselInstance=true


                id = $(this).data('id');//session for selected pending account
                $.post('php/registerProcesses/activeSelectedPendingSession.php',{id:id}).done(function (data) {
                    // alert(data)
                    let result = JSON.parse(data);
                    $(".fname").html(result.first_name)
                    $(".mname").html(result.middle_name)
                    $(".lname").html(result.last_name+" "+result.suffix)
                    $(".bday").html(result.birthday)
                    $(".purok").html(result.purok)
                    $(".occu").html(result.occupation)
                    $(".civil").html(result.civil_status)
                    $(".email-used").html(result.email)
                    $(".contact-used").html(result.contact_no)
                })

                name = $(this).data('lname')+", "+$(this).data('fname')+" "+$(this).data('mname');
                email = $(this).data('email');//alert(email)
                //alert(name)
                $("#modal-title").html(name)
                //alert(id)
                $("#pop-up-loading").modal({
                    showClose:false,
                })

                $.post('php/registerProcesses/retrieve_pending_patient_info.php',{id:id}).done(
                    function (data) {
                        setTimeout(function () {
                            /* if(pic_count!=0){
                                 for(let a=0;a<pic_count;a++){
                                     $( '.gallery' ).flickity( 'remove', $(".gallery-cell")[a])
                                 }
                             }
                             pic_count=0;*/

                            let result = JSON.parse(data)
                            //alert(result.pic_path)
                            let pics = result.pic_path.split(" ")
                            //alert(pics.length)
                            for(let pic of pics){
                                pic_count+=1;
                                // alert(pic)
                                $( '.gallery' ).flickity('insert',
                                    $($.parseHTML("<div>")).prop("class","gallery-cell")
                                        .append($($.parseHTML("<img>")).prop('src',pic))
                                )
                            }

                            $("#view-pending-patient").modal({/*clickClose:false,*/ escapeClose: false,/*showClose:false*/})
                            //$( '.gallery' ).flickity('reloadCells')
                            $( '.gallery' ).flickity('resize')
                            window.dispatchEvent(new Event('resize'));
                            window.dispatchEvent(new Event('resize'));

                        },300)

                    }
                )//done
            })
        }
        click_view_button();

        //======================Accept===============
        $("#accept").on('click',function () {
            $("#pop-up-confirm-add").modal({
                showClose: false,
                escapeClose: false,
                clickClose: false,
                closeExisting:false,
            })
        })
        $("#final-accept").on('click',function () {
            $("#pop-up-loading").modal({
                showClose: false,
                escapeClose: false,
                clickClose: false,
                /*closeExisting:false,*/
            })
            $("#pop-up-loading-message").html("Processing Request...")

            $.post('php/registerProcesses/validate_patient_account.php',{pending_patient_id:id}).done(function (data) {

                if(data==1){
                    setTimeout(()=>{
                        $("#pop-up-success").modal({showClose: false, escapeClose: false, clickClose: false,})
                    },700)
                }
                else {
                    setTimeout(()=>{
                        $("#pop-up-error").modal({showClose: false, escapeClose: false, clickClose: false,})
                    },700)
                    console.log(data)
                }

            })

        })
        //======================Decline===============
        $("#decline").on('click',function (){
            $("#pop-up-decline").modal({/*showClose: false,*/ escapeClose: false, clickClose: false,closeExisting: false})
            $("#to").html("<strong>To: </strong>"+name)
            $("#email").html("<strong>Email: </strong>"+email)
        })
        $("#final-decline").click(function () {
            if($("#decline-reason").val()==""){
                $(".modal-p-error").css('visibility','visible')
            }
            else {
                $(".modal-p-error").css('visibility','hidden')
                $("#pop-up-loading").modal({showClose: false, escapeClose: false, clickClose: false})
                $("#pop-up-loading-message").html("Processing Request...")

                $.post('php/registerProcesses/decline.php',{id:id,decline_msg:$("#decline-reason").val()}).done(function (data) {
                    if(data==1){
                        setTimeout(()=>{
                            $("#pop-up-success").modal({showClose: false, escapeClose: false})
                            $("#pop-up-success-message").html("The account declined successfully")
                        },700)
                    }
                    else{
                        setTimeout(()=>{
                            $("#pop-up-error").modal({showClose: false, escapeClose: false})
                            $("#pop-up-error-message").html("Can't process request! Please try again later")
                        },700)
                    }

                })
            }
        })
        $("#decline-reason").keyup(function () {
            $(".modal-p-error").css('visibility','hidden')
        })

        //================PAGINATION RELATED CODE================================
        var table = $('#pending-patient-table').tableSortable({
            data: [],
            columns:
                {
                    name:"Name",
                    date:"Date",
                    // address:"Address",
                    // contact_no: "Contact",
                    // email:'Email',
                    button:"Action"
                }
            ,
            sorting:['name','date'],
            searchField: '#pending-search',
            // responsive: {
            //     720: {
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     },
            //     512:{
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     }
            // },
            rowsPerPage: 5,
            pagination: true,
            tableWillMount: function() {
                console.log('table will mount')
            },
            tableDidMount: function() {
                console.log('table did mount')
            },
            tableWillUpdate: function() {console.log('table will update')},
            tableDidUpdate: function() {
                console.log('table did update');  click_view_button();
                for (a=0;a<parseInt(window.rowCount_pending);a++){
                    $($($(".gs-table-body").children()[a]).children()[0]).attr("data-label","Name")
                    $($($(".gs-table-body").children()[a]).children()[1]).attr("data-label","Date Requested")
                    $($($(".gs-table-body").children()[a]).children()[2]).attr("data-label","Action")

                    }
                },
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });
        $.get('php/registerProcesses/retrievePendingList.php', function(data) {
            // Push data into existing data
            console.log(JSON.parse(data))
            if(JSON.parse(data).length==0){
                $("#pending-patient-table div .gs-table tbody").html("").append("<tr style='pointer-events: none'><td colspan='3'><h3 style='text-align: center;width: 100%;color: var(--third-color)'>No Record</h3></td></tr>")
                return
            }
            //table.setData(JSON.parse(data), null, true);
            window.rowCount_pending = JSON.parse(data).length;
            // or Set new data on table, columns is optional.
            table.setData(JSON.parse(data),{
                // id: "ID",
                name:"Name",
                // address:"Address",
                // contact_no: "Contact",
                // email:'Email',
                date:"Date Requested",
                button:"Action"
            });

        })
        $('#changeRows').on('change', function() {
            table.updateRowsPerPage(parseInt($(this).val(), 10));
        })

        $('#rerender').click(function() {
            table.refresh(true);
        })

        $('#distory').click(function() {
            table.distroy();
        })

        $('#refresh').click(function() {
            table.refresh();
        })

        $('#setPage2').click(function() {
            table.setPage(1);
        })

    });// END OF DOCUMENT REDY FUNCTION



</script>
<!-- Carousel JavaScript -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://unpkg.com/flickity-fullscreen@1/fullscreen.js"></script>
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
<!--Pagination table style-->
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
    }
    button.view{
        padding: 0.5em;
        border:none;
        outline: none;
        background: var(--primary-color);
        color: var(--secondary-color);
    }
    @media(max-width: 1150px) {
        td{
            font-size: clamp(0.4rem,0.8rem,1rem);
        }
    }
    .gs-table-head tr th span {
        color: white!important;
    }

</style>

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

<!--Modal for loading list-->
<div id="pop-up-loading-list" class="modal">
    <div style="display: flex;align-items: center;justify-content: center">
        <div class="loader"></div>
        <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
            Retrieving List...
        </p>
        <a href="#pop-up-loading-list" rel="modal:close" id="close-loading" style="display: none">
        </a>
    </div>
</div>
<script>
    $("#pop-up-loading-list").modal({
        showClose:false,clickClose:false,escapeClose:false
    })
    $(window).on("load",function () {
        setTimeout(()=>{
            $('[href="#pop-up-loading-list"]').trigger("click")
        },500)

    })
</script>
</body>
</html>