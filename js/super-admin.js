//wala pa way para mawala laman ni fields upon closing
/*$(document).ready(function(){
    $("#show").on("hidden.bs.modal", function(){
        $(this).removeData();
    });

})*/
//
$(document).ready(function (){
    $("#confirmation-addmin").click(function (){
        console.log("clicked");
        checkEmpty();
    })
})
//click table to get admin ID and name
$(document).ready(function (){
    var table = document.getElementById('adminTable');
    for(var i = 1; i < table.rows.length; i++)
    {
        $(table.rows[i]).on("click",function (){
            document.getElementById("idno").value = this.cells[0].innerHTML;
            document.getElementById("adminname").value = this.cells[1].innerHTML;
            $('#show-del').modal();
        })
    }
})

//click table to get patient ID and name
$(document).ready(function (){
    var pattable = document.getElementById('patientTable');
    for(var i = 1; i < pattable.rows.length; i++)
    {
        $(pattable.rows[i]).on("click",function (){
            document.getElementById("patidno").value = this.cells[0].innerHTML;
            document.getElementById("patname").value = this.cells[1].innerHTML;
            $('#show-delpat').modal();
        })
    }
})
//trigger if disable admin modal button is clicked
$(document).ready(function (){
    $("#disable-admin2").click(function (){
        var adminIds = $('#idno').val();
        var adminname = $('#adminname').val();
        adminDisableCheck(adminIds,adminname);
    })
})
//By button disable ADMIN
$(document).ready(function (){
    $("#disable-admin").click(function (){
        var adminIds = $('#idno2').val();
        adminDisableCheck2(adminIds);
    })
})

//trigger if disable PATIENT modal button is clicked
$(document).ready(function (){
    $("#disable-patient2").click(function (){
        var patientIds = $('#patidno').val();
        var patname = $('#patname').val();
        patientDisableCheck(patientIds,patname);
    })
})
//By button disable PATIENT
$(document).ready(function (){
    $("#disable-patient").click(function (){
        var patientIds = $('#patidno2').val();
        patientDisableCheck2(patientIds);
    })
})

