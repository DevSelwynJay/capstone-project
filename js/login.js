let logged_gmail;//the gmail of logged account to be sent in back-end

window.onload = function () {
    google.accounts.id.initialize({
        client_id: "373815557222-68l0i08iuj7i2j5iq5inrt54550nm6fp.apps.googleusercontent.com",
        callback: handleCredentialResponse

    });
    //to make google login button and prompt
    google.accounts.id.renderButton(
        document.getElementById("buttonDiv"),
        { size: "large",shape:"circle",theme:"filled_blue",text:"continue_with"
        }  // customization attributes
    );

    google.accounts.id.prompt(); // also display the One Tap dialog

}
//
//to handle google logged account's credential
function handleCredentialResponse(response) {
    console.log("Encoded JWT ID token: " + response.credential);

    const responsePayload = decodeJwtResponse(response.credential);
    checkEmailInDatabase(responsePayload.email);

    logged_gmail=responsePayload.email;

    console.log("ID: " + responsePayload.sub);
    console.log('Full Name: ' + responsePayload.name);
    console.log('Given Name: ' + responsePayload.given_name);
    console.log('Family Name: ' + responsePayload.family_name);
    console.log("Image URL: " + responsePayload.picture);
    console.log("Email: " + responsePayload.email);


    //decode JWT(JSON WEB Token)
    function decodeJwtResponse (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    };

    //function for google sign in no need a password
    //check gmail if exist in database
    function checkEmailInDatabase(email){
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = ()=>{
            if(xhr.readyState==4 && xhr.status==200){ //gmail successfully found in database

                $("#pop-up").modal('toggle');

                if(xhr.responseText==1){
                    //window.location.href="main.php"
                    //prevent from clicking outside
                    modalPopupMain();
                }
                else{
                    //alert("Google Account is not registered !!!");
                    $("#pop-up-error").modal('show'); //toggle pop-up error prompt
                    $("#pop-up-error-message").html("Invalid credentials")
                }
            }
        }
        xhr.open("POST","php/loginProcesses/loginProcess.php",true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
        xhr.send("email="+email+"&signInType="+1);// 1 for google sign in
    }
}

//for regular login process
function loginProcess(){

    logged_gmail = $('input[type="text"]').val();
    var password = $('input[type="password"]').val();

    if(logged_gmail==""||password==""){
        $("#pop-up-error").modal('show'); //toggle pop-up error prompt
        $("#pop-up-error-message").html("Please fill all the field")
        return;
    }

        $.post("php/loginProcesses/loginProcess.php", {email:logged_gmail,password:password,signInType:0/* 0 for regular login*/})
            .done(function (data){

                if(data==1){
                    modalPopupMain();
                }
                else {
                    $("#pop-up-error").modal('show'); //toggle pop-up error prompt
                    $("#pop-up-error-message").html("Invalid Credentials")
                }
            })
}

/*
* ===========================
* Functions that calls the modal
* ===========================
* */

//pop-up where you will select sms or email
function  modalPopupMain(){
    $("#pop-up-main").modal('toggle');
    //get the value of selected radio button (isSMS,isEmail)
    $("#pop-up-main-ok-btn").click(function (){
        var radioValue = $("input[name=toggle]:checked").val();

        setTimeout(function (){
            console.log("selectAuthenticationType"+radioValue)

            if(radioValue=="isSMS"){
                console.log("SMS was selected")
            }
            else if(radioValue=="isEmail"){
                console.log("Email was selected");


                //send OTP via email
                $.post("php/loginProcesses/sendOTPviaEmail.php",{email: logged_gmail}).done(function (data){

                    if(data==1){//otp successfully sent in email

                        modalPopupEmailConfirmation();
                    }
                    else{
                        $("#pop-up-main").modal('hide');
                        $("#pop-up-error").modal('show'); //toggle pop-up error prompt
                        $("#pop-up-error-message").html("Can't send OTP")
                    }
                });

                //pag itetest ng maraming beses ung login
                //pa comment ung buong post method sa taas at pa uncomment ung line sa baba
                //baka kasi maubos ung 500email sent per 24 hours
                //modalPopupEmailConfirmation();
                //tignan nalang sa database ung OTP muna para maka pag login
            }
        },0);
    })
}
//if email was selected to send OTP
function modalPopupEmailConfirmation(){

    $("#pop-up-main").modal('hide');
    $("#pop-up-email").modal('show');

    //put random '*' in an email
    var at = logged_gmail.indexOf("@");
    var displayedGmail = logged_gmail.split("");
    console.log(at);
    var start = (at-1)/2;
    displayedGmail[0]='*'
    for(a=start;a<at;a++){
       displayedGmail[a]='*';
    }
    $("#email-txt").html(displayedGmail.join(""));

    //confirm 6 Digit Code OTP
    $("#pop-up-email-ok-btn").click(function (){

       var otp = $("#otp-input").val();
        $.post( "php/loginProcesses/verifyOTP.php", { email: logged_gmail,verificationType:"email",OTP:otp }, function( data ) {
          console.log(data)
            if(data.result){
                console.log("tama ang OTP");
                location.href="php/loginProcesses/redirect.php";
            }
            else{
                $("#pop-up-email").modal('hide');
                $("#pop-up-error").modal('show'); //toggle pop-up error prompt
                $("#pop-up-error-message").html("Invalid OTP")
                $("#pop-up-error-cancel-btn").click(function (){
                    $("#pop-up-email").modal('show');
                });
            }


        }, "json");
    })
}

$(document).ready(function (){

    /*
    ====== actions =========
    */
    //login button
    $("#login-btn").click(function (){
        console.log("fffffff")
        loginProcess();
    })







})

