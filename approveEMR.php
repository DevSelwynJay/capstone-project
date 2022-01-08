<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <!--Get admin info from session-->
  <script>
    $.post('php/admin_session.php').done(
            function (data) {
              let result = JSON.parse(data)
              $("#name-sidebar").html(result.admin_name)
            }
    )
  </script>
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
              <img src="img/jay.jpg" alt="">
            </div>
            <h4 id="name-sidebar">Your Name</h4>
          </div>
          <ul class="menu">
            <li><a href="dashboard-admin.php" class="dashboard">Dashboard</a></li>
            <li><a href="patient.php" class="patient">Patient</a></li>
            <li><a href="reports.php" class="reports">Reports</a></li>
            <li><a href="track-map.php" class="trackMap">Track Map</a></li>
            <li><a href="inventory.php" class="inventory">Inventory</a></li>
          </ul>
        </div>
        <div class="social-media-links">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-instagram"></i>
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
              <a href="profile.php"><i class="fas fa-user-circle"></i></a>
              <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
              <a id="close-dropdown"><i class="fas fa-times" id="x-1"></i></a>
              <a id="mobile-menu" class="mobile-menu"><i class="fas fa-bars"></i></a>
              <a id="close-mobile-menu"><i class="fas fa-times" id="x-2"></i></a>
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
                  <li><a id="approved-emr" href="#">Approve EMR</a></li>
                  <script>
                    $("#approved-emr").click(function (data) {
                      $("#pop-up-approve-emr").modal({
                        showClose:false,escapeClose:false
                      })
                      $("#x-1").trigger("click")
                    })
                  </script>
                  <li><a href="settings.php">settings</a></li>
                  <li><a href="about.php">About</a></li>
                  <li><a href="php/sessionDestroy.php">Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="search-tab margin-top-2 row justify-content-sm-around">
            <div class="button-container col-lg-6 col-md-6 col-sm-6 col-xs-6 flex-box-row justify-content-start align-items-center">
<!--              <a href="add-patient-admin.php">-->
<!--                <button class="modal-primary-button-2" style="margin-right: 1rem">-->
<!--                  <i class="fas fa-plus" style="margin-right: 0.3rem"></i>-->
<!--                  Add Patient-->
<!--                </button>-->
<!--              </a>-->
<!--              <a href="pending-patient-acc.php">-->
<!--                <button class="modal-primary-button">-->
<!--                  <i class="fas fa-user-check" style="margin-right: 0.3rem"></i>-->
<!--                  Pending Online Account Request-->
<!--                </button>-->
<!--              </a>-->

            </div>
<!--            <div class="search-container col-lg-4 col-md-6 col-sm-5 col-xs-6 margin-top-2">-->
<!--              <input type="text" class="search-bar">-->
<!--              <a href="/"><i class="fas fa-search"></i></a>-->
<!--              <style>-->
<!--                @media ( max-width: 575px) {-->
<!--                  .search-bar{-->
<!--                    width: 50% !important;-->
<!--                  }-->
<!--                  .search-container{-->
<!--                    justify-content: flex-end;-->
<!--                    margin-top: 2rem !important;-->
<!--                  }-->
<!--                  .button-container{-->
<!--                    justify-content: center !important;-->
<!--                  }-->
<!--                }-->
<!--              </style>-->
<!--            </div>-->
            <!--                        <div class="details-settings">-->
            <!--                           <a href="/">View Details</a>-->
            <!--                           <a href="/">Edit Details</a>-->
            <!--                        </div>-->
          </div>

          <div class="content patients-view-container">
            <h1 style="color: var(--third-color);text-align: center"class="margin-top-2 flex-box-row align-items-end justify-content-start">
                <img src="img/medical-record.png" class="modal-header-icon" style="margin-right: 0.3rem">
                EMR Request
            </h1>
              <p class="modal-p" style="margin-top: 1.5rem !important;"><span style="color: darkred">Note: </span>The table below shows all of the online patient account who is requesting for EMR (Electronic Medical Record)</p>

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
              <tbody id="emr-req-cont">
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
            <div class="content patients-view-container">
                <h1 style="color: var(--third-color);text-align: center"class="margin-top-2 flex-box-row align-items-end justify-content-start">
                    <img src="img/history.png" class="modal-header-icon" style="margin-right: 0.3rem">
                     EMR Request History
                </h1>
                <p class="modal-p" style="margin-top: 1.5rem !important;"><span style="color: darkred">Note: </span>The table below shows all of the request history of  EMR (Electronic Medical Record)</p>

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
                    <tbody id="approve-emr-req-cont">
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
  .view-req-btn{
      padding: 0.5rem;
      border-radius: 0;
      border: none;
      background: var(--primary-color);
      color: white;
      font-family: 'Poppins', sans-serif;
      font-weight: bold;
  } .view-req-btn:hover{
        background: #72c8f8;
        cursor: pointer;
    }
</style>
<?php
include 'approveEMRScript.html';
?>
</body>
</html>
<style>

</style>