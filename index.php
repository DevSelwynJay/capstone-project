<?php
session_start();
if(isset($_SESSION['email'])){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
//test 123
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <meta http-equiv='cache-control' content='no-cache'>
      <meta http-equiv='expires' content='0'>
      <meta http-equiv='pragma' content='no-cache'>

    <!--CSS Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--CSS Styling-->
    <link rel="stylesheet" href="scss/main.css"/>

    <!--JS-->
      <!--Google sign in api-->
      <script src="https://accounts.google.com/gsi/client" async defer></script>
      <!--JQuery API-->
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

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
      </style>
      <title>Login</title>
  </head>
  <body>
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
                    <h1 class="text-center" style="font-weight:700">Login</h1>
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
                        >Remember Me</label
                      >
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
                    <p class="text-center" style="color:#6d6d6d;">
                      Not yet Registered?&nbsp;<span
                        ><a href="register.php">Create Account</a></span>
                    </p>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="col-12 col-xs-12 col-sm-12 col-md-5 col-lg-5">
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

                    <div id="modal-content">

                        <div id="modal-icon"><img src="./img/authentication.png"/></div>
                        <h3>Two-Step Authentication</h3>
                        <p>Please choose one of the following where to send your login verification code to continue.</p>
                        <div class="container-fluid">
                            <div class="row" id="choose-authentication">
                                <div class="col-sm">
                                    <img src="img/email.png">
                                    <p>Code to be sent by email</p>
                                    <div class="toggle-cont">
                                        <input type="radio" name="toggle" value="isEmail" id="isEmail">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <img src="img/sms.png" id="sms-icon">

                                    <p>Code to be sent by SMS</p>
                                    <div class="toggle-cont">
                                        <input type="radio" name="toggle" value="isSMS" id="isSMS">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="radio" name="toggle" style="display: none" checked value="none" id="isNone">

                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pop-up-main-ok-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="pop-up-main-cancel-btn">Back</button>
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

                    <div id="modal-content">

                        <div id="modal-icon"><img src="./img/email.png"/></div>
                        <h3>Email Confirmation</h3>
                        <h5 class="subtitle">A verification code has been sent to your email</h5>
                        <h5 id="email-txt">sample@gmail.com</h5>
                        <!--<p class="paragraph">To verify that it is you, Enter 6 digit verification code that has been sent to your email to continue</p>-->
                        <h5 class="subtitle">Enter 6-digit OTP code</h5>
                        <form autocomplete="off">
                            <input type="text" maxlength="6" id="otp-input">
                        </form>
                        <p id="invalid-OTP-indicator" style="color: darkred;visibility: hidden ;margin: 5px 0 0 0 ;display: flex;justify-content: center;font-size: smaller">Invalid OTP</p>

                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pop-up-email-ok-btn">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="pop-up-email-cancel-btn">Back</button>
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

                    <div id="modal-content" class="forgot-cont">

                        <div id="modal-icon"><img src="./img/Icons/question.png"/></div>
                        <h3>Forgot your password?</h3>
                        <p>Please enter your email to search for your account</p>
                        <form autocomplete="off">
                            <input type="text" id="email-input" placeholder="E-mail"/>
                        </form>
                        <p id="invalid-email-indicator" style="font-size: smaller">Can't recognize e-mail</p>

                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pop-up-forgot-ok-btn">Search</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="pop-up-forgot-cancel-btn">Back</button>
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

                    <div id="modal-content" class="forgot-cont">

                        <div id="modal-icon"><img src="./img/Icons/locked.png"/></div>
                        <h3 class="forgot-pwd-otp-header" >Hello Sample User</h3>
                        <p class="forgot-pwd-otp-email" style="color: var(--dark-grey)">sample@gmail.com</p>
                        <p style="margin-bottom: 2rem;text-align: center">To reset your password, you must enter the 6-Digit code that has been sent to your email.
                        </p>
                        <p>Enter 6 Digit Reset Code</p>
                        <form autocomplete="off">
                            <input type="number" id="forgot-pwd-otp-input" maxlength="6"/>
                        </form>
                        <p id="invalid-otp-indicator" style="color: darkred;font-size: smaller">Invalid Code</p>
                        <div class="flex">
                            <button type="button" class="btn btn-primary" id="pop-up-forgot-otp-ok-btn">Verify</button>
                        </div>
                         </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pop-up-forgot-resend-OTP-btn">Resend Code</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="pop-up-forgot-otp-cancel-btn">Back</button>
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

                    <div id="modal-content" class="forgot-cont">

                        <div id="modal-icon"><img src="./img/Icons/rotation-lock.png"/></div>
                        <h3>Reset Password</h3>
                        <p style="color: var(--dark-grey)">Hello! Benitez, Alfredo Bas</p>
                        <p style="margin-bottom: 1.5rem;text-align: center;font-size: smaller">sample@gmail.com</p>

                        <div class="reset-pwd-cont">
                            <div class="input-cont">
                                <p class="input-label"  style="margin: 0.3rem 0" >New Password</p>
                                <input type="password" id="pwd-reset" class="pwd-reset"  style="margin: 0" data-toggle="tooltip" data-placement="top" title="Minimum of 8 characters." data-container="body"/>
                            </div>
                            <p></p>
                            <div class="input-cont">
                                <p  class="input-label"  style="margin: 0.3rem 0">Confirm Password</p>
                                <input type="password" id="cpwd-reset" class="pwd-reset" style="margin: 0"/>
                            </div>

                            <p id="invalid-pwd-indicator" style="color: darkred;font-size: smaller">Password did not matched!</p>
                        </div>

                    </div><!--end of modal content-->
                </div><!--end of modal body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pop-up-reset-pwd-ok-btn">Verify</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="pop-up-reset-pwd-cancel-btn">Back</button>
                </div>
            </div>
        </div>
    </div>


    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pop-up-reset-pwd">
        Launch demo modal
    </button>
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
  </body>
</html>
