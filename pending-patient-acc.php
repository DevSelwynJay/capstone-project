<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pending Patient</title>
    <!--Carousel CSS-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity-fullscreen@1/fullscreen.css">
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
    <link rel="stylesheet" href="scss/modal.css">
    <!--Custom Carousel Design-->
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
                                echo "<td>".$row[9]."</td>";
                                echo "<td>".$row[11]."</td>";
                                echo "<td>".$row[6]."</td>";
                                echo "<td><button class='view' id='$row[0]%%%%%".$row[1].", ".$row[2]." ".$row[3]."' >View</button></td>";

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
<!--<a href="#view-pending-patient" rel="modal:open">fdfd</a>-->

<!--Modal for loading-->
<div id="pop-up-loading" class="modal">
    <div style="display: flex;align-items: center;justify-content: center">
        <div class="loader"></div>
        <p class="modal-p" id="pop-up-loading-message" style="display: flex;justify-content: center;margin-left: 1rem">
            Retrieving Info...
        </p>
    </div>
</div>
<!--Modal for success-->
<div class="modal" id="pop-up-success">
    <div class="flex-box-row justify-content-center align-items-center">
        <img class="modal-header-icon" src="img/check.png">
        <p class="modal-p" id="pop-up-success-message">Account successfully added</p>
    </div>

    <div class="flex-box-row justify-content-end align-items-end">
        <a href="#pop-up-success" rel="modal:close">
            <button class="modal-primary-button" id="pop-up-success-ok-btn" style="margin-right: 0.5rem">Okay</button>
        </a>
        <script>
            $("#pop-up-success-ok-btn").on('click',function () {
                location.reload()
            })
        </script>
    </div>
</div>
<!--Modal for error-->
<div class="modal" id="pop-up-error">
    <div class="flex-box-row justify-content-center align-items-center">
        <img class="modal-header-icon" src="img/Icons/exclamation-mark.png">
        <p class="modal-p" id="pop-up-error-message">Cannot add account</p>
    </div>

    <div class="flex-box-row justify-content-end align-items-end">
        <a href="#pop-up-success" rel="modal:close">
            <button class="modal-primary-button" id="pop-up-success-ok-btn" style="margin-right: 0.5rem">Okay</button>
        </a>
    </div>
</div>



<a href="#" class="float" id="close-pic" style="display: none">
    <i class="fa fa-sign-out my-float" id="exit-fs"></i>
</a>

<!--modal for individual view-->
<div class="modal" id="view-pending-patient">

    <div class="flex-box-row justify-content-center align-items-center">
        <img src="img/user.png" class="modal-header-icon">
        <p class="modal-title-2" id="modal-title" style="width: fit-content">View</p>
    </div>

    <div class="flex-box-row justify-content-end align-items-end" style="margin-bottom: clamp(0.2em,0.3em,5em)">
        <a id="fs" class="modal-smaller-p">View ID in Fullscreen</a>
    </div>
    <div class="gallery" style="margin-bottom: 1.5rem">
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
<!--        <div class="gallery-cell"></div>-->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="flex-box-row justify-content-center align-items-end" style="margin: 1rem">
                <button class="modal-cancel-button" id="decline" style="margin-right: 0.5rem">Decline</button>
                <button class="modal-primary-button" id="accept" style="margin-left: 0.5rem">Accept</button>
            </div>
        </div>
    </div>
</div>

<!--modal for confirm-->
<div id="pop-up-confirm-add" class="modal">
    <div class="flex-box-row justify-content-center align-items-center">
        <img class="modal-header-icon" src="img/question.png">
        <p class="modal-p">Add this account to patient?</p>
    </div>

    <div class="flex-box-row justify-content-end align-items-end">
        <a href="#pop-up-confirm-add" rel="modal:close">
            <button class="modal-cancel-button"  style="margin-right: 0.5rem">Cancel</button>
        </a>
        <button class="modal-primary-button" id="final-accept" style="margin-left: 0.5rem">Accept</button>
    </div>
</div>

<!--modal for decline-->
<div id="pop-up-decline" class="modal">
    <div class="flex-box-row justify-content-center align-items-center">
        <img class="modal-header-icon" src="img/decline.png">
        <p class="modal-title-2">Decline Account Request</p>
    </div>
    <div class="flex-box-column justify-content-center align-items-start  margin-top-3">
        <p class="modal-smaller-p " style="font-weight: 400;width: 100%;color: var(--third-color)">To: Alfredo B. Benitez</p>
        <p class="modal-smaller-p " style="font-weight: 400;width: 100%;color: var(--third-color)">Email: alfredogie@gmail.com</p>
    </div>
    <div class="flex-box-row justify-content-start align-items-center margin-top-1" style="margin-bottom: clamp(0.2em,0.3em,5em);">
        <a class="modal-smaller-p" style="cursor: inherit">Please type a reason</a>
    </div>

    <div class="flex-box-column justify-content-center align-items-start" style="margin-bottom: clamp(0.2em,0.3em,5em)">
        <textarea id="decline-reason" placeholder="Message" style="font-family: Poppins;letter-spacing: 1px">
        </textarea>
        <p class="modal-p-error">Please input reason!</p>
        <script>
            $("#decline-reason").val("")
        </script>
        <style>
            #decline-reason{
                resize: none;width: 97%;max-width: 100%;border: none;
                padding: 0.5rem;outline: none;margin: 0 0.3rem 0 0.3rem;
                height: 25vh;
                border-top: 0.1rem solid var(--light-grey);
            }
        </style>
    </div>
    <div class="flex-box-row justify-content-end align-items-end margin-top-1" style="margin: 0.5rem">
        <a href="#pop-up-decline" rel="modal:close">
            <button class="modal-cancel-button"  style="margin-right: 0.5rem">Cancel</button>
        </a>
        <button class="modal-primary-button" id="final-decline" style="margin-left: 0.5rem">Decline</button>
    </div>