//check if the fields are empty
function checkEmpty(){
    console.log("dumaan sa empty");
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var mname = $('#mname').val();
    var password = $('#password').val();
    var ademail = $('#admin-email').val();
    var gender = $('#gender').val();
    var confirmpass = $('#conf-pass').val();
    var contactno = $('#contact').val();
    var workcat = $('#work-cat').val();

    if(fname == "" || lname == "" || mname == "" || password == "" || ademail == "" || gender == "" || confirmpass == "" || contactno == "" || workcat == ""){
        //shows alerts
        let timerInterval
        Swal.fire({
            title: 'Please fill out all the fields!!!',
            //html: 'I will close in <b></b> milliseconds.',
            timer: 2500,
            timerProgressBar: true,
            didOpen: () => {
                //Swal.showLoading()
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
        })
    }else{
        checkEmailValidation(ademail,password,confirmpass);
    }
}
//check kung may email talaga na nag eexist
function checkEmailValidation(email,password,confirmpass){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState==4 && xhr.status==200){
            if(xhr.responseText==1){
                //nag eexist ung email
                if(password != confirmpass){
                    let timerInterval
                    Swal.fire({
                        title: 'Password does not match!!!',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                    $('#password').val("");
                    $('#conf-pass').val("");
                }else{
                    addAdmin();
                }

            } else{
                    let timerInterval
                    Swal.fire({
                        title: 'Email is non-existent!',
                        timer: 2500,
                        timerProgressBar: true,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                        }
                    })
                $('#admin-email').val("");
                $('#password').val("");
                $('#conf-pass').val("");
            }
        }
    }
    xhr.open("POST","php/superAdminProcesses/validateEmail.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    xhr.send("email="+email);
}

// Adds the admin account as well as filtering datas
function addAdmin(){
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var mname = $('#mname').val();
    var password = $('#password').val();
    var ademail = $('#admin-email').val();
    var gender = $('#gender').val();
    var confirmpass = $('#conf-pass').val();
    var contactno = $('#contact').val();
    var workcat = $('#work-cat').val();

    $.post("php/superAdminProcesses/addingProcess.php", {email:ademail,password:password,confirmpass:confirmpass,lname:lname,fname:fname,mname:mname,gender:gender,workcat:workcat,contactno:contactno})
        .done(function (data){

            if(data==1){//walang pang data sa admin db

                let timerInterval
                Swal.fire({
                    title: 'Admin is added successfully...',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                        appendTableAdmin();
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        appendTableAdmin();
                    }
                })
                //Clear all of the fields upon closing
                $('#admin-email').val("");
                $('#password').val("");
                $('#conf-pass').val("");
                $('#lname').val("");
                $('#mname').val("");
                $('#fname').val("");
                $('#contact').val("");
                $('#work-cat').val("");
                $('#gender').val("");

                $.modal.close();
            }
            else {//may data na sa admin db
                let timerInterval
                Swal.fire({
                    title: 'Email is already in the database!',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                //$('#admin-email').set;
                $('#admin-email').val("");
                $('#password').val("");
                $('#conf-pass').val("");
            }
        })
}
//Appends the new added admin to the row
function appendTableAdmin() {
    //$.post("php/superAdminProcesses/tableLoad.php")
       // .done(function (data){
                //var result = data.toString();
                //console.log(result);
            location.reload();
            //$("#adminTable>tbody").append(result).preventDefault();
            //$(result).appendTo( "#adminTable>tbody" );
       // })
}

//DISABLE ADMIN
//Ask for confirmation and calls the php function to check if ID exist and calls the function to disable
function adminDisableCheck(adminIds,adminname){
    $.post("php/superAdminProcesses/checkAdminId.php", {adminId:adminIds})
        .done(function (data){
            if(data == 1){

                Swal.fire({
                    title: 'Are you sure you want to archive this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        disableAdmin(adminIds,adminname);
                        let timerInterval
                        Swal.fire({
                            title: adminname+' Archived!',
                            timer: 2500,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                                appendTableAdmin();
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                                appendTableAdmin();
                            }
                        })

                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')
                        $.modal.close();
                    }
                })

            }else{
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'User ID is already in the database!',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                $.modal.close();
            }

        })
}
//Disable Admin and transfer the disabled to new DB
function disableAdmin(adminIds){
    $.post("php/superAdminProcesses/disableAdminProcess.php", {adminId:adminIds})
        .done(function (data){
            if(data == 1){

            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}

//// DISABLE ADMIN BY BUTTON
function adminDisableCheck2(adminIds){
    $.post("php/superAdminProcesses/checkAdminId.php", {adminId:adminIds})
        .done(function (data){
            if(data == 1){

                Swal.fire({
                    title: 'Are you sure you want to archive this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        disableAdmin2(adminIds);
                        $.post("php/superAdminProcesses/adminNameCaller.php", {adminId:adminIds})
                            .done(function (data){
                                var session = sessionStorage.getItem("adminCall");
                                let timerInterval
                                Swal.fire({
                                    title: ' Archived Successful!',
                                    timer: 2500,
                                    timerProgressBar: true,
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                        appendTableAdmin();
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        console.log('I was closed by the timer')
                                        appendTableAdmin();
                                    }
                                })
                            })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')
                        $.modal.close();
                    }
                })
            }else{
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'User ID is already in the database!',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                $.modal.close();
            }

        })
}
//Disable Admin and transfer the disabled to new DB
function disableAdmin2(adminIds){
    $.post("php/superAdminProcesses/disableAdminProcess.php", {adminId:adminIds})
        .done(function (data){
            if(data == 1){

            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}

//PATIENT DISABLE
function patientDisableCheck(patientIds,patname){
    $.post("php/superAdminProcesses/checkPatientId.php", {patId:patientIds})
        .done(function (data){
            if(data == 1){

                Swal.fire({
                    title: 'Are you sure you want to archive this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        disablePatient(patientIds);
                        let timerInterval
                        Swal.fire({
                            title: patname+' Archived!',
                            timer: 2500,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                                appendTableAdmin();
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                                appendTableAdmin();
                            }
                        })

                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')
                        $.modal.close();
                    }
                })

            }else{
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'User ID is already in the database!',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                $.modal.close();
            }

        })
}
//Disable patient and transfer the disabled to new DB
function disablePatient(patientIds){
    $.post("php/superAdminProcesses/disablePatientProcess.php", {patId:patientIds})
        .done(function (data){
            if(data == 1){

            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}

//// DISABLE Patient BY BUTTON
function patientDisableCheck2(patientIds){
    $.post("php/superAdminProcesses/checkPatientId.php", {patId:patientIds})
        .done(function (data){
            if(data == 1){

                Swal.fire({
                    title: 'Are you sure you want to archive this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        disablePatient2(patientIds);
                        //$.post("php/superAdminProcesses/adminNameCaller.php", {patId:patIds})
                          //  .done(function (data){
                                var session = $('#session').val();
                                let timerInterval
                                Swal.fire({
                                    title: session+' Archived Successful!',
                                    timer: 2500,
                                    timerProgressBar: true,
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                        appendTableAdmin();
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        console.log('I was closed by the timer')
                                        appendTableAdmin();
                                    }
                                })
                           // })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')
                        $.modal.close();
                    }
                })
            }else{
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'User ID is already in the database!',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                $.modal.close();
            }

        })
}
//Disable patient and transfer the disabled to new DB
function disablePatient2(patientIds){
    $.post("php/superAdminProcesses/disablePatientProcess.php", {patId:patientIds})
        .done(function (data){
            if(data == 1){

            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}
