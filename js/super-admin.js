

$(document).ready(function (){
    $("#confirmation-addmin").click(function (){
        console.log("clicked")
        checkEmpty();
    })
})
//check if the fields are empty
function checkEmpty(){
    var fname = $('#fname').val();
    var lname = $('#lname').val();
    var mname = $('#mname').val();
    var password = $('#password').val();
    var email = $('#admin-email').val();
    var gender = $('#gender').val();
    var confirmpass = $('#conf-pass').val();
    var contactno = $('#contact').val();
    var workcat = $('#work-cat').val();

    if(fname == "" || lname == "" || mname == "" || password == "" || email == "" || gender == ""
        || confirmpass == "" || contactno == "" || workcat == ""){

        console.log("walang laman");
    }else {
        checkEmailValidation(email);
    }
}
//check kung may email talaga na nag eexist
function checkEmailValidation(email){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState==4 && xhr.status==200){

            //$("#pop-up").modal('toggle');

            if(xhr.responseText==1){
                //dito tatawag ng another function na magcoconfirm kung nag eexist na ba ung account sa data base
                console.log("nag eexist");
            }
            else{
                //alert("Google Account is not registered !!!");
                //$("#pop-up-error").modal('show'); //toggle pop-up error prompt
                //$("#pop-up-error-message").html("Invalid credentials");
                console.log("di nag eexist");
            }
        }
    }
    xhr.open("POST","php/superAdminProcesses/validateEmail.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    xhr.send("email="+email);
}

