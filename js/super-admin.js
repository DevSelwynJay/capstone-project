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


//?trigger if disable admin modal button is clicked
$(document).ready(function (){
    $("#disable-admin2").click(function (){
        var adminIds = $('#idno').val();
        var adminname = $('#adminname').val();
        adminDisableCheck(adminIds,adminname);
    })
})
//?trigger if activate admin modal button is clicked
$(document).ready(function (){
    $("#reactivate-admin1").click(function (){
        var adminIds = $('#idno3').val();
        var adminname = $('#adminname3').val();
        adminActivationCheck(adminIds,adminname);
    })
})
//By button disable ADMIN
/*
$(document).ready(function (){
    $("#disable-admin").click(function (){
        var adminIds = $('#idno2').val();
        adminDisableCheck2(adminIds);
    })
})
*/
// ?trigger if disable PATIENT modal button is clicked
$(document).ready(function (){
    $("#disable-patient2").click(function (){
        var patientIds = $('#patidno').val();
        var patname = $('#patname').val();
        patientDisableCheck(patientIds,patname);
    })
})
// ?trigger if disable PATIENT modal button is clicked
$(document).ready(function (){
    $("#activate-patient2").click(function (){
        var patientIds = $('#patidno3').val();
        var patname = $('#patname3').val();
        patientActivateCheck(patientIds,patname);
    })
})
//By button disable PATIENT
/*
$(document).ready(function (){
    $("#disable-patient").click(function (){
        var patientIds = $('#patidno2').val();
        patientDisableCheck2(patientIds);
    })
})
*/
//// * ADD ADMIN PROCESSES
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
    var admaddress = $('#modalAddress').val();
    var adbday = $('#birthday').val();

    if(fname == "" || lname == "" || mname == "" || password == "" || adbday == "" || ademail == "" || gender == "" || confirmpass == "" || contactno == "" || workcat == "" || admaddress == ""){
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
        console.log(adbday,admaddress);
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
    var admaddress = $('#modalAddress').val();
    var adbday = $('#birthday').val();

    $.post("php/superAdminProcesses/addingProcess.php", {email:ademail,password:password,confirmpass:confirmpass,lname:lname,fname:fname,mname:mname,gender:gender,workcat:workcat,contactno:contactno,admaddress:admaddress,adbday:adbday})
        .done(function (data){

            if(data==1){//walang pang data sa admin db

                let timerInterval
                Swal.fire({
                    title: 'Admin is added successfully...',
                    timer: 2000,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                        //appendTableAdmin();
                        $("#reload-admin").trigger("click")
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                        $("#reload-admin").trigger("click")
                        //appendTableAdmin();
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
                $('#modalAddress').val("");
                $('#birthday').val("");

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
//// * DISABLE PROCESSESS
// *DISABLE ADMIN
//Ask for confirmation and calls the php function to check if ID exist and calls the function to disable
function adminDisableCheck(adminIds,adminname){
    (async () => {

        const { value: password } = await Swal.fire({
            title: 'Enter your password',
            input: 'password',
            //customClass: 'swal-wide',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
                //maxlength: 20,
                autocapitalize: 'off',
                autocorrect: 'off'
            }

        })

        if (password) {
            var loggedEmail = document.getElementById('emmm').innerText;
            checkPassDisable(adminIds,adminname,loggedEmail, password);
            //Swal.fire(`Entered password: ${password}`)
        }

    })()
}
//checks the password entered
function checkPassDisable(adminIds,adminname,superEmail,superPass){
    $.post("php/superAdminProcesses/passCheck.php", {swalpass:superPass,loggedEmail:superEmail})
        .done(function (data){
            console.log(superEmail,superPass);
            var statt = "active";
            var acttype = "1";
            if(data == 1){
                Swal.fire({
                    title: 'Are you sure you want to deactivate this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    // Read more about isConfirmed, isDenied below
                    if (result.isConfirmed) {
                        console.log("dito passdisable");
                        disableAdmin(adminIds);
                        sendmail(adminIds,statt,acttype);
                        let timerInterval
                        Swal.fire({
                            title: adminname+' Deactivated!',
                            timer: 2500,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                                //appendTableAdmin();
                            }
                        }).then((result) => {
                            // Read more about handling dismissals below
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                                //appendTableAdmin();
                            }
                        })
                        $.modal.close();
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')
                        $.modal.close();
                    }
                })
            }else {
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Password! Action Cancelled.',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    //Read more about handling dismissals below
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
            console.log("dito disableadmin");
            if(data == 1){
                $("#reload-admin").trigger("click")
            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}

// * PATIENT DISABLE
function patientDisableCheck(patientIds,patname){
    (async () => {

        const { value: password } = await Swal.fire({
            title: 'Enter your password',
            input: 'password',
            //customClass: 'swal-wide',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
                //maxlength: 20,
                autocapitalize: 'off',
                autocorrect: 'off'
            }

        })

        if (password) {
            var loggedEmail = document.getElementById('emmm').innerText;
            checkPatDisable(patientIds,patname,loggedEmail, password);
            //Swal.fire(`Entered password: ${password}`)
        }

    })()
}
//check pasword and if correct disables the account of the patient
function checkPatDisable (patientIds,patname,superEmail, superPass){
    $.post("php/superAdminProcesses/passCheck.php", {swalpass:superPass,loggedEmail:superEmail})
        .done(function (data){
            console.log(superEmail,superPass);
            var statt = "active";
            var acttype = "3";
            if(data == 1){
                Swal.fire({
                    title: 'Are you sure you want to deactivate this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    // Read more about isConfirmed, isDenied below
                    if (result.isConfirmed) {
                        disablePatient(patientIds);
                        sendmail(patientIds,statt,acttype);

                        let timerInterval
                        Swal.fire({
                            title: patname+' Deactivated!',
                            timer: 2500,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                                //$('.triggerbut').trigger("click");
                                //displayPtnts();
                            }
                        }).then((result) => {
                            // Read more about handling dismissals below
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                                //$('.triggerbut').trigger("click");
                                //displayPtnts();
                            }
                        })
                        $.modal.close();
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')

                    }
                })
            }else {
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Password! Action Cancelled.',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    //Read more about handling dismissals below
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
                $("#reload-patient").trigger("click")
            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}


//// * ACTIVATE PROCESSESS
// * ACTIVATE ADMIN ROW BUTTON
//Ask for confirmation and calls the php function to check if ID exist and calls the function to disable
function adminActivationCheck(adminIds,adminname){
    //$("#passmod").modal();
    (async () => {

        const { value: password } = await Swal.fire({
            title: 'Enter your password',
            input: 'password',
            inputLabel: 'Password',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
                //maxlength: 20,
                autocapitalize: 'off',
                autocorrect: 'off',


            }
        })

        if (password) {
            var loggedEmail = document.getElementById('emmm').innerText;
            checkPassActivate(adminIds,adminname,loggedEmail, password);
            //Swal.fire(`Entered password: ${password}`)
        }

    })()

    /*
        swal.fire({
            title: 'Enter Super Admin Password',
            html:
                '<input type="password" id="swal-input1" class="swal2-input" style="width: fit-content">',
            preConfirm: function () {
                return new Promise(function (resolve) {
                    var swalInput = $('#swal-input1').val();
                    var loggedEmail = document.getElementById('emmm').innerText;
                    checkPass(loggedEmail, swalInput);
                })
            }
        }) */
}
//Activate Admin and update the column status to 1
function activateAdmin(adminIds){
    $.post("php/superAdminProcesses/statusActivateProcess.php", {adminId:adminIds})
        .done(function (data){
            if(data == 1){
                $("#reload-admin").trigger("click")
            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}
//checks the password of the admin
function checkPassActivate(adminIds,adminname,superEmail,superPass){
    $.post("php/superAdminProcesses/passCheck.php", {swalpass:superPass,loggedEmail:superEmail})
        .done(function (data){
            console.log(superEmail,superPass);
            var statt = "inactive";
            var acttype = "1";
            if(data == 1){
                Swal.fire({
                    title: 'Are you sure you want to activate this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    // Read more about isConfirmed, isDenied below
                    if (result.isConfirmed) {
                        activateAdmin(adminIds);
                        sendmail(adminIds,statt,acttype);
                        let timerInterval
                        Swal.fire({
                            title: adminname+' Activated!',
                            timer: 2500,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)
                                //appendTableAdmin();
                            }
                        }).then((result) => {
                            // Read more about handling dismissals below
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                                //appendTableAdmin();
                            }
                        })
                        $.modal.close();
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')
                        $.modal.close();
                    }
                })
            }else {
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Password! Action Cancelled.',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    //Read more about handling dismissals below
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                $.modal.close();
            }



        })

}

// * ACTIVATE PATIENT ROW BUTTON
//Ask for confirmation and calls the php function to check if ID exist and calls the function to disable
function patientActivateCheck(patientIds,patname){
    //$("#passmod").modal();
    (async () => {

        const { value: password } = await Swal.fire({
            title: 'Enter your password',
            input: 'password',
            inputLabel: 'Password',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
                //maxlength: 20,
                autocapitalize: 'off',
                autocorrect: 'off',


            }
        })

        if (password) {
            var loggedEmail = document.getElementById('emmm').innerText;
            checkPatActivate(patientIds,patname,loggedEmail, password);
            //Swal.fire(`Entered password: ${password}`)
        }

    })()

    /*
        swal.fire({
            title: 'Enter Super Admin Password',
            html:
                '<input type="password" id="swal-input1" class="swal2-input" style="width: fit-content">',
            preConfirm: function () {
                return new Promise(function (resolve) {
                    var swalInput = $('#swal-input1').val();
                    var loggedEmail = document.getElementById('emmm').innerText;
                    checkPass(loggedEmail, swalInput);
                })
            }
        }) */
}
//Activate Admin and update the column status to 1
function activatePatient(patientIds){
    $.post("php/superAdminProcesses/patientStatusActivate.php", {patId:patientIds})
        .done(function (data){
            if(data == 1){
                $("#reload-patient").trigger("click")
            }else{
                Swal.fire('Unsuccesful!', '', 'error')
            }

        })
}
//checks the password of the admin
function checkPatActivate(patientIds,patname,superEmail, superPass){
    $.post("php/superAdminProcesses/passCheck.php", {swalpass:superPass,loggedEmail:superEmail})
        .done(function (data){
            var statt = "inactive";
            var acttype = "3";
            console.log(superEmail,superPass);
            if(data == 1){
                Swal.fire({
                    title: 'Are you sure you want to activate this account?',
                    showDenyButton: true,
                    //showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    // Read more about isConfirmed, isDenied below
                    if (result.isConfirmed) {
                        activatePatient(patientIds);
                        sendmail(patientIds,statt,acttype);

                        let timerInterval
                        Swal.fire({
                            title: patname+' Activated!',
                            timer: 2500,
                            timerProgressBar: true,
                            willClose: () => {
                                clearInterval(timerInterval)

                                //$('.triggerbut').trigger("click");
                                //displayPtnts();
                            }
                        }).then((result) => {
                            // Read more about handling dismissals below
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')

                                //$('.triggerbut').trigger("click");
                                //displayPtnts();
                            }
                        })
                        $.modal.close();
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved!', '', 'info')
                        $.modal.close();
                    }
                })
            }else {
                let timerInterval
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong Password! Action Cancelled.',
                    timer: 2500,
                    timerProgressBar: true,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    //Read more about handling dismissals below
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
                $.modal.close();
            }



        })

}

//sends email to admin or patient if their status is changed
function sendmail(allId,stat,acttype){

    $.post("php/superAdminProcesses/sendEmail.php", {allId:allId,status:stat,acttype:acttype})
        .done(function (data){
            console.log(data);
        })
}
