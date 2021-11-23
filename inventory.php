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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.js"></script>
    <!--Custom Modal Design-->
    <link rel="stylesheet" href="scss/modal.css">
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
<div class="col-sm-12">
<div class="">
   <div class="inventory__container">
       <div class="inventory__table-main-container"  >
           <!--Add Button para sa MEDS-->
           <button type="button" id="addbtn">Add Medicine</button>
           <div>
               <input style="width: 40vw" type="text" id="meds" class="form-control" placeholder="Search Medicines" autocomplete="off">
           </div>
           <!--Display ko dito yung Table of MEDS-->
           <div id="displayMedicineDataTable">
           </div>
       </div>
   </div>
    <div class="inventory__table-toexpire-container"  >
        <div id="toExptab">
        </div>
    </div>
   
    <div class="inventory__table-expired-container" >
        <div id="exptab">
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
                           <p class="modal-p" for="medicineName">Medicine Name:</p><input type="text" id="medicineName" class="modal-field" autocomplete="off" required>
                       </div>
                       <div class="col-sm-12" >
                           <p class="modal-p" for="medicineCategory">Category:</p><input type="text" id="medicineCategory"  class="modal-field" autocomplete="off" required>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-sm-12" >
                           <p class="modal-p"for="medicineStocks">Stock:</p>
                           <input type="text" id="medicineStocks"  class="modal-field" autocomplete="off" required>
                       </div>
                       <div class="col-sm-12" >
                           <p class="modal-p" for="medicineMfgDate" >Mfg. Date:</p>
                           <input type="text" id="medicineMfgDate" contenteditable="false"  class="modal-field" autocomplete="off" required>
                       </div>
                       <div class="col-sm-12" >
                           <p class="modal-p" for="medicineExpDate" >Exp Date:</p>
                           <input type="text" id="medicineExpDate" contenteditable="false"  class="modal-field" autocomplete="off" required>
                       </div>
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
                        <p class="modal-p" for="updatemedicineName">Medicine Name:</p><input type="text" id="updatemedicineName" class="modal-field" readonly required>
                    </div>
                    <div class="col-sm-12" >
                        <p class="modal-p" for="updatemedicineCategory">Category:</p><input type="text" id="updatemedicineCategory"  class="modal-field" readonly required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12" >
                        <p class="modal-p"for="updatemedicineStocks">Stock:</p> <input type="text" id="updatemedicineStocks"  class="modal-field" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12" >
                        <p class="modal-p" for="updatemedicineMfgDate" >Mfg. Date:</p>
                        <input type="text" id="updatemedicineMfgDate" contenteditable="false"  class="modal-field" autocomplete="off" required>
                    </div>
                    <div class="col-sm-12" >
                        <p class="modal-p" for="updatemedicineExpDate" >Exp Date:</p>
                        <input type="text" id="updatemedicineExpDate" contenteditable="false"  class="modal-field" autocomplete="off" required>
                        <input type="hidden" id="hiddendata" >
                    </div>
                </div>
                <div class="row flex-row justify-content-start" style="display: flex">
                    <div class="col-sm-12 flex-box-row justify-content-end align-items-end margin-top-1">
                        <a href="#update-modal" rel="modal:close"><button class="modal-cancel-button" id="addcancel" style="margin-right: 0.5rem">Cancel</button></a>
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
                        <a href="#delete-modal" rel="modal:close"><button class="modal-cancel-button" id="addcancel" style="margin-right: 0.5rem">Cancel</button></a>
                        <a><button id="okay-edit-btn" class="modal-primary-button" onclick="">Delete</button></a>
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
    })
    function delModal(id){
        $('#hideid').val(id);
        $('#delete-modal').modal("show");
            $('#delete-modal').modal({
                clickClose: false,
                showClose: false
            })
    }
    <!--    Display Function ng MEDS-->
    function displayMedicines() {
        var displayData = true;
        $.ajax({
            url: 'php/inventoryProcesses/displayMeds.php',
            type: 'POST',
            data: {
                displayMedData: displayData
            },
            success: function(data, status) {
                $('#displayMedicineDataTable').html(data);
            }
        });
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
    //Display To Expire Table
    function displayToExpTab(){
    var displayToExpData = true;
    $.ajax({
        url:'php/inventoryProcesses/displayToExpTab.php',
        type:'POST',
        data:{
            displayToExpData: displayToExpData
        },
        success:function(data, status){
            $('#toExptab').html(data);
        }
    });
    }
    //Display Expired Table
    function displayExpTab(){
        var displayExpTab = true;
        $.ajax({
            url:'php/inventoryProcesses/displayExpTab.php',
            type:'POST',
            data:{
                displayExpTab: displayExpTab
            },
            success:function(data,status){
                $('#exptab').html(data);
            }
        });
    }
    //Add New Medicine Function
    function addNewMedicine() {
        var medName = $('#medicineName').val()
        var medCategory = $('#medicineCategory').val()
        var medStocks = $('#medicineStocks').val()
        var medMfgDate = $('#medicineMfgDate').val()
        var medExpDate = $('#medicineExpDate').val()
        $.ajax({
            url: "php/inventoryProcesses/inventoryAddProc.php",
            type: 'POST',
            data: {
                newMedName: medName,
                newMedCategory: medCategory,
                newMedStocks: medStocks,
                newMedMfgDate: medMfgDate,
                newMedExpDate: medExpDate
            },
            success: function(data, status) {
                console.log(status);
                $("[href='#add-modal']").trigger('click');
                displayMedicines();
                displayToExpTab();
                displayExpTab();
            }
        });
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
        $('#addcancel').on("click", function (){
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
</body>
</html>