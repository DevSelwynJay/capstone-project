<div class="modal" id="pop-up-change-pwd">
    <div class="flex-box-row justify-content-center align-items-center">
        <img src="img/HIS%20logo%20blue.png" width="250" height="90">
    </div>
    <p class="modal-title-2">Change Password</p>
    <p class="modal-p-2" style="text-align: center!important;">Please Re-enter your Password Again</p>
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
                            $(".modal-p-error").css("visibility","visible")
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
        <button id="new-pwd-btn" class="modal-primary-button-2 margin-top-2">
            Confirm
        </button>
        <script>
            $("#new-pwd").focus(function () {
                $(".modal-p-error").css("visibility","hidden")
            })
            $("#new-pwd-btn").click(function (data) {
                let char = $("#new-pwd").val().trim();


                $("#pop-up-loading").modal({showClose: false,clickClose: false,escapeClose: false})
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