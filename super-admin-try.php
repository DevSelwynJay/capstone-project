<?php

session_start();
/*
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=0){
    header("location:index.php",true);
    exit();
}
$emm = $_SESSION['email_session_for_sms_otp'];
*/
$emm = 'galvezirish17@gmail.com';

//?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon-sto.png" />
    <!--CSS Grid Bootstrap-->
    <link rel="stylesheet" href="scss/bootstrap-grid.css">
    <!--custom CSS-->
    <link rel="stylesheet" href="scss/main.css">
    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/617ba34092.js" crossorigin="anonymous"></script>
    <!-- Font Family Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <title>Administrator</title>
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!--Super Admin JS-->
    <script src="js/super-ad1.js"></script>
    <!--<script src="js/sa_pagination.js"></script> -->
    <!--Sweet Alert-->
    <script src="sweetalert2-11.1.9/package/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="sweetalert2-11.1.9/package/dist/sweetalert2.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" href="scss/scrollbar_loading.css">
    <!--Custom Modal Design-->
    <link rel="stylesheet" href="scss/modal.css">

</head>
<body>
<section>
    <div class="super-admin">

        <div class="main">
            <div class="inner-page-content">
                <div class="col-sm-12 p-0">
                    <div class="inner-page-nav">
                        <div class="logo">

                            <img src="img/HIS logo blue.png" alt="Logo" class="hide-for-mobile">
                            <img src="img/HIS-logo-white.png" alt="Logo" class="hide-for-desktop">
                        </div>

                        <div class="settings">

                            <a id="dropdown-toggle"><i class="fas fa-ellipsis-h"></i></a>
                            <a id="close-dropdown"><i class="fas fa-times"></i></a>

                            <div style="opacity:0; display:none">
                                <a id="mobile-menu" class="mobile-menu">
                                    <i class="fas fa-bars"></i>
                                </a>
                                <a id="close-mobile-menu"><i class="fas fa-times"></i></a>

                                <div class="menu-mobile " id="menu">
                                    <ul>
                                        <li><a href="dashboard-admin.php"><i class="fas fa-columns"></i>Dashboard</a></li>
                                        <li><a href="patient.php"><i class="fas fa-user"></i>Patient</a></li>
                                        <li><a href="reports.php"><i class="fas fa-chart-bar"></i>Reports</a></li>
                                        <li><a href="track-map.php"><i class="fas fa-map-marker"></i>Track Map</a></li>
                                        <li><a href="inventory.php"><i class="fas fa-box"></i>Inventory</a></li>
                                    </ul>
                                </div>
                            </div>



                            <div class="drop-down-settings" id="dropdown">
                                <ul>
                                    <li><a href="php/sessionDestroy.php">Logout</a></li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-sm-12 super-admin--container">
                    <div id="show" class="modal">
                        <div class="flex-box-row align-items-center justify-content-center">
                            <style>
                                #modal-header-icon{
                                    color: #465A72;
                                    margin-right: 0.3rem;
                                }

                            </style>

                            <h3 class="title" style="color: var(--third-color)"> <i class="fas fa-user-shield fa-lg" id="modal-header-icon"></i>Add Admin Account</h3>
                        </div>

                        <div class="modal-content-scrollable">
                            <form autocomplete="off" style="margin-right: 0.3rem">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" id="fname" placeholder="First Name" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" id="mname"  placeholder="Middle Name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" id="lname"  placeholder="Last Name" />
                                    </div>
                                    <div class="col-sm-6">
                                        <!--    <input type="text" id="gender"  placeholder="Gender" />  -->
                                        <style>#gender,#work-cat {
                                                width: 100%;
                                                margin-top: 1rem;
                                                padding: 0.6rem 1rem;
                                                border: 2px solid var(--third-color);
                                                border-radius: 10px;
                                                outline: none;
                                            }
                                            tr:not(:first-child) { cursor: pointer; }</style>
                                        <select name="type" id="gender" title="Gender">
                                            <option value="" disabled selected>Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" placeholder="Email" id="admin-email"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" id="contact" placeholder="Contact No. (ex. 09...)"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <select name="type" id="work-cat" title="Work Category" >
                                            <option value="" disabled selected>Work Category</option>
                                            <option value="Midwife">Midwife</option>
                                            <option value="Health Worker">Health Worker</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" placeholder="Birthday" id="birthday"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="password" placeholder="Password" id="password"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" id="conf-pass"  placeholder="Confirm Password" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" value="Sto. Rosario Paombong Bulacan" id="modalAddress">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="flex-box-row justify-content-end margin-top-1">
                            <a href="#show" rel="modal:close">
                                <button href="#show" rel="modal:close" class="modal-cancel-button" style="margin-right: 0.3rem">Cancel</button>
                            </a>>
                            <a href="#show" rel="modal:open" id="confirmation-addmin">
                                <button class="modal-primary-button">
                                    <i class="fas fa-plus"></i> Add Admin
                                </button>
                            </a>
                            <!--class="button-square"-->
                        </div>

                    </div>
                    <!-- Modal for disable admin upon click of data -->
                    <div class="col-sm-12">
                        <div id="show-del" class="modal2">
                            <style>#show-del{
                                    display: none;
                                }</style>
                            <form autocomplete="off">
                                <div class="row">
                                    <label for="idno" style="color:#6D6D6DFF">Admin ID:</label>
                                    <input type="text" id="idno" disabled placeholder="Enter Admin ID" />
                                    <label for="adminname" style="color:#6D6D6DFF">Admin:</label>
                                    <input type="text" id="adminname" disabled placeholder="" />
                                </div>
                                <a href="#show-del" rel="modal:open" id="disable-admin2" class="button-square">Deactivate Account</a>
                            </form>
                        </div>
                    </div>
                    <!-- Modal for activation of admin upon click of data -->
                    <div class="col-sm-12">
                        <div id="activemod" class="modal2">
                            <style>#activemod{
                                    display: none;
                                }
                                .swal-wide{
                                    width: fit-content;
                                    justify-content: center;
                                }</style>
                            <form autocomplete="off">
                                <div class="row">
                                    <label for="idno3" style="color:#6D6D6DFF">Admin ID:</label>
                                    <input type="text" id="idno3" disabled placeholder="" />
                                    <label for="adminname3" style="color:#6D6D6DFF">Admin:</label>
                                    <input type="text" id="adminname3" disabled placeholder="" />
                                </div>
                                <a href="#activemod" rel="modal:open" id="reactivate-admin1" class="button-square">Activate Account</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div id="show-del2" class="modal2">
                            <style>#show-del2{
                                    display: none;
                                }</style>
                            <form autocomplete="off">
                                <div class="row">
                                    <label for="idno2" style="color:#6D6D6DFF">Admin ID:</label>
                                    <input type="text" id="idno2" placeholder="Enter Admin ID" />
                                </div>
                                <a href="#show-del2" rel="modal:open" id="disable-admin" class="button-square">Deactivate Account</a>
                            </form>
                        </div>
                    </div>
                    <p id="emmm" hidden class="color-black"><?php echo $emm; ?></p>
                    <h3 class="color-black">Manage Admin Accounts</h3>
                    <div class="row flex-box-row justify-content-lg-end" style="margin-bottom: 1rem">
                        <div class="col-lg-5 col-md-6 flex-box-row justify-content-md-end">
                                <select id='filterSearch'>
                                    <option value="0">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Deactivated</option>
                                </select>

                            <div class="search-container search-container-inventory" >
                                <input style="" type="text" id="search-admin" class="form-control search-bar" placeholder="Search" autocomplete="off"> <a href="#"><i class="fas fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="tableAdmin"  style="max-height: 50vh;overflow-y: auto">
                        <div class="reports__individual-container" >
                            <table class="reports__individual-reports-table">
                                <tbody id="adtablediv">

                                </tbody>
                            </table>
                        </div>
                        <style>
                            #adminTable tr td:nth-child(1), #adminTable th:nth-child(1) {
                                display: none;
                            }
                        </style>
                        <!--<table id="adminTable">
                            <tr>
                                <th>Admin ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Work Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            Query Admin accounts-->
                            <!--<tbody>
                            <?php
                            /*
                            $con=null;
                            include 'php/DB_Connect.php';
                            $adder = 1;
                            $result = mysqli_query($con,"SELECT id, last_name, first_name, middle_name, email, contact_no, role, account_status FROM admin");
                            while ($row=mysqli_fetch_array($result)){
                                $id = $row[0];
                                $name = $row[1].", ".$row[2]." ".$row[3];
                                $email = $row[4];
                                $contact_no = $row[5];
                                $role = $row[6];

                                if($row[7]==1){
                                    $status="Active";
                                    $buttonstat = "Deactivate";
                                    $butID = "butinactive";
                                }elseif ($row[7]==0){
                                    $status="Deactivated";
                                    $buttonstat = "Activate";
                                    $butID = "butactive";
                                }
                                echo "
                             <style>tr:not(:first-child):hover { background-color : rgba(87,191,243,0.82) }
                              #butactive : hover { background-color : rgba(87,102,243,0.82) }
                             </style>
                             <tr>
                               <td class=\"data1\" data-label='Admin ID'>$id</td>
                               <td class='data2' data-label='Name'>$name</td>
                               <td data-label='Email'>$email</td>
                               <td data-label='Contact No.'>$contact_no</td>
                               <td data-label='Work Category'>$role</td>
                               <td data-label='Status'>$status</td>
                               <td data-label='Action'><button class='$butID'>$buttonstat</button></td>
                            </tr>
                             ";
                                //$adder++;
                            }
                            mysqli_close($con); */
                            ?>
                            </tbody>
                        </table>  -->
                    </div>
                    <div class="cta-wrapper2">
                        <a  id="add-admin-modal" href="#show" rel="modal:open" class="square-btn"><i class="fas fa-plus"></i>Add Admin Account</a>
                        <!--Palagyan ng Disable Account na button din dito.  -->
                        <!--                         <a href="#show-del2" rel="modal:open" id="disable-admin1" class="red-square-btn"><i class="fas fa-trash-alt"></i>Disable Account</a>-->
                    </div>
                </div>

                <div class="col-sm-12">
                    <div id="show-delpat" class="modal2">
                        <style>#show-delpat{
                                display: none;
                            }</style>
                        <form autocomplete="off">
                            <div class="row">
                                <label for="patidno" style="color:#6D6D6DFF">Patient ID:</label>
                                <input type="text" id="patidno" disabled placeholder="Enter Patient ID" />
                                <label for="patname" style="color:#6D6D6DFF">Patient:</label>
                                <input type="text" id="patname" disabled placeholder="" />
                            </div>
                            <a href="#show-delpat" rel="modal:open" id="disable-patient2" class="button-square">Deactivate Account</a>
                        </form>
                    </div>
                </div>
                <!-- Ptient Activation Modal -->
                <div class="col-sm-12">
                    <div id="show-actpat" class="modal2">
                        <style>#show-actpat{
                                display: none;
                            }</style>
                        <form autocomplete="off">
                            <div class="row">
                                <label for="patidno3" style="color:#6D6D6DFF">Patient ID:</label>
                                <input type="text" id="patidno3" disabled placeholder="Enter Patient ID" />
                                <label for="patname3" style="color:#6D6D6DFF">Patient:</label>
                                <input type="text" id="patname3" disabled placeholder="" />
                            </div>
                            <a href="#show-actpat" rel="modal:open" id="activate-patient2" class="button-square"><i class="fas fa-plus"></i>Activate Account</a>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div id="show-delpat2" class="modal2">
                        <style>#show-delpat2{
                                display: none;
                            }</style>
                        <form autocomplete="off">
                            <div class="row">
                                <label for="patidno2" style="color:#6D6D6DFF">Patient ID:</label>
                                <input type="text" id="patidno2" placeholder="Enter Patient ID" />
                            </div>
                            <a href="#show-delpat2" rel="modal:open" id="disable-patient" class="button-square">Deactivate Account</a>
                        </form>
                    </div>
                </div>
                <br> <br>

                <div class="col-sm-12 super-admin--container">
                    <h3 class="color-black">Manage Patient Accounts</h3>
                    <div class="row flex-box-row justify-content-lg-end" style="margin-bottom: 1rem">
                        <div class="col-lg-5 col-md-6 flex-box-row justify-content-md-end">
                            <select id='filterpat'>
                                <option value="0">All</option>
                                <option value="1">Active</option>
                                <option value="2">Deactivated</option>
                            </select>
                            <div class="search-container search-container-inventory" >

                                <input style="" type="text" id="search-pat" class="form-control search-bar" placeholder="Search" autocomplete="off"> <a href="#"><i class="fas fa-search"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id ="patTable" style="max-height: 70vh;overflow-y: auto">
                        <div class="reports__individual-container" >
                            <table class="reports__individual-reports-table">
                                <tbody id="pattablediv">

                                </tbody>
                            </table>
                        </div>
                        <style>
                            #patientTable tr td:nth-child(1){
                                display: none;
                            }
                            #patientTable tr td:nth-child(2){
                                display: none;
                            }
                        </style>
                        <!--                  <table id="patientTable">
                        <tr>
                           <th>User/Patient ID</th>
                           <th>First Name</th>
                           <th>Middle Name</th>
                           <th>Last Name</th>
                           <th>Email</th>
                        </tr>
                         <tbody>
                            <?php
                        /*$con=null;
                        include 'php/DB_Connect.php';
                        $count = 0;
                        $result = mysqli_query($con,"SELECT id, first_name, middle_name, last_name, email FROM patient");
                        while ($row=mysqli_fetch_array($result)){
                            $ids = $row[0];
                            $fnames = $row[1];
                            $mnames = $row[2];
                            $lnames = $row[3];
                            $ems = $row[4];
                            echo "
                         <style>tr:not(:first-child):hover { background-color : rgba(87,191,243,0.82) }</style>
                         <tr>
                           <td>$ids</td>
                           <td>$fnames</td>
                           <td>$mnames</td>
                           <td>$lnames</td>
                           <td>$ems</td>
                        </tr>
                         ";
                            $count++;
                            if ($count<5){
                                break;
                            }
                        }
                        mysqli_close($con); */
                        ?>
                         </tbody>
                     </table> -->
                    </div>
                    <div class="cta-wrapper2">
                        <!--Patanggal nung show more kasi scrollable naman na  -->
                        <a href="#blank"/>
                        <!--                         <a href="#show-delpat2" rel="modal:open"  id="disable-patient1" class="red-square-btn"><i class="fas fa-trash-alt"></i>Disable Account</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<button id="reload-patient" class="modal-primary-button" type="button" style="display: none">test dyanmic</button>
