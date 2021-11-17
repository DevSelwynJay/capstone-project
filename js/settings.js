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
    $("#fname-edit").click(function () {
       $("#fname").prop('contenteditable','true')
        $("#fname").trigger('focus')
    })
    $("#fname").on('blur',function () {
        $("#fname").prop('contenteditable','false')
    })
    //
    $("#mname-edit").click(function () {
        $("#mname").prop('contenteditable','true')
        $("#mname").trigger('focus')
    })
    $("#mname").on('blur',function () {
        $("#mname").prop('contenteditable','false')
    })
    //
    $("#lname-edit").click(function () {
        $("#lname").prop('contenteditable','true')
        $("#lname").trigger('focus')
    })
    $("#lname").on('blur',function () {
        $("#lname").prop('contenteditable','false')
    })
    //
    $("#gender-edit").click(function () {
        $("#gender-modal").dialog("open")
    })
    $("#gender").on('blur',function () {

    })
})