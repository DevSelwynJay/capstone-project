$(document).ready(function (){
    let noOfPicture=0;

    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview,e) {

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
                        $($.parseHTML('<p>')).html('No image was selected').appendTo(placeToInsertImagePreview);
                        return;
                    }
                }
                
                var filesAmount = input.files.length;
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

    $("#trigger-reg-modal").click(function (e) {
        let fname = $('[name="fname"]').val()
        let mname = $('[name="mname"]').val()
        let lname = $('[name="lname"]').val()
        //let suffix =$('[name="suffix"]').val() // not required
        let occu = $('[name="occupation"]').val()
        let civil = $('[name="civil_status"]').val()
        let email = $('[name="email"]').val()
        let contact =$('[name="contact"]').val()
        let pwd = $('[name="pwd"]').val()
        let cpwd =$('[name="cpwd"]').val()
        let gender =$('[name="gender"]').val()
        let bday = $('[name="bday"]').val()
        let purok = $('[name="purok"]').val()
        let house_no = $('[name="house_no"]').val()

        if(fname==""||mname==""||lname==""||occu==""||civil==""||email==""||
            contact==""||pwd==""||cpwd==""||gender==""||bday==""||purok==""||house_no==""||noOfPicture==0){
            console.log("fill all the field")
            return
        }
        else {
            if(pwd!=cpwd){
                console.log("Password did not matched")
                e.preventDefault()
                return;
            }
            else {
                //call the register modal
                e.preventDefault()
                $("#pop-up-reg").modal('toggle')

            }
        }
    })

    $("#pop-up-reg-ok-btn").click(function () {
       $("#reg-form").submit()
    })
})//end