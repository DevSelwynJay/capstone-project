<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Patient</title>
    <!--Carousel Design-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity-fullscreen@1/fullscreen.css">
    <link rel="stylesheet" href="scss/modal.css">
    <!--CSS Grid Bootstrap-->
    <link rel="stylesheet" href="scss/bootstrap-grid.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="scss/main.css">
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
    <!-- Font Family Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap"
            rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- jQuery Modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--Custom CSS-->
    <link rel="stylesheet" href="scss/scrollbar_loading.css">
    <!--Custom Modal Design-->
    <link rel="stylesheet" href="scss/carousel.css">

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
                        <h4>Your Name</h4>
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
                <div class="col-sm-12">
                    <div class="inner-page-nav">
                        <div class="logo">
                            <img src="img/HIS logo blue.png" alt="">
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
                <div class = "pending-patient-container">
                    <div class="container-shadow">
                        <p>Pending Patient Accounts</p>
                        <hr>
                        <table>
                            <tr>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                            </tr>
                            <?php
                            $con=null;
                            require 'php/DB_Connect.php';
                            $res = mysqli_query($con,"SELECT*FROM pending_patient");
                            while ($row = mysqli_fetch_array($res)){
                                echo "<tr>";
                                echo "<td>".$row[1].", ".$row[2]." ".$row[3]."</td>";
                                echo "<td>".$row[10]."</td>";
                                echo "<td>".$row[12]."</td>";
                                echo "<td>".$row[6]."</td>";
                                echo "<td><button class='view' id='$row[0]' >View</button></td>";

                                echo "<tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<table>-->
<!--  <tr>-->
<!--    <th>fullname</th>-->
<!--    <th>email</th>-->
<!--    <th>contact</th>-->
<!--    <th>address</th>-->
<!--    <th>Action</th>-->
<!--  </tr>-->
<!--  --><?php
//  $con=null;
//  require 'php/DB_Connect.php';
//  $res = mysqli_query($con,"SELECT*FROM pending_patient");
//  while ($row = mysqli_fetch_array($res)){
//      echo "<tr>";
//        echo "<td>".$row[1].", ".$row[2]." ".$row[3]."</td>";
//        echo "<td>".$row[10]."</td>";
//      echo "<td>".$row[12]."</td>";
//      echo "<td>".$row[6]."</td>";
//      echo "<td><button class='view' id='$row[0]' >View</button></td>";
//
//      echo "<tr>";
//  }
//  ?>
<!--</table>-->
<a href="#view-pending-patient" rel="modal:open">fdfd</a>
<!--modal for loading-->
<div id="pop-up-loading" class="modal">
    <div style="display: flex;align-items: center;justify-content: center">
        <div class="loader"></div>
        <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
            Retrieving Info...
        </p>
    </div>
</div>


<a href="#" class="float" id="close-pic" style="display: none">
    <i class="fa fa-sign-out my-float" id="exit-fs"></i>
</a>

<!--modal for individual view-->
<div class="modal" id="view-pending-patient">

    <div class="flex-box-row justify-content-center align-items-center">
        <p class="modal-title">View</p>
    </div>

    <div class="gallery" style="margin-bottom: 1.5rem">
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
    </div>
    <div class="flex-box-row justify-content-end">
        <button class="modal-primary-button" id="fs">View Fullscreen</button>
    </div>



</div>

<script>
    let pic_count=0;
    $(document).ready(function(){
        /*
        ===============call the carousel======================
        */
        $( '.gallery' ).flickity( {
            cellAlign: 'center',
            //contain: true,
            //prevNextButtons: false,
            //groupCells: 2,
        } );
        $('#fs').on( 'click', function() {
            $( '.gallery' ).flickity('viewFullscreen');
            $("#close-pic").css("display","inline")
            $(".gallery-cell img").css("max-height","80vh")
        });
        $("#exit-fs").on( 'click', function() {
            $( '.gallery' ).flickity('exitFullscreen')
            $("#close-pic").css("display","none")
            $(".gallery-cell img").css("max-height","100%")
        });

//=====================action====================
        $(".view").click(function () {



            let id = $(this).prop('id')
            //alert(id)
            $("#pop-up-loading").modal({
               showClose:false,
            })


            $.post('php/registerProcesses/retrieve_pending_patient_info.php',{id:id}).done(
                function (data) {
                    setTimeout(function () {
                        if(pic_count!=0){
                            for(let a=0;a<pic_count;a++){
                                $( '.gallery' ).flickity( 'remove', $(".gallery-cell")[a])
                            }
                        }
                        pic_count=0;

                        let result = JSON.parse(data)
                        //alert(result.pic_path)
                        let pics = result.pic_path.split(" ")
                        //alert(pics.length)
                        for(let pic of pics){
                            pic_count+=1;
                           // alert(pic)
                            $( '.gallery' ).flickity('insert',
                                $($.parseHTML("<div>")).prop("class","gallery-cell")
                                    .append($($.parseHTML("<img>")).prop('src',pic))
                            )
                        }

                        $("#view-pending-patient").modal({clickClose:false})
                        //$( '.gallery' ).flickity('reloadCells')
                        $( '.gallery' ).flickity('resize')

                    },300)

                }
            )//done
        })
    });
</script>
<!-- Carousel JavaScript -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://unpkg.com/flickity-fullscreen@1/fullscreen.js"></script>
</body>
</html>