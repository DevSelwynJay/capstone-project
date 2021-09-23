//to make google login button and prompt
let logged_gmail;
window.onload = function () {
    google.accounts.id.initialize({
        client_id: "373815557222-68l0i08iuj7i2j5iq5inrt54550nm6fp.apps.googleusercontent.com",
        callback: handleCredentialResponse

    });
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

    //check gmail if exist in database
    function checkEmailInDatabase(email){
        xhr = new XMLHttpRequest();
        xhr.onreadystatechange = ()=>{
            if(xhr.readyState==4 && xhr.status==200){ //gmail successfully found in database
                if(xhr.responseText==1){
                    //window.location.href="main.php"
                    $("#pop-up").modal('toggle');
                    modalPopupMain();

                }
                else{
                    //alert("Google Account is not registered !!!");
                    $("#pop-up").modal('toggle');
                    modalPopupPrompt();
                }
            }
        }
        xhr.open("POST","php/loginProcesses/checkEmail.php",true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
        xhr.send("email="+email);
    }
}

/*
* ===========================
* Functions that add content to modal
* just call it
* ===========================
* */
function modalPopupPrompt(){
    $("#modal-content").html("Error");
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
           modalPopupEmailConfirmation();
       }
    })
}
function modalPopupEmailConfirmation(){
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
                location.href="redirect.php";
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
        //$("#dialog-email-confirmation").dialog("open")
    })







})

