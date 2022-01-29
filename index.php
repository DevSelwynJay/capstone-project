<?php
session_start();
if(isset($_SESSION['email'])&&isset($_SESSION['account_type'])){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
if(!isset($_SESSION['showRegSuccess'])){
    $_SESSION['showRegSuccess']=0;
}

//test 123
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="img/favicon-sto.png" />
      <meta http-equiv='cache-control' content='no-cache'>
      <meta http-equiv='expires' content='0'>
      <meta http-equiv='pragma' content='no-cache'>

    <!--CSS Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--CSS Styling-->
    <link rel="stylesheet" href="scss/main.css">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <!--JS-->
      <!--Google sign in api-->
      <script src="https://accounts.google.com/gsi/client" async defer></script>
      <!--Jquery-->
      <script src="js/jquery-3.6.0.js"></script>

      <!--Bootstrap Script-->
      <!--
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       -->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

      <!--User-defined JS-->
      <script src="js/login.js"></script>
      <script src="js/forgotPassword.js"></script>

      <!--for toggle button
      <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
       -->

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
          <!---->
          /*override scss*/
          #modal-content h3{
              font-weight: normal;
          }
          @media all and (max-width: 468px){
              #modal-content h3{
                  font-size: clamp(1rem,1.5rem,1.8rem);
              }
              input{
                  font-size: clamp(0.5rem,0.8rem,1rem);
              }
          }
          @media all and (max-width: 381px){
              #modal-content h3{
                  font-size: clamp(0.8rem,1.3rem,1.5rem);
              }

          }
          .modal { overflow: auto !important; }
      </style>
      <!--Custom Modal Design-->
      <link rel="stylesheet" href="scss/modal.css">
      <title>Login</title>
  </head>
  <body style="overscroll-behavior-y: contain;">
    <section class="login-form">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <div class="logo">
              <img src="img/HIS%20logo%20blue.png" alt="logo" />
            </div>
            <div id="show" class="modal">
                           <form>
                                <div class="row">
                                  
                                    <input type="text" placeholder="First Name" />
                              
                               
                                    <input type="text" placeholder="Middle Name" />
                              
                             
                                    <input type="text" placeholder="Last Name" />
                           
                                </div>
                                <div class="row">
                              
                                   <input type="text" placeholder="Email" />
                            
                            
                                    <input type="text" placeholder="Gender" />
                           
                               </div>
                               <div class="row">
                               
                                    <input type="password" placeholder="Password" />
                             
                            
                                    <input type="password" placeholder=" Confirm Password" />
                              
                               </div>
                               <div class="row">
                               
                                   <input type="text" placeholder="Work Category" />
                            
                                   <input type="text" placeholder="Contact No." />
                             
                              </div>
                              
                                 <a href="#show" rel="modal:open" class="button-square"><i class="fas fa-plus"></i>Add Admin Account</a>
                            
                            </form>
                         </div>
            <form>
              <div class="form-wrapper">
                <div class="row">
                  <div class="col-sm-12">
                    <h1 id="login-title" class="text-center" style="font-weight:700">Login</h1>
                  </div>
                  <div class="col-sm-12">
                    <input type="text" placeholder="Email" id="login-email"/>
                  </div>
                  <div class="col-sm-12">
                    <input type="password" placeholder="Password" id="login-pwd"/>
                  </div>

                  <div class="flex margin-top-1">
                    <div class="col-sm-6 d-flex align-items-center">
                      <input type="checkbox" name="rememberMe" id="remember-me" />&nbsp;<label style="color:#6d6d6d; margin:0" for="remember-me"
                        >Show Password</label
                      >
                        <script>
                            $("#remember-me").click(function (data) {
                               if ($(this).prop('checked')){
                                   $("#login-pwd").prop("type","text")
                               }
                               else {
                                   $("#login-pwd").prop("type","password")
                               }
                            })
                        </script>
                    </div>
                    <div class="col-sm-6 text-right">
                      <a id="trigger-forgot-modal" href="#">Forgot Password?</a>
                    </div>
                  </div>

                  <div class="col-sm-12 margin-top-2">
                    <button class="primary-btn" id="login-btn" type="button">Login</button>
                  </div>
                    <div class="col-sm-12 margin-top-2" id="buttonDiv">

                    </div>
                  <div class="col-sm-12 margin-top-3">
                    <p id="login-p" class="text-center" style="color:#6d6d6d;font-size: medium">
                      Are you a patient?&nbsp;<span
                        ><a id="login-a" href="register.php">Create Account Now</a></span>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5" id="login-pic-cont">
            <div class="hero-image">
              <img src="img/hero-image-1.png"/>
            </div>
          </div>
        </div>
      </div>
    </section>





    <!--
    ======== Modal ===========
    -->

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
                    <div>
                        <div style="display: flex;align-items: center;justify-content: center">
                            <div class="loader"></div>
                            <p id="pop-up-loading-message" class="modal-p">
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
                    <div>
                        <div style="display: flex;align-items: center;justify-content: center">
                            <img src="img/Icons/exclamation-mark.png" class="modal-header-icon"/>
                            <p id="pop-up-error-message" class="modal-p">
                                Error
                            </p>
                        </div>
                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="modal-cancel-button-2" data-dismiss="modal" id="pop-up-error-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!--first pop that will show show kapag valid ang credentials-->
    <div class="modal fade" id="pop-up-main" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header">
                    <h5 class="modal-title" id="pop-upLabel">Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>-->
                <div class="modal-body">

                    <div>

                        <div class="flex-box-row justify-content-center align-items-center">
                            <img src="./img/authentication.png" class="modal-header-icon-wider"/>
                        </div>
                        <p class="modal-title-2">Two-Step Authentication</p>
                        <p class="modal-p-lighter">Please choose one of the following where to send your login verification code to continue.</p>
                        <div class="row flex-box-row justify-content-center align-items-center">
                            <div class="option-cont col-sm-6 flex-box-column justify-content-center align-items-center margin-top-1">
                                    <img src="img/email.png" class="modal-icon-wider">
                                    <p class="modal-p-lighter margin-top-1 text-center" style="margin-bottom: 0.5rem">Code to be sent by email</p>
                                    <div class="toggle-cont">
                                        <input type="radio" name="toggle" value="isEmail" id="isEmail">
                                    </div>
                            </div>
                            <div class="option-cont col-sm-6 flex-box-column justify-content-center align-items-center margin-top-1">
                                    <img src="img/sms.png" class="modal-icon-wider">
                                    <p class="modal-p-lighter margin-top-1 text-center" style="margin-bottom: 0.5rem">Code to be sent by SMS</p>
                                    <div class="toggle-cont">
                                        <input type="radio" name="toggle" value="isSMS" id="isSMS">
                                    </div>
                            </div>
                        </div>
                        <input type="radio" name="toggle" style="display: none" checked value="none" id="isNone">

                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="modal-primary-button-2" id="pop-up-main-ok-btn">Confirm</button>
                    <button type="button" class="modal-cancel-button-2" data-dismiss="modal" id="pop-up-main-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!--Email OTP Confirmation Pop-up-->
    <div class="modal fade" id="pop-up-email" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                     <h5 class="modal-title" id="pop-upLabel">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                </div>-->
                <div class="modal-body">


                        <div class="flex-box-row justify-content-center align-items-center">
                            <img src="./img/email.png" class="modal-header-icon-wider"/>
                        </div>
                        <p class="modal-title-2">Email Confirmation</p>
                        <p class="modal-p-lighter text-center">A verification code has been sent to your email.</p>
                        <p id="email-txt" class="modal-smaller-p text-center">sample@gmail.com</p>
                        <!--<p class="paragraph">To verify that it is you, Enter 6 digit verification code that has been sent to your email to continue</p>-->
                        <p class="modal-p-lighter margin-top-3 text-center">Enter 6-digit OTP code</p>
                        <form autocomplete="off" class="flex-box-row justify-content-center" style="margin-top: 0.2rem">
                            <input type="text" maxlength="6" id="otp-input" style="font-size: revert;border-radius: revert">
                        </form>
                        <p id="invalid-OTP-indicator" class="modal-p-error">Invalid OTP</p>


                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="modal-primary-button-2" id="pop-up-email-ok-btn">Confirm</button>
                    <button type="button" class="modal-cancel-button-2" data-dismiss="modal" id="pop-up-email-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>


    <!--Forgot Password-->
    <div class="modal fade" id="pop-up-forgot" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                     <h5 class="modal-title" id="pop-upLabel">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                </div>-->
                <div class="modal-body">
                        <div class="flex-box-row justify-content-center align-items-center">
                            <img src="./img/Icons/question.png" class="modal-icon-wider"/>
                        </div>
                        <p class="modal-title-2">Forgot your password?</p>
                        <p class="modal-p-lighter text-center">Please enter your email to search for your account</p>
                        <form autocomplete="off" class="flex-box-row justify-content-center">
                            <input type="text" id="email-input" placeholder="E-mail" style="font-size: revert;border-radius: revert"/>
                        </form>
                        <p id="invalid-email-indicator" class="modal-p-error">Can't recognize e-mail</p>
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="modal-primary-button-2" id="pop-up-forgot-ok-btn">Search</button>
                    <button type="button" class="modal-cancel-button-2" data-dismiss="modal" id="pop-up-forgot-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!--Forgot Password OTP Part-->
    <div class="modal fade" id="pop-up-forgot-otp" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                     <h5 class="modal-title" id="pop-upLabel">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                </div>-->
                <div class="modal-body">

                    <div>

                        <div class="flex-box-row justify-content-center align-items-center">
                            <img src="./img/Icons/locked.png" class="modal-header-icon-wider"/>
                        </div>
                        <p id="forgot-pwd-otp-header" class="modal-title-2 text-center">Hello Sample User</p>
                        <p id="forgot-pwd-otp-email" class="modal-sub-title-blue text-center">alfredogiebenitez@gmail.com</p>
                        <p class="modal-p-lighter text-center margin-top-1">To reset your password, you must enter the 6-Digit code that has been sent to your email.
                        </p>
                        <p class="modal-p-lighter margin-top-3 text-center">Enter 6 Digit Reset Code</p>
                        <form autocomplete="off" class="flex-box-row justify-content-center">
                            <input type="number" id="forgot-pwd-otp-input" maxlength="6" style="border-radius: revert;font-size: revert"/>
                        </form>
                        <p id="invalid-otp-indicator" class="modal-p-error">Invalid Code</p>
                        <div class="flex">
                            <button type="button" class="modal-primary-button-2" id="pop-up-forgot-otp-ok-btn">Verify</button>
                        </div>
                         </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="modal-primary-button-2" id="pop-up-forgot-resend-OTP-btn">Resend Code</button>
                    <button type="button" class="modal-cancel-button-2" data-dismiss="modal" id="pop-up-forgot-otp-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>


    <!--Reset Password-->
    <div class="modal fade" id="pop-up-reset-pwd" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                     <h5 class="modal-title" id="pop-upLabel">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                </div>-->
                <div class="modal-body">

                    <div class="flex-box-column align-items-center">

                        <div class="flex-box-row justify-content-center">
                            <img src="./img/Icons/rotation-lock.png" class="modal-header-icon-wider"/>
                        </div>
                        <p class="modal-title-2">Reset Password</p>
                        <p id="forgot-pwd-greetings" class="modal-p text-center">Hello! Benitez, Alfredo Bas</p>
                        <p id="forgot-pwd-email"class="modal-smaller-p text-center">sample@gmail.com</p>

                            <div class="input-cont margin-top-3">
                                <p class="modal-p-lighter"  style="margin: 0.3rem 0" >New Password</p>
                                <input type="password" id="pwd-reset" class="pwd-reset" style="border-radius: revert;font-size: revert;margin: 0" data-toggle="tooltip" data-placement="top" title="Minimum of 8 characters." data-container="body"/>
                            </div>
                            <p></p>
                            <div class="input-cont">
                                <p  class="modal-p-lighter"  style="margin: 0.3rem 0">Confirm Password</p>
                                <input type="password" id="cpwd-reset" class="pwd-reset" style="border-radius: revert;font-size: revert;margin: 0"/>
                            </div>

                            <p id="invalid-pwd-indicator" class="modal-p-error">Password did not matched!</p>




                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="modal-primary-button-2" id="pop-up-reset-pwd-ok-btn">Verify</button>
                    <button type="button" class="modal-cancel-button-2" data-dismiss="modal" id="pop-up-reset-pwd-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal for notifying user the password was successfully changed-->
    <div class="modal fade" id="pop-up-reset-pwd-success" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">

                    <div id="modal-content" class="forgot-cont">

                        <div id="modal-icon"><img src="./img/Icons/checked.png"/></div>
                        <h3>Password Successfully Changed</h3>
                        <div class="reset-pwd-cont">
                            <p style="text-align: center;margin-bottom: 1rem">You can now login using your new password</p>
                            <button type="button" class="btn btn-primary" id="pop-up-reset-pwd-success-ok-btn" data-dismiss="modal">OK</button>
                        </div>

                    </div><!--end of modal content-->
                </div><!--end of modal body-->
            </div>
        </div>
    </div>


