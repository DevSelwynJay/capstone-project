<?php
session_start();
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=0){
   header("location:index.php",true);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--custom CSS-->
      <link rel="stylesheet" href="scss/main.css">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <title>Administrator</title>
      <!--Jquery-->
       <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
   </head>
   <body>
      <section>
         <div class="super-admin">
            <!--
               <div class="sidenav">
                  <div class="inner-sidenav">
                     <div class="spacer">
                        <div class="profile">
                           <div class="profile-img">
                              <img src="img/jay.jpg" alt="">
                           </div>
                           <h4>Your Name</h4>
                        </div>
                        <ul class="menu">
                           <li><a href="" class="dashboard">Dashboard</a></li>
                           <li><a href="" class="patient">Patient</a></li>
                           <li><a href="" class="reports">Reports</a></li>
                           <li><a href="" class="trackMap">Track Map</a></li>
                           <li><a href="" class="inventory">Inventory</a></li>
                        </ul>
                     </div>
                     <div class="social-media-links">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                     </div>
                  </div>
               </div>
               
               -->
            <div class="main">
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
                  <div class="col-sm-12">
                     <div id="show" class="modal">
                        <form autocomplete="off">
                           <div class="row">
                              <input type="text" placeholder="First Name" />
                              <input type="text" placeholder="Middle Name" />
                              <input type="text" placeholder="Last Name" />
                           </div>
                           <div class="row">
                              <input type="text" placeholder="Gender" />
                              <input type="text" placeholder="Email" id="email"/>
                           </div>
                           <div class="row">
                              <input type="password" placeholder="Password" id="password"/>
                              <input type="password" placeholder=" Confirm Password" />
                           </div>
                           <div class="row">
                              <input type="text" placeholder="Work Category" />
                              <input type="text" placeholder="Contact No." />
                           </div>
                           <a href="#show" rel="modal:open" class="button-square"><i class="fas fa-plus"></i>Add Admin Account</a>
                        </form>
                     </div>
                     <h3 class="color-black">Manage Admin Accounts</h3>
                      <div style="max-height: 50vh;overflow-y: auto">
                     <table>
                        <tr>
                           <th>Admin ID</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Contact No.</th>
                           <th>Work Category</th>
                        </tr>
                         <!--Query Admin accounts-->
                         <?php
                         $con=null;
                         include 'php/DB_Connect.php';
                         $result = mysqli_query($con,"SELECT id, last_name, first_name, middle_name, email, contact_no, role FROM admin");
                         while ($row=mysqli_fetch_array($result)){
                             $id = $row[0];
                             $name = $row[1].", ".$row[2]." ".$row[3];
                             $email = $row[4];
                             $contact_no = $row[5];
                             $role = $row[6];
                             echo "
                             <tr>
                               <td>$id</td>
                               <td>$name</td>
                               <td>$email</td>
                               <td>$contact_no</td>
                               <td>$role</td>
                            </tr>
                             ";
                         }
                         mysqli_close($con);
                         ?>
                     </table>
                     </div>
                     <div class="cta-wrapper">
                         <a  id="add-admin-modal" href="#show" rel="modal:open" class="square-btn"><i class="fas fa-plus"></i>Add Admin Account</a>
                         <!--Palagyan ng Disable Account na button din dito.  -->
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <h3 class="color-black">Manage User Accounts</h3>
                      <div style="max-height: 50vh;overflow-y: auto">
                     <table>
                        <tr>
                           <th>User/Patient ID</th>
                           <th>First Name</th>
                           <th>Middle Name</th>
                           <th>Last Name</th>
                           <th>Email</th>
                        </tr>
                        <tr>
                           <td>01</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>02</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>03</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>04</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>05</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>06</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>07</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>08</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                        <tr>
                           <td>09</td>
                           <td>First Name</td>
                           <td>Middle Name</td>
                           <td>Last Name</th>
                           <td>Email</td>
                        </tr>
                     </table>
                      </div>
                     <div class="cta-wrapper2">
                         <!--Patanggal nung show more kasi scrollable naman na  -->
                         <a href="" class="square-btn">Show More</a>
                         <a href="" class="red-square-btn"><i class="fas fa-trash-alt"></i>Disable Account</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   <script>
       //additional script for autocomplete form problem
        $("#add-admin-modal").on("click",function (){

            setTimeout(function (){
                $("#email").val("")
                $("#password").val("")
            },500)


        })
   </script>
   </body>
</html>