


$(document).ready(function (){
    $("#confirmation-addmin").click(function (){
        console.log("clicked");
        checkEmpty();
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
    }else if(password != confirmpass){
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
    }else{
        checkEmailValidation(ademail);
    }
}
//check kung may email talaga na nag eexist
function checkEmailValidation(email){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState==4 && xhr.status==200){
            if(xhr.responseText==1){
                //nag eexist ung email
                addAdmin();
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
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })

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
            }
        })
}
