<?php
$con=null;
require 'php/DB_Connect.php';

$sql = "SELECT * FROM `medinventory` WHERE stock <= 100 AND expdate > NOW()";
$countres = mysqli_query($con,$sql);
$count = mysqli_num_rows($countres);
$sql2 = "SELECT * FROM `medinventory` WHERE stock = 0";
$countres2 = mysqli_query($con,$sql2);
$count4 = mysqli_num_rows($countres2);
$exptab = "Select * from `medinventory`  where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY";
$expire = "Select * from `medinventory` where `expdate` < NOW()";
$res1 = mysqli_query($con,$expire);
$res2 = mysqli_query($con,$exptab);
$count2 = mysqli_num_rows($res1);
$count3 = mysqli_num_rows($res2);
$critstocks = "There ".$count." Critical Stocks in our Inventory";
$toexp = "There ".$count3." To Expire Medicine in our Inventory";
$exp = "There ".$count2." Expired Medicine in our Inventory";
$ofs = "There ".$count4." Out of Stocks in our Inventory";


?>








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
    <title>Inventory</title>
    <!--Jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery Modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.js"></script>
    <!--Custom Modal Design-->
    <link rel="stylesheet" href="scss/modal.css">
    <link rel="stylesheet" href="scss/notif.css">

    <!--Get admin info from session-->

    <script>


        $(document).ready(function () {
            Notif();
            $.post('php/admin_session.php').done(
                function (data) {
                    let result = JSON.parse(data)
                    $("#name-sidebar").html(result.admin_name)
                }
            )



            function Notif(){
                var data = true;
                $.ajax({
                    url:"php/inventoryProcesses/Notif_function.php",
                    method: "POST",
                    data: {data},
                    success:function(data){
                        $('.count').html(data);

                    }
                })
            }
            setInterval(Notif,1000);
        });
        $(function() {
            $(".navbar").click(function() {
                $(".dropdown").toggle();
            });
        });


    </script>
    <style>
        .overflow {
            height: 200px;
        }
    </style>
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
                            <div class="navbar">
                                <ul class="notif" >
                                    <li>

                                        <a href="#">

                                                <i style="cursor: pointer" class="fa fa-bell-o"></i>

                                            <span class="count">3</span>
                                        </a>

                                        <ul class="dropdown">
                                            <?php
                                            if($count >= 0){
                                                ?><li><?php
                                                echo $critstocks;
                                                ?></li><?php
                                            }
                                            ?>
                                            <?php
                                            if($count > 0){
                                                ?><li><?php
                                                echo $toexp;
                                                ?></li><?php
                                            }
                                            ?>
                                            <?php
                                            if($count > 0){
                                                ?><li><?php
                                                echo $exp;
                                                ?></li><?php
                                            }
                                            ?>
                                            <?php
                                            if($count > 0){
                                                ?><li><?php
                                                echo $ofs;
                                                ?></li><?php
                                            }
                                            ?>

                                        </ul>
                                    </li>

                                </ul>

                            </div>

                            <a href="profile.php"><i class="fas fa-user-circle"></i></a>
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
                                    <li><a href="">Approve EMR</a></li>
                                    <li><a href="settings.php">settings</a></li>
                                    <li><a href="about.php">About</a></li>
                                    <li><a href="php/sessionDestroy.php">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="">
                        <div class="inventory__container">
                            <div class="inventory__table-main-container"  >
                                <!--Add Button para sa MEDS-->
                                <button class="modal-primary-button-2" type="button" id="addbtn"><i class="fas fa-plus" style="margin-right: 0.3rem"></i>Add Medicine</button>
