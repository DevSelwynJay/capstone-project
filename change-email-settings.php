<?php
session_start();
if(!isset($_SESSION['email'])){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
?><!DOCTYPE html>
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
    <title>Change Email Settings</title>
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>

    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="scss/tooltip.css">
    <script src="jquery-ui/jquery-ui.js"></script>
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

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--Custom CSS-->
    <link rel="stylesheet" href="scss/scrollbar_loading.css">
    <!--Custom Modal Design-->
    <link rel="stylesheet" href="scss/modal.css">
    <!--Bootstrap
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
     -->

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
                                    <li><a href="dashboard-admin.php"><i class="fas fa-columns"></i>Dashboard</a></li>
                                    <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                                    <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                                    <li><a href="track-map.php"><i class="fas fa-map-marker"></i>Track Map</a></li>
                                    <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
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


                    <div class="content">
                        <div class="text-content">
                            <div class="left-text">
                                <p>Settings</p>
                                <ul>
                                    <li><a href="settings.php">Change Personal Information</a></li>
                                    <li><a href="change-email-settings.php" style="color: #0c6893">Update Existing Email</a></li>
                                    <li><a href="change-password-settings.php">Change Password</a></li>
                                </ul>
                            </div>
                            <style>
                                a{
                                    text-decoration: none;
                                }
                            </style>
                            <div class="right-text">
                                    <p>Modify Email Address</p>
                                    <label for="current-email">Current Email</label>
                                    <input type="email" name = "current-email" id = "current-email" title="Please type your current email" data-toggle="tooltip" data-placement="top" title="House #" data-container="body"><br>
                                    <label for="new-email">New Email</label>
                                    <input type="email" name = "new-email" id = "new-email" title="Please type your new email" data-toggle="tooltip" data-placement="top" title="House #" data-container="body">
                                    <a><button class="save-changes2" id="save">Save Changes</button></a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>


    </section>
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
    <!--Change email script-->
    <script>
        let modalConfig = {
            escapeClose: false,
            clickClose: false,
            showClose: false
        }

        //$('[data-toggle="tooltip"]').tooltip()
        let email="";
        $.post("php/settingsProcesses/retrieveCurrentEmail.php").done(function (data) {
           email= data

        })
        let is_valid_email_format =false
        $("#current-email").keyup(function (){
            is_valid_email_format =false
            $(this).prop('title','Please type your current email')
            if($(this).val()=="") {$(this).css("border-color","#6d6d6d");return}
            if($(this).val()!=email){
                $(this).css("border-color","#B10000")
            }
            else {
                $(this).css("border-color","#6d6d6d")
                is_valid_email_format =true
            }
        })
        $("#current-email").blur(function () {
            if($(this).val()==""){
                return
            }
            if($(this).val()!=email){
                $(this).prop('title','Invalid email')
            }

        })

        let is_valid_new_email_format =false
        $("#new-email").keyup(function () {
            $(this).prop('title','Please type your new email')
            if($(this).val()==""){
                is_valid_new_email_format = false
                $(this).css("border-color","#6d6d6d")
                return
            }

            $.post("php/settingsProcesses/validateEmail.php",{email:$(this).val()}).done(function (data) {
                if(data==1){
                    $("#new-email").css("border-color","#6d6d6d")
                    is_valid_new_email_format =true
                }
                else{
                    $("#new-email").css("border-color","#B10000")
                    is_valid_new_email_format =false
                }
            })
        })//f
        $("#new-email").blur(function () {
            if($(this).val()==""){
                return
            }
            if(!is_valid_new_email_format){
                $(this).prop('title','Invalid email')
            }

        })

        $("#save").click(function () {
            $("#pop-up-loading").modal({
                escapeClose: false,
                clickClose: false,
                showClose: false
            })
            if(is_valid_new_email_format &&  is_valid_email_format){

                $.post("php/settingsProcesses/finalEmailValidation.php",{new_email: $("#new-email").val(),logged_email: $("#current-email").val()})
                    .done(function (data) {


                            if(data==1){
                                setTimeout(function () {
                                    location.reload()
                                    console.log("change email success")
                                },300)

                            }
                            else if(data==-1){
                                setTimeout(function () {
                                    $("#pop-up-error").modal(modalConfig)
                                    $("#pop-up-error-message").html("Email is already taken!")
                                    console.log("email is not valid")
                                },300)
                            }
                            else{
                                setTimeout(function () {
                                    $("#pop-up-error").modal(modalConfig)
                                    $("#pop-up-error-message").html("Either of the two email is invalid!")
                                    console.log("email is not valid")
                                },300)

                            }


                    })
            }
            else {
                setTimeout(function () {
                    $("#pop-up-error").modal(modalConfig)
                    $("#pop-up-error-message").html("Please double check the form!")
                    console.log("Please double check the form")
                },300)

            }
        })
            //will send confirmation to email to know if it is really existing




    </script>

    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 3rem;
            height: 3rem;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <!--modal for loading-->
    <div id="pop-up-loading" class="modal">
        <div style="display: flex;align-items: center;justify-content: center">
            <div class="loader"></div>
            <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
                Processing Request...
            </p>
        </div>
    </div>

    <!--modal for error-->
    <div id="pop-up-error" class="modal">
        <div style="display: flex;align-items: center;justify-content: center">
            <img src="img/Icons/exclamation-mark.png" class="modal-header-icon"/>
            <p class="modal-p" id="pop-up-error-message" style="display: flex;justify-content: center;">
                Error
            </p>
        </div>
        <div class="flex-box-row justify-content-end">
            <a href="#pop-up-error" rel="modal:close"><button class="modal-primary-button">Okay</button></a>
        </div>

    </div>

    <!--Jquery modal script-->
    <script>

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