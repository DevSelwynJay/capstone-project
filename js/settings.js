window.onload = function () {
$.post("php/settingsProcesses/showInfo.php").done(function (data) {
    let result = JSON.parse(data)
    //alert(result.status)
})

}//
//=============
$(document).ready(function () {

})