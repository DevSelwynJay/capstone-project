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
      <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

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
       </style>
      <!--Jquery UI css and js-->
       <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
       <script src="jquery-ui/jquery-ui.js"></script>

       <!--Bootstrap-->
       <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

   </head>
   
   <body style=";height: 100vh;overflow: hidden">
      <section class="registration-form">
         <div class="registration-form__container">
            <div class="registration-form__wrapper">
               <div class="logo">
                  <img src="img/HIS logo blue.png" alt="Logo" />
               </div>
               <div class="registration-form__form-wrapper" >
                   <h1 class="text-center" style="font-weight:700;margin-bottom: 0.5rem">Create patient account</h1>
                  <form method="post" autocomplete="off" enctype="multipart/form-data" action="php/registerProcesses/registerProcess.php" style="overflow-y: auto;height: 70vh">
                     <div class="container">

                        <div class="row">
                           <div class="col-sm-6"> <input type="text" name="fname" placeholder="First Name" data-toggle="tooltip" data-placement="top" title="First Name" data-container="body" /></div>
                           <div class="col-sm-6"> <input type="text" name="mname" placeholder="Middle Name" data-toggle="tooltip" data-placement="top" title="Middle Name" data-container="body" /></div>
                           <div class="col-sm-6"> <input type="text" name="lname" placeholder="Last Name" data-toggle="tooltip" data-placement="top" title="Last Name" data-container="body" /></div>
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
                              <input type="text" name="email" inputmode="email"  placeholder="Email" data-toggle="tooltip" data-placement="top" title="E-mail" data-container="body" />
                           </div>
                           <div class="col-sm-6">
                                <input type="number" name="contact" inputmode="tel" placeholder="Contact No." data-toggle="tooltip" data-placement="top" title="Contact no" data-container="body" />
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6"> <input type="password" name="pwd" placeholder="Password" data-toggle="tooltip" data-placement="top" title="Password" data-container="body" /></div>
                           <div class="col-sm-6"> <input type="password" name="cpwd" placeholder=" Confirm Password" data-toggle="tooltip" data-placement="top" title="Confirm Password" data-container="body"/></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <select type="text" name="gender" placeholder="Gender" value="" data-toggle="tooltip" data-placement="top" title="Gender" data-container="body">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text"  name="bday" inputmode="none" placeholder="Birthday"  data-toggle="tooltip" data-placement="left" title="Birthday" data-container="body"/>
                            </div>
                            <div class="col-sm-3">
                                <select data-toggle="tooltip" name="purok" data-placement="top" title="Purok" data-container="body">
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
                                 <p style="color: var(--dark-grey);margin: 1rem 0 0 0;text-align: center">
                                     To make your account approved by admin, please attach a photo of your <b>VALID ID</b>
                                 </p>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-sm-12">
                                 <p style="text-align: center;margin: 1rem 0 0.5rem 0 ;font-size: small">-The address in your ID will be the proof that you are from Brgy. Sto. Rosario-</p>
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
                                     <input type="file" name="upload[]" multiple class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" accept="image/*">
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
                      <div style="display: flex;justify-content: center">
                          <button class="primary-btn" id="trigger-reg-modal" type="button" style="width: 100%">Register</button>
                      </div>

                     </div>
                      <!--testing button only-->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pop-up-reg">
                          test modal only
                      </button>
                  </form>
               </div>
            </div>
            <div class="registration-form__image">
               <img src="img/reg-image.png">
            </div>
         </div>
      </section>

      <!--Modal to preview images uploaded-->
      <div class="modal fade" id="pop-up-preview-id" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true"  data-show="false">
          <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="pop-upLabel" style="color: var(--dark-grey)">Image Preview</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
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
          <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-body">

                      <div id="modal-content" class="disclaimer-cont" style="display: flex;flex-flow: column;align-items: center" >
                          <img src="img/HIS%20logo%20blue.png" width="200" height="100"/>
                          <h3 style="color: #3f3b3b;text-align: center;font-weight: normal">Terms and Condition</h3>
                          <p style="color: #3f3b3b;font-size: smaller">Lorem korem hehehehe mag agree na kayo kundi patay kayo sakin</p>

                          <p></p>
                          <div style="width: 90%" class="disclaimer-cont">
                              <div class="form-check" style="margin-bottom: 1rem">
                                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
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
      </script>

   </body>
</html>