<?php
session_start();
if(!isset($_SESSION['email'])){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
?>
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
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <title>Settings</title>
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>
    <!--CustomJS-->
    <script src="js/settings.js"></script>
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
    <script>
        $( document ).tooltip({
            position: {
                my: "center bottom-20",
                at: "center top",
                using: function( position, feedback ) {
                    $( this ).css( position );
                    $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                }
            }
        });
    </script>
    <!--Override some CSS-->
    <style>
        .fa-edit:hover{
            color: #969191;
            transform: scale(1.5,1.5);
        }
        .fa-edit{
            transition: all 700ms;
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
                    <div class="col-sm-12">
                        <div class="inner-page-nav">
                            <div class="logo">
                                <img src="img/HIS logo blue.png" alt="">
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


                    <div class="content">
                        <div class="text-content">
                            <div class="left-text">
                                <p>Settings</p>
                                <ul>
                                    <li><a href=settings.php#" style="color: #0c6893">Change Personal Information</a></li>
                                    <li><a href="change-email-settings.php">Update Existing Email</a></li>
                                    <li><a href="change-password-settings.php">Change Password</a></li>
                                </ul>
                            </div>
                            <div class="right-text">
                                <p>Personal Information</p>
                                <table>
                                    <tr>
                                        <td><i class="fas fa-edit" id="fname-edit"></i>First Name:</td>
                                        <td id="fname">Juan</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-edit" id="mname-edit"></i>Middle Name:</td>
                                        <td id="mname">Santos</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-edit" id="lname-edit"></i>Surname:</td>
                                        <td id="lname">Dela Cruz</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-edit" id="gender-edit"></i>Gender:</td>
                                        <td id="gender">Male</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-edit" id="age-edit"></i>Age:</td>
                                        <td id="age">21</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-edit" id="bday-edit"></i>Birthday:</td>
                                        <td id="bday">01/01/1999</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-edit" id="address-edit"></i>Address:</td>
                                        <td id="address">Guinhawa, Malolos, Bulacan</td>
                                    </tr>
                                </table>
                                <button class = "save-changes">Save Changes</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>

    <!--Edit modal-->
    <div id="edit-modal" class="modal">
        <div class="flex-box-row justify-content-center align-items-center">
            <p class="modal-title-2 flex-box-row align-items-center title-font-color">
                <i class="fas fa-user-edit fa-lg fourth-color" style="margin-right: 0.3rem"></i>
                Edit Personal Info
            </p>
        </div>
        <div class="modal-content-scrollable">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6" >
                        <p class="modal-p" for="fname-edit">First Name:</p><input type="text" id="fname-edit-2" class="modal-field">
                    </div>
                    <div class="col-sm-6" >
                        <p class="modal-p" for="mname-edit">Middle Name:</p><input type="text" id="mname-edit-2"  class="modal-field">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6" >
                        <p class="modal-p"for="lname-edit">Last Name:</p> <input type="text" id="lname-edit-2"  class="modal-field">
                    </div>
                    <div class="col-sm-6" >
                        <p class="modal-p" for="bday-edit" >Birthday:</p>
                        <input type="text" id="bday-edit-2" contenteditable="false"  class="modal-field">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="modal-p" for="gender-edit">Gender:</p>
                        <select id="gender-edit-2"  class="modal-field">
                            <option id="Male">Male</option>
                            <option id="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <p class="modal-p" for="age-edit">Age:</p>
                        <input type="text" id="age-edit-2" disabled="disabled"  class="modal-field">
                    </div>
                </div>
                <div class="row flex-row justify-content-start" style="display: flex">
                    <div class="col-sm-12">
                        <p class="modal-p" for="age-edit">Address:</p>
                        <input type="text" id="address-edit-2" class="modal-field">
                    </div>

                </div>

                </div>
        </div>
        <div class="col-sm-12 flex-box-row justify-content-end align-items-end margin-top-1">
            <a href="#edit-modal" rel="modal:close"><button class="modal-cancel-button" style="margin-right: 0.5rem">Cancel</button></a>
            <a><button id="okay-edit-btn" class="modal-primary-button">Okay</button></a>
        </div>
        </div>
    <!--Confirm edit-->
    <div class="modal" id="confirm-changes">
        <div class="justify-content-center" style="display: flex">
            <p class="modal-sub-title">Save changes?</p>
        </div>
        <div class="justify-content-end" style="display: flex">
            <a href="#confirm-changes" rel="modal:close">
                <button class="modal-cancel-button" style="margin-right: 0.5rem">Cancel</button>
            </a>
                <button id="confirm-changes-ok-btn" class="modal-primary-button">Okay</button>
        </div>
    </div>

    <!--modal for loading-->
    <div id="pop-up-loading" class="modal">
        <div style="display: flex;align-items: center;justify-content: center">
            <div class="loader"></div>
            <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
                Processing Request...
            </p>
        </div>
    </div>


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