<!--                                <button class="modal-cancel-button" type="button" id="critbtn"><i class="fa fa-times-circle"  style="margin-right: 0.3rem"></i>Out of Stock Medicines</button>-->

                                <div>
                                    <input style="width: 40vw" type="text" id="meds" class="form-control" placeholder="Search Medicines" autocomplete="off">
                                </div>
                                <!--Display ko dito yung Table of MEDS-->
                                <div id="displayMedicineDataTable">
                                </div>


                            <div class="inventory__table-toexpire-container"  >
                                <div id="toExptab">
                                </div>
                            </div>

                            <div class="inventory__table-expired-container" >

                                <div id="exptab">
                                </div>
                            </div>
                            </div>
                        </div>
                        <!--Modals-->
                        <!-- Add New Meds Modal -->
                        <div id="add-modal" class="modal">
                            <div class="flex-box-row justify-content-center align-items-center">
                                <img class="modal-header-icon" src="img/medicine.png"><p class="modal-title">Add New Medicine</p>
                            </div>
                            <div class="modal-content-scrollable">

                                <div class="container-fluid">

                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="medicineCategory">Category:</p>
                                            <select class="modal-field" id="medcategorySelect">
                                                <option value="Medicine">Medicine</option>
                                                <option value="Vaccine">Vaccine</option>
                                            </select>
                                            <script>
                                                $('#medcategorySelect').change(function (){
                                                    if($('#medcategorySelect').val() == "Vaccine"){
                                                        $('#medSubCategory').css("display","none");
                                                        $('#vacSubCategory').css("display","block");
                                                    }
                                                    else{
                                                        $('#vacSubCategory').css("display","none");
                                                        $('#medSubCategory').css("display","block");
                                                    }
                                                })
                                            </script>
                                            <input class="modal-field" type="text" id="medSubCategory" autocomplete="off" placeholder="Medicine Type">

                                            <input class="modal-field" type="text" id="vacSubCategory" autocomplete="off" placeholder="Vaccine Type" style="display: none">

                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="medicineName">Medicine Name:</p>
                                            <input type="text" class="modal-field" id="medicineName" autocomplete="off" placeholder="Enter Medicine Name" required>
                                            <p class="modal-p" class="error" id="name-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="medicineDosage">Medicine Dosage:</p><input type="text" id="medicineDosage" class="modal-field" placeholder="Enter Medicine Dosage" autocomplete="off" required>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p"for="medicineStocks">Stock:</p>
                                            <input type="text" id="medicineStocks"  class="modal-field" placeholder="Enter Medicine Stocks" autocomplete="off" required>
                                            <p class="modal-p" class="error" id="stock-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="medicineMfgDate" >Mfg. Date:</p>
                                            <input type="text" id="medicineMfgDate" contenteditable="false"  class="modal-field" placeholder="Enter Mfg Date" autocomplete="off" required>
                                            <p class="modal-p" class="error" id="mfgdate-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p"  for="medicineExpDate" >Exp Date:</p>
                                            <input type="text" id="medicineExpDate" contenteditable="false"  class="modal-field" placeholder="Enter Exp Date" autocomplete="off" required>
                                            <p class="modal-p" class="error" id="expdate-incorrect-indcator" style="color: red; visibility: hidden;"></p>
                                        </div>
                                        <p class="modal-p" class="error" id="all-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                    </div>

                                    <div class="row flex-row justify-content-start" style="display: flex">
                                        <div class="col-sm-12 flex-box-row justify-content-end align-items-end margin-top-1">
                                            <a href="#add-modal" rel="modal:close"><button class="modal-cancel-button" id="addcancel" style="margin-right: 0.5rem">Cancel</button></a>
                                            <a><button id="okay-edit-btn" class="modal-primary-button" onclick="addNewMedicine()">Add</button></a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- Update Meds Modal -->
                        <div id="update-modal" class="modal">
                            <div class="flex-box-row justify-content-center align-items-center">
                                <img class="modal-header-icon" src="img/medicine.png"><p class="modal-title">Update Medicine</p>
                            </div>
                            <div class="modal-content-scrollable">

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="upmedicineCategory">Category:</p>
                                            <select class="modal-field" id="upmedcategorySelect" disabled>

                                                <option value="Medicine">Medicine</option>
                                                <option value="Vaccine">Vaccine</option>
                                            </select>
                                            <script>
                                                $('#upmedcategorySelect').change(function (){
                                                    if($('#upmedcategorySelect').val() == "Vaccine"){
                                                        $('#upmedSubCategory').css("display","none");
                                                        $('#upvacSubCategory').css("display","block");
                                                    }
                                                    else{
                                                        $('#upvacSubCategory').css("display","none");
                                                        $('#upmedSubCategory').css("display","block");
                                                    }
                                                })
                                            </script>
                                            <input class="modal-field" type="text" id="upmedSubCategory" autocomplete="off" placeholder="Medicine Sub-Category" readonly>

                                            <input class="modal-field" type="text" id="upvacSubCategory" autocomplete="off" placeholder="Vaccine Sub-Category" style="display: none" readonly>

                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="updatemedicineName">Medicine Name:</p><input type="text" id="updatemedicineName" class="modal-field" readonly >
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="upmedicineDosage">Medicine Dosage:</p><input type="text" id="upmedicineDosage" class="modal-field" placeholder="Enter Medicine Dosage" autocomplete="off" readonly>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p"for="updatemedicineStocks">Stock:</p> <input type="text" id="updatemedicineStocks"  class="modal-field" autocomplete="off" required>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="updatemedicineMfgDate" >Mfg. Date:</p>
                                            <input type="text" id="updatemedicineMfgDate" contenteditable="false"  class="modal-field" autocomplete="off" readonly>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="updatemedicineExpDate" >Exp Date:</p>
                                            <input type="text" id="updatemedicineExpDate" contenteditable="false"  class="modal-field" autocomplete="off" readonly>
                                            <input type="hidden" id="hiddendata" >
                                        </div>
                                    </div>
                                    <div class="row flex-row justify-content-start" style="display: flex">
                                        <div class="col-sm-12 flex-box-row justify-content-end align-items-end margin-top-1">
                                            <a href="#update-modal" rel="modal:close"><button class="modal-cancel-button" id="addupcancel" style="margin-right: 0.5rem">Cancel</button></a>
                                            <a><button id="okay-update-btn" class="modal-primary-button" onclick="medUpdate()">Update</button></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Delete Meds Modal -->
                        <div id="delete-modal" class="modal">
                            <div class="flex-box-row justify-content-center align-items-center">
                                <img class="modal-header-icon" src="img/medicine.png"><p class="modal-title">Delete Medicine</p>
                            </div>
                            <div class="modal-content-scrollable">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p">Do you want to Delete this Expired Medicine?</p>
                                            <input type="hidden" id="hideid" >
                                        </div>
                                    </div>
                                    <div class="row flex-row justify-content-start" style="display: flex">
                                        <div class="col-sm-12 flex-box-row justify-content-end align-items-end margin-top-1">
                                            <a href="#delete-modal" rel="modal:close"><button class="modal-cancel-button" id="adddelcancel" style="margin-right: 0.5rem">Cancel</button></a>
                                            <a><button id="delete-btn" class="modal-primary-button" onclick="medDelete()" >Delete</button></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="crit-modal" class="modal">
                            <div class="flex-box-row justify-content-center align-items-center">
                                <img class="modal-header-icon" src="img/medicine.png"><p class="modal-title">Out of Stock Medicines</p>
                            </div>
                            <div class="modal-content-scrollable">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p">Do you want to Delete this Expired Medicine?</p>
                                            <input type="hidden" id="hideid" >
                                        </div>
                                    </div>
                                    <div class="row flex-row justify-content-start" style="display: flex">
                                        <div class="col-sm-12 flex-box-row justify-content-end align-items-end margin-top-1">
                                            <a href="#crit-modal" rel="modal:close"><button class="modal-cancel-button" id="adddelcancel" style="margin-right: 0.5rem">Cancel</button></a>
                                            <a><button id="crit-btn" class="modal-primary-button" >Delete</button></a>
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
<script type="text/javascript">
    //Display Automatically
    $(document).ready(function(){
        displayMedicines();
        displayToExpTab();
        displayExpTab();

        $( "#medNameSelect" )
            .selectmenu()
            .selectmenu( "menuWidget" )
            .addClass( "overflow" );


    });
    //Sort function
    $(document).ready(function(){
        $(document).on('click','.column_sort', function (){
            var column_name = $(this).attr("id");
            var order = $(this).data("order");
            var arrow = '';
            if(order == 'desc'){
                arrow = '&nbsp;<i class="fas fa-arrow-down"></i>';
            }
            else {
                arrow = '&nbsp;<i class="fas fa-arrow-up"></i>';
            }
            $.ajax({
                url:"php/inventoryProcesses/medSort.php",
                method:"POST",
                data:{column_name:column_name, order:order},
                success:function(data){
                    $('#displayMedicineDataTable').html(data);
                    $('#'+column_name+'').append(arrow);
                }
            })

        })
    });
    //Search Function
    $(document).ready(function(){

        $('#meds').autocomplete({
            source: function( request, response){
                $.ajax({
                    url: 'php/inventoryProcesses/medSearch.php',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        search:request.term
                    },
                    success: function(data){
                        response(data);
                    }
                });
            },
            select:function(event,ui){
                medDisplayUpdateModal(ui.item.value);
                $('#meds').val("");
                return false;

            }
        });
    });
    //Modals
    $(document).ready(function(){
        $('#addbtn').on("click",function (){
            $("#add-modal").modal({
                //escapeClose: false,
                clickClose: false,
                showClose: false
            })
        })
        $('#addcancel').on("click", function (){
            $('#meds').trigger("focus");
            $('#medicineName').val("");
            $('#medicineCategory').val("");
            $('#medicineStocks').val("");
            $('#medicineMfgDate').val("");
            $('#medicineExpDate').val("");
        })
        $('#critbtn').on("click",function(){
            $("#crit-modal").modal({
                clickClose:false,
                showClose:false
            })
        })


    })
    function delModal(id){
        $('#hideid').val(id);
        $('#delete-modal').modal("show");
        $('#delete-modal').modal({
            clickClose: false,
            showClose: false
        });

    }
    function medDelete(){

        var id = $('#hideid').val();

        $.post("php/inventoryProcesses/medDelete.php",{
            id:id
        },function(data,status){
            $("[href='#delete-modal']").trigger('click');
            displayMedicines();
            displayToExpTab();
            displayExpTab();
        });


    }



    <!--    Display Function ng MEDS-->
    function displayMedicines(page) {
        var displayData = true;
        $.ajax({
            url: 'php/inventoryProcesses/displayMeds.php',
            type: 'POST',
            data: {
                page: page
            },
            success: function(data, status) {
                $('#displayMedicineDataTable').html(data);
            }
        });
    }
    $(document).on("click",".pagination_link",function (){
        var page = $(this).attr("id");
        displayMedicines(page);
    })
    //Datepicker Validation
    $("#medicineMfgDate").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'1970:new Date()',
        maxDate: new Date()
    }).datepicker("option", "dateFormat", "yy-mm-dd")
    $("#medicineMfgDate").focus(function () {
        $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem").css("border-radius","0.2rem").css("border","none")
        $(".ui-datepicker-year").css("padding","1px").css("border-radius","0.2rem").css("border","none")
        console.log($(this).val())
    })
    $("#medicineExpDate").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'new Date():2100',
        minDate: new Date()
    }).datepicker("option", "dateFormat", "yy-mm-dd")
    $("#medicineExpDate").focus(function () {
        $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem").css("border-radius","0.2rem").css("border","none")
        $(".ui-datepicker-year").css("padding","1px").css("border-radius","0.2rem").css("border","none")
        console.log($(this).val())
    })
    /*    $("#updatemedicineMfgDate").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange:'1970:new Date()',
            maxDate: new Date()
        }).datepicker("option", "dateFormat", "yy-mm-dd")
        $("#updatemedicineMfgDate").focus(function () {
            $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem").css("border-radius","0.2rem").css("border","none")
            $(".ui-datepicker-year").css("padding","1px").css("border-radius","0.2rem").css("border","none")
            console.log($(this).val())
        })
        $("#updatemedicineExpDate").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange:'new Date():2100',
            minDate: new Date()
        }).datepicker("option", "dateFormat", "yy-mm-dd")
        $("#updatemedicineExpDate").focus(function () {
            $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem").css("border-radius","0.2rem").css("border","none")
            $(".ui-datepicker-year").css("padding","1px").css("border-radius","0.2rem").css("border","none")
            console.log($(this).val())
        })*/
    //Display To Expire Table
    function displayToExpTab(displayToExpDatapage){
        var displayToExpData = true;
        $.ajax({
            url:'php/inventoryProcesses/displayToExpTab.php',
            type:'POST',
            data:{
                displayToExpDatapage: displayToExpDatapage
            },
            success:function(data, status){
                $('#toExptab').html(data);
            }
        });
    }
    $(document).on("click",".pagination_linktoexp", function (){
        var displayToExpDatapage = $(this).attr("id");
        displayToExpTab(displayToExpDatapage);
    })
    //Display Expired Table
    function displayExpTab(displayExpTabpage){
        var displayExpTab = true;
        $.ajax({
            url:'php/inventoryProcesses/displayExpTab.php',
            type:'POST',
            data:{
                displayExpTabpage: displayExpTabpage
            },
            success:function(data,status){
                $('#exptab').html(data);
            }
        });
    }
    $(document).on("click",".pagination_linkexp", function (){
        var displayExpTabpage = $(this).attr("id");
        displayExpTab(displayExpTabpage);
    })
    //Add New Medicine Function
    function addNewMedicine() {

        var medName = $('#medicineName').val()
        var medCategory = $('#medcategorySelect').val()
        var medsubCategory = $('#medSubCategory').val()
        var meddosage = $('#medicineDosage').val();
        var medStocks = $('#medicineStocks').val()
        var medMfgDate = $('#medicineMfgDate').val()
        var medExpDate = $('#medicineExpDate').val()

        if(medName == "" || medCategory == "" || medStocks == "" || medMfgDate == "" || medExpDate == ""|| medsubCategory == ""|| meddosage == ""){
            $('#all-incorrect-indcator').css("visibility","visible");
            $('#all-incorrect-indcator').html('Please Fill out all the fields!');
        }

        else {

            $.ajax({
                url: "php/inventoryProcesses/inventoryAddProc.php",
                type: 'POST',
                data: {
                    newMedName: medName,
                    newMedCategory: medCategory,
                    newMedsubCategory:medsubCategory,
                    newMedDosage:meddosage,
                    newMedStocks: medStocks,
                    newMedMfgDate: medMfgDate,
                    newMedExpDate: medExpDate
                },
                success: function (data, status) {
                    console.log(status);
                    $("[href='#add-modal']").trigger('click');
                    displayMedicines();
                    displayToExpTab();
                    displayExpTab();
                }
            });
        }

        $('#addcancel').on("click", function (){
            $('#meds').trigger("focus");
            $('#medicineName').val("");
            $('#medcategorySelect').selectedIndex = 1;
            $('#medicineStocks').val("");
            $('#medicineMfgDate').val("");
            $('#medicineExpDate').val("");
            $('#name-incorrect-indcator').css("visibility","hidden");
            $('#category-incorrect-indcator').css("visibility","hidden");
            $('#stock-incorrect-indcator').css("visibility","hidden");
            $('#mfgdate-incorrect-indcator').css("visibility","hidden");
            $('#expdate-incorrect-indcator').css("visibility","hidden");
            $('#all-incorrect-indcator').css("visibility","hidden");
            $('#all-incorrect-indcator').html('');
            $('#name-incorrect-indcator').html('')
        })
    }
    //Below this are the Update Process

    //Display Update Modal function
    function medDisplayUpdateModal(medupdateid){
        $('#hiddendata').val(medupdateid);
        $.post("php/inventoryProcesses/medUpdate.php",{medupdateid:medupdateid},function(data,status){
            var medid = JSON.parse(data);
            $('#updatemedicineName').val(medid.name);
            $('#updatemedicineCategory').val(medid.category);
            $('#updatemedicineStocks').val(medid.stock);
            $('#updatemedicineMfgDate').val(medid.mfgdate);
            $('#updatemedicineExpDate').val(medid.expdate);
        });
        $('#update-modal').modal("show");
        $("#update-modal").modal({
            //escapeClose: false,
            clickClose: false,
            showClose: false
        })
        $('#addupcancel').on("click", function (){
            $('#meds').trigger("focus");
            $('#updatemedicineName').val("");
            $('#updatemedicineCategory').val("");
            $('#updatemedicineStocks').val("");
            $('#updatemedicineMfgDate').val("");
            $('#updatemedicineExpDate').val("");
        })

    }

    //Update Medicine Stocks function
    function medUpdate(){
        var updatemedicineName=$('#updatemedicineName').val();
        var updatemedicineCategory=$('#updatemedicineCategory').val();
        var updatemedicineStocks=$('#updatemedicineStocks').val();
        var updatemedicineMfgDate=$('#updatemedicineMfgDate').val();
        var updatemedicineExpDate=$('#updatemedicineExpDate').val();
        var id=$('#hiddendata').val();

        $.post("php/inventoryProcesses/medUpdate.php",{
            updatemedicineName:updatemedicineName,
            updatemedicineCategory:updatemedicineCategory,
            updatemedicineStocks:updatemedicineStocks,
            updatemedicineMfgDate:updatemedicineMfgDate,
            updatemedicineExpDate:updatemedicineExpDate,
            id:id
        },function(data,status){
            $("[href='#update-modal']").trigger('click');
            displayMedicines();
            displayToExpTab();
            displayExpTab();

        });
    }



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
</body>
</html>