<!--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pop-up-reset-pwd">-->
<!--        Launch demo modal-->
<!--    </button>-->
  <script>

      $('[data-toggle="tooltip"]').focus(function () {
          $('[data-toggle="tooltip"]').tooltip('show')
      })
      $('[data-toggle="tooltip"]').hover(function () {
          $('[data-toggle="tooltip"]').tooltip('show')
      },function (){
          $('[data-toggle="tooltip"]').tooltip('hide')
      })

  </script>

    <!--Some modal CSS fixed-->
  <style>
      /*sa main pop up modal ito*/
      .option-cont{
          padding: 15px;
      }
        @media (max-width: 575px) {
            .option-cont{
                width: clamp(40%,60%,70%);
                padding: 0.3rem!important;
            }
        }
      /*sa forgot pwd modal ito*/

          @media (min-width: 455px) {
              #email-input,.input-cont{
                  width: clamp(60%,70%,80%)
              }
          }
      @media (max-width: 391px) {
          #contact-input{
              width: 70%!important;
          }
      }

  </style>
    <!--SMS OTP Confirmation Pop-up-->
    <div class="modal fade" id="pop-up-sms" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                     <h5 class="modal-title" id="pop-upLabel">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                </div>-->
                <div class="modal-body">


                    <div class="flex-box-row justify-content-center align-items-center">
                        <img src="./img/sms.png" class="modal-header-icon-wider"/>
                    </div>
                    <p class="modal-title-2">SMS Confirmation</p>
                    <p class="modal-p-lighter text-center">A verification code has been sent to your contact number</p>
                    <p id="sms-txt" class="modal-smaller-p text-center">09xxxxxxxxxxx</p>
                    <!--<p class="paragraph">To verify that it is you, Enter 6 digit verification code that has been sent to your email to continue</p>-->
                    <p class="modal-p-lighter margin-top-3 text-center">Enter 6-digit OTP code</p>
                    <form autocomplete="off" class="flex-box-row justify-content-center" style="margin-top: 0.2rem">
                        <input type="text" maxlength="6" id="sms-otp-input" style="font-size: revert;border-radius: revert;width: 50%">
                    </form>
                    <p id="invalid-OTP-indicator" class="modal-p-error">Invalid OTP</p>
                </div><!--end of modal body-->

                <div class="modal-footer">
                    <button type="button" class="modal-primary-button-2" id="pop-up-sms-ok-btn">Confirm</button>
                    <button type="button" class="modal-cancel-button-2" data-dismiss="modal" id="pop-up-email-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>

