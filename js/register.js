$(document).ready(function (){$( '[data-target="#pop-up-preview-id"]' ).trigger( "click" );
    let noOfPicture=0;

    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview,e) {
            let filesAmount = input.files.length;

            $("#gallery").html("")//reset the preview

            if (input.files) {

                //validate file format
                let valid = false;
                let files = e.target.files;
                for(let file of files){
                    let ext = file.name.substring(file.name.lastIndexOf('.')+1)
                    let correctExt = ['png','jpg','jpeg']

                    for (let ce of correctExt){
                        if(ce==ext){
                            valid = true;
                            break;
                        }
                        else {
                            valid = false;
                        }

                    }

                    if(!valid){
                        console.log("Invalid file format")
                        $("#pop-up-error").modal('toggle')
                        $("#pop-up-error-message").html("<p>File has invalid format!</p>")
                        $($.parseHTML('<p>')).html('No image was selected').appendTo(placeToInsertImagePreview);
                        $('#customFileInput').val('')
                        noOfPicture = 0
                        $("#reg-pic-no").html("Image Selected: 0")
                        return;
                    }
                }
                

                noOfPicture = filesAmount
                console.log("no if image selected"+filesAmount)
                $("#reg-pic-no").html("Image Selected: "+filesAmount)

                if(filesAmount<=0){
                    $($.parseHTML('<p>')).html('No image was selected').appendTo(placeToInsertImagePreview);
                    return;
                }

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    console.log(e.target.files[i].name)
                    reader.onload = function(event) {

                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#customFileInput').on('change', function(e) {
            imagesPreview(this, '#gallery',e);
        });
    });

    $("[name=\"bday\"]").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'1900:new Date()',
        maxDate: new Date()
    }).datepicker("option", "dateFormat", "yy-mm-dd")
    $("[name=\"bday\"]").focus(function () {
        $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem")
        $(".ui-datepicker-year").css("padding","1px")
        console.log($(this).val())
    })

    //validation of some input

    let isValidEmail = false
    $('[name="email"]').blur(function (){
        let email = $(this).val()
        $.post("php/registerProcesses/validateEmail.php",{email:email }).done(function (data){

            if(data==1){
                console.log("valid email");
                $('[name="email"]').css("border-color","#6d6d6d");
                isValidEmail = true
            }
            else{
                console.log("invalid email");
                $('[name="email"]').css("border-color","#B10000");
                isValidEmail = false

            }

        });
    })

    let isValidContact=false
    $('[name="contact"]').blur(function () {
        let val = $(this).val();
        if(val==""){
            $(this).css("border-color","#6d6d6d");return;
            isValidContact=false
        }

        if(Number.isNaN(val)||val.length!=11||val.charAt(0)!=0){
            $(this).css("border-color","#B10000")
            isValidContact=false

        }
        else {
            $(this).css("border-color","#6d6d6d")
            isValidContact=true
        }
    })

    let chk_pwd = function (e) {
        let pwd = $('[name="pwd"]').val()
        let cpwd =$('[name="cpwd"]').val()

        if(cpwd==""||pwd==""){
            $('[name="pwd"]').css("border-color","#6d6d6d")
            $('[name="cpwd"]').css("border-color","#6d6d6d")
            return
        }
        if(cpwd!=pwd){
            $('[name="pwd"]').css("border-color","#B10000")
            $('[name="cpwd"]').css("border-color","#B10000")
        }
        if(cpwd==pwd){
            if(pwd.length<8){
                $('[name="pwd"]').css("border-color","#B10000")
                $('[name="cpwd"]').css("border-color","#B10000")
                return;
            }
            $('[name="pwd"]').css("border-color","#6d6d6d")
            $('[name="cpwd"]').css("border-color","#6d6d6d")
        }
    }
    $('[name="cpwd"]').blur(chk_pwd)
    $('[name="pwd"]').blur(chk_pwd)






    $("#trigger-reg-modal").click(function (e) {//nauuna to tawagin bago ung  default action ng submit button
        let fname = $('[name="fname"]').val()
        let mname = $('[name="mname"]').val()
        let lname = $('[name="lname"]').val()
        //let suffix =$('[name="suffix"]').val() // not required
        //let occu = $('[name="occupation"]').val()
        let civil = $('[name="civil_status"]').val()
        let email = $('[name="email"]').val()
        let contact = $('[name="contact"]').val()
        let pwd = $('[name="pwd"]').val()
        let cpwd = $('[name="cpwd"]').val()
        let gender = $('[name="gender"]').val()
        let bday = $('[name="bday"]').val()
        let purok = $('[name="purok"]').val()
        //let house_no = $('[name="house_no"]').val()

        if (fname == "" || mname == "" || lname == "" || civil == "" || email == "" ||
            contact == "" || pwd == "" || cpwd == "" || gender == "" || bday == "" || purok == "" ||  noOfPicture == 0) {
            console.log("fill all the field")//html form bahala sa pag notify kung kumpleto na
            return
        } else {

            //for drop down that has default value that is not valid

            e.preventDefault()//para di magsubmit kasi i vavalidate pa ni js
            //may laman na ung forms, si js na bahala


            let errCount=0;
            let errMessage="";
            $("#err-title").html("Can't sign up")
            if(pwd!=cpwd){
                //$("#pop-up-error").modal('toggle')
               // $("#pop-up-error-message").html('<p>Password did not matched</p>')
                errMessage+="<p>Password did not matched</p>";
                errCount+=1
                if(pwd.length<8){
                    errMessage+="<p>Password must be 8 or more characters</p>";
                    errCount+=1
                }
            }
            else  if(pwd==cpwd){
                if(pwd.length<8){
                    errMessage+="<p>Password must be 8 or more characters</p>";
                    errCount+=1
                }
            }
            if(!isValidContact){
                errMessage+="<p>Contact number is invalid</p>";
                errCount+=1
            }
            if(!isValidEmail){
                errMessage+="<p>Email is invalid</p>";
                errCount+=1
            }
            if(purok==null){
                errMessage+="<p>No purok selected</p>";
                errCount+=1
            }



            if(errCount!=0){
                $("#pop-up-error-message").html($.parseHTML(errMessage))
                $("#pop-up-error").modal('toggle')
                console.log(errMessage)

                $("#pop-up-error-cancel-btn").off('click')
                $("#pop-up-error-cancel-btn").click(function (){

                    $('#reg-form').animate({
                        scrollTop: $('[name="pwd"]').offset().top
                    }, 500);
                    $(this).off('click')
                });

            }
            else {
                //final validation
                //check for validity of email and phone
                //show the loading modal
                $("#pop-up-loading").modal('toggle');


                //check
                $.post("php/registerProcesses/finalValidation.php", {contact:contact,email:email})
                    .done(function (data){

                        setTimeout(function () {
                            $("#pop-up-loading").modal('hide');
                            const result = JSON.parse(data);
                            if(result.success==true){//valid
                                $("#pop-up-reg").modal('toggle')
                                console.log("valid form")
                            }
                            else {//invalid
                                console.log("invalid form")
                                console.log(result.message)
                                $("#pop-up-error-message").html($.parseHTML(result.message))
                                $("#pop-up-error").modal('show'); //toggle pop-up error prompt
                            }
                        },1000)

                    })
            }

        }//main else

    });

    $("#pop-up-reg-ok-btn").click(function () {
       $("#reg-form").submit()
    })




})//end


