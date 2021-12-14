<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

 <!--Bootstrap-->
 <link rel="stylesheet" href="scss/bootstrap-grid.css">
  <!--Custom CSS-->
  <link rel="stylesheet" href="scss/style.css">
<!--Font Awesome-->
<script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
<!-- Font Family Poppins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<title>Reports</title>
<!--Jquery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .drop-down-settings,.drop-down-settings open{
            z-index: 1000;
        }
    </style>
    <!--Get admin info from session-->
    <script>
        $(document).ready(function () {
            $.post('php/admin_session.php').done(
                function (data) {
                    let result = JSON.parse(data)
                    $("#name-sidebar").html(result.admin_name)
                }
            )
        })
    </script>
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
                       <li><a href="dashboard-admin.html" class="dashboard">Dashboard</a></li>
                       <li><a href="patient.php" class="patient">Patient</a></li>
                       <li><a href="reports.php" class="reports">Reports</a></li>
                       <li><a href="track-map.html" class="trackMap">Track Map</a></li>
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
                 <div class="col-sm-12  p-0">
                    <div class="inner-page-nav">
                       <div class="logo">
                          <img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
                          <img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
                       </div>
                       <div class="settings">
                          <a><i class="fas fa-user-circle"></i></a>
                          <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
                          <a id="close-dropdown"><i class="fas fa-times"></i></a>
                          <div class="drop-down-settings" id="dropdown">
                             <ul>
                                <li><a href="">Approve EMR</a></li>
                                <li><a href="settings.php">settings</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="php/sessionDestroy.php">Logout</a></li>
                             </ul>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-sm-12">
                    <div class="reports_content">
                       <div class="row-container">
                          <div class="col-md-12 col-lg-8">
                             <div class="reports__left-col">
                                <div class="reports__left-col-container">
                                    <table class="reports__table">
                                        <tbody>
                                           <tr>
                                              <th>Name</th>
                                              <th>Type</th>
                                           </tr>
                                           <tr>
                                              <td>Name</td>
                                              <td>Illness</td>
                                           </tr>
                                           <tr>
                                            <td>Name</td>
                                            <td>Illness</td>
                                           </tr>
                                           <tr>
                                            <td>Name</td>
                                            <td>Illness</td>
                                           </tr>
                                           <tr>
                                            <td>Name</td>
                                            <td>Illness</td>
                                           </tr>
                                          
                                        </tbody>
                                     </table>
                                </div>
                             </div>
                          </div>
                          <div class="col-md-12  col-lg-4">
                             <div class="reports__right-col">
                               <div class="reports__right-col_links">
                                <a href="medicine-reports.html">Medicine</a>
                                <a href="consultation-reports.html">Consulted</a>
                                <a href=vaccination-reports.html>Vaccinated Patient</a>
                               </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
<!--Drop down script-->
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
</body>
</html>