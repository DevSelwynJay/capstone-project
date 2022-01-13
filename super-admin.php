<?php
  session_start();

if(!isset($_SESSION['email'])||$_SESSION['account_type']!=0){
    header("location:index.php",true);
    exit();
}
$emm = $_SESSION['email_session_for_sms_otp'];
//?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!--CSS Grid Bootstrap-->
       <link rel="stylesheet" href="scss/bootstrap-grid.css">
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
       <script src="js/jquery-3.6.0.js"></script>
       <!--Jquery UI css and js-->
       <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
       <script src="jquery-ui/jquery-ui.js"></script>
       <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
       <!--Super Admin JS-->
       <script src="js/super-admin.js"></script>
       <!--<script src="js/sa_pagination.js"></script> -->
       <!--Sweet Alert-->
       <script src="sweetalert2-11.1.9/package/dist/sweetalert2.all.min.js"></script>
       <link rel="stylesheet" href="sweetalert2-11.1.9/package/dist/sweetalert2.min.css">

       <!--Custom CSS-->
       <link rel="stylesheet" href="scss/scrollbar_loading.css">
       <!--Custom Modal Design-->
       <link rel="stylesheet" href="scss/modal.css">

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
<!--                            <a><i class="fas fa-user-circle"></i></a>-->
                            <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
                            <a id="close-dropdown"><i class="fas fa-times"></i></a>
                            <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"></i></a>
                           <a id="close-mobile-menu"><i class="fas fa-times"></i></a>
                                <!--MOBILE MENU-->
                                <div class="menu-mobile " id="menu">
                                   <ul>
                                    <li><a href="dashboard-admin.php"><i class="fas fa-columns"></i>Dashboard</a></li>
                                    <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                                    <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                                    <li><a href="track-map.php"><i class="fas fa-map-marker"></i>Track Map</a></li>
                                    <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
                                   </ul>
                                </div>

                            <div class="drop-down-settings" id="dropdown">
                                <ul>
                                    <li><a href="php/sessionDestroy.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div id="show" class="modal">
                         <div class="flex-box-row align-items-center justify-content-center">
                             <style>
                                #modal-header-icon{
                                    color: #465A72;
                                    margin-right: 0.3rem;
                                }

                             </style>

                             <h3 class="title" style="color: var(--third-color)"> <i class="fas fa-user-shield fa-lg" id="modal-header-icon"></i>Add Admin Account</h3>
                         </div>

                          <div class="modal-content-scrollable">
                             <form autocomplete="off" style="margin-right: 0.3rem">
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <input type="text" id="fname" placeholder="First Name" />
                                     </div>
                                     <div class="col-sm-6">
                                         <input type="text" id="mname"  placeholder="Middle Name" />
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <input type="text" id="lname"  placeholder="Last Name" />
                                     </div>
                                     <div class="col-sm-6">
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
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <input type="text" placeholder="Email" id="admin-email"/>
                                     </div>
                                     <div class="col-sm-6">
                                         <input type="number" id="contact" placeholder="Contact No. (ex. 09...)"/>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <select name="type" id="work-cat" title="Work Category" >
                                             <option value="" disabled selected>Work Category</option>
                                             <option value="Midwife">Midwife</option>
                                             <option value="Health Worker">Health Worker</option>
                                         </select>
                                     </div>
                                     <div class="col-sm-6">
                                         <input type="date" placeholder="birthday" id="birthday"/>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-sm-6">
                                         <input type="password" placeholder="Password" id="password"/>
                                     </div>
                                     <div class="col-sm-6">
                                         <input type="password" id="conf-pass"  placeholder="Confirm Password" />
                                     </div>
                                 </div>

                                 <div class="row">
                                     <div class="col-sm-12">
                                         <input type="text" value="Sto. Rosario Paombong Bulacan" id="modalAddress">
                                     </div>
                                 </div>
                                  </form>
                         </div>
                         <div class="flex-box-row justify-content-end margin-top-1">
                             <a href="#show" rel="modal:close">
                             <button href="#show" rel="modal:close" class="modal-cancel-button" style="margin-right: 0.3rem">Cancel</button>
                             </a>>
                             <a href="#show" rel="modal:open" id="confirmation-addmin">
                              <button class="modal-primary-button">
                                  <i class="fas fa-plus"></i> Add Admin
                              </button>
                             </a>
                             <!--class="button-square"-->
                         </div>

                     </div>
                      <!-- Modal for disable admin upon click of data -->
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
                      <!-- Modal for activation of admin upon click of data -->
                      <div class="col-sm-12">
                          <div id="activemod" class="modal2">
                              <style>#activemod{
                                      display: none;
                                  }
                              .swal-wide{
                                  width: fit-content;
                                  justify-content: center;
                              }</style>
                              <form autocomplete="off">
                                  <div class="row">
                                      <label for="idno3" style="color:#6D6D6DFF">User ID:</label>
                                      <input type="text" id="idno3" disabled placeholder="" />
                                      <label for="adminname3" style="color:#6D6D6DFF">Admin:</label>
                                      <input type="text" id="adminname3" disabled placeholder="" />
                                  </div>
                                  <a href="#activemod" rel="modal:open" id="reactivate-admin1" class="button-square"><i class="fas fa-plus"></i>Activate Account</a>
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
                                      <a href="#show-del2" rel="modal:open" id="disable-admin" class="button-square"><i class="fas fa-plus"></i>Disable Account</a>
                                  </form>
                              </div>
                          </div>
                      <p id="emmm" hidden class="color-black"><?php echo $emm; ?></p>
                     <h3 class="color-black">Manage Admin Accounts</h3>
                      <div id="tableAdmin"  style="max-height: 50vh;overflow-y: auto">
                          <style>
                              #adminTable tr td:nth-child(1), #adminTable th:nth-child(1) {
                                  display: none;
                              }
                          </style>
                     <table id="adminTable">
                        <tr>
                           <th>Admin ID</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Contact No.</th>
                           <th>Work Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                         <!--Query Admin accounts-->
                         <tbody>
                         <?php
                         $con=null;
                         include 'php/DB_Connect.php';
                         $adder = 1;
                         $result = mysqli_query($con,"SELECT id, last_name, first_name, middle_name, email, contact_no, role, account_status FROM admin");
                         while ($row=mysqli_fetch_array($result)){
                             $id = $row[0];
                             $name = $row[1].", ".$row[2]." ".$row[3];
                             $email = $row[4];
                             $contact_no = $row[5];
                             $role = $row[6];

                             if($row[7]==1){
                                 $status="Active";
                                 $buttonstat = "Deactivate";
                                 $butID = "butinactive";
                             }elseif ($row[7]==0){
                                 $status="Deactivated";
                                 $buttonstat = "Activate";
                                 $butID = "butactive";
                             }
                             echo "
                             <style>tr:not(:first-child):hover { background-color : rgba(87,191,243,0.82) }
                              #butactive : hover { background-color : rgba(87,102,243,0.82) }
                             </style>
                             <tr>
                               <td class=\"data1\">$id</td>
                               <td class='data2'>$name</td>
                               <td>$email</td>
                               <td>$contact_no</td>
                               <td>$role</td>
                               <td>$status</td>
                               <td ><button class='$butID'>$buttonstat</button></td>
                            </tr>
                             ";
                             //$adder++;
                         }
                         mysqli_close($con);
                         ?>
                         </tbody>
                     </table>
                     </div>
                     <div class="cta-wrapper2">
                         <a  id="add-admin-modal" href="#show" rel="modal:open" class="square-btn"><i class="fas fa-plus"></i>Add Admin Account</a>
                         <!--Palagyan ng Disable Account na button din dito.  -->
