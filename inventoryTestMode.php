<?php
session_start();
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=1){
    //redirect to main page
    header("location:php/loginProcesses/redirect.php");
    exit();
}
$con=null;
require 'php/DB_Connect.php';
$sql = "Select name, SUM(stock) as stock, dosage from `medinventory` Group by name order by dateadded asc";
$res2 = mysqli_query($con,$sql);
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
    <title>Inventory</title>
    <!--Jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery Modal-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.js"></script>
    <!--Custom CSS-->
    <link rel="stylesheet" href="scss/scrollbar_loading.css">
    <!--Custom Modal Design-->
    <link rel="stylesheet" href="scss/modal.css">
    <link rel="stylesheet" href="scss/notif.css">
    <!--Sweet Alert-->
    <script src="sweetalert2-11.1.9/package/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="sweetalert2-11.1.9/package/dist/sweetalert2.min.css">






    <!--Get admin info from session-->

    <script>



        $(document).ready(function () {
            $.post('php/admin_session.php').done(
                function (data) {
                    let result = JSON.parse(data)
                    $("#name-sidebar").html(result.admin_name)
                }
            )
        });

        //==========FOR NOTIFICATION SCRIPT ===========================
        $(document).ready(function () {
            function getNotif() {
                $.post("notif/getNotif_1.php").done(function (data) {
                    let notifMessages = JSON.parse(data);//get notif messages

                    $(".counter").css("visibility","hidden")//hide first the counter
                    $(".notification-dropdown").html("")//reset notification items

                    if(notifMessages.length==0){//pag walang notif stop ang code
                        $(".notification-dropdown").html("<li>No new notification</li>")//reset notification items
                        return
                    }
                    // alert("may laman")
                    for (const notifMessage of notifMessages) {
                        $(".notification-dropdown").append(notifMessage)
                    }

                    //put notification count
                    let notif_count = $(".notification-dropdown li").length;
                    $(".counter").html(notif_count).css("visibility","visible")
                    // alert()
                })
            }//end of function
            getNotif()
            setInterval(()=>{
                getNotif()
            },6000)

        })


    </script>
    <!--Notif Styling--->
    <style>
        .notification-dropdown li{
            padding: 0.4rem;
            text-align: justify-all;
            border-radius: 0.5rem;
            cursor: pointer;
        }
        .notification-dropdown li span{
            color: #2b2b2b;
            font-weight: 600;
        }
        .notification-dropdown li a{
            text-decoration: none;
            all: inherit;
        }
        .notification-dropdown li:hover{
            background: #e5e7ec;
        }
    </style>
    <style>
        .overflow {
            height: 200px;
        }
    </style>


    <!--    Tree Table-->
    <link href="treeTable/treetable/css/jquery.treetable.css" rel="stylesheet" type="text/css" />
    <script src="treeTable/treetable/jquery.treetable.js"></script>

    <!--Ogie-->
    <link href="js/new-pagination/pagination.css" rel="stylesheet" type="text/css">
    <script src="js/new-pagination/pagination.js"></script>

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
                        <li><a href="patient.php" class="patient" >Patient</a></li>
                        <li><a href="reports.php" class="reports" >Reports</a></li>
                        <li><a href="track-map.php" class="trackMap" >Vaccine Graph</a></li>
                        <li><a href="inventory.php" class="inventory" style="background: var(--hover-color)">Inventory</a></li>
                        <?php include 'sidebarFix.html' ?>
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
        <li><a href="patient.php"><i class="fas fa-user"></i></a></li>
        <li><a href="reports.php"><i class="fas fa-chart-bar"></i></a></li>
        <li><a href="track-map.php"><i class="fas fa-map-marker"></i></a></li>
        <li class="active"><a href="inventory.php"><i class="fas fa-box"></i></a></li>
    </ul>
</div>

