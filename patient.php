<?php

session_start();
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=1){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
$con=null;
require 'php/DB_Connect.php';

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="img/favicon-sto.png" />
       <!--CSS Grid Bootstrap-->
       <link rel="stylesheet" href="scss/bootstrap-grid.css">
      <!--Custom CSS-->
      <link rel="stylesheet" href="scss/main.css">
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
      <!-- Font Family Poppins -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
      <title>Patient List</title>
       <!--Jquery-->
       <script src="js/jquery-3.6.0.js"></script>
       <!-- jQuery Modal-->
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
       <!--Jquery UI css and js-->
       <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
       <script src="jquery-ui/jquery-ui.js"></script>
       <link rel="stylesheet" href="scss/tooltip.css">
       <!--Custom CSS-->
       <link rel="stylesheet" href="scss/scrollbar_loading.css">
       <!--Custom Modal Design-->
       <link rel="stylesheet" href="scss/modal.css">
       <!--Table sortable-->
       <script src="js/table-sortable.js"></script>
       <link rel="stylesheet" href="scss/notif.css">
       <!--Get admin info from session-->
       <script>
           $(document).ready(function () {
               $.post('php/admin_session.php').done(
                   function (data) {
                       let result = JSON.parse(data)
                       $("#name-sidebar").html(result.admin_name)
                   }
               )
               ;
           });
       </script>

       <!--==========FOR NOTIFICATION SCRIPT ===========================-->
       <script src="notif/notif.js"></script>
       <!--==========Notification Style ===========================-->
       <link rel="stylesheet" href="notif/notif.css">

       <link rel="stylesheet" href="scss/modal.css"/>
   </head>
   <body>
   <section class="global">
       <div class="global__container">
           <div class="global__sidenav">
               <div class="inner-sidenav">
                   <div class="spacer">
                       <div class="profile">
                           <div class="profile-img">
                               <img src="img/user3.png" alt="">
                           </div>
                           <h4 id="name-sidebar">Your Name</h4>
                       </div>
                       <ul class="menu">
                           <li><a href="dashboard-admin.php" class="dashboard">Dashboard</a></li>
                           <li><a href="patient.php" class="patient" style="background: var(--hover-color)">Patient</a></li>
                           <li><a href="reports.php" class="reports">Reports</a></li>
                           <li><a href="track-map.php" class="trackMap">Track Map</a></li>
                           <li><a href="inventory.php" class="inventory">Inventory</a></li>
                           <?php include 'sidebarFix.html'?>
                       </ul>
                   </div>

               </div>
           </div>
           <div class="global__main-content">
               <div class="inner-page-content">
               <div class="col-sm-12 p-0">

<div class="inner-page-nav">

    <div class="logo">
        <img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
        <img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
    </div>

    <div class="settings">

        <a class="notification-toggle">
        <i style="cursor: pointer" class="fa fa-bell-o"></i>
        <span class="counter">3+</span>
        </a>
        <!--UPDATED NOTIF STYLING-->
        <ul class="notification-dropdown">
        <li>Lorem ipsum dolor sit amet consectetur </li>
        <li>Lorem ipsum dolor sit amet consectetur </li>
        <li>Lorem ipsum dolor sit amet consectetur </li>
        </ul>
        <!--UPDATED NOTIF STYLING-->

        <a href="profile.php"><i class="fas fa-user-circle"></i></a>
        <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
        <a id="close-dropdown"><i class="fas fa-times"></i></a>
       

        <div class="drop-down-settings" id="dropdown">
            <ul>
                <li><a href="approveEMR.php">Approve EMR</a></li>
                <li><a href="settings.php">settings</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="php/sessionDestroy.php">Logout</a></li>
            </ul>
        </div>
        
    </div>

</div>

<!--MOBILE MENU-->
<div class="menu-mobile " id="menu">
    <ul>
        <li><a href="dashboard-admin.php"><i class="fas fa-columns"></i></a></li>
        <li class="active"><a href="patient.php"><i class="fas fa-user"></i></a></li>
        <li><a href="reports.php"><i class="fas fa-chart-bar"></i></a></li>
        <li><a href="track-map.php"><i class="fas fa-map-marker"></i></a></li>
        <li><a href="inventory.php"><i class="fas fa-box"></i></a></li>
    </ul>
</div>

</div>
                  <div class="col-sm-12">
                     <div class="search-tab margin-top-2 row justify-content-sm-around">
                         <div class="button-container col-lg-6 col-md-6 col-sm-6 col-xs-6 flex-box-row margin-bottom-2 justify-content-start align-items-center">
                             <a href="add-patient-admin.php">
                                 <button class="modal-primary-button-2" style="margin-right: 1rem">
                                     <i class="fas fa-plus" style="margin-right: 0.3rem"></i>
                                     Add Patient
                                 </button>
                             </a>
                             <a href="pending-patient-acc.php">
                                 <button class="modal-primary-button">
                                     <i class="fas fa-user-check" style="margin-right: 0.3rem"></i>
                                     Pending Online Account Request
                                 </button>
                             </a>

                         </div>
                        <div class="search-container search-container-patient col-lg-4 col-md-6 col-sm-5 col-xs-6">
                           <input type="text" class="search-bar" placeholder="Search Patients" >
                           <a href="#"><i class="fas fa-search"></i></a>
                            <style>
                                @media ( max-width: 575px) {
                                    .search-bar{
                                        width: 50% !important;
                                    }
                                    .search-container{
                                        justify-content: flex-end;
                                        margin-top: 1rem !important;
                                    }
                                    .button-container{
                                        justify-content: center !important;
                                    }
                                }
                            </style>
                        </div>
<!--                        <div class="details-settings">-->
<!--                           <a href="/">View Details</a>-->
<!--                           <a href="/">Edit Details</a>-->
<!--                        </div>-->
                     </div>

                     <div class="content patients-view-container" style="margin-bottom: 5rem">
                         <h3 style="color: var(--third-color)">Patient List</h3>

<!--                         <h3 class="table-title margin-top-3">-->
<!--                             <img src="img/patient.png"class="modal-icon-wider" style="margin-right: 0.3rem"/>-->
<!--                             Patient List-->
<!--                         </h3>-->
<!--                         <style>-->
<!--                             .table-title{-->
<!--                                 font-weight:700;-->
<!--                                 margin-bottom: 0.5rem;-->
<!--                                 font-size: clamp(1.5rem,2rem,1vw);-->
<!--                                 font-family: 'Poppins', sans-serif;-->
<!--                                 color: var(--third-color);-->
<!--                                 display: flex;-->
<!--                                 align-items: center;-->
<!--                             }-->
<!--                         </style>-->
                        <table class="patients-view">
            <tbody>
<!--                <tr class="patients-view-title">-->
<!--                    <th>Patient Id</th>-->
<!--                    <th>Patient Name</th>-->
<!--                    <th>Address</th>-->
<!--                    <th>Age</th>-->
<!--                    <th>Gender</th>-->
<!--                </tr>-->
<!---->
<!--                <tr class='clickable-row' data-href='http://localhost/capstone-project/individual-patient.php'>-->
<!---->
<!--                   <td>01</td>-->
<!--                    <td>Name</td>-->
<!--                    <td>Hagonoy</th>-->
<!--                    <td>21</td>-->
<!--                    <td>M</td>-->
<!---->
<!---->
<!--                </tr>-->
<!---->
<!--                <tr>-->
<!--                    <td>02</td>-->
<!--                    <td>Name</td>-->
<!--                    <td>Hagonoy</th>-->
<!--                    <td>21</td>-->
<!--                    <td>M</td>-->
<!---->
<!--                </tr>-->
              
               
              
               
               
            </tbody>
        </table>


                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

<!--Dropdown Script-->
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
     </script>
<!--Table sortable script-->
<script src="js/table-sortable.js"></script>
      <script>

          //alert($(document).width())
      </script>
      <style>
          .active{
              background: var(--primary-color)!important;
              color: var(--secondary-color)!important;
              border:none!important;
              padding: 0.5em 0.5rem!important;
          }
          .btn-default{
              border:1px solid var(--light-grey)!important;
              padding: 0.5em 0.5rem!important;
          }
          .gs-pagination{
              margin-top: 0.5em;
          }
          .gs-pagination .row .col-md-6 span{
              font-size: clamp(0.4rem,0.8rem,1rem);
          }
          .gs-button,.gs-button span{
              color: var(--secondary-color);
          }
          th{
              background: var(--primary-color);
          }
          .btn-group button,.btn-group button span{/*sa pagination na button*/
              outline: none;
              padding: 0.2em 0.3rem;
              margin: 0.2%;
              word-wrap: normal;
          }
          @media(max-width: 1150px) {
              td{
                  font-size: clamp(0.4rem,0.8rem,1rem);
              }
          }
      </style>
<script>

   jQuery(document).ready(function() {
    // $(".clickable-row").click(function() {
    //     window.location = $(this).data("href");
    // });
       var table = $('tbody').tableSortable({
           data: [],
           columns:
               {
                   id: "ID",
                   name:"Name",
                   patient_type:"Patient Type",
                   age: "Age",
                   purok:"Purok",
                   account_type: "Reg. Type",

                   // address:"Address",
               }
           ,
           searchField: '.search-bar',
           // responsive: {
           //     720: {
           //         columns: {
           //             id: "ID",
           //             name:"Name",
           //             patient_type:"Patient Type",
           //             age: "Age",
           //             purok:"Purok"
           //
           //         },
           //     },
           // },
           rowsPerPage: 5,
           pagination: true,
           tableWillMount: function() {
               console.log('table will mount')
           },
           tableDidMount: function() {
               console.log('table did mount')
           },
           tableWillUpdate: function() {console.log('table will update')},
           tableDidUpdate: function() {
               console.log('table did update')
               row_click()
               for (a=0;a<parseInt(window.rowCount);a++){
                   $($($(".gs-table-body").children()[a]).children()[0]).attr("data-label","ID")
                   $($($(".gs-table-body").children()[a]).children()[1]).attr("data-label","Name")
                   $($($(".gs-table-body").children()[a]).children()[2]).attr("data-label","Patient Type")
                   $($($(".gs-table-body").children()[a]).children()[3]).attr("data-label","Age")
                   $($($(".gs-table-body").children()[a]).children()[4]).attr("data-label","Purok")
                   $($($(".gs-table-body").children()[a]).children()[5]).attr("data-label","Acc. Type")
               }
           },
           tableWillUnmount: function() {console.log('table will unmount')},
           tableDidUnmount: function() {console.log('table did unmount')},
           onPaginationChange: function(nextPage, setPage) {
               setPage(nextPage);
           }
       });
       $.get('php/patientProcesses/retrievePatientList.php', function(data) {
           d = data;
           // Push data into existing data
           console.log(JSON.parse(data))
           //table.setData(JSON.parse(data), null, true);
           window.rowCount = JSON.parse(data).length;
           // or Set new data on table, columns is optional.
           if($(document).width()<=720){
               table.setData(JSON.parse(data),{
                   id: "ID",
                   name:"Name",
                   patient_type:"Patient Type",
                   age: "Age",
                   purok:"Purok",
                   account_type: "Reg. Type",
                   // bday: "BirthDay",

                   // address:"Address",
               });
           }
           else{
               table.setData(JSON.parse(data),{
                   id: "ID",
                   name:"Name",
                   patient_type:"Patient Type",
                   age: "Age",
                   purok:"Purok",
                   account_type: "Reg. Type",
                   // bday: "BirthDay",

                   // address:"Address",
               });
           }
           // alert(window.rowCount)
           // for (a=0;a<parseInt(window.rowCount);a++){
           //     $($($(".gs-table-body").children()[a]).children()[0]).attr("data-label","ID")
           // }
           // alert($($($(".gs-table-body").children()[0]).children()[0]).attr("data-label","ID"))
       })//end of get/post method
       $('#changeRows').on('change', function() {
           table.updateRowsPerPage(parseInt($(this).val(), 10));
       })

       $('#rerender').click(function() {
           table.refresh(true);
       })

       $('#distory').click(function() {
           table.distroy();
       })

       $('#refresh').click(function() {
           table.refresh();
       })

       $('#setPage2').click(function() {
           table.setPage(1);
       })

       //========Action Function======================//
       function row_click() {
           $("tr").click(function () {
               let a =  $(this).children();
               let id =  $($(this).children()[0]).html();//get the ID
               console.log(id)
               if(id.indexOf("gs-button")!=-1){
                   return; //cancel code because table header was clicked
               }
               setTimeout(()=>{
                   $.post('php/patientProcesses/setPatientSessionID.php',{id:id}).done(
                       function (data) {
                           //alert(data)
                           location.href="individual-patient.php"
                       }
                   )
               },500)

               //console.log(a[0].innerHTML)//just another way
           })
       }


});//end of document ready
</script>

<script>
        const toggle = document.querySelector('.notification-toggle');
        const drop = document.querySelector('.notification-dropdown');
        

        toggle.addEventListener('click', function () {//Conditions
            if (drop.classList.contains('notification--show')) { // Close Mobile Menu
                drop.classList.remove('notification--show');
            }
            else {
                drop.classList.add('notification--show');
            }
        });
    </script>

   </body>
</html>