<!--                         <a href="#show-del2" rel="modal:open" id="disable-admin1" class="red-square-btn"><i class="fas fa-trash-alt"></i>Disable Account</a>-->
                     </div>
                  </div>

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
                   <!-- Ptient Activation Modal -->
                   <div class="col-sm-12">
                       <div id="show-actpat" class="modal2">
                           <style>#show-actpat{
                                   display: none;
                               }</style>
                           <form autocomplete="off">
                               <div class="row">
                                   <label for="patidno3" style="color:#6D6D6DFF">User ID:</label>
                                   <input type="text" id="patidno3" disabled placeholder="Enter Patient ID" />
                                   <label for="patname3" style="color:#6D6D6DFF">Patient:</label>
                                   <input type="text" id="patname3" disabled placeholder="" />
                               </div>
                               <a href="#show-actpat" rel="modal:open" id="activate-patient2" class="button-square"><i class="fas fa-plus"></i>Activate Account</a>
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
                                   <a href="#show-delpat2" rel="modal:open" id="disable-patient" class="button-square"><i class="fas fa-plus"></i>Disable Account</a>
                               </form>
                           </div>
                       </div>
                   <br> <br>

                  <div class="col-sm-12">
                     <h3 class="color-black">Manage User Accounts</h3>
                      <div id ="patTable" style="max-height: 50vh;overflow-y: auto">
                          <table id="patientTable">

                          </table>
   <!--                  <table id="patientTable">
                        <tr>
                           <th>User/Patient ID</th>
                           <th>First Name</th>
                           <th>Middle Name</th>
                           <th>Last Name</th>
                           <th>Email</th>
                        </tr>
                         <tbody>
                            <?php
                            /*$con=null;
                            include 'php/DB_Connect.php';
                            $count = 0;
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
                                $count++;
                                if ($count<5){
                                    break;
                                }
                            }
                            mysqli_close($con); */
                            ?>
                         </tbody>
                     </table> -->
                      </div>
                     <div class="cta-wrapper2">
                         <!--Patanggal nung show more kasi scrollable naman na  -->
                         <a href="#blank"/>
