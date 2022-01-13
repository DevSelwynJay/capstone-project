<div class="modal" id="pop-up-change-pwd">
    <div class="flex-box-row justify-content-center align-items-center">
        <img src="img/HIS%20logo%20blue.png" width="250" height="90">
    </div>
    <p class="modal-title-2">Change Password</p>
    <p class="modal-p-2" style="text-align: center!important;">Please re-enter your password again</p>
    <div class="flex-box-column align-items-center margin-top-2">
        <input id="old-pwd" type="password" class="search-bar" placeholder="password" style="width: 60%">
        <p class="modal-p-error">Invalid Password</p>
        <button id="old-pwd-btn" class="modal-primary-button-2 margin-top-2">
            Enter
        </button>
        <script>
            $("#old-pwd").focus(function () {
                $(".modal-p-error").css("visibility","hidden")
            })
            $("#old-pwd-btn").click(function (data) {
                let char = $("#old-pwd").val().trim();

                $.post("php/patientSide/checkPatientOnlineAccountPassword.php",{pwd:char}).done(
                    function (data) {
                        if(data==1){
                            $(".modal-p-error").css("visibility","hidden")
                            $("#pop-up-new-pwd").modal({
                                clickClose:false,
                                showClose:false,
                                escapeClose:false
                            })
                        }
                        else {
                            $(".modal-p-error").css("visibility","visible").html("Invalid Password")
                        }
                    }
                )
            })
        </script>
    </div>
</div>

<div class="modal" id="pop-up-new-pwd">
    <div class="flex-box-row justify-content-center align-items-center">
        <img src="img/HIS%20logo%20blue.png" width="250" height="90">
    </div>
    <p class="modal-title-2">Change Password</p>
    <p class="modal-p-2" style="text-align: center!important;">Please enter your new password</p>
    <div class="flex-box-column align-items-center margin-top-2">
        <input id="new-pwd" type="password" class="search-bar" placeholder="password" style="width: 60%">
        <p class="modal-p-error">Invalid Password</p>
       <div class="flex-box-row justify-content-center">
           <button id="back-new-pwd" class="modal-cancel-button-2 margin-top-2" style="margin-right: 0.3rem">
               Cancel
           </button>
           <button id="new-pwd-btn" class="modal-primary-button-2 margin-top-2">
               Confirm
           </button>
           <a href="#pop-up-new-pwd" rel="modal:close" style="display: none"></a>
       </div>
        <script>
            $("#back-new-pwd").click(function () {
                $('[href="#pop-up-new-pwd"]').trigger("click")
            })
            $("#new-pwd").focus(function () {
                $(".modal-p-error").css("visibility","hidden")
            })
            $("#new-pwd-btn").click(function (data) {
                let char = $("#new-pwd").val().trim();
                if(char.length==0){
                    $(".modal-p-error").css("visibility","visible").html("Please input password")
                    return
                }
                if(char.length<8){
                    $(".modal-p-error").css("visibility","visible").html("Please input 8 or more character")
                    return
                }


                $("#pop-up-loading").modal({showClose: false,clickClose: false,escapeClose: false})
                $("#pop-up-loading-message").html("Processing Request...")
                $.post("php/patientSide/changePWD.php",{pwd:char}).done(
                    function (data) {
                        if(data==1){
                            setTimeout(()=>{
                                $("#pop-up-success").modal({showClose:false})
                                $("#pop-up-success-message").html("Password successfully changed!")
                            },1500)
                        }
                        else {
                            setTimeout(()=>{
                                $('[href="#pop-up-loading"]').trigger("click")
                                    console.log("error")
                            },1500)
                        }
                    }
                )
            })
        </script>
    </div>
</div>

<div class="modal" id="pop-up-update-email">
    <div class="flex-box-row justify-content-center align-items-center">
        <img src="img/HIS%20logo%20blue.png" width="250" height="90">
    </div>
    <p class="modal-title-2">Update Email</p>

    <div class="flex-box-column align-items-center margin-top-2">
        <p class="modal-p-2" style="text-align: center!important;">Please enter your new email</p>
        <input id="new-email" type="text" class="search-bar" placeholder="email" style="width: 60%;margin-top: 0.3rem!important;">

        <p class="modal-p-2 margin-top-2" style="text-align: center!important;">Please re-enter your password again</p>
        <input id="confirm-pwd" type="password" class="search-bar" placeholder="password" style="width: 60%;margin-top: 0.3rem!important;">
        <p class="modal-p-error">Invalid Password</p>



        <div class="flex-box-row justify-content-center">
            <button id="back-new-email" class="modal-cancel-button-2 margin-top-2" style="margin-right: 0.3rem">
                Cancel
            </button>
            <button id="new-email-btn" class="modal-primary-button-2 margin-top-2">
                Confirm
            </button>
            <a href="#pop-up-update-email" rel="modal:close" style="display: none"></a>
        </div>

</div>
<script>
    $("input").focus(function () {
        $(".modal-p-error").css("visibility","hidden")
    })

    $("#update-email").click(function (data) {
        $("#pop-up-update-email").modal({})
    })

    $("#back-new-email").click(function () {
        $('[href="#pop-up-update-email"]').trigger("click")
    })

    $("#new-email-btn").click(function (data) {

        let char = $("#confirm-pwd").val();
        let new_email = $("#new-email").val().trim();
        //check if fields are complete
        if(char.length==0||new_email.length==0){
            $(".modal-p-error").css("visibility","visible").html("Please fill all the fields")
            return;
        }
        //validate email check password and if okay palitan na
        $("#pop-up-loading").modal({showClose:false,clickClose:false,escapeClose:false,closeExisting:false})
        $("#pop-up-loading-message").html("Processing Request...");
        $(".modal-p-error").css("visibility","hidden")
        $.post("php/patientSide/changedEmail.php",{email:new_email,pwd:char}).done(
            function (data) {
                if(data==1){
                    setTimeout(()=>{
                        $('[href="#pop-up-loading"]').trigger("click")
                        $(".modal-p-error").css("visibility","hidden")
                        $("#pop-up-success").modal({})
                        $("#pop-up-success-message").html("Email successfully changed")
                    },500)

                }
                else {
                    setTimeout(()=>{
                        $('[href="#pop-up-loading"]').trigger("click")
                        $(".modal-p-error").css("visibility","visible").html(data)
                    },500)

                }
            }
        )

    })

</script>