</div>
                <div class="col-sm-12">
                    <div class="">
                        <div class="inventory__container">
                            <div class="inventory__table-main-container">
                                <div class="row flex-box-row justify-content-lg-around">
                                    <div class="col-lg-6 flex-box-row  justify-content-lg-start margin-top-1">
                                        <!--Add Button para sa MEDS-->
                                        <button class="modal-primary-button-2" type="button" id="addbtn"><i class="fas fa-plus" style="margin-right: 0.3rem"></i>Add Medicine</button>
                                        <!--                                <button class="modal-cancel-button" type="button" id="critbtn"><i class="fa fa-times-circle"  style="margin-right: 0.3rem"></i>Out of Stock Medicines</button>-->
                                        <button id="inventory-logs-btn" class="modal-primary-button" style="background: darkslategray!important;margin-left: 0.3rem"><i class="fas fa-history"></i>View Inventory Logs</button>

                                    </div>
                                    <div class="col-lg-6 flex-box-row justify-content-lg-end margin-top-1">
                                        <div class="search-container search-container-inventory" >
                                            <input style="" type="text" id="meds" class="form-control search-bar" placeholder="Search Medicines" autocomplete="off"> <a href="#"><i class="fas fa-search"></i></a>
                                        </div>
                                    </div>
                                </div>
<!--                                <button id="sam">hehehe</button>-->
                                <!--Ogie Custom table-->
                                <div  class="inventory__table-medicine-container" >

                                    <table>
                                        <tbody>
