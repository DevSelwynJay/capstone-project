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

             if(data==1){
                console.log("nakita ang email")
             }
             else{
                 $("#invalid-email-indicator").css("visibility","visible");
             }
         });

     })
})