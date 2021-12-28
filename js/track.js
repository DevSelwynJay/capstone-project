//triggers when week button is clicked
$(document).ready(function (){
    $("#wk1").click(function (){
        console.log("clicked button");
        fetchWeek();
    })
})
//gets the json from a php
function fetchWeek(){
    $.post("../timeProcesses/opvWeek.php")
        .done(function (data){
            var returnedData = JSON.parse(data);
            console.log(returnedData.mindata);
            console.log(returnedData.infdata);
            updateWeekData(returnedData);
        })
}
//updates the current datas
function updateWeekData(newdata){
    infant.data=newdata.infdata;
    minor.data=newdata.mindata;
    lineChart.update();
}