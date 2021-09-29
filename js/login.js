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
                    $("#pop-up-ok-btn").css("display","flex");
                }
                else{
                    //alert("Google Account is not registered !!!");
                    modalPopupPrompt("Account doesn't exist");
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

    var email = $('input[type="text"]').val();
    var password = $('input[type="password"]').val();

    if(email==""||password==""){
        $("#pop-up").modal('toggle');
        modalPopupPrompt("Please fill all the fields");
        $("#pop-up-ok-btn").css("display","none")
        return;
    }

        $.post("php/loginProcesses/loginProcess.php", {email:email,password:password,signInType:0/* 0 for regular login*/})
            .done(function (data){

                $("#pop-up").modal('toggle');

                if(data==1){
                    modalPopupMain();
                    $("#pop-up-ok-btn").css("display","flex");
                }
                else {
                    modalPopupPrompt("Invalid Credentials");
                }
            })
}

/*
* ===========================
* Functions that add content to modal
* just call it
* modalPopupMain() will be called if the email is in the database
* else error prompt message will show
* ===========================
* */
function modalPopupPrompt(message){
    $("#pop-up-ok-btn").css("display","none");
    $("#modal-content").html(message);
}
function  modalPopupMain(){
    $("#modal-content").html("<div id=\"modal-icon\"><img src=\"./img/authentication.png\"/></div>\n" +
        "                        <h3>Two-Step Authentication</h3>\n" +
        "                        <p>Please choose one of the following where to send your login verification code to continue.</p>\n" +
        "\n" +
        "                        <div class=\"container\">\n" +
        "                            <div class=\"row\" id=\"choose-authentication\">\n" +
        "                                <div class=\"col-sm\">\n" +
        "                                    <img src=\"img/email.png\">\n" +
        "                                    <p>Code to be sent by email</p>\n" +
        "                                    <div class=\"toggle-cont\">\n" +
        "                                        <input type=\"radio\" name=\"toggle\" value=\"isEmail\" id=\"isEmail\">\n" +
        "                                    </div>\n" +
        "                                </div>\n" +
        "                                <div class=\"col-sm\">\n" +
        "                                    <img src=\"img/sms.png\" id=\"sms-icon\">\n" +
        "                                    <p style=\"margin-top: 1rem\">Code to be sent by SMS</p>\n" +
        "                                    <div class=\"toggle-cont\">\n" +
        "                                        <input type=\"radio\" name=\"toggle\" value=\"isSMS\" id=\"isSMS\">\n" +
        "                                    </div>\n" +
        "                                </div>\n" +
        "                            </div>\n" +
        "                        </div>\n" +
        "                        <input type=\"radio\" name=\"toggle\" style=\"display: none\" checked value=\"none\" id=\"isNone\">");

    //radio button to choose for authentication sms or email
    $("#pop-up-ok-btn").click(function (){

        var radioValue = $("input[name=toggle]:checked").val();

       if(radioValue=="isSMS"){
           console.log("SMS was selected")
       }
       else if(radioValue=="isEmail"){
           console.log("Email was selected");
           $(".modal-footer").css("display","none");
           $("#modal-content").html("Please Wait!");

           //send OTP via email
           $.post("php/loginProcesses/sendOTPviaEmail.php",{email: logged_gmail}).done(function (data){

               if(data==1){//otp successfully sent in email

                   modalPopupEmailConfirmation();
               }
               else {
                   modalPopupPrompt("Error Sending OTP");
               }
           });

           //pag itetest ng maraming beses ung login
           //pa comment ung buong post method sa taas at pa uncomment ung line sa baba
           //baka kasi maubos ung 500email sent per 24 hours
           //modalPopupEmailConfirmation();
           //tignan nalang sa database ung OTP muna para maka pag login
       }
    })
}
function modalPopupEmailConfirmation(){

    $(".modal-footer").css("display","flex");
    $("#modal-content").html("<div id=\"modal-icon\"><img src=\"./img/email.png\"/></div>\n" +
        "                        <h3>Email Confirmation</h3>\n" +
        "                        <h5>A verification code has been sent to your email</h5>\n" +
        "                        <h5 id=\"email-txt\">sample@gmail.com</h5>\n" +
        "                        <p>To verify that it is you, Enter 6 digit verification code that has been sent to your email to continue</p>\n" +
        "                        <h5>Enter 6-digit code</h5>\n" +
        "                        <form autocomplete=\"off\">\n" +
        "                            <input type=\"text\" maxlength=\"6\" id=\"otp-input\">\n" +
        "                        </form>");

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
    $("#pop-up-ok-btn").click(function (){

       var otp = $("#otp-input").val();
        $.post( "php/loginProcesses/verifyOTP.php", { email: logged_gmail,verificationType:"email",OTP:otp }, function( data ) {
          console.log(data)
            if(data.result){
                console.log("tama ang OTP");
                location.href="php/loginProcesses/redirect.php";
            }
        }, "json");
    })
}

$(document).ready(function (){

    //prevent from clicking outside
    $('#pop-up').modal({backdrop: 'static', keyboard: false});

    /*
    ====== actions =========
    */
    //login button
    $("#login-btn").click(function (){
        console.log("fffffff")
        loginProcess();
    })







})

