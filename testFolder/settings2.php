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
    <link rel="stylesheet" href="../scss/bootstrap-grid.css">
   <!--Custom CSS-->
    <link rel="stylesheet" href="../scss/main.css">
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!--CustomJS-->
    <script src="../js/settings.js"></script>
    <!-- jQuery Modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--Custom Modal Design-->
    <link rel="stylesheet" href="../scss/modal.css">
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="../jquery-ui/jquery-ui.css">
    <script src="../jquery-ui/jquery-ui.js"></script>
    <link rel="stylesheet" href="../scss/tooltip.css">
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
                                <img src="../img/jay.jpg" alt="">
                            </div>
                            <h4>Your Name</h4>
                        </div>
                        <ul class="menu">
                            <li><a href="../dashboard-admin.php" class="dashboard">Dashboard</a></li>
                            <li><a href="../patient.php" class="patient">Patient</a></li>
                            <li><a href="../reports.php" class="reports">Reports</a></li>
                            <li><a href="../track-map.php" class="trackMap">Track Map</a></li>
                            <li><a href="../inventory.php" class="inventory">Inventory</a></li>
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
                                <img src="../img/HIS%20logo%20blue.png" alt="">
                            </div>
                            <div class="settings">
                                <a><i class="fas fa-user-circle"></i></a>
                                <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
                                <a id="close-dropdown"><i class="fas fa-times"></i></a>

                                <div class="drop-down-settings" id="dropdown">
                                    <ul>
                                        <li><a href="">Approve EMR</a></li>
                                        <li><a href="../settings.php">settings</a></li>
                                        <li><a href="../about.php">About</a></li>
                                        <li><a href="../php/sessionDestroy.php">Logout</a></li>
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
                                    <li><a href=../settings.php#" style="color: #0c6893">Change Personal Information</a></li>
                                    <li><a href="../change-email-settings.php">Update Existing Email</a></li>
                                    <li><a href="../change-password-settings.php">Change Password</a></li>
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

    <!--Edit modal CSS-->
    <style>

        #edit-modal-content .container-fluid{
            padding: 0 0.5rem;
            text-align: left;
            overflow-y: scroll;
            overflow-x: hidden;
            max-height: 75vh;
            height: fit-content;
        }
        #edit-modal-content label{
            font-size: small;
            font-weight: normal;
            padding-left: 0.8rem;
            color: var(--third-color)
        }
        .col-sm-12 input,.col-sm-6 input,.col-sm-6 select,.col-sm-3 input,.col-sm-3 select{
            margin: 0.3rem;
            padding: 0.5rem;
        }
        /*scrollbar*/
             /* width */
         ::-webkit-scrollbar {
             width: 5px;
         }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #c5c5c5;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <!--Edit modal-->
    <div id="edit-modal" class="modal">
        <div style="display: flex;justify-content: center;align-items: center;margin: 1rem">
            <img src="../img/Icons/edit.png" width="50" height="50"><h4 style="color: var(--dark-grey);margin-left: 0.5rem">Edit Personal Info</h4>
        </div>
        <div class="flex-box-column" id="edit-modal-content" style="align-items: flex-start">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6" >
                        <label for="fname-edit">First Name:</label><input type="text" id="fname-edit-2">
                    </div>
                    <div class="col-sm-6" >
                        <label for="mname-edit">Middle Name:</label><input type="text" id="mname-edit-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6" >
                        <label for="lname-edit">Last Name:</label> <input type="text" id="lname-edit-2">
                    </div>
                    <div class="col-sm-6" >
                        <label for="bday-edit">Birthday:</label>
                        <input type="text" id="bday-edit-2" contenteditable="false">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6" style="padding: 0 15px">
                        <label for="gender-edit">Gender:</label>
                        <select id="gender-edit-2">
                            <option id="Male">Male</option>
                            <option id="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-sm-6" style="padding: 0 15px">
                        <label for="age-edit">Age:</label>
                        <input type="text" id="age-edit-2" disabled="disabled">
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-sm-3">
                        <label style="font-size-adjust: inherit">House#</label>
                        <input id="" type="number" name="house_no" required>
                    </div>
                    <div class="col-sm-3">
                        <label>Purok</label>
                        <select name="purok">
                            <option value="0" disabled selected>Purok</option>
                            <option value="0">Not available</option>
                            <?php
                              for($a=1;$a<=7;$a++){
                                  //echo "<option>".$a."</option>";
                              }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Barangay</label>
                        <input type="text" value="Sto. Rosario" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Town</label>
                        <input type="text" value="Paombong" disabled>
                    </div>
                    <div class="col-sm-6">
                        <label>Province/City</label>
                        <input type="text" value="Bulacan" disabled>
                    </div>
                </div>


            </div>
-->
                <div class="row flex-row justify-content-start" style="display: flex">
                    <div class="col-sm-12" style="padding: 0 15px">
                        <label for="age-edit">Address:</label>
                        <input type="text" id="address-edit-2">
                    </div>
                    <div class="col-sm-12 justify-content-end align-items-end" style="display: flex;padding: 0 15px;margin-top: 1rem">
                        <a href="#edit-modal" rel="modal:close"><button class="modal-cancel-button" style="margin-right: 0.5rem">Cancel</button></a>
                        <a href="#edit-modal" rel="modal:close"><button id="okay-edit-btn" class="modal-primary-button">Okay</button></a>
                    </div>
                </div>

                </div>
        </div>
    </div>
    <!--Confirm edit-->
    <div class="modal" id="confirm-changes">
        <div class="justify-content-center" style="display: flex">
            <p>Save changes?</p>
        </div>
        <div class="justify-content-end" style="display: flex">
            <a href="#confirm-changes" rel="modal:close">
                <button class="modal-cancel-button" style="margin-right: 0.5rem">Cancel</button>
            </a>
                <button class="modal-primary-button">Okay</button>
        </div>
    </div>
    <!--loading for style-->
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