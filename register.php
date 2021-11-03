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
      <!--Bootstrap JS-->
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

       <!--Custom JS-->
       <script src="js/register.js"></script>
   </head>
   
   <body>
      <section class="registration-form">
         <div class="registration-form__container">
            <div class="registration-form__wrapper">
               <div class="logo">
                  <img src="img/HIS logo blue.png" alt="Logo" />
               </div>
               <div class="registration-form__form-wrapper">
                  <form>
                     <div class="container">
                        <h1 class="text-center" style="font-weight:700">Create patient account</h1>
                        <div class="row">
                           <div class="col-sm-6"> <input type="text" placeholder="First Name" data-toggle="tooltip" data-placement="top" title="First Name" data-container="body" /></div>
                           <div class="col-sm-6"> <input type="text" placeholder="Middle Name" data-toggle="tooltip" data-placement="top" title="Middle Name" data-container="body" /></div>
                           <div class="col-sm-6"> <input type="text" placeholder="Last Name" data-toggle="tooltip" data-placement="top" title="Last Name" data-container="body" /></div>
                           <div class="col-sm-6">  <input type="text" placeholder="Suffix" data-toggle="tooltip" data-placement="top" title="Suffix (ex. Jr. Sr.)" data-container="body"/></div>
                           </div>
                         <div class="row">
                             <div class="col-sm-6">  <input type="text" placeholder="Occupation" data-toggle="tooltip" data-placement="top" title="Occupation" data-container="body"/></div>
                             <div class="col-sm-6">
                                 <select type="text" placeholder="Civil Status" value="" data-toggle="tooltip" data-placement="top" title="Civil Status (Married, Single, etc.)" data-container="body">
                                     <option>Single</option>
                                     <option>Married</option>
                                     <option>Divorced</option>
                                     <option>Widowed</option>
                                 </select>
                             </div>
                         </div>
                         <div class="row">
                           <div class="col-sm-6">
                              <input type="text" placeholder="Email" data-toggle="tooltip" data-placement="top" title="E-mail" data-container="body" />
                           </div>
                           <div class="col-sm-6">
                                <input type="number" placeholder="Contact No." data-toggle="tooltip" data-placement="top" title="Contact no" data-container="body" />
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6"> <input type="password" placeholder="Password" data-toggle="tooltip" data-placement="top" title="Password" data-container="body" /></div>
                           <div class="col-sm-6"> <input type="password" placeholder=" Confirm Password" data-toggle="tooltip" data-placement="top" title="Confirm Password" data-container="body"/></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <select type="text" placeholder="Gender" value="" data-toggle="tooltip" data-placement="top" title="Gender" data-container="body">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="col-sm-3"><input type="date" placeholder="Birthday" value="" data-toggle="tooltip" data-placement="top" title="Birthday" data-container="body"/></div>
                            <div class="col-sm-3">
                                <select data-toggle="tooltip" data-placement="top" title="Purok" data-container="body">
                                    <option value="" disabled selected>Purok</option>
                                    <?php
                                    for($a=1;$a<=7;$a++){
                                        echo "<option>$a</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                           <div class="col-sm-3"><input type="number" placeholder="House #" id="num" data-toggle="tooltip" data-placement="top" title="House #" data-container="body"/></div>
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
                             <div class="col-sm-6">
                                 <div class="custom-file" style="margin: 1rem 0">
                                     <input type="file" multiple class="custom-file-input" id="customFileInput" aria-describedby="customFileInput" accept="image/*">
                                     <label class="custom-file-label" for="customFileInput">Select file</label>
                                     <p id="reg-pic-no" style="margin: 0.5rem 0;text-align: center">Image Selected: 0</p>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <button type="button" class="primary-btn" style="background: var(--dark-grey);margin: 1rem 0" data-toggle="modal" data-target="#pop-up-preview-id" >Preview Image</button>
                             </div>
                         </div>
                        <a class="primary-btn" id="reg">Register</a>
                     </div>
                  </form>
               </div>
            </div>
            <div class="registration-form__image">
               <img src="img/reg-image.png">
            </div>
         </div>
      </section>

      <!--testing button only-->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pop-up-reg">
       test modal only
      </button>

      <!--Modal to preview images uploaded-->
      <div class="modal fade" id="pop-up-preview-id" tabindex="-1" aria-labelledby="pop-upLabel" aria-hidden="true" data-backdrop="static" data-show="false" data-keyboard="false">
          <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-body">

                      <div id="modal-content" class="preview-id-cont" style="display: flex;flex-flow: column;align-items: center">
                          <div class="row" >
                              <div class="col-sm-3" style="display: flex;justify-content: center;align-items: center">
                                  <img src="img/Icons/gallery.png" width="80" height="80">
                              </div>
                              <div class="col-sm-9">
                                  <h3 style="text-align: center;font-weight:normal">Image Preview</h3>
                              </div>
                          </div>


                          <style>
                              #gallery img{
                                  width: 20rem;
                                  height: 20rem;
                                  margin: 0.5rem 0;
                              }
                              @media (max-width: 400px) {
                                  #gallery img{
                                      width: 15rem;
                                      height: 15rem;
                                      margin: 0.5rem 0;
                                  }
                              }
                          </style>
                          <div id="gallery" style="max-height: 60vh;overflow-y: auto;display: flex;flex-flow: column;align-items: center;margin: 1.5rem 0;width: 100%">
                                <p>No image was selected</p>
                          </div>
                          <button type="button" class="btn btn-primary" id="pop-up-reset-pwd-success-ok-btn" data-dismiss="modal">OK</button>

                      </div><!--end of preview-->
                  </div><!--end of modal body-->
              </div>
          </div>
      </div>

      <script>
          $(".logo").click(function (){
             location.href="index.php";
          })
          $('[data-toggle="tooltip"]').tooltip()
      </script>

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