<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--CSS Bootstrap-->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
      <!--custom CSS-->
      <link rel="stylesheet" href="scss/main.css">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <title>Register</title>
       <!--Jquery-->
       <script src="js/jquery-3.6.0.js"></script>
       <!--Custom JS-->
       <script src="js/register.js"></script>
       <style>
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
      <!--Jquery UI css and js-->
       <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
       <script src="jquery-ui/jquery-ui.js"></script>
       <!--Bootstrap-->
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
       <!--Custom Modal Design-->
       <link rel="stylesheet" href="scss/modal.css">
   </head>
   
   <body style=";height: 100vh;overflow: hidden;overscroll-behavior-y: contain;">
      <section class="registration-form">
         <div class="registration-form__container">
            <div class="registration-form__wrapper">
               <div class="logo" style="padding:1rem;">
                  <img src="img/HIS logo blue.png" alt="Logo"  />
               </div>
               <div class="registration-form-form-wrapper" style="max-width: 90% !important;
            margin: 0 auto !important;" >
                   <h1 class="text-center" style="font-weight:700;margin-bottom: 0.5rem;font-size: clamp(1.5rem,2rem,3vw)">Create patient account</h1>
                   <div style="overflow-y: auto;height: 60vh">
                       <form id="reg-form" method="post" autocomplete="off" enctype="multipart/form-data" action="php/registerProcesses/registerProcess.php" >
                           <div class="container">

                               <div class="row">
                                   <div class="col-sm-6"> <input type="text" name="fname" placeholder="First Name" data-toggle="tooltip" data-placement="top" title="First Name" data-container="body" required/></div>
                                   <div class="col-sm-6"> <input type="text" name="mname" placeholder="Middle Name" data-toggle="tooltip" data-placement="top" title="Middle Name" data-container="body" required/></div>
                                   <div class="col-sm-6"> <input type="text" name="lname" placeholder="Last Name" data-toggle="tooltip" data-placement="top" title="Last Name" data-container="body" required/></div>
                                   <div class="col-sm-6">  <input type="text" name="suffix" placeholder="Suffix" data-toggle="tooltip" data-placement="top" title="Suffix (ex. Jr. Sr.)" data-container="body"/></div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-6">  <input type="text" name="occupation" placeholder="Occupation" data-toggle="tooltip" data-placement="top" title="Occupation" data-container="body"/></div>
                                   <div class="col-sm-6">
                                       <select type="text" name="civil_status" placeholder="Civil Status" value="" data-toggle="tooltip" data-placement="top" title="Civil Status (Married, Single, etc.)" data-container="body">
                                           <option>Single</option>
                                           <option>Married</option>
                                           <option>Divorced</option>
                                           <option>Widowed</option>
                                       </select>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-6">
                                       <input type="text" name="email" inputmode="email"  placeholder="Email" data-toggle="tooltip" data-placement="top" title="E-mail (name@gmail.com)" data-container="body" required/>
                                   </div>
                                   <div class="col-sm-6">
                                       <input type="number" name="contact" inputmode="tel" placeholder="Contact No." data-toggle="tooltip" data-placement="top" title="Contact no (11-digit number)" data-container="body" required/>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-6"> <input type="password" name="pwd" placeholder="Password" data-toggle="tooltip" data-placement="top"
                                                                 title="Password (Recommended: 8 or more characters)" data-container="body" minlength="8" required/>
                                   </div>
                                   <div class="col-sm-6"> <input type="password" name="cpwd" placeholder=" Confirm Password" data-toggle="tooltip" data-placement="top" title="Confirm Password" data-container="body" minlength="8" required/></div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-3">
                                       <select type="text" name="gender" placeholder="Gender" value="" data-toggle="tooltip" data-placement="top" title="Gender" data-container="body">
                                           <option>Male</option>
                                           <option>Female</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-3">
                                       <input type="text"  name="bday" inputmode="none" placeholder="Birthday"  data-toggle="tooltip" data-placement="left" title="Birthday" data-container="body" required/>
                                   </div>
                                   <div class="col-sm-3">
                                       <select data-toggle="tooltip" name="purok" data-placement="top" title="Purok" data-container="body" required>
                                           <option value="" disabled selected>Purok</option>
                                           <?php
                                           for($a=1;$a<=7;$a++){
                                               echo "<option>$a</option>";
                                           }
                                           ?>
                                       </select>
                                   </div>
                                   <div class="col-sm-3"><input type="number" inputmode="tel" name="house_no" placeholder="House #" id="num" data-toggle="tooltip" data-placement="top" title="House #" data-container="body"/></div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-6"><input type="text" placeholder="" value="Barangay Sto. Rosario" readonly/></div>
                                   <div class="col-sm-3"><input type="text" placeholder="" value="Paombong" readonly/></div>
                                   <div class="col-sm-3"><input type="text" placeholder="" value="Bulacan" readonly/></div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-12">
                                       <p style="color: var(--third-color);margin: 1rem 0 0 0;text-align: center">
                                           To make your account approved by admin, please attach a photo of your <b>VALID ID</b>
                                       </p>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="col-sm-6">
                                       <style>
                                           .prev-id-sm{
                                               width: auto;
                                               height: 10rem;
                                               display: flex;
                                               justify-content: center;
                                               align-items: center;
                                           }
                                           .prev-id-sm img{
                                               width: fit-content;
                                               height: fit-content;
                                               max-width: 100%;
                                               max-height: 100%;
                                               transition: all 500ms linear;
                                           }
                                           .prev-id-sm img:hover{
                                               transform: scale(1.1);
                                               box-shadow: 7px 9px 13px 0px rgba(0,0,0,0.76);
                                               -webkit-box-shadow: 7px 9px 13px 0px rgba(0,0,0,0.76);
                                               -moz-box-shadow: 7px 9px 13px 0px rgba(0,0,0,0.76);;
                                           }
                                       </style>
                                       <!--
                                       <div class="prev-id-sm">
                                           <img src="img/sms.png">
                                       </div>-->
                                       <div class="custom-file" style="margin: 1rem 0">
                                           <input type="file" name="upload[]" multiple class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" accept="image/*" data-toggle="tooltip" data-placement="top" title="Photo of ID" data-container="body" required>
                                           <label class="custom-file-label" for="customFileInput">Select Photo</label>
                                           <!--<p style="margin: 0.5rem 0;text-align: center;font-size: small">Upload first photo</p>-->
                                           <p id="reg-pic-no" style="margin: 0.5rem 0;text-align: center">Image Selected: 0</p>
                                       </div>
                                   </div>
                                   <div class="col-sm-6">
                                       <button type="button" class="primary-btn" style="background: var(--dark-grey);margin: 1rem 0" data-toggle="modal" data-target="#pop-up-preview-id" >Preview Image</button>

                                       <!--
                                       <div class="prev-id-sm">
                                           <img src="img/Icons/add-image.png">
                                       </div>
                                       <div class="custom-file" style="margin: 1rem 0">
                                           <input type="file" name="upload[]" multiple class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" accept="image/*">
                                           <label class="custom-file-label" for="customFileInput">Second Photo</label>
                                           <p style="margin: 0.5rem 0;text-align: center;font-size: small">Upload second photo</p>
                                           <p id="reg-pic-no" style="margin: 0.5rem 0;text-align: center">Image Selected: 0</p>
                                           <button type="button" class="primary-btn" style="background: var(--dark-grey);margin: 1rem 0" data-toggle="modal" data-target="#pop-up-preview-id" >Preview Image</button>
                                          -->
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-12">
                                       <p style="text-align: center;margin: 1rem 0 0.5rem 0 ;font-size: small">-The address in your ID will be the proof that you are from Brgy. Sto. Rosario-</p>
                                   </div>
                                   <div class="col-sm-12" style="margin-top: 0.1rem!important;">
                                       <p style="text-align: center;font-size: small">-The account will be rejected if the information from valid ID did not matched to the information you provided-</p>
                                   </div>
                               </div>
                               <div style="display: flex;justify-content: center">
                                   <button class="primary-btn" id="trigger-reg-modal" type="submit" style="width: 100%">Register</button>
                               </div>
                               <div style="display: flex;justify-content: center">
                                   <p class="modal-p">--------or--------</p>
                               </div>
                               <div style="display: flex;justify-content: center" class="margin-top-2">
                                   <button class="modal-primary-button"  id="login-btn" type="button" style="width: 50%">Go back to login page</button>
                                   <script>
                                       $("#login-btn").click(function () {
                                           location.href = "index.php";
                                       })
                                   </script>
                               </div>

                           </div>
                           <!--testing button only
                           <button id="test-btn" type="button" class="btn btn-primary"data-toggle="modal" data-target="#pop-up-error">
                               test modal only
                           </button>-->
<!--                           <button type="button" class="modal-primary-button" data-toggle="modal" data-target="#pop-up-reg">-->
<!--                               Launch demo modal-->
<!--                           </button>-->
                       </form>
                   </div>

               </div>
            </div>
            <div class="registration-form__image">
               <img src="img/reg-image.png"  style="object-fit:contain;">
            </div>
         </div>
      </section>

      <!--Modal to preview images uploaded-->
      <div class="modal fade" id="pop-up-preview-id" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true"  data-show="false">
          <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                  <div class="modal-body">

                      <div id="modal-content" class="preview-id-cont" style="display: flex;flex-flow: column;align-items: center">
                          <style>
                              #gallery img{
                                  width: fit-content;
                                  height: fit-content;
                                  max-height: 20rem;
                                  max-width: 100%;
                                  margin: 0.5rem 0;
                                  border-bottom: 0.3rem solid var(--dark-grey);
                                  /*transition: all 1s;*/
                              }
                              #gallery img:hover{
                                  /*transform: scale(1.1);*/
                              }
                              @media (max-width: 400px) {
                                  #gallery img{
                                      width: fit-content;
                                      height: fit-content;
                                      max-height: 100%;
                                      max-width: 100%;
                                      margin: 0.5rem 0;
                                  }
                              }
                              #gallery,#preview-footer{
                                  display: flex;flex-flow: column wrap; align-items: center;justify-content: center;
                              }
                          </style>
                          <div id="gallery">
                              <p>No image was selected</p>
                          </div>

                      </div><!--end of preview-->

                      </div><!--end of modal body-->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" style="font-weight: bold;font-size: 0.8rem;margin-top: 2rem" data-dismiss="modal">Back</button>
                  </div>

              </div>
          </div>
      </div>


      <script>
          $(".logo").click(function (){
              location.href="index.php";
          })
          $('[data-toggle="tooltip"]').tooltip()
      </script>
      <!--End of preview modal-->

      <!--Disclaimer modal-->
      <style>

            .disclaimer-cont .form-check-input{
                width: 1rem;
                height: 1rem;
            }
            .disclaimer-cont .form-check .form-check-label{
                font-size: smaller;
                margin-left: 0.3rem;
            }
            @media (max-width: 410px) {
                .disclaimer-cont h3{
                    font-size: 1.2rem;
                    font-weight: bolder;
                }
            }
      </style>
      <div class="modal fade" id="pop-up-reg" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true"  data-show="false" >
          <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                  <div class="modal-body">

                      <div id="modal-content" class="disclaimer-cont" style="display: flex;flex-flow: column;align-items: center" >
                          <img src="img/HIS%20logo%20blue.png" width="200" height="100"/>
                          <h3 style="color: #3f3b3b;text-align: center;font-weight: normal">Privacy Policy for Sto. Rosario Health Information System</h3>
                          <p style="color: #3f3b3b;font-size: smaller">
                              At Sto Rosario HIS Paombong Bulacan, accessible from <span><a style="text-decoration: none;color: var(--primary-color)" href="https://storosariohis.online">https://storosariohis.online</a></span>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Sto Rosario HIS Paombong Bulacan and how we use it.
