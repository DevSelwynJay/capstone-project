<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap Css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>

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
<li><a href="" class="dashboard">Dashboard</a></li>
<li><a href="patient.php" class="patient">Patient</a></li>
<li><a href="reports.php" class="reports">Reports</a></li>
<li><a href="" class="trackMap">Track Map</a></li>
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
<a><i class="fas fa-ellipsis-h"></i></a> 
</div>
</div>
</div>
<div class="col-sm-12">
<div class="">
   <div class="inventory__container">
    <div class="inventory__table-toexpire-container"  >
        <div id="toExptab">

        <!--<table>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expires in 3 days</td>
                    <td class="warning-btn"><i class="fas fa-exclamation"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expires in 5 days</td>
                    <td class="warning-btn"><i class="fas fa-exclamation"></i></td>
                </tr>
            </tbody>
        </table>-->
        </div>
    </div>
   
    <div class="inventory__table-expired-container" >
        <div id="exptab">
        <!--<h1>Expired Medicines</h1>
        <table>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expired</td>
                    <td class="delete-btn"><i class="fas fa-trash"></i></td>
                </tr>
                <tr>
                    <td>01</td>
                    <td>Medicine Name</td>
                    <td class="expired-text">Expired</td>
                    <td class="delete-btn"><i class="fas fa-trash"></i></td>
                </tr>
            </tbody>
        </table>-->
        </div>
    </div>

<!--Modals-->
       <!-- Add New Meds Modal -->
       <div class="modal fade" id="getAddMedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="addNewMedicineLabel">Add New Medicine</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <div class="form-group">
                           <label for="medicineName">Medicine Name</label>
                           <input type="text" class="form-control" id="medicineName"  autocomplete="off" placeholder="Enter Medicine Name" required>
                       </div>
                       <div class="form-group">
                           <label for="medicineCategory">Category</label>
                           <input type="text" class="form-control" id="medicineCategory" autocomplete="off" placeholder="Enter Category" required>
                       </div>
                       <div class="form-group">
                           <label for="medicineStocks">Stocks</label>
                           <input type="text" class="form-control" id="medicineStocks" autocomplete="off" placeholder="Enter Stocks" required>
                       </div>
                       <div class="form-group">
                           <label for="medicineMfgDate">Mfg. Date</label>
                           <input type="date" class="form-control" id="medicineMfgDate" autocomplete="off" placeholder="Enter Manufacturing Date" required>
                       </div>
                       <div class="form-group">
                           <label for="medicineExpDate">Exp. Date</label>
                           <input type="date" class="form-control" id="medicineExpDate" autocomplete="off" placeholder="Enter Expiration Date" required>
                       </div>

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-primary" onclick="addNewMedicine()">Add</button>
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

                   </div>
               </div>
           </div>
       </div>

       <!-- Update Meds Modal -->
       <div class="modal fade" id="getUpdateMedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="UpdateMedicineLabel">Update Medicine Stocks</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <div class="form-group">
                           <label for="updatemedicineName">Medicine Name</label>
                           <input type="text" readonly class="form-control-plaintext"  class="form-control" id="updatemedicineName" autocomplete="off" placeholder="Enter Medicine Name">
                       </div>
                       <div class="form-group">
                           <label for="updatemedicineCategory">Category</label>
                           <input type="text" readonly class="form-control-plaintext" class="form-control" id="updatemedicineCategory" autocomplete="off" placeholder="Enter Category">
                       </div>
                       <div class="form-group">
                           <label for="updatemedicineStocks">Stocks</label>
                           <input type="text" class="form-control" id="updatemedicineStocks" autocomplete="off" placeholder="Enter Stocks" required>
                       </div>
                       <div class="form-group">
                           <label for="updatemedicineMfgDate">Mfg. Date</label>
                           <input type="date" class="form-control" id="updatemedicineMfgDate" autocomplete="off" placeholder="Enter Manufacturing Date" required>
                       </div>
                       <div class="form-group">
                           <label for="updatemedicineExpDate">Exp. Date</label>
                           <input type="date" class="form-control" id="updatemedicineExpDate" autocomplete="off" placeholder="Enter Expiration Date" required>
                       </div>

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-primary" onclick="medUpdate()">Update</button>
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                       <input type="hidden" id="hiddendata">
                   </div>
               </div>
           </div>
       </div>

    <div class="inventory__table-main-container">
            <!--Add Button para sa MEDS-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#getAddMedModal">
                Add Medicine</button>

<!--        Display ko dito yung Table of MEDS-->
        <div id="displayMedicineDataTable"></div>

<!--        <table>-->
<!--            <tbody>-->
<!--                <tr class="title">-->
<!--                    <th>Medicine ID</th>-->
<!--                    <th>Medicine Name</th>-->
<!--                    <th>Category</th>-->
<!--                    <th>No. of Stocks</th>-->
<!--                    <th>Mfg. Date</th>-->
<!--                    <th>Exp. Date</th>-->
<!--                    <th class="add-row"></th>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01</td>-->
<!--                    <td>Medicine Name</td>-->
<!--                    <td>Category</th>-->
<!--                    <td>XXX</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td class="add-btn"><i class="fas fa-plus"></i></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01</td>-->
<!--                    <td>Medicine Name</td>-->
<!--                    <td>Category</th>-->
<!--                    <td>XXX</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td class="add-btn"><i class="fas fa-plus"></i></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01</td>-->
<!--                    <td>Medicine Name</td>-->
<!--                    <td>Category</th>-->
<!--                    <td>XXX</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td class="add-btn"><i class="fas fa-plus"></i></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01</td>-->
<!--                    <td>Medicine Name</td>-->
<!--                    <td>Category</th>-->
<!--                    <td>XXX</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td class="add-btn"><i class="fas fa-plus"></i></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01</td>-->
<!--                    <td>Medicine Name</td>-->
<!--                    <td>Category</th>-->
<!--                    <td>XXX</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td class="add-btn"><i class="fas fa-plus"></i></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>01</td>-->
<!--                    <td>Medicine Name</td>-->
<!--                    <td>Category</th>-->
<!--                    <td>XXX</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td>MM/DD/YYYY</td>-->
<!--                    <td class="add-btn"><i class="fas fa-plus"></i></td>-->
<!--                </tr>-->
<!--            </tbody>-->
<!--        </table>-->

    </div>
   </div>
</div>
</div>
</div>
</div>
</div>
</section>




<script>

    //Display Automatically
    $(document).ready(function(){
        displayMedicines();
        displayToExpTab()
        displayExpTab();

    });
    setInterval(function() {
        displayMedicines();
        displayToExpTab()
        displayExpTab();
    }, 1000);


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
                displayMedicines();
                $('#getAddMedModal').modal('hide');



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




        $('#getUpdateMedModal').modal("show");

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
            $('#getUpdateMedModal').modal('hide');
            displayMedicines();
        });

    }


</script>


</body>
</html>