<!--  <button id="test-modal">test button</button>-->
<!--  <script>-->
<!--      $("#test-modal").click(function () {-->
<!--          $("#pop-up-sms").modal('show')-->
<!--      })-->
<!--  </script>-->


  <button style="display: none" id="trigger-sms"></button>
  <script type="module">
      // Import the functions you need from the SDKs you need
      import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
      // TODO: Add SDKs for Firebase products that you want to use
      // https://firebase.google.com/docs/web/setup#available-libraries

      // Your web app's Firebase configuration
      const firebaseConfig = {
          apiKey: "AIzaSyCp0izZKXrwRCfmfGkLgogG-He_tX-7L00",
          authDomain: "capstoneproject3m-his.firebaseapp.com",
          projectId: "capstoneproject3m-his",
          storageBucket: "capstoneproject3m-his.appspot.com",
          messagingSenderId: "373815557222",
          appId: "1:373815557222:web:44c490f0efc8775211c1a7"
      };
      // Initialize Firebase
      const app = initializeApp(firebaseConfig);

      import { getAuth, RecaptchaVerifier,signInWithPhoneNumber } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js";
      const auth = getAuth();
      window.recaptchaVerifier = new RecaptchaVerifier('sign-in-button', {
          'size': 'invisible',
          'callback': (response) => {
              // reCAPTCHA solved, allow signInWithPhoneNumber.
              onSignInSubmit();
          }
      }, auth);

      function sendOTP() {
          let number =  window.logged_contact_no
          const phoneNumber = "+63"+number.substr(1);
          const appVerifier = window.recaptchaVerifier;

          signInWithPhoneNumber(auth, phoneNumber, appVerifier)
              .then((confirmationResult) => {
                  // SMS sent. Prompt user to type the code from the message, then sign the
                  // user in with confirmationResult.confirm(code).
                  window.confirmationResult = confirmationResult;
                  //alert(confirmationResult)
                  // ...
              }).catch((error) => {
              // Error; SMS not sent
              //alert(error)
              console.log(error)
              // ...
          });

      }



      $("#pop-up-sms-ok-btn").click(function () {
          //alert(987665)
          const code = $("#sms-otp-input").val();
          confirmationResult.confirm(code).then((result) => {
              // User signed in successfully.
              const user = result.user;
              // alert("naka login na")
              //separate process for setting email session becoz  sms has different process
              $.post("php/loginProcesses/setEmailSessionForSMSLogin.php").done(function (data) {
                  location.href = 'php/loginProcesses/redirect.php';
              })
              // ...
          }).catch((error) => {
              // User couldn't sign in (bad verification code?)
              // ...
              console.log(error)
          });
      })


      $("#trigger-sms").click(function (data) {
              // alert(window.logged_contact_no)
              $("#pop-up-sms").modal("show")
              sendOTP();
      })


  </script>
  <div id="sign-in-button"></div>

    <!--Success Register-->
    <div class="modal fade" id="pop-up-success" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
                     <h5 class="modal-title" id="pop-upLabel">Message</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                </div>-->
                <div class="modal-body">
                    <div class="flex-box-row justify-content-center align-items-center">
                        <img class="modal-header-icon" src="img/check.png">
                        <p class="modal-p" id="pop-up-success-message">Please wait for the email confirming whether your account will be approved or not.</p>
                    </div>
                </div><!--end of modal body-->

                <div class="modal-footer">
                    <button type="button" class="modal-primary-button-2" data-dismiss="modal" id="pop-up-success-ok-btn">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <?php
     if($_SESSION['showRegSuccess']==1){
         echo "
         
         <script> 
            $('#pop-up-success').modal('show')
         </script>
         ";
     }
    $_SESSION['showRegSuccess']=0;
    ?>

  </body>
</html>
