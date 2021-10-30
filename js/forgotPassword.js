let c=0;
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

         $.post("php/forgotPasswordProcesses/validateEmail.php",{email: email}).done(function (data){
             console.log("server process finished");

             const result = JSON.parse(data);
             if(result.status==1){
                console.log("nakita ang email")
                 //hide the 1st modal
                 $("#pop-up-forgot").modal('hide')
                 showForgotPasswordOTP_Input(result.full_name,result.email);
             }
             else{
                 $("#invalid-email-indicator").css("visibility","visible");
             }
         });

     })
    $("#pop-up-forgot-cancel-btn").off('click')
    $("#pop-up-forgot-cancel-btn").on('click',function (){
        $("#email-input").val("");
        $("#invalid-email-indicator").css("visibility","hidden");
    })
})

function  showForgotPasswordOTP_Input(full_name,email){
    $("#email-input").val("");
    $("#pop-up-forgot-otp").modal('show');
    console.log(full_name+" "+email)
    $(".forgot-pwd-otp-header").html("Hello! "+full_name);
    $(".forgot-pwd-otp-email").html(email);

    $("#pop-up-forgot-otp-ok-btn").off('click');//remove click tapos set uli
    // kasi nauulit ng maraming beses ung click function
    $("#pop-up-forgot-otp-ok-btn").on('click',function () {

        let inputtedOTP = $("#forgot-pwd-otp-input").val();

        $.post("php/forgotPasswordProcesses/verifyCode.php",{inputtedOTP: inputtedOTP,email:email}).done(function (data){
            console.log("server process finished")
            c+=1;console.log(c);
            const result = JSON.parse(data);
            if(result.OK){
                console.log("tama ang OTP na ininput")
            }
            else{
                $("#invalid-otp-indicator").css("visibility","visible");
            }
        });
    })
    $("#pop-up-forgot-otp-cancel-btn").off('click');
    $("#pop-up-forgot-otp-cancel-btn").on('click',function () {
        $("#forgot-pwd-otp-input").val("");
        $("#invalid-otp-indicator").css("visibility","hidden");
    })

    $("#pop-up-forgot-resend-OTP-btn").off('click');
    $("#pop-up-forgot-resend-OTP-btn").on('click',function (){
        let seconds = 60;
        $(this).prop('disabled',true);
        setInterval(function () {
            if(seconds==0){
                $(this).prop('disabled',false);
                return;
            }
            $("#pop-up-forgot-resend-OTP-btn").html("Resend Code "+seconds);
            seconds-=1;
        },1000)
    })


}