<!--                                        <tr>-->
<!--                                            <th colspan="3">MEDICINE NAME</th>-->
<!--                                            <th colspan="2">STOCKS</th>-->
<!--                                        <th>MEDICINE ID</th>-->
<!--                                         <th>CATEGORY</th>-->
<!--                                       <th>DATE</th>-->
<!--                                         <th>DATEADDED</th>-->
<!--                                            <th colspan="2">ACTION</th>-->
<!--                                        </tr>-->
                                        </tbody>
                                    </table>
                                    <!--wag tanggalin nasa taas-->

                                    <div id="inv-table">

                                    </div>

                                    <button id="nakatago" style="display: none"></button>
                                </div>

                                <!--Display ko dito yung Table of MEDS-->

                                <div class="inventory__table-toexpire-container"  >
                                <?php
                                include 'inventoryToTable.html'?>
                                <button id="nakatago2" style="display: none"></button>

                                </div>

                                <div class="inventory__table-expired-container" >
                                <?php
                                include 'inventoryToExp.html'?>
                                <button id="nakatago3" style="display: none"></button>

                                </div>
                            </div>
                            <?php
                            include 'inventorylogs.php';
                            ?>


                        </div>
                        <!--Modals-->
                        <!-- Add New Meds Modal -->
                        <div id="add-modal" class="modal" >
                            <div class="flex-box-row justify-content-center align-items-center">
                                <img class="modal-header-icon-wider" src="img/medicine.png"><p class="modal-title-2">Add New Medicine</p>
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
                                            <p class="modal-p" for="medicineName">Name:</p>
                                            <input type="text" class="modal-field" id="medicineName" autocomplete="off" placeholder="Enter Medicine/Vaccine Name" required>
                                            <p class="modal-p" class="error" id="name-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="medicineDosage">Dosage:</p><input type="text" id="medicineDosage" class="modal-field" placeholder="Enter  Dosage" autocomplete="off" required>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p"for="medicineStocks">Stock:</p>
                                            <input type="number" id="medicineStocks"  class="modal-field" placeholder="Enter  Stocks" autocomplete="off" required>
                                            <p class="modal-p" class="error" id="stock-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p"for="medicinecriticalStocks">Critical Stock:</p>
                                            <input type="number" id="medicinecriticalStocks"  class="modal-field" placeholder="Enter Critical Stocks" autocomplete="off" required>
                                            <p class="modal-p" class="error" id="critical-stock-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="medicineMfgDate" >Mfg. Date:</p>
                                            <input type="text" id="medicineMfgDate" contenteditable="false"  class="modal-field" placeholder="Enter Manufacturing Date" autocomplete="off" required>
                                            <p class="modal-p" class="error" id="mfgdate-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p"  for="medicineExpDate" >Exp Date:</p>
                                            <input type="text" id="medicineExpDate" contenteditable="false"  class="modal-field" placeholder="Enter Expiration Date" autocomplete="off" required>
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
                                            <select class="modal-field" id="upmedcategorySelect" >

                                                <option value="Medicine">Medicine</option>
                                                <option value="Vaccine">Vaccine</option>
                                            </select>
                                            <!--<script>
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
                                            </script>-->
                                            <input class="modal-field" type="text" id="upmedSubCategory" autocomplete="off" placeholder="Medicine Sub-Category" >

                                            <input class="modal-field" type="text" id="upvacSubCategory" autocomplete="off" placeholder="Vaccine Sub-Category" style="display: none" >

                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="updatemedicineName">Name:</p><input type="text" id="updatemedicineName" class="modal-field" autocomplete="off" >
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="upmedicineDosage">Dosage:</p><input type="text" id="upmedicineDosage" class="modal-field" placeholder="Enter Dosage" autocomplete="off" >

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" >
                                            <p class="modal-p"for="updatemedicineStocks">Stock:</p> <input type="number" id="updatemedicineStocks"  class="modal-field" autocomplete="off" required>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p"for="updatemedicinecriticalStocks">Critical Stock:</p>
                                            <input type="number" id="updatemedicinecriticalStocks"  class="modal-field" placeholder="Enter Critical Stocks" autocomplete="off" required>
                                            <p class="modal-p" class="error" id="upcritical-stock-incorrect-indcator" style="color: red; visibility: hidden"></p>
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="updatemedicineMfgDate" >Mfg. Date:</p>
                                            <input type="text" id="updatemedicineMfgDate" contenteditable="false"  class="modal-field" autocomplete="off" >
                                        </div>
                                        <div class="col-sm-12" >
                                            <p class="modal-p" for="updatemedicineExpDate" >Exp Date:</p>
                                            <input type="text" id="updatemedicineExpDate" contenteditable="false"  class="modal-field" autocomplete="off" >
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
                                            <a><button id="delete-btn" class="modal-primary-button" onclick="medDelete()">Delete</button></a>
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


        $( "#medNameSelect" )
            .selectmenu()
            .selectmenu( "menuWidget" )
            .addClass( "overflow" );


    });
    //Modals
    $(document).ready(function(){
        displaymed();
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
            $('#medcategorySelect').selectedIndex = 1;
            $('#medicineStocks').val("");
            $('#medicinecriticalStocks').val("");
            $('#medSubCategory').val("");
            $('#vacSubCategory').val("");
            $('#medicineDosage').val("");
            $('#medicineMfgDate').val("");
            $('#medicineExpDate').val("");
            $('#name-incorrect-indcator').css("visibility","hidden");
            $('#category-incorrect-indcator').css("visibility","hidden");
            $('#stock-incorrect-indcator').css("visibility","hidden");
            $('#mfgdate-incorrect-indcator').css("visibility","hidden");
            $('#expdate-incorrect-indcator').css("visibility","hidden");
            $('#all-incorrect-indcator').css("visibility","hidden");
            $('#all-incorrect-indcator').html('');
            $('#name-incorrect-indcator').html('');
            $('#medicinecriticalStocks').attr('disabled','');
            $('#medicinecriticalStocks').val('');
        })
        $('#critbtn').on("click",function(){
            $("#crit-modal").modal({
                clickClose:false,
                showClose:false
            })
        })
        $('#medicineName').on("keyup",function(){
            var medName = $('#medicineName').val();

            $.ajax({
                url: "php/inventoryProcesses/checkCriticalStock.php",
                type:'POST',
                data:{
                    medName:medName
                },
                success:function(data,status){
                    console.log(data);
                    if(data == ''){
                        $('#medicinecriticalStocks').attr('disabled','');
                        $('#medicinecriticalStocks').val('');

                    }
                    else{
                        $('#medicinecriticalStocks').attr('disabled','disabled');
                        $('#medicinecriticalStocks').val(data);
                    }
                }
            })
        });

        $('.updta').click(function(){
            var medupdateid = $(this).data('id');
            $.post("php/inventoryProcesses/medUpdate.php",{medupdateid:medupdateid},function(data,status){
                var medid = JSON.parse(data);
                $('#hiddendata').val(medupdateid);
                $('#updatemedicineName').val(medid.name);
                $('#upmedSubCategory').val(medid.subcategory);
                $('#upmedicineDosage').val(medid.dosage);
                $('#upmedcategorySelect').val(medid.category);
                $('#updatemedicineStocks').val(medid.stock);
                $('#updatemedicinecriticalStocks').val(medid.criticalstock);
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
                $('#upmedSubCategory').val("");
                $('#updatemedicineStocks').val("");
                $('#updatemedicinecriticalStocks').val("");
                $('#updatemedicineStocks').val("");
                $('#updatemedicineMfgDate').val("");
                $('#updatemedicineExpDate').val("");
            })
        });
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
            $('#nakatago').trigger("click");
            $('#nakatago2').trigger("click");
            $('#nakatago3').trigger("click");

            Swal.fire({
                title:'Medicine Deleted Successfully!',
                icon:'success'

            });
            $("#refresh-inv-logs").trigger("click")

        });
    }
    function displaymed(){
        display = true;
        $.ajax({
            url:'php/inventoryP/displayMeds2.php',
            type:'POST',
            data: {data:display},
            success:function(data,status){


            }
        })
    }


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


    //Add New Medicine Function
    function addNewMedicine() {

        var medName = $('#medicineName').val();
        var medCategory = $('#medcategorySelect').val();
        var medsubCategory = $('#medSubCategory').val();
        var medsubCategory2 = $('#vacSubCategory').val();
        var meddosage = $('#medicineDosage').val();
        var medStocks = $('#medicineStocks').val();
        var medcritStocks = $('#medicinecriticalStocks').val();
        var medMfgDate = $('#medicineMfgDate').val();
        var medExpDate = $('#medicineExpDate').val();

        if(medCategory == "Medicine"){
            var medsubCategory = $('#medSubCategory').val()
            if(medName == "" || medSubCategory == "" || medStocks == "" || medcritStocks == ""|| medMfgDate == "" || medExpDate == ""||  meddosage == ""){
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
                        newMedCritStocks:medcritStocks,
                        newMedMfgDate: medMfgDate,
                        newMedExpDate: medExpDate
                    },
                    success: function (data, status) {
                        console.log(status);
                        $("[href='#add-modal']").trigger('click');

                        $('#meds').trigger("focus");
                        $('#medicineName').val("");
                        $('#medcategorySelect').selectedIndex = 1;
                        $('#medicineStocks').val("");
                        $('#medicinecriticalStocks').val("");
                        $('#medSubCategory').val("");
                        $('#vacSubCategory').val("");
                        $('#medicineDosage').val("");
                        $('#medicineMfgDate').val("");
                        $('#medicineExpDate').val("");
                        $('#name-incorrect-indcator').css("visibility","hidden");
                        $('#category-incorrect-indcator').css("visibility","hidden");
                        $('#stock-incorrect-indcator').css("visibility","hidden");
                        $('#mfgdate-incorrect-indcator').css("visibility","hidden");
                        $('#expdate-incorrect-indcator').css("visibility","hidden");
                        $('#all-incorrect-indcator').css("visibility","hidden");
                        $('#all-incorrect-indcator').html('');
                        $('#name-incorrect-indcator').html('');
                        $('#nakatago').trigger("click");
                        $('#nakatago2').trigger("click");
                        $('#nakatago3').trigger("click");
                        Swal.fire({
                            title:'Medicine Added Successfully!',
                            icon:'success'
                        })
                        $("#meds").val("").trigger("keyup")
                        $("#refresh-inv-logs").trigger("click")
                        // $("[data-status='collpase']").trigger("click")
                    }
                });
            }
        }
        else if(medCategory == "Vaccine"){
            var medsubCategory2 = $('#vacSubCategory').val()
            if(medName == "" || vacSubCategory == "" || medStocks == ""  || medcritStocks == ""|| medMfgDate == "" || medExpDate == ""||  meddosage == ""){
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
                        newMedsubCategory:medsubCategory2,
                        newMedDosage:meddosage,
                        newMedStocks: medStocks,
                        newMedCritStocks:medcritStocks,
                        newMedMfgDate: medMfgDate,
                        newMedExpDate: medExpDate
                    },
                    success: function (data, status) {
                        console.log(status);
                        $("[href='#add-modal']").trigger('click');
                        $('#meds').trigger("focus");
                        $('#medicineName').val("");
                        $('#medcategorySelect').selectedIndex = 1;
                        $('#medicineStocks').val("");
                        $('#medicinecriticalStocks').val("");
                        $('#medSubCategory').val("");
                        $('#vacSubCategory').val("");
                        $('#medicineDosage').val("");
                        $('#medicineMfgDate').val("");
                        $('#medicineExpDate').val("");
                        $('#name-incorrect-indcator').css("visibility","hidden");
                        $('#category-incorrect-indcator').css("visibility","hidden");
                        $('#stock-incorrect-indcator').css("visibility","hidden");
                        $('#mfgdate-incorrect-indcator').css("visibility","hidden");
                        $('#expdate-incorrect-indcator').css("visibility","hidden");
                        $('#all-incorrect-indcator').css("visibility","hidden");
                        $('#all-incorrect-indcator').html('');
                        $('#name-incorrect-indcator').html('');
                        $('#nakatago').trigger("click");
                        $('#nakatago2').trigger("click");
                        $('#nakatago3').trigger("click");



                        Swal.fire({
                            title:'Vaccine Added Successfully!',
                            icon:'success'
                        })
                        $("#meds").val("").trigger("keyup")
                        $("#refresh-inv-logs").trigger("click")
                    }
                });
            }
        }





        $('#addcancel').on("click", function (){
            $('#meds').trigger("focus");
            $('#medicineName').val("");
            $('#medcategorySelect').selectedIndex = 1;
            $('#medicineStocks').val("");
            $('#medicinecriticalStocks').val("");
            $('#medSubCategory').val("");
            $('#vacSubCategory').val("");
            $('#medicineDosage').val("");
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

    $("#updatemedicineMfgDate").datepicker({
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
    })
    //Display Update Modal function

    /*function medDisplayUpdateModal(medupdateid){
        $('#hiddendata').val(medupdateid);
        $.post("php/inventoryProcesses/medUpdate.php",{medupdateid:medupdateid},function(data,status){
            var medid = JSON.parse(data);
            $('#updatemedicineName').val(medid.name);
            $('#upmedSubCategory').val(medid.subcategory);
            $('#upmedicineDosage').val(medid.dosage);
            $('#upmedcategorySelect').val(medid.category);
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

    }*/


    //Update Medicine Stocks function
    function medUpdate(){
        var updatemedicineName=$('#updatemedicineName').val();
        var updatemedicineCategory=$('#upmedcategorySelect').val();
        var updatemedicinesubCategory=$('#upmedSubCategory').val();
        var upmedicineDosage=$('#upmedicineDosage').val();
        var updatemedicineStocks=$('#updatemedicineStocks').val();
        var updatemedicineCritStocks=$('#updatemedicinecriticalStocks').val();
        var updatemedicineMfgDate=$('#updatemedicineMfgDate').val();
        var updatemedicineExpDate=$('#updatemedicineExpDate').val();
        var id=$('#hiddendata').val();

        $.post("php/inventoryProcesses/medUpdate.php",{
            updatemedicineName:updatemedicineName,
            updatemedicineCategory:updatemedicineCategory,
            updatemedicinesubCategory:updatemedicinesubCategory,
            upmedicineDosage:upmedicineDosage,
            updatemedicineStocks:updatemedicineStocks,
            updatemedicineCritStocks:updatemedicineCritStocks,
            updatemedicineMfgDate:updatemedicineMfgDate,
            updatemedicineExpDate:updatemedicineExpDate,
            id:id
        },function(data,status){
            $("[href='#update-modal']").trigger('click');
            $('#nakatago').trigger("click");
            $('#nakatago2').trigger("click");
            $('#nakatago3').trigger("click");

            Swal.fire({
                title:'Medicine/Vaccine Updated Successfully!',
                icon:'success'
            })
            $("#meds").val("").trigger("keyup")
            $("#refresh-inv-logs").trigger("click")
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
<script src="js/table-sortable.js"></script>
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
    .gs-table-head tr th span {
        color: white!important;
    }
    #updatebtn{
        background-color: var(--primary-color);
        color: #f8f8f8 !important;
        padding: 0.6rem;
        border-radius: 0.4rem;
        -webkit-transition: all 200ms ease-in-out;
        transition: all 200ms ease-in-out;
    }
    #exclamation{
        color: #ff1515 !important;
        padding: 0.6rem;
        border-radius: 0.4rem;
        font-size: 1.4rem !important;
        cursor: unset !important;
    }
    #medicinecriticalStocks, #medicinecriticalStocks, #updatemedicineStocks{
        -webkit-appearance: none;
        margin: 0;
        -moz-appearance: textfield;
    }

</style>
<script>
    $("#tab").treetable({ expandable: true });



    //dagdag OGIE=================================================
    //<i class="fas fa-caret-right"></i>  <i class="fas fa-caret-down"></i>
    $(window).click(function () {
        $("[title='Collapse']").html('<i class="fas fa-caret-down"></i>')
        $("[title='Expand']").html('<i class="fas fa-caret-right"></i>')
    })

</script>

<?php include "invTestPagination.html"?>
</body>
</html>