<button id="reload-admin" class="modal-primary-button" type="button" style="display: none">test dyanmic2</button>
<script>
$("#reload-patient").click(function () {
    $('#filterpat').val("0");
    displayPtnts();
})
$("#reload-admin").click(function () {
    $('#filterSearch').val("0");
    displayAdmin();
})
</script>

<script>
    // *TABLE FOR ADMIN UPDATE
    function displayAdmin(){//? admin
        //calls the json data to display admin users
        $.ajax({
            url: 'php/superAdminProcesses/loadtablepat.php',
            type: 'POST',
            data:{

            },
            success: function (data, status){
                //console.log(JSON.parse(data)+"pwd");
                displayreportadmin(data);
            }
        })
    }
    function displayreportadmin(data){
        var record = data;
        let result = JSON.parse(record);
        window.rowCount_admins = JSON.parse(record).length;
        var tableadmin = $('#adtablediv').tableSortable({
            data: result,
            searchField: '#search-admin',
            responsive: {
                1750: {
                    columns: {
                        adname:"Name",
                        ademail:"Email",
                        adcontact:"Contact No.",
                        adworkcat:"Work Category",
                        adstatus:"Status",
                        adaction:"Action",
                    },
                },
            },
            //searchField: '#meds',
            // responsive: {
            //     720: {
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     },
            //     512:{
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     }
            // },
            rowsPerPage: 5,
            pagination: true,
            sorting:false,
            tableWillMount: function() {
                console.log('table will mount')
            },
            tableDidMount: function() {
                console.log('table did mount')
                for (a=0;a<parseInt(window.rowCount_admins);a++){
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[0]).attr("data-label","Name")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[1]).attr("data-label","Email")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Contact No")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Work Category")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Status")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Action")
                }
            },
            tableWillUpdate: function() {
                console.log('table will update')

            },
            tableDidUpdate: function() {
                    // console.log('table did update');  click_view_button();
                    //$("#medicine-table div .gs-table thead tr th").css("background","darkslategrey")
                    for (a=0;a<parseInt( window.rowCount_admins);a++){
                        $($($("#adtablediv div .gs-table-body").children()[a]).children()[0]).css("font-weight","500")
                    }
                    for (a=0;a<parseInt(window.rowCount_admins);a++){
                        $($($("#adtablediv .gs-table-body").children()[a]).children()[0]).attr("data-label","Name")
                        $($($("#adtablediv .gs-table-body").children()[a]).children()[1]).attr("data-label","Email")
                        $($($("#adtablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Contact No")
                        $($($("#adtablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Work Category")
                        $($($("#adtablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Status")
                        $($($("#adtablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Action")
                    }


                //thead color
                //$("#medicine-table div .gs-table thead tr th").css("background","darkslategrey")
                $(".gs-table-head tr th span").css("color","white!important");
            },
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });
        if(JSON.parse(record).length==0){
            $("#adtablediv div .gs-table tbody").html("").append("<tr style='pointer-events: none'><td colspan='6'><h3 style='text-align: center;width: 100%;color: var(--third-color)'>No Records</h3></td></tr>")

            return
        }
        $('#changeRows').on('change', function() {
            tableadmin.updateRowsPerPage(parseInt($(this).val(), 10));
        })

        $('#rerender').click(function() {
            tableadmin.refresh(true);
        })

        $('#distory').click(function() {
            tableadmin.distroy();
        })

        $('#refresh').click(function() {
            tableadmin.refresh();
        })

        $('#setPage2').click(function() {
            tableadmin.setPage(1);
        })
        //thead color
        //$("#medicine-table div .gs-table thead tr th").css("background","darkslategrey")
        $(".gs-table-head tr th span").css("color","white!important");

        function resetadmin(){
            $.get('php/superAdminProcesses/loadtablepat.php', function(data) {
                d = data;
                // Push data into existing data
                console.log(JSON.parse(data))
                //table.setData(JSON.parse(data), null, true);
                window.rowCount_admins = JSON.parse(data).length;
                // or Set new data on table, columns is optional.

                tableadmin.setData(JSON.parse(data), {
                    adname: "Name",
                    ademail: "Email",
                    adcontact: "Contact No.",
                    adworkcat: "Work Category",
                    adstatus: "Status",
                    adaction: "Action",
                });
            })

        }

        $("#filterSearch").change(function () {
            let filterVal = $("#filterSearch").val();
            console.log("dumaan sa filter");
            console.log(filterVal);
            if (filterVal == "0") {
                resetadmin();
            } else if (filterVal == "1") {
                $.post("php/superAdminProcesses/filter.php", {filstat: filterVal}).done(function (data) {
                    d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tableadmin.setData(JSON.parse(data), {
                        adname: "Name",
                        ademail: "Email",
                        adcontact: "Contact No.",
                        adworkcat: "Work Category",
                        adstatus: "Status",
                        adaction: "Action",
                    });
                })
            } else if (filterVal == "2") {
                $.post("php/superAdminProcesses/filter.php", {filstat: filterVal}).done(function (data) {
                    d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tableadmin.setData(JSON.parse(data), {
                        adname: "Name",
                        ademail: "Email",
                        adcontact: "Contact No.",
                        adworkcat: "Work Category",
                        adstatus: "Status",
                        adaction: "Action",
                    });
                })
            }
        })
    }

    // *TABLE FOR PATIENT UPDATE
    function displayPtnts(){//? patient table updater
        //alert("natawag display patients")
        $.ajax({
            url: 'php/superAdminProcesses/ptientload.php',
            type: 'POST',
            data:{

            },
            success: function (data, status){
                //console.log(JSON.parse(data)+"pwd");
                displayreport(data);
            }
        })
    }
    function displayreport(data){
        var record = data;
        let result = JSON.parse(record);
        window.rowCount_patients = JSON.parse(record).length;
        var tablepat = $('#pattablediv').tableSortable({
            data: result,
            searchField: '#search-pat',
            responsive: {
                1750: {
                    columns: {
                        name:"Name",
                        email:"Email",
                        status:"Status",
                        action:"Action",
                    },
                },
            },
            //searchField: '#meds',
            // responsive: {
            //     720: {
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     },
            //     512:{
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     }
            // },
            rowsPerPage: 5,
            pagination: true,
            sorting:false,
            tableWillMount: function() {
                console.log('table will mount')
            },
            tableDidMount: function() {
                console.log('table did mount')
                for (a=0;a<parseInt(window.rowCount_patients);a++){
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[0]).attr("data-label","Name")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[1]).attr("data-label","Email")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Status")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Action")

                }
            },
            tableWillUpdate: function() {
                console.log('table will update')

            },
            tableDidUpdate: function() {

                // console.log('table did update');  click_view_button();
                //$("#medicine-table div .gs-table thead tr th").css("background","darkslategrey")
                for (a=0;a<parseInt( window.rowCount_patients);a++){
                    $($($("#pattablediv div .gs-table-body").children()[a]).children()[0]).css("font-weight","500")
                }
                for (a=0;a<parseInt(window.rowCount_patients);a++){
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[0]).attr("data-label","Name")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[1]).attr("data-label","Email")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Status")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Action")

                }
                //thead color
                //$("#medicine-table div .gs-table thead tr th").css("background","darkslategrey")
                $(".gs-table-head tr th span").css("color","white!important");
            },
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });
        if(JSON.parse(record).length==0){
            $("#pattablediv div .gs-table tbody").html("").append("<tr style='pointer-events: none'><td colspan='4'><h3 style='text-align: center;width: 100%;color: var(--third-color)'>No Records</h3></td></tr>")

            return
        }
        $('#changeRows').on('change', function() {
            tablepat.updateRowsPerPage(parseInt($(this).val(), 10));
        })

        $('#rerender').click(function() {
            tablepat.refresh(true);
        })

        $('#distory').click(function() {
            tablepat.distroy();
        })

        $('#refresh').click(function() {
            tablepat.refresh();
        })

        $('#setPage2').click(function() {
            tablepat.setPage(1);
        })
        //thead color
        //$("#medicine-table div .gs-table thead tr th").css("background","darkslategrey")
        $(".gs-table-head tr th span").css("color","white!important");

        function resetpatient(){
            $.get('php/superAdminProcesses/ptientload.php', function(data) {
                d = data;
                // Push data into existing data
                console.log(JSON.parse(data))
                //table.setData(JSON.parse(data), null, true);
                window.rowCount_admins = JSON.parse(data).length;
                // or Set new data on table, columns is optional.

                tablepat.setData(JSON.parse(data),{
                    name:"Name",
                    email:"Email",
                    status:"Status",
                    action:"Action",
                });
            })

        }

        $("#filterpat").change(function () {
            let filterVal = $("#filterpat").val();
            console.log("dumaan sa filter");
            console.log(filterVal);
            if(filterVal =="0"){
                resetpatient();
            }else if (filterVal == "1"){
                $.post("php/superAdminProcesses/tableLoad.php",{filstat:filterVal}).done(function (data) {
                    d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tablepat.setData(JSON.parse(data),{
                        name:"Name",
                        email:"Email",
                        status:"Status",
                        action:"Action",
                    });
                })
            }else if (filterVal == "2"){
                $.post("php/superAdminProcesses/tableLoad.php",{filstat:filterVal}).done(function (data) {
                    d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tablepat.setData(JSON.parse(data),{
                        name:"Name",
                        email:"Email",
                        status:"Status",
                        action:"Action",
                    });
                })
            }
        })
    }
    //displayPtnts();
    // !End of patient update


