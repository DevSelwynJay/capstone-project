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

})