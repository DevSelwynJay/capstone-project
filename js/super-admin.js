


$(document).ready(function (){
    $("#confirmation-addmin").click(function (){
        console.log("clicked");
        checkEmpty();
    })
})
//click table to get admin ID
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
//$(document).ready(function (){
    //$("#disable-admin2").click(function (){
    //    console.log("clicked");
    //    checkEmptyDis();
    //})

//})



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
                appendTableAdmin();
                let timerInterval
                Swal.fire({
                    title: 'Admin is added successfully...',
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