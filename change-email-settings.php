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
    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!--Jquery UI css and js
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
    </script>-->

    <!--Bootstrap
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
     -->
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
                                    <input type="email" name = "current-email" id = "current-email" title="Please type your current email" data-toggle="tooltip" data-placement="top" title="House #" data-container="body"><br>
                                    <label for="new-email">New Email</label>
                                    <input type="email" name = "new-email" id = "new-email" title="Please type your new email" data-toggle="tooltip" data-placement="top" title="House #" data-container="body">
                                    <button class="save-changes2" id="save">Save Changes</button>
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
        $('[data-toggle="tooltip"]').tooltip()
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
            $("#pop-up-loading").modal("show")
            if(is_valid_new_email_format &&  is_valid_email_format){

                $.post("php/settingsProcesses/finalEmailValidation.php",{new_email: $("#new-email").val(),logged_email: $("#current-email").val()})
                    .done(function (data) {


                            if(data==1){
                                setTimeout(function () {
                                    $("#pop-up-loading").modal("hide")
                                    console.log("change email success")
                                },700)

                            }
                            else if(data==-1){
                                setTimeout(function () {
                                    $("#pop-up-loading").modal("hide")
                                    $("#pop-up-error").modal("show")
                                    $("#pop-up-error-message").html("Email is already taken!")
                                    console.log("email is not valid")
                                },700)
                            }
                            else{
                                setTimeout(function () {
                                    $("#pop-up-loading").modal("hide")
                                    $("#pop-up-error").modal("show")
                                    $("#pop-up-error-message").html("Either of the two email is invalid!")
                                    console.log("email is not valid")
                                },700)

                            }


                    })
            }
            else {
                setTimeout(function () {
                    $("#pop-up-loading").modal("hide")
                    $("#pop-up-error").modal("show")
                    $("#pop-up-error-message").html("Please double check the form!")
                    console.log("Please double check the form")
                },500)

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
    <div class="modal fade" id="pop-up-loading" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header">
                  <h5 class="modal-title" id="pop-upLabel">Message</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>-->
                <div class="modal-body">
                    <div id="modal-content">
                        <div style="display: flex;align-items: center;justify-content: center">
                            <div class="loader"></div>
                            <p id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem;font-size: larger">
                                Processing Request...
                            </p>
                        </div>

                    </div><!--end of modal content-->
                </div><!--end of modal body-->
            </div>
        </div>
    </div>

    <!--modal for error-->
    <div class="modal fade" id="pop-up-error" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header">
                     <h5 class="modal-title" id="pop-upLabel">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>-->
                <div class="modal-body">
                    <div id="modal-content">
                        <div style="display: flex;align-items: center;justify-content: center">
                            <img src="img/Icons/exclamation-mark.png" width="80" height="70"/>
                            <p id="pop-up-error-message" style="display: flex;justify-content: center;margin-left: 1rem;font-size: larger">
                                Error
                            </p>
                        </div>
                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="pop-up-error-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>