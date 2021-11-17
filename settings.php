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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--CustomJS-->
    <script src="js/settings.js"></script>
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="scss/tooltip.css">
    <script src="jquery-ui/jquery-ui.js"></script>
    <!-- jQuery Modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="scss/modal.css">
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
    <!--loading animation-->
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
                                        <td><i class="fas fa-edit"></i>Age:</td>
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

    <!--Edit modal CSS-->
    <style>
        .modal{
            width: 80vw;
        }
        @media (max-width: 720px) {
            .modal{
                width: 100vw;
            }
            #edit-modal-content label{
                font-size: larger;
            }
            #edit-modal-content input{
                font-size: larger;
            }
        }
        @media (max-width: 480px) {
            .modal{
                width: 100vw;
            }
            #edit-modal-content label{
                font-size: x-large;
            }
            #edit-modal-content input{
                font-size: x-large;
            }
        }
        #edit-modal-content {
            padding: 0 0.5rem;
            text-align: left;
        }
        #edit-modal-content label{
            font-weight: normal;
            padding-left: 0.8rem;
            color: var(--third-color);
        }
        #edit-modal-content input{
            margin: 0.3rem;
            padding: 0.5rem;
        }
    </style>
    <!--Edit modal-->
    <div id="edit-modal" class="modal">
        <div class="flex-box-column" id="edit-modal-content" style="align-items: flex-start">
                    <label for="fname-edit">First Name:</label><input type="text" id="fname-edit">
                    <label for="mname-edit">Middle Name:</label><input type="text" id="mname-edit">
                    <label for="lname-edit">Last Name:</label> <input type="text" id="lname-edit">
                    <label for="bday-edit">Birthday:</label><input type="text" id="bday-edit">
            <label for="gender-edit">Gender:</label><input type="text" id="gender-edit">
            <label for="address-edit">Address:</label><input type="text" id="address-edit">
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
</body>

</html>