</script>
<script>
    //// *Initial caller of admin table display
    jQuery(document).ready(function() {
        // *ADMIN DATA Table
        var tableadmin = $('#adtablediv').tableSortable({
            data: [],
            columns: {
                adname:"Name",
                ademail:"Email",
                adcontact:"Contact No.",
                adworkcat:"Work Category",
                adstatus:"Status",
                adaction:"Action",
            },
            searchField: '#search-admin',


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
                //resetTable();
                for (a=0;a<parseInt(window.rowCount_admins);a++){
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[0]).attr("data-label","Name")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[1]).attr("data-label","Email")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Contact No")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Work Category")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Status")
                    $($($("#adtablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Action")

                }
            },
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });
        // ?get function that gets json data for admin table
        $.get('php/superAdminProcesses/loadtablepat.php', function(data) {
            var d = data;
            // Push data into existing data
            console.log(JSON.parse(data))
            //table.setData(JSON.parse(data), null, true);
            window.rowCount_admins = JSON.parse(data).length;
            // or Set new data on table, columns is optional.
            if($(document).width()<=720){
                tableadmin.setData(JSON.parse(data),{
                    adname:"Name",
                    ademail:"Email",
                    adcontact:"Contact No.",
                    adworkcat:"Work Category",
                    adstatus:"Status",
                    adaction:"Action",
                });
            }
            else{
                tableadmin.setData(JSON.parse(data),{
                    adname:"Name",
                    ademail:"Email",
                    adcontact:"Contact No.",
                    adworkcat:"Work Category",
                    adstatus:"Status",
                    adaction:"Action",
                });
            }
            // alert(window.rowCount)
            // for (a=0;a<parseInt(window.rowCount);a++){
            //     $($($(".gs-table-body").children()[a]).children()[0]).attr("data-label","ID")
            // }
            // alert($($($(".gs-table-body").children()[0]).children()[0]).attr("data-label","ID"))
        })//end of get/post method

        $('#changeRows').on('change', function() {
            tableadmin.updateRowsPerPage(parseInt($(this).val(), 10));
        })

        $('#rerender').click(function() {
            tableadmin.refresh(true);
        })

        $('#distory').click(function() {
            tableadmin.distroy();
        })

        $('#refresh').click(function() {
            tableadmin.refresh();
        })

        $('#setPage2').click(function() {
            tableadmin.setPage(1);
        })

        function resetadmin(){
            $.get('php/superAdminProcesses/loadtablepat.php', function(data) {
                d = data;
                // Push data into existing data
                console.log(JSON.parse(data))
                //table.setData(JSON.parse(data), null, true);
                window.rowCount_admins = JSON.parse(data).length;
                // or Set new data on table, columns is optional.

                tableadmin.setData(JSON.parse(data), {
                    adname: "Name",
                    ademail: "Email",
                    adcontact: "Contact No.",
                    adworkcat: "Work Category",
                    adstatus: "Status",
                    adaction: "Action",
                });
            })

        }

        $("#filterSearch").change(function () {
            let filterVal = $("#filterSearch").val();
            console.log("dumaan sa filter");
            console.log(filterVal);
            if(filterVal =="0"){
                resetadmin();
            }else if (filterVal == "1"){
                $.post("php/superAdminProcesses/filter.php",{filstat:filterVal}).done(function (data) {
                    var d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tableadmin.setData(JSON.parse(data), {
                        adname: "Name",
                        ademail: "Email",
                        adcontact: "Contact No.",
                        adworkcat: "Work Category",
                        adstatus: "Status",
                        adaction: "Action",
                    });
                })
            }else if (filterVal == "2"){
                $.post("php/superAdminProcesses/filter.php",{filstat:filterVal}).done(function (data) {
                    var d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tableadmin.setData(JSON.parse(data), {
                        adname: "Name",
                        ademail: "Email",
                        adcontact: "Contact No.",
                        adworkcat: "Work Category",
                        adstatus: "Status",
                        adaction: "Action",
                    });
                })
            }
        })



    });//end of document ready

    //// *Initial caller of patient table display
    jQuery(document).ready(function() {
        // *PATIENT DATA Table
        var tablepat = $('#pattablediv').tableSortable({
            data: [],
            columns: {
                name:"Name",
                email:"Email",
                status:"Status",
                action:"Action",
            },
            searchField: '#search-pat',


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
                //resetTable();
                for (a=0;a<parseInt(window.rowCount_patients);a++){
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[0]).attr("data-label","Name")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[1]).attr("data-label","Email")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[2]).attr("data-label","Status")
                    $($($("#pattablediv .gs-table-body").children()[a]).children()[3]).attr("data-label","Action")

                }
            },
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });
        $.get('php/superAdminProcesses/ptientload.php', function(data) {
            var d = data;
            // Push data into existing data
            console.log(JSON.parse(data))
            //table.setData(JSON.parse(data), null, true);
            window.rowCount_patients = JSON.parse(data).length;
            // or Set new data on table, columns is optional.
            if($(document).width()<=720){
                tablepat.setData(JSON.parse(data),{
                    name:"Name",
                    email:"Email",
                    status:"Status",
                    action:"Action",
                });
            }
            else{
                tablepat.setData(JSON.parse(data),{
                    name:"Name",
                    email:"Email",
                    status:"Status",
                    action:"Action",
                });
            }
            // alert(window.rowCount)
            // for (a=0;a<parseInt(window.rowCount);a++){
            //     $($($(".gs-table-body").children()[a]).children()[0]).attr("data-label","ID")
            // }
            // alert($($($(".gs-table-body").children()[0]).children()[0]).attr("data-label","ID"))
        })//end of get/post method

        $('#changeRows').on('change', function() {
            tablepat.updateRowsPerPage(parseInt($(this).val(), 10));
        })

        $('#rerender').click(function() {
            tablepat.refresh(true);
        })

        $('#distory').click(function() {
            tablepat.distroy();
        })

        $('#refresh').click(function() {
            tablepat.refresh();
        })

        $('#setPage2').click(function() {
            tablepat.setPage(1);
        })
        function resetpatient(){
            $.get('php/superAdminProcesses/ptientload.php', function(data) {
                d = data;
                // Push data into existing data
                console.log(JSON.parse(data))
                //table.setData(JSON.parse(data), null, true);
                window.rowCount_admins = JSON.parse(data).length;
                // or Set new data on table, columns is optional.

                tablepat.setData(JSON.parse(data),{
                    name:"Name",
                    email:"Email",
                    status:"Status",
                    action:"Action",
                });
            })

        }

        $("#filterpat").change(function () {
            let filterVal = $("#filterpat").val();
            console.log("dumaan sa filter");
            console.log(filterVal);
            if(filterVal =="0"){
                resetpatient();
            }else if (filterVal == "1"){
                $.post("php/superAdminProcesses/tableLoad.php",{filstat:filterVal}).done(function (data) {
                    d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tablepat.setData(JSON.parse(data),{
                        name:"Name",
                        email:"Email",
                        status:"Status",
                        action:"Action",
                    });
                })
            }else if (filterVal == "2"){
                $.post("php/superAdminProcesses/tableLoad.php",{filstat:filterVal}).done(function (data) {
                    d = data;
                    // Push data into existing data
                    console.log(JSON.parse(data))
                    //table.setData(JSON.parse(data), null, true);
                    window.rowCount_admins = JSON.parse(data).length;
                    // or Set new data on table, columns is optional.

                    tablepat.setData(JSON.parse(data),{
                        name:"Name",
                        email:"Email",
                        status:"Status",
                        action:"Action",
                    });
                })
            }
        })

    });//end of document ready



