


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
        console.log("walang laman");
    }else if(password != confirmpass){
        console.log("di tugma pass!");
    }else{
        console.log("sa else ni empty");
        checkEmailValidation(ademail);
    }
}
//check kung may email talaga na nag eexist
function checkEmailValidation(email){
    xhr = new XMLHttpRequest();
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState==4 && xhr.status==200){
            console.log("dumaan sa check email");
            if(xhr.responseText==1){
                //dito tatawag ng another function na magcoconfirm kung nag eexist na ba ung account sa data base
                console.log("nag eexist");
                addAdmin();
            } else{
                console.log("di nag eexist");
            }
        }
    }
    xhr.open("POST","php/superAdminProcesses/validateEmail.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    xhr.send("email="+email);
}

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
                console.log("added na sa db");
            }
            else {//may data na sa admin db
                console.log("email is already in the database.");
            }
        })
}
