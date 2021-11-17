window.onload = function () {
$.post("php/settingsProcesses/showInfo.php").done(function (data) {
    let result = JSON.parse(data)
    //alert(result)
    $("#fname").html(result.fname)
    $("#mname").html(result.mname)
    $("#lname").html(result.lname)
    $("#gender").html(result.gender)
    $("#age").html(result.age)
    $("#bday").html(result.bday)
    $("#address").html(result.address)
})

}//
//=============
$(document).ready(function () {

    //click
    $("tr .fa-edit").click(function () {
       let selected_ID = $(this).prop('id')
        setTimeout(function () {
            $("#edit-modal").modal({
                //escapeClose: false,
                clickClose: false,
                //showClose: false
            })
            $("#edit-modal-content #"+selected_ID).trigger('focus')
        },300)

    })

    $("#edit-modal-content #bday-edit").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange:'1900:new Date()',
        maxDate: new Date()
    }).datepicker("option", "dateFormat", "yy-mm-dd")
    $("#edit-modal-content #bday-edit").focus(function () {
        $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem")
        $(".ui-datepicker-year").css("padding","1px")
        console.log($(this).val())
    })


})