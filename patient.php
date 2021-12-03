<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!--CSS Grid Bootstrap-->
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
      <title>Patient List</title>
       <!--Jquery-->
       <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
       <!--Get admin info from session-->
       <script>
           $.post('php/admin_session.php').done(
               function (data) {
                   let result = JSON.parse(data)
                   $("#name-sidebar").html(result.admin_name)
               }
           )
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
                  <div class="col-sm-12 p-0">
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
                     <div class="search-tab margin-top-2">
                        <div class="search-container">
                           <input type="text" class="search-bar">
                           <a href="/"><i class="fas fa-search"></i></a>
                        </div>
<!--                        <div class="details-settings">-->
<!--                           <a href="/">View Details</a>-->
<!--                           <a href="/">Edit Details</a>-->
<!--                        </div>-->
                     </div>
                     <div class="content patients-view-container">


                       
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
                   patient_type:"Type",
                   age: "Age",
                   purok:"Purok",
                   address:"Address",
               }
           ,
           searchField: '.search-bar',
           responsive: {
               720: {
                   columns: {
                       id: "ID",
                       name:"Name",
                       patient_type:"Type",
                       age: "Age",
                       purok:"Purok"

                   },
               },
           },
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

           // or Set new data on table, columns is optional.
           if($(document).width()<=720){
               table.setData(JSON.parse(data),{
                   id: "ID",
                   name:"Name",
                   patient_type:"Type",
                   age: "Age",
                   purok:"Purok"
                   // address:"Address",
               });
           }
           else{
               table.setData(JSON.parse(data),{
                   id: "ID",
                   name:"Name",
                   patient_type:"Type",
                   age: "Age",
                   purok:"Purok",
                   address:"Address",
               });
           }
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

   </body>
</html>