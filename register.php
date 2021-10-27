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
                           <div class="col-sm-6"><input type="text" placeholder="" value="Sto. Rosario" readonly/></div>
                        </div>
                         <div class="row">
                             <div class="col-sm-6"><input type="text" placeholder="" value="Paombong" readonly/></div>
                             <div class="col-sm-6"><input type="text" placeholder="" value="Bulacan" readonly/></div>
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
      <script>
          $(".logo").click(function (){
             location.href="index.php";
          })
          $('[data-toggle="tooltip"]').tooltip()
      </script>
   </body>
</html>