<!--                         <a href="#show-delpat2" rel="modal:open"  id="disable-patient1" class="red-square-btn"><i class="fas fa-trash-alt"></i>Disable Account</a>-->
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

      <script>
          const dropdown = document.querySelector('#dropdown');
          const dropdownToggle = document.querySelector('#dropdown-toggle');
          const Closedropdown = document.querySelector('#close-dropdown');

          dropdownToggle.addEventListener('click',function(){//Conditions
              if(dropdown.classList.contains('open')){ // Close Mobile Menu
                  dropdown.classList.remove('open');
              }
              else{ // Open Mobile Menu
                  dropdown.classList.add('open');
              }});


          dropdownToggle.addEventListener('click',function(){
              dropdown.classList.add('open');
              dropdownToggle.style.display = "none";
              Closedropdown.style.display = "block"
          });

          Closedropdown.addEventListener('click',function(){
              dropdown.classList.remove('open');
              Closedropdown.style.display = "none"
              dropdownToggle.style.display = "block";
          });

          address_autocomlete();
          function address_autocomlete() {
              //$("#address-edit-2").autocomplete({
              //  source:['Sto. Rosario Paombong Bulacan',"Paombong","Bulacan"]
              //})
              function split( val ) {
                  return val.split( / \s*/ );
              }
              function extractLast( term ) {
                  return split( term ).pop();
              }

              $( "#modalAddress" )
                  // don't navigate away from the field on tab when selecting an item
                  .on( "keydown", function( event ) {
                      if ( event.keyCode === $.ui.keyCode.TAB &&
                          $( this ).autocomplete( "instance" ).menu.active ) {
                          event.preventDefault();
                      }
                  })
                  .autocomplete({
                      minLength: 0,
                      source: function( request, response ) {
                          // delegate back to autocomplete, but extract the last term
                          response( $.ui.autocomplete.filter(
                              ['Sto. Rosario Paombong Bulacan',"Paombong","Bulacan","Purok","Malolos"], extractLast( request.term ) ) );
                      },
                      focus: function() {
                          // prevent value inserted on focus
                          return false;
                      },
                      select: function( event, ui ) {
                          var terms = split( this.value );
                          // remove the current input
                          terms.pop();
                          // add the selected item
                          terms.push( ui.item.value );
                          // add placeholder to get the comma-and-space at the end
                          terms.push( "" );
                          this.value = terms.join( " " );
                          return false;
                      }
                  });
          }//
      </script>
       <script>
        const menu = document.querySelector('#menu');
        const mobileMenu = document.querySelector('#mobile-menu');
        const closeMobileMenu = document.querySelector('#close-mobile-menu');
        
        mobileMenu.addEventListener('click',function(){//Conditions
        if(menu.classList.contains('open')){ // Close Mobile Menu
        menu.classList.remove('open');
        }
        else{ 
        menu.classList.add('open');
        }});
        
        
        mobileMenu.addEventListener('click',function(){
            menu.classList.add('open');
            mobileMenu.style.display = "none";
            closeMobileMenu.style.display = "block"
        });
        
        closeMobileMenu.addEventListener('click',function(){
           menu.classList.remove('open');
           closeMobileMenu.style.display = "none"
           mobileMenu.style.display = "block";
        });
        $(document).ready(function() {
            displayUsers();
        })

        function displayUsers(page) {
            var displayData = true;
            $.ajax({
                url: 'php/superAdminProcesses/tableLoad.php',
                type: 'POST',
                data: {
                    page: page
                },
                success: function(data, status) {
                    $('#patientTable').html(data);
                }
            });
        }
        $(document).on("click",".pagination_link",function (){
            var page = $(this).attr("id");
            displayUsers(page);
        })



        //// *ADMIN BUTTON CLICK
        // *click button activate to get admin ID and name
        $(".butactive").click(function() {
            console.log("dumaan sa active");
            var $row = $(this).closest("tr");    // Find the row
            var $text1 = $row.find(".data1").text(); // Find the text
            var $text2 = $row.find(".data2").text(); // Find the text
            document.getElementById("idno3").value = $text1;
            document.getElementById("adminname3").value = $text2;
            $('#activemod').modal();
        })
        // *click button deactivate to get admin ID and name
        $(".butinactive").click(function() {
            console.log("dumaan sa active");
            var $row = $(this).closest("tr");    // Find the row
            var $text1 = $row.find(".data1").text(); // Find the text
            var $text2 = $row.find(".data2").text(); // Find the text
            document.getElementById("idno").value = $text1;
            document.getElementById("adminname").value = $text2;
            $('#show-del').modal();
        })



        // ?click button to get patient ID and name

            function patclick(patids,patname, statuses){

                            if(statuses=="Active"){// ?if status is active, disable modal will show
                                document.getElementById("patidno").value = patids;
                                document.getElementById("patname").value = patname;
                                $('#show-delpat').modal();
                            }else if (statuses=="Deactivated"){// ?if status is inactive, activate modal will show
                                document.getElementById("patidno3").value = patids;
                                document.getElementById("patname3").value = patname;
                                $('#show-actpat').modal();
                            }


            }


     </script>

   <style>
       .swal2-input{
           max-width: 50%;
           margin: 0 auto;
       }
       td button{
           padding: 0.5em;
           border:none;
           outline: none;
           background: var(--primary-color);
           color: var(--secondary-color);
                      }
       tr:nth-child(odd){
           background: var(--light-grey)!important;
       }
       tr:nth-child(even){
           background: white!important;
       }
       tr:nth-child(odd):hover,tr:nth-child(even):hover{
           background: var(--light-grey)!important;
       }

   </style>
   </body>
</html>