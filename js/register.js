$(document).ready(function (){
    let noOfPicture=0;

    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            $("#gallery").html("")//reset the preview

            if (input.files) {

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

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#customFileInput').on('change', function() {
            imagesPreview(this, '#gallery');
        });
    });

})//end