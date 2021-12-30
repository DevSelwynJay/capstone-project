// *MMR FUNCTIONS
//triggers when week button is clicked
$(document).ready(function (){
    $("#wk4").click(function (){
        console.log("clicked button");
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("wk4").style.color = "#ffffff";
        document.getElementById("wk4").style.backgroundColor = "#363636";
        var week = 1;
        caller3(week);
        //fetchWeek();
    })
})
//trigger upon month button click
$(document).ready(function (){
    $("#mo4").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("mo4").style.color = "#ffffff";
        document.getElementById("mo4").style.backgroundColor = "#363636";
        var month = 2;
        caller3(month);
    })
})
//trigger upon year button click
$(document).ready(function (){
    $("#yr4").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("yr4").style.color = "#ffffff";
        document.getElementById("yr4").style.backgroundColor = "#363636";
        var year = 3;
        caller3(year);
    })
})
//trigger upon overall button click
$(document).ready(function (){
    $("#ov4").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("ov4").style.color = "#ffffff";
        document.getElementById("ov4").style.backgroundColor = "#363636";
        var overall = 4;
        caller3(overall);
    })
})

//gets the json from a php
function caller3(vals){
    if (vals==1){
        fetchMmrWeek(vals);
    }else if (vals==2){
        fetchMmrMonth(vals);
    }else if(vals==3){
        fetchMmrYear(vals);
    }else if(vals==4){
        fetchMmrOvall(vals);
    }
}
//
function fetchMmrWeek(value){
    $.post("../timeProcesses/mmrData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateMmrWeekData(returnedData);
        })
}
//updates the current data gathered from fetchweek function
function updateMmrWeekData(newdata){
    mmrInfant.data=newdata.infdata;
    mmrMinor.data=newdata.mindata;
    mmrlineChart.update();
}

function fetchMmrMonth(value){
    $.post("../timeProcesses/mmrData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateMmrMonthData(returnedData);
        })
}
//updates the current data gathered from fetchmonth function
function updateMmrMonthData(newdata){
    mmrInfant.data=newdata.infdataMo;
    mmrMinor.data=newdata.mindataMo;
    mmrlineChart.update();
}
function fetchMmrYear(value){
    $.post("../timeProcesses/mmrData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);//converts json data to string so that javascript can read it
            updateMmrYearData(returnedData);

        })
}
//updates the current data gathered from fetchmonth function
function updateMmrYearData(newdata){
    mmrInfant.data=newdata.infdataYr;
    mmrMinor.data=newdata.mindataYr;
    mmrlineChart.update();
}
function fetchMmrOvall(value){
    $.post("../timeProcesses/mmrData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateMmrOvData(returnedData);

        })
}
// updates the current data gathered from fetchOvall function
function updateMmrOvData(newdata){
    mmrInfant.data=newdata.infdataOv;
    mmrMinor.data=newdata.mindataOv;
    mmrlineChart.update();
}
// ! End of MMR Functions

// *Covid FUNCTIONS
//triggers when week button is clicked
$(document).ready(function (){
    $("#wk5").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("wk5").style.color = "#ffffff";
        document.getElementById("wk5").style.backgroundColor = "#363636";

        console.log("clicked button");
        var week = 1;
        caller4(week);
        //fetchWeek();
    })
})
//trigger upon month button click
$(document).ready(function (){
    $("#mo5").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("mo5").style.color = "#ffffff";
        document.getElementById("mo5").style.backgroundColor = "#363636";
        console.log("clicked button");
        var month = 2;
        caller4(month);
    })
})
//trigger upon year button click
$(document).ready(function (){
    $("#yr5").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("yr5").style.color = "#ffffff";
        document.getElementById("yr5").style.backgroundColor = "#363636";
        console.log("clicked button");
        var year = 3;
        caller4(year);
    })
})
//trigger upon overall button click
$(document).ready(function (){
    $("#ov5").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("ov5").style.color = "#ffffff";
        document.getElementById("ov5").style.backgroundColor = "#363636";
        var overall = 4;
        caller4(overall);
    })
})
//gets the json from a php
function caller4(vals){
    if (vals==1){
        fetchCovWeek(vals);
    }else if (vals==2){
        fetchCovMonth(vals);
    }else if(vals==3){
        fetchCovYear(vals);
    }else if(vals==4){
        fetchCovOvall(vals);
    }
}
//
function fetchCovWeek(value){
    $.post("../timeProcesses/covidData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateCovWeekData(returnedData);
        })
}
//updates the current data gathered from fetchweek function
function updateCovWeekData(newdata){
    covminor.data=newdata.mindata;
    covadult.data=newdata.addata;
    covsenior.data=newdata.sendata;
    covpwd.data=newdata.pwddata;
    covpregnant.data=newdata.pregdata;
    covlineChart.update();
}

function fetchCovMonth(value){
    $.post("../timeProcesses/covidData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateCovMonthData(returnedData);
        })
}
//updates the current data gathered from fetchmonth function
function updateCovMonthData(newdata){
    covminor.data=newdata.mindataMo;
    covadult.data=newdata.addataMo;
    covsenior.data=newdata.sendataMo;
    covpwd.data=newdata.pwddataMo;
    covpregnant.data=newdata.pregdataMo;
    covlineChart.update();
}
function fetchCovYear(value){
    $.post("../timeProcesses/covidData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);//converts json data to string so that javascript can read it
            updateCovYearData(returnedData);

        })
}
//updates the current data gathered from fetchmonth function
function updateCovYearData(newdata){
    covminor.data=newdata.mindataYr;
    covadult.data=newdata.addataYr;
    covsenior.data=newdata.sendataYr;
    covpwd.data=newdata.pwddataYr;
    covpregnant.data=newdata.pregdataYr;
    covlineChart.update();
}
function fetchCovOvall(value){
    $.post("../timeProcesses/covidData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateCovOvData(returnedData);

        })
}
// updates the current data gathered from fetchOvall function
function updateCovOvData(newdata){
    covminor.data=newdata.mindataOv;
    covadult.data=newdata.addataOv;
    covsenior.data=newdata.sendataOv;
    covpwd.data=newdata.pwddataOv;
    covpregnant.data=newdata.pregdataOv;
    covlineChart.update();
}
// ! End of Covid Functions
