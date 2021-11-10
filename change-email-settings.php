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
    <!--Jquery
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

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
                                <a><i class="fas fa-ellipsis-h"></i></a>
                            </div>
                        </div>
                    </div>


                    <div class="content">
                        <div class="text-content">
                            <div class="left-text">
                                <p>Settings</p>
                                <ul>
                                    <li><a href="#">Change Personal Information</a></li>
                                    <li><a href="#" style="color: #0c6893">Update Existing Email</a></li>
                                    <li><a href="#">Change Password</a></li>
                                </ul>
                            </div>
                            <div class="right-text">
                                <p>Modify Email Address</p>
                                <label for="current-email">Current Email</label>
                                <input type="email" name = "current-email" id = "current-email" title="Please type your current email"><br>
                                <label for="new-email">New Email</label>
                                <input type="email" name = "new-email" id = "new-email" title="Please type your new email">
                                <button class = "save-changes2" id="save">Save Changes</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        </div>


    </section>
    <!--Change email script-->
    <script>
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
            if(is_valid_new_email_format||is_valid_email_format){
                $.post("php/settingsProcesses/finalEmailValidation.php",{new_email: $("#new-email").val(),logged_email: $("#current-email").val()})
                    .done(function (data) {
                        if(data==1){
                            console.log("change email success")
                        }
                        else{
                            console.log("email is not valid")
                        }
                    })
            }
            else {
                console.log("Please double check the form")
            }
        })
            //will send confirmation to email to know if it is really existing




    </script>
</body>

</html>