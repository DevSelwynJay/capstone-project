$(document).ready(function (){
    $('#email-input').keypress(function(event){
        if ( event.which == 13 ) {
            event.preventDefault();
        }
    }).keyup(function (){ $("#invalid-email-indicator").css("visibility","hidden")});

     $("#pop-up-forgot-ok-btn").click(function (){
         let email  = $("#email-input").val();
         if(email==""){return;}

         $.post("php/forgotPasswordProcesses/validateEmail.php",{email: email}).done(function (data){

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

    $("#pop-up-forgot-cancel-btn").click(function (){
        $("#email-input").val("");
        $("#invalid-email-indicator").css("visibility","hidden");
    })
})

function  showForgotPasswordOTP_Input(full_name,email){
    $("#email-input").val("");
    $("#pop-up-forgot-otp").modal('show');
    console.log(full_name+" "+email)
    $(".forgot-pwd-otp-header").html("Hello!, "+full_name);
    $(".forgot-pwd-otp-email").html(email);

}