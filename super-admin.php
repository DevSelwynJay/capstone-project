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
       <!--Super Admin JS-->
       <script src="js/super-admin.js"></script>
       <!--Sweet Alert-->
       <script src="sweetalert2-11.1.9/package/dist/sweetalert2.all.min.js"></script>
       <link rel="stylesheet" href="sweetalert2-11.1.9/package/dist/sweetalert2.min.css">

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
                              <input type="text" id="fname" placeholder="First Name" />
                              <input type="text" id="mname"  placeholder="Middle Name" />
                              <input type="text" id="lname"  placeholder="Last Name" />
                           </div>
                           <div class="row">
                          <!--    <input type="text" id="gender"  placeholder="Gender" />  -->
                               <style>#gender,#work-cat {
                               width: 100%;
                               margin-top: 1rem;
                               padding: 0.6rem 1rem;
                               border: 2px solid var(--third-color);
                               border-radius: 10px;
                               outline: none;
                               }
                               tr:not(:first-child) { cursor: pointer; }</style>
                               <select name="type" id="gender" title="Gender">
                                   <option value="" disabled selected>Gender</option>
                                   <option value="Male">Male</option>
                                   <option value="Female">Female</option>
                               </select>
                               <input type="text" placeholder="Email" id="admin-email"/>
                           </div>
                           <div class="row">
                              <input type="password" placeholder="Password" id="password"/>
                              <input type="password" id="conf-pass"  placeholder=" Confirm Password" />
                           </div>
                           <div class="row">
                               <select name="type" id="work-cat" title="Work Category" >
                                   <option value="" disabled selected>Work Category</option>
                                   <option value="Midwife">Midwife</option>
                                   <option value="Health Worker">Health Worker</option>
                               </select>
                              <input type="text" id="contact" placeholder="Contact No." />
                           </div>
                           <a href="#show" rel="modal:open" id="confirmation-addmin" class="button-square"><i class="fas fa-plus"></i>Add Admin Account</a>
                        </form>
                     </div>
                      //TRY
                      <div class="col-sm-12">
                          <div id="show-del" class="modal2">
                              <style>#show-del{
                                      display: none;
                                  }</style>
                              <form autocomplete="off">
                                  <div class="row">
                                      <label for="idno" style="color:#6D6D6DFF">User ID:</label>
                                      <input type="text" id="idno" disabled placeholder="Enter Admin ID" />
                                      <label for="adminname" style="color:#6D6D6DFF">Admin:</label>
                                      <input type="text" id="adminname" disabled placeholder="" />
                                  </div>
                                  <a href="#show-del" rel="modal:open" id="disable-admin2" class="button-square"><i class="fas fa-plus"></i>Disable Account</a>
                              </form>
                          </div>
                      </div>
                          <div class="col-sm-12">
                              <div id="show-del2" class="modal2">
                                  <style>#show-del2{
                                          display: none;
                                      }</style>
                                  <form autocomplete="off">
                                      <div class="row">
                                          <label for="idno2" style="color:#6D6D6DFF">User ID:</label>
                                          <input type="text" id="idno2" placeholder="Enter Admin ID" />
                                      </div>
                                      <a href="#show-del2" rel="modal:open" id="disable-admin2" class="button-square"><i class="fas fa-plus"></i>Disable Account</a>
                                  </form>
                              </div>
                          </div>
                      //END TRY
                     <h3 class="color-black">Manage Admin Accounts</h3>
                      <div id="tableAdmin"  style="max-height: 50vh;overflow-y: auto">
                     <table id="adminTable">
                        <tr>
                           <th>Admin ID</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Contact No.</th>
                           <th>Work Category</th>
                        </tr>
                         <!--Query Admin accounts-->
                         <tbody>
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
                             <style>tr:not(:first-child):hover { background-color : rgba(87,191,243,0.82) }</style>
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
                         </tbody>
                     </table>
                     </div>
                     <div class="cta-wrapper2">
                         <a  id="add-admin-modal" href="#show" rel="modal:open" class="square-btn"><i class="fas fa-plus"></i>Add Admin Account</a>
                         <!--Palagyan ng Disable Account na button din dito.  -->
                         <a href="#show-del2" rel="modal:open" id="disable-admin1" class="red-square-btn"><i class="fas fa-trash-alt"></i>Disable Account</a>
                     </div>
                  </div>
                      //TRY
                      <div class="col-sm-12">
                          <div id="show-delpat" class="modal2">
                              <style>#show-delpat{
                                      display: none;
                                  }</style>
                              <form autocomplete="off">
                                  <div class="row">
                                      <label for="patidno" style="color:#6D6D6DFF">User ID:</label>
                                      <input type="text" id="patidno" disabled placeholder="Enter Patient ID" />
                                      <label for="patname" style="color:#6D6D6DFF">Patient:</label>
                                      <input type="text" id="patname" disabled placeholder="" />
                                  </div>
                                  <a href="#show-delpat" rel="modal:open" id="disable-patient2" class="button-square"><i class="fas fa-plus"></i>Disable Account</a>
                              </form>
                          </div>
                      </div>
                       <div class="col-sm-12">
                           <div id="show-delpat2" class="modal2">
                               <style>#show-delpat2{
                                       display: none;
                                   }</style>
                               <form autocomplete="off">
                                   <div class="row">
                                       <label for="patidno2" style="color:#6D6D6DFF">User ID:</label>
                                       <input type="text" id="patidno2" placeholder="Enter Patient ID" />
                                   </div>
                                   <a href="#show-delpat2" rel="modal:open" id="disable-patient2" class="button-square"><i class="fas fa-plus"></i>Disable Account</a>
                               </form>
                           </div>
                       </div>
                          //END TRY
                  <div class="col-sm-12">
                     <h3 class="color-black">Manage User Accounts</h3>
                      <div style="max-height: 50vh;overflow-y: auto">
                     <table id="patientTable">
                        <tr>
                           <th>User/Patient ID</th>
                           <th>First Name</th>
                           <th>Middle Name</th>
                           <th>Last Name</th>
                           <th>Email</th>
                        </tr>
                         <tbody>
                            <?php
                            $con=null;
                            include 'php/DB_Connect.php';
                            $result = mysqli_query($con,"SELECT id, first_name, middle_name, last_name, email FROM patient");
                            while ($row=mysqli_fetch_array($result)){
                                $ids = $row[0];
                                $fnames = $row[1];
                                $mnames = $row[2];
                                $lnames = $row[3];
                                $ems = $row[4];
                                echo "
                             <style>tr:not(:first-child):hover { background-color : rgba(87,191,243,0.82) }</style>
                             <tr>
                               <td>$ids</td>
                               <td>$fnames</td>
                               <td>$mnames</td>
                               <td>$lnames</td>
                               <td>$ems</td>
                            </tr>
                             ";
                            }
                            mysqli_close($con);
                            ?>
                         </tbody>
                     </table>
                      </div>
                     <div class="cta-wrapper2">
                         <!--Patanggal nung show more kasi scrollable naman na  -->
                         <a href="" class="square-btn">Show More</a>
                         <a href="#show-delpat2" rel="modal:open"  id="disable-patient1" class="red-square-btn"><i class="fas fa-trash-alt"></i>Disable Account</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   <script>


       //additional script for autocomplete form problem
       //$('#show-del').modal.open();
        $("#add-admin-modal").on("click",function (){

            setTimeout(function (){
                $("#email").val("")
                $("#password").val("")
            },500)


        })
   </script>
   </body>
</html>