</script>
<script>


    //additional script for autocomplete form problem
    //$('#show-del').modal.open();
    $("#add-admin-modal").on("click",function (){

        setTimeout(function (){
            $("#email").val("")
            $("#password").val("")
        },500)


    })
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

    address_autocomlete();
    function address_autocomlete() {
        //$("#address-edit-2").autocomplete({
        //  source:['Sto. Rosario Paombong Bulacan',"Paombong","Bulacan"]
        //})
        function split( val ) {
            return val.split( / \s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }

        $( "#modalAddress" )
            // don't navigate away from the field on tab when selecting an item
            .on( "keydown", function( event ) {
                if ( event.keyCode === $.ui.keyCode.TAB &&
                    $( this ).autocomplete( "instance" ).menu.active ) {
                    event.preventDefault();
                }
            })
            .autocomplete({
                minLength: 0,
                source: function( request, response ) {
                    // delegate back to autocomplete, but extract the last term
                    response( $.ui.autocomplete.filter(
                        ['Sto. Rosario Paombong Bulacan',"Paombong","Bulacan","Purok","Malolos"], extractLast( request.term ) ) );
                },
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                select: function( event, ui ) {
                    var terms = split( this.value );
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( " " );
                    return false;
                }
            });
    }//
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
    // !past patientTable
    /*
    $(document).ready(function() {
        displayUsers();
    })



    function displayUsers(page) {
        var displayData = true;
        $.ajax({
            url: 'php/superAdminProcesses/tableLoad.php',
            type: 'POST',
            data: {
                page: page
            },
            success: function(data, status) {
                $('#patientTable').html(data);
            }
        });
    }
    $(document).on("click",".pagination_link",function (){
        var page = $(this).attr("id");
        displayUsers(page);
    })
*/

/*
    //// *ADMIN BUTTON CLICK
    // *click button activate to get admin ID and name
    $(".butactive").click(function() {
        console.log("dumaan sa active");
        var $row = $(this).closest("tr");    // Find the row
        var $text1 = $row.find(".data1").text(); // Find the text
        var $text2 = $row.find(".data2").text(); // Find the text
        document.getElementById("idno3").value = $text1;
        document.getElementById("adminname3").value = $text2;
        $('#activemod').modal();
    })
    // *click button deactivate to get admin ID and name
    $(".butinactive").click(function() {
        console.log("dumaan sa active");
        var $row = $(this).closest("tr");    // Find the row
        var $text1 = $row.find(".data1").text(); // Find the text
        var $text2 = $row.find(".data2").text(); // Find the text
        document.getElementById("idno").value = $text1;
        document.getElementById("adminname").value = $text2;
        $('#show-del').modal();
    })
*/

    // *click button to get patient ID and name
    function adclick(adminids,adminname, statuses){
        if(statuses=="Deactivated"){// ?if status is deactivate, activate modal will show
            document.getElementById("idno3").value = adminids;
            document.getElementById("adminname3").value = adminname;
            $('#activemod').modal();
        }else if (statuses=="Active"){// ?if status is active, deactivate modal will show
            document.getElementById("idno").value = adminids;
            document.getElementById("adminname").value = adminname;
            $('#show-del').modal();
        }
    }

    // *click button to get patient ID and name
    function patclick(patids,patname, statuses){
        if(statuses=="Active"){// ?if status is active, disable modal will show
            document.getElementById("patidno").value = patids;
            document.getElementById("patname").value = patname;
            $('#show-delpat').modal();
        }else if (statuses=="Deactivated"){// ?if status is inactive, activate modal will show
            document.getElementById("patidno3").value = patids;
            document.getElementById("patname3").value = patname;
            $('#show-actpat').modal();
        }
    }


</script>

<style>
    .swal2-input{
        max-width: 50%;
        margin: 0 auto;
    }
    td button{
        padding: 0.5em;
        border:none;
        outline: none;
        background: var(--primary-color);
        color: var(--secondary-color);
    }
    tr:nth-child(odd){
        background: var(--light-grey)!important;
    }
    tr:nth-child(even){
        background: white!important;
    }
    tr:nth-child(odd):hover,tr:nth-child(even):hover{
        background: var(--light-grey)!important;
    }

</style>
<script src="js/table-sortable.js"></script>
<style>
    /*.active{
        background: var(--primary-color)!important;
        color: var(--secondary-color)!important;
        border:none!important;
        padding: 0.5em 0.5rem!important;
    }*/
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
</style>
</body>
</html>