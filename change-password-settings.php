<?php
session_start();
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=1){
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
    <link rel="shortcut icon" href="img/favicon-sto.png" />
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
    <title>Change Password Settings</title>
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>
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
                            <li><a href="patient.php" class="patient">Patient</a></li>
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


                    <div class="content settings-page">
                        <div class="text-content">
                            <div class="left-text">
                                <p>Settings</p>
                                <ul>
                                    <li><a href="settings.php">Change Personal Information</a></li>
                                    <li><a href="change-email-settings.php">Update Existing Email</a></li>
                                    <li><a href="change-password-settings.php" style="color: #0c6893">Change Password</a></li>
                                </ul>
                            </div>
                            <div class="right-text">
                                <p>Change Password</p>

                                <div class="input--container">
                                <label for="current-pass">Current Password</label>
                                <input type="password" name = "current-pass" id = "current-pass">
                                </div>
                                <div class="input--container">
                                <label for="new-pass">New Password</label>
                                <input type="password" name = "new-pass" id = "new-pass">
                                </div>
                                <div class="input--container">
                                <label for="confirm-pass">Confirm Password</label>
                                <input type="password" name = "confirm-pass" id = "confirm-pass">
                                </div>
                                <button class = "save-changes3">Save Changes</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>

        <!--modal for error-->
        <div id="pop-up-error" class="modal">
            <div class="flex-box-row justify-content-center align-items-center">
                <img src="img/Icons/exclamation-mark.png" class="modal-header-icon"/>
                <p class="modal-p" id="pop-up-error-message" style="display: flex;justify-content: center;">
                    Error
                </p>
            </div>
            <div class="flex-box-row justify-content-end align-items-center">
                <a href="#pop-up-error" rel="modal:close"><button class="modal-primary-button">Okay</button></a>
            </div>

        </div>

        <!--modal for success-->
        <div id="pop-up-success" class="modal">
            <div style="display: flex;align-items: center;justify-content: center">
                <img src="img/check.png" class="modal-header-icon"/>
                <p class="modal-p" id="pop-up-success-message" style="display: flex;justify-content: center;">

                </p>
            </div>
            <div class="flex-box-row justify-content-end">
                <a href="#pop-up-success" rel="modal:close"><button class="modal-primary-button">Okay</button></a>
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

        <script>
            let modalConfig = {
                escapeClose: false,
                clickClose: false,
                showClose: false
            }
            $(document).ready(function () {
                $(".save-changes3").on('click',function () {

                    //check for empty input
                    if($("#current-pass").val()==""||$("#new-pass").val()==""||$("#confirm-pass").val()==""){
                        $("#pop-up-error").modal(modalConfig)
                        $("#pop-up-error-message").html("One or more fields are empty!")
                        return
                    }

                    $("#pop-up-loading").modal(modalConfig)
                    $.post('php/settingsProcesses/changePassword.php',
                        {
                            old_pwd:$("#current-pass").val(),
                            new_pwd:$("#new-pass").val(),
                            confirm_pwd:$("#confirm-pass").val()
                        }).done(function (data) {
                        if(data==-1){
                            setTimeout(function () {
                                console.log("incorrect old password")
                                $("#pop-up-error").modal(modalConfig)
                                $("#pop-up-error-message").html("One or more fields are incorrect!");
                            },1200)
                        }
                        else if(data==0){
                            setTimeout(function () {
                                //password di not matched
                                $("#pop-up-error").modal(modalConfig)
                                $("#pop-up-error-message").html("One or more fields are incorrect!");
                            },1200)
                        }
                        else {
                            setTimeout(function () {
                                $("#pop-up-success").modal(modalConfig)
                                $("#pop-up-success-message").html("Password changed successfully")
                            },1200)
                        }
                    })
                })

                $('[href="#pop-up-success"]').click(function () {
                    location.reload()
                })
            })
        </script>

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