</div>

<script>
    let pic_count=0;
    let carouselInstance=false
    $(document).ready(function(){
        /*
        ===============call % destroy the carousel======================
        */
        function call_carousel() {
            $( '.gallery' ).flickity( {
                cellAlign: 'center',
                //contain: true,
                //prevNextButtons: false,
                //groupCells: 2,
            } );
            $(".flickity-slider").prop('id','flickity-slider')
            $('#fs').on( 'click', function() {
                $( '.gallery' ).flickity('viewFullscreen');
                $("#close-pic").css("display","inline")
                $(".gallery-cell img").css("max-height","80vh")
            });
            function exit_fullscreen() {
                $( '.gallery' ).flickity('exitFullscreen')
                $("#close-pic").css("display","none")
                $(".gallery-cell img").css("max-height","100%")
            }
            $("#exit-fs").on( 'click', function() {
                exit_fullscreen()
            });
            $(document).keyup(function(e) {
                if (e.key === "Escape") { // escape key maps to keycode `27`
                    exit_fullscreen()
                }
            });
            $(document).on('click',function (e) {//close fullscreen when black bg was clicked
                if(e.target.id=='flickity-slider'){
                    exit_fullscreen()
                }
            })

        }
        function destroy_carousel() {
            $( '.gallery' ).flickity('destroy')
            $("#fs").off('click')
            $("#exit-fs").off('click')
            $(".gallery").html("")
        }

//=====================action====================
        let data ="";
        let id="";
        let name="" ;


        $(".view").click(function () {
            if(carouselInstance){
                destroy_carousel()
            }
            call_carousel();
            carouselInstance=true

            data = $(this).prop('id').split("%%%%%")
            id = data[0]
            name = data[1]
            //alert(name)
            $("#modal-title").html(name)
            //alert(id)
            $("#pop-up-loading").modal({
               showClose:false,
            })

            $.post('php/registerProcesses/retrieve_pending_patient_info.php',{id:id}).done(
                function (data) {
                    setTimeout(function () {
                       /* if(pic_count!=0){
                            for(let a=0;a<pic_count;a++){
                                $( '.gallery' ).flickity( 'remove', $(".gallery-cell")[a])
                            }
                        }
                        pic_count=0;*/

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

                        $("#view-pending-patient").modal({/*clickClose:false,*/ escapeClose: false,/*showClose:false*/})
                        //$( '.gallery' ).flickity('reloadCells')
                        $( '.gallery' ).flickity('resize')

                    },300)

                }
            )//done
        })

        //======================Accept===============
        $("#accept").on('click',function () {
            $("#pop-up-confirm-add").modal({
                showClose: false,
                escapeClose: false,
                clickClose: false,
                closeExisting:false,
            })
        })
        $("#final-accept").on('click',function () {
            $("#pop-up-loading").modal({
                showClose: false,
                escapeClose: false,
                clickClose: false,
                /*closeExisting:false,*/
            })
            $("#pop-up-loading-message").html("Processing Request...")

            $.post('php/registerProcesses/validate_patient_account.php',{pending_patient_id:id}).done(function (data) {

               if(data==1){
                   setTimeout(()=>{
                       $("#pop-up-success").modal({showClose: false, escapeClose: false, clickClose: false,})
                   },700)
               }
               else {
                   setTimeout(()=>{
                       $("#pop-up-error").modal({showClose: false, escapeClose: false, clickClose: false,})
                   },700)
                   console.log("cant add data")
               }

            })

        })
        //======================Decline===============
        $("#decline").on('click',function (){
            $("#pop-up-decline").modal({/*showClose: false,*/ escapeClose: false, clickClose: false,closeExisting: false})
        })
        $("#final-decline").click(function () {
            if($("#decline-reason").val()==""){
                $(".modal-p-error").css('visibility','visible')
            }
            else {
                $(".modal-p-error").css('visibility','hidden')
                $("#pop-up-loading").modal({showClose: false, escapeClose: false, clickClose: false})
                $("#pop-up-loading-message").html("Processing Request...")
                setTimeout(()=>{
                    $("#pop-up-success").modal({showClose: false, escapeClose: false})
                        $("#pop-up-success-message").html("The account declined successfully")
  .o              },700)
            }
        })
        $("#decline-reason").keyup(function () {
            $(".modal-p-error").css('visibility','hidden')
        })

    });
</script>
<!-- Carousel JavaScript -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://unpkg.com/flickity-fullscreen@1/fullscreen.js"></script>
</body>
</html>