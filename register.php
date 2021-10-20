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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                           <div class="col-sm-6"> <input type="text" placeholder="First Name" /></div>
                           <div class="col-sm-6"> <input type="text" placeholder="Middle Name" /></div>
                           <div class="col-sm-6"> <input type="text" placeholder="Last Name" /></div>
                           <div class="col-sm-6">  <input type="text" placeholder="Suffix" /></div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6">
                              <input type="text" placeholder="Email" />
                           </div>
                            <div class="col-sm-6">
                                <input type="text" placeholder="Contact No." />
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-6"> <input type="password" placeholder="Password" /></div>
                           <div class="col-sm-6"> <input type="password" placeholder=" Confirm Password" /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <select type="text" placeholder="Purok" >
                                    <?php
                                    for($a=1;$a<=7;$a++){
                                        echo "<option>$a</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                           <div class="col-sm-3"><input type="text" placeholder="House #" /></div>
                           <div class="col-sm-6"><input type="text" placeholder="" value="Sto. Rosario" readonly/></div>
                        </div>
                         <div class="row">
                             <div class="col-sm-6"><input type="text" placeholder="" value="Paombong" readonly/></div>
                             <div class="col-sm-6"><input type="text" placeholder="" value="Bulacan" readonly/></div>

                         </div>
                        <a class="primary-btn">Register</a>
                     </div>
                  </form>
               </div>
            </div>
            <div class="registration-form__image">
               <img src="img/reg-image.png">
            </div>
         </div>
      </section>
   </body>
</html>