<!--                              Welcome to PHRMS. These are our terms and conditions for use of the network, which you may access in several ways, including but not limited to computer, tablets, laptops, and cellphones. In these terms and conditions, you agree that all the information that you will provide will be seen only by the admin users with the condition that it will only be used for the sole purpose of catering the patient in the entirety of the system.-->
<!--                          -->

                          </p>
                          <p style="color: #3f3b3b;font-size: smaller">If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>
                          <p style="color: #3f3b3b;font-size: smaller">This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Sto Rosario HIS Paombong Bulacan. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href="https://www.privacypolicygenerator.info">Free Privacy Policy Generator</a>.</p>

                          <p style="font-weight: 700">Consent</p>
                          <p  style="color: #3f3b3b;font-size: smaller">By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                          <p style="font-weight: 700">Information we collect</p>
                          <p style="color: #3f3b3b;font-size: smaller">The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
                          <p style="color: #3f3b3b;font-size: smaller">If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
                          <p style="color: #3f3b3b;font-size: smaller">When you register for an Account, we may ask for your personal information, including items such as name, address, email address, and telephone number. We also ask for the picture of your valid ID that will only be used to verify and validate your online account registration.</p>
                          <p style="color: #3f3b3b;font-size: smaller">The account you registered will be used to store all of your medication list</p>

                          <p style="font-weight: 700">We use the information we collect for the different services of the health center, including to:</p>
                          <div class="flex-box-column justify-content-center align-items-center padding-all-15">
                              <ul id="ul-policy">
                                  <style>
                                      #ul-policy li{
                                          color: #3f3b3b;font-size: smaller
                                      }
                                  </style>
                                  <li>Provide you a patient account</li>
                                  <li>Record the medication you currently taking for monitoring</li>
                                  <li>Analyze patient records to easily identify the demands in medicine/vaccine</li>
                                  <li>Send you an email message containing an EMR (Electronic Medical Record)</li>
                              </ul>
                          </div>

                          <div style="width: 90%" class="disclaimer-cont">
                              <div class="form-check" style="margin-bottom: 1rem;display: none">
                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                                  <label class="form-check-label" for="defaultCheck1" style="color:#3f3b3b">
                                      I have read and agree to the <span style="color: #02a9f7">Term of Service</span>.
                                  </label>
                              </div>

                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                  <label class="form-check-label" for="defaultCheck1" style="color: #3f3b3b">
                                      By using this form you agree with the storage and handling of your data by
                                      this website in accordance with our <span style="color: #02a9f7">Privacy Policy</span>.
                                  </label>
                              </div>
                          </div>


                          <button type="button" class="btn btn-primary" id="pop-up-reg-ok-btn" style="font-weight: bold;font-size: 0.8rem;margin-top: 2rem" disabled>Sign Up</button>
                      </div><!--end of preview-->
                  </div><!--end of modal body-->
              </div>
          </div>
      </div>
      <script>
          let chClicked = function (e){

              let c1 = $("#defaultCheck1").prop('checked')
              let c2  =$("#defaultCheck2").prop('checked')
              if(c1&&c2){
                  $("#pop-up-reg-ok-btn").prop('disabled',false)
              }
              else {
                  $("#pop-up-reg-ok-btn").prop('disabled',true)
              }
          }
          $("#defaultCheck1").click(chClicked)
          $("#defaultCheck2").click(chClicked)

          $('#pop-up-reg').on('hidden.bs.modal', function (event) {
              // do something...
              console.log("tago modal")
               $("#defaultCheck1").prop('checked',false)
               $("#defaultCheck2").prop('checked',false)
               $("#pop-up-reg-ok-btn").prop('disabled',true)
          })
      </script>


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
                              <img src="img/Icons/exclamation-mark.png" class="modal-header-icon"/>
                              <p id="err-title" style="font-weight: 700">
                                 Can't Sign up
                              </p>
                          </div>
                          <style>
                              #pop-up-error-message p{
                                  text-align: center;
                              }
                          </style>
                          <div id="pop-up-error-message">

                          </div>
                      </div><!--end of modal content-->
                  </div><!--end of modal body-->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="pop-up-error-cancel-btn">Back</button>
                  </div>
              </div>
          </div>
      </div>

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
                              <p id="pop-up-loading-message" class="modal-p">
                                  Processing Request...
                              </p>
                          </div>

                      </div><!--end of modal content-->
                  </div><!--end of modal body-->
              </div>
          </div>
      </div>

   </body>
</html>