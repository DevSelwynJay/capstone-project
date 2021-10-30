let c=0;
let interval;
$(document).ready(function (){
    //prevent enter button to reload page
    //hide error indicator
    let hideErrorIndicator = function (){
        $("#invalid-email-indicator").css("visibility","hidden");
        $("#invalid-otp-indicator").css("visibility","hidden");
    }

    $('#email-input').keypress(function(event){
        if ( event.which == 13 ) {
            event.preventDefault();
        }
    }).keyup(hideErrorIndicator);
    $("#forgot-pwd-otp-input").keypress(function(event){
        if ( event.which == 13 ) {
            event.preventDefault();
        }
    }).keyup(hideErrorIndicator);
    //====================Actions============================
     $("#pop-up-forgot-ok-btn").on('click',function (){
         let email  = $("#email-input").val();
         if(email==""){return;}

         //hide the 1st modal then show loading screen
         $("#pop-up-forgot").modal('hide')
         $("#pop-up-loading").modal('show');

         $.post("php/forgotPasswordProcesses/validateEmail.php",{email: email}).done(function (data){
             console.log("server process finished");

             const result = JSON.parse(data);
             if(result.status==1){
                console.log("nakita ang email")

                 //show loading modal before going to next modal

                 setTimeout(function () {
                     $("#pop-up-loading").modal('hide');
                     showForgotPasswordOTP_Input(result.full_name,result.email);
                 },1000)

             }
             else{
                 setTimeout(function () {
                     $("#pop-up-loading").modal('hide');
                     $("#pop-up-forgot").modal('show')
                     $("#invalid-email-indicator").css("visibility","visible");
                 },1000)

             }
         });

     })
    $("#pop-up-forgot-cancel-btn").off('click')
    $("#pop-up-forgot-cancel-btn").on('click',function (){
        $("#email-input").val("");
        $("#invalid-email-indicator").css("visibility","hidden");
    })
})
//Tips and trick reset the modal to its default state every time you call it to avoid problems
function  showForgotPasswordOTP_Input(full_name,email){

    //remove text in textbox and reactivate some disable button onload
    $("#email-input").val("");
    $("#invalid-otp-indicator").html('Invalid code').css('visibility','hidden');
    $("#pop-up-forgot-otp-ok-btn").prop('disabled',false);
    $("#forgot-pwd-otp-input").prop('readonly',false)

    $("#pop-up-forgot-otp").modal('show');
    console.log(full_name+" "+email)
    $(".forgot-pwd-otp-header").html("Hello! "+full_name);
    $(".forgot-pwd-otp-email").html(email);

    buttonTimer();//wait a seconds before resending the OTP

    $("#pop-up-forgot-otp-ok-btn").off('click');//remove click tapos set uli
    // kasi nauulit ng maraming beses ung click function
    $("#pop-up-forgot-otp-ok-btn").on('click',function () {

        $("#forgot-pwd-otp-input").prop('readonly',true)
        $("#pop-up-forgot-otp-ok-btn").prop('disabled',true);

        let inputtedOTP = $("#forgot-pwd-otp-input").val();

        $("#invalid-otp-indicator").html('<img width="30" height="30" src="img/Icons/loadingLine.gif"/>').css('visibility','visible')

        $.post("php/forgotPasswordProcesses/verifyCode.php",{inputtedOTP: inputtedOTP,email:email}).done(function (data){
            console.log("server process finished")
            c+=1;console.log(c);
            const result = JSON.parse(data);
            if(result.OK){
                setTimeout(function () {
                    console.log("tama ang OTP na ininput")
                    clearInterval(interval);
                },1500)

            }
            else{
                setTimeout(function () {
                    $("#invalid-otp-indicator").html('Invalid code').css('visibility','visible');
                    $("#forgot-pwd-otp-input").prop('readonly',false)
                    $("#pop-up-forgot-otp-ok-btn").prop('disabled',false);

                },1500)

            }
        });
    })
    $("#pop-up-forgot-otp-cancel-btn").off('click');
    $("#pop-up-forgot-otp-cancel-btn").on('click',function () {
        $("#forgot-pwd-otp-input").val("");
        $("#invalid-otp-indicator").css("visibility","hidden");
        $("#pop-up-forgot-resend-OTP-btn").html("Resend Code")
        clearInterval(interval);
    })

    $("#pop-up-forgot-resend-OTP-btn").off('click');
    $("#pop-up-forgot-resend-OTP-btn").on('click',function (){
        buttonTimer();
    })
    function buttonTimer(){
        let seconds = 30;
        $("#pop-up-forgot-resend-OTP-btn").prop('disabled',true);
            interval = setInterval(function () {
            if(seconds==-1){
                $("#pop-up-forgot-resend-OTP-btn").prop('disabled',false).html("Resend Code");
                seconds = 30;
                clearInterval(interval);
                return;
            }
            $("#pop-up-forgot-resend-OTP-btn").html("Resend Code in "+seconds);
            seconds-=1;
        },1000)
    }


}