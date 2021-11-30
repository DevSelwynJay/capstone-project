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
                 console.log("mag sesend na ng Code")

                 $.post("php/forgotPasswordProcesses/sendPwdResetCode.php",{email:email}).done(function (data){
                     console.log(data)
                     setTimeout(function () {
                         $("#pop-up-loading").modal('hide');
                         showForgotPasswordOTP_Input(result.full_name,result.email);
                     },1000)
                 });

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
    $("#pop-up-forgot-cancel-btn").on('click',function (){
        $("#email-input").val("");
        $("#invalid-email-indicator").css("visibility","hidden");
    })
    
    //===ACTIONS FOR PASSWORD RESET MODAL
    $(".pwd-reset").on('keyup',function (){
        $("#invalid-pwd-indicator").css("visibility","hidden");
        let pwd = $("#pwd-reset").val();
        let cpwd = $("#cpwd-reset").val();
        if(cpwd!=""&&pwd!=""){
            if(pwd!=cpwd){
                $("#invalid-pwd-indicator").css("visibility","visible").html("Password did not matched!")
                return;
            }
            else if(pwd==cpwd){
                if(pwd.length<8){
                    $("#invalid-pwd-indicator").css("visibility","visible").html("Minimum of 8 characters")
                    return;
                }
            }
        }
    })
    $("#pop-up-reset-pwd-ok-btn").click(function () {
        let pwd = $("#pwd-reset").val();
        let cpwd = $("#cpwd-reset").val();

        if(pwd==""||cpwd==""){
            $("#invalid-pwd-indicator").css("visibility","visible").html("Please fill all the field!")
            return;
        }
        if(pwd!=cpwd||pwd.length<8){
            return;
        }

        $("#pop-up-reset-pwd").modal("hide")
        $("#pop-up-loading").modal("show")
        $.post("php/forgotPasswordProcesses/changePassword.php",{new_password:pwd}).done(function (data){
            setTimeout(function () {
                $("#pop-up-loading").modal("hide")
                console.log(data)
                if(data==1){
                    $(".pwd-reset").val("");
                    $("#pop-up-reset-pwd-success").modal('show')
                }
                else {
                    show_pwd_reset_modal();
                }
            },1000)


        })


    })
    $("#pop-up-reset-pwd-cancel-btn").click(function () {
        $(".pwd-reset").val("");
    })

})//end of document ready

//===========functions to call
//Tips and trick reset the modal to its default state every time you call it to avoid problems
function  showForgotPasswordOTP_Input(full_name,email){

    //remove text in textbox and reactivate some disable button onload
    $("#email-input").val("");
    $("#invalid-otp-indicator").html('Invalid code').css('visibility','hidden');
    $("#pop-up-forgot-otp-ok-btn").prop('disabled',false);
    $("#forgot-pwd-otp-input").prop('readonly',false).val("")

    buttonTimer();

    //show the next modal(otp input) then display the email and fullname
    $("#pop-up-forgot-otp").modal('show');
    console.log(full_name+" "+email)
    $("#forgot-pwd-otp-header").html("Hello! "+full_name);
    $("#forgot-pwd-otp-email").html(email);

    $("#forgot-pwd-otp-input").off('keypress');
    $("#forgot-pwd-otp-input").on('keypress',function (event) {
       if($(this).val().length==6){
           event.preventDefault()
       }

    })

    $("#pop-up-forgot-otp-ok-btn").off('click');//remove click tapos set uli
    // kasi nauulit ng maraming beses ung click function
    $("#pop-up-forgot-otp-ok-btn").on('click',function () {

        //get the inputted OTP
        let inputtedOTP = $("#forgot-pwd-otp-input").val();
        if(inputtedOTP==""||inputtedOTP.length<6){
            $("#invalid-otp-indicator").html('It must be a 6-Digit').css('visibility','visible');
            return;
        }

        //clicking verify button will disable it with the OTP text box and resend OTP button temporarily
        $("#forgot-pwd-otp-input").prop('readonly',true)
        $("#pop-up-forgot-otp-ok-btn").prop('disabled',true);
        $("#pop-up-forgot-resend-OTP-btn").prop('disabled',true)


        //show the loading icon
        $("#invalid-otp-indicator").html('<img width="30" height="30" style="margin: 0" src="img/Icons/loadingLine.gif"/>').css('visibility','visible')

        $.post("php/forgotPasswordProcesses/verifyCode.php",{inputtedOTP: inputtedOTP,email:email}).done(function (data){
            console.log("server process finished")
            c+=1;console.log(c);
            const result = JSON.parse(data);
            if(result.OK){
                setTimeout(function () {
                    console.log("tama ang OTP na ininput")
                    clearInterval(interval);
                    $("#pop-up-forgot-otp").modal('hide');
                    show_pwd_reset_modal(email,full_name)
                },1500)

            }
            else{
                setTimeout(function () {
                    $("#invalid-otp-indicator").html('Invalid code').css('visibility','visible');
                    $("#forgot-pwd-otp-input").prop('readonly',false)
                    $("#pop-up-forgot-otp-ok-btn").prop('disabled',false);
                    if(interval==null){
                        $("#pop-up-forgot-resend-OTP-btn").prop('disabled',false)
                    }

                },1500)

            }
        });
    })
    $("#pop-up-forgot-otp-cancel-btn").off('click');
    $("#pop-up-forgot-otp-cancel-btn").on('click',function () {
        $("#pop-up-forgot-resend-OTP-btn").html("Resend Code")
        clearInterval(interval);
        interval=null;
    })

    $("#pop-up-forgot-resend-OTP-btn").off('click');
    $("#pop-up-forgot-resend-OTP-btn").on('click',function (){
        buttonTimer();
        $.post("php/forgotPasswordProcesses/sendPwdResetCode.php",{email:email}).done(function (data){
                console.log(data)
        });

    })
    function buttonTimer(){
        let seconds = 5;
        $("#pop-up-forgot-resend-OTP-btn").prop('disabled',true);
            interval = setInterval(function () {
            if(seconds==-1){
                $("#pop-up-forgot-resend-OTP-btn").prop('disabled',false).html("Resend Code");
                clearInterval(interval);
                interval=null;
                return;
            }
            $("#pop-up-forgot-resend-OTP-btn").html("Resend Code in "+seconds);
            seconds-=1;
        },1000)
    }


}

function show_pwd_reset_modal(email,full_name){
    //reset the modal, it will remove all the value in text-box then show it
    $(".pwd-reset").val("");
    $("#invalid-pwd-indicator").css('visibility','hidden').html("Sample Text");
    $("#forgot-pwd-greetings").html("Hello!, "+full_name)
    $("#forgot-pwd-email").html(email)
    $("#pop-up-reset-pwd").modal('show');

}


