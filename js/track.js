// *OPV FUNCTIONS
//triggers when week button is clicked
$(document).ready(function (){
    $("#wk1").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("wk1").style.color = "#ffffff";
        document.getElementById("wk1").style.backgroundColor = "#363636";

        console.log("clicked button");
        var week = 1;
        caller(week);
        //fetchWeek();
    })
})
//trigger upon month button click
$(document).ready(function (){
    $("#mo1").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("mo1").style.color = "#ffffff";
        document.getElementById("mo1").style.backgroundColor = "#363636";
        console.log("clicked button");
        var month = 2;
        caller(month);
    })
})
//trigger upon year button click
$(document).ready(function (){
    $("#yr1").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("yr1").style.color = "#ffffff";
        document.getElementById("yr1").style.backgroundColor = "#363636";
        console.log("clicked button");
        var year = 3;
        caller(year);
    })
})
//trigger upon overall button click
$(document).ready(function (){
    $("#ov1").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("ov1").style.color = "#ffffff";
        document.getElementById("ov1").style.backgroundColor = "#363636";
        var overall = 4;
        caller(overall);
    })
})
//gets the json from a php
function caller(vals){
    if (vals==1){
        fetchWeek(vals);
    }else if (vals==2){
        fetchMonth(vals);
    }else if(vals==3){
        fetchYear(vals);
    }else if(vals==4){
        fetchOvall(vals);
    }
}
//
function fetchWeek(value){
    $.post("../timeProcesses/opvWeek.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            console.log(returnedData.mindata);
            console.log(returnedData.infdata);
            updateWeekData(returnedData);
        })
}
//updates the current data gathered from fetchweek function
function updateWeekData(newdata){
    opvinfant.data=newdata.infdata;
    opvminor.data=newdata.mindata;
    opvlineChart.update();
}

function fetchMonth(value){
    $.post("../timeProcesses/opvWeek.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateMonthData(returnedData);
        })
}
//updates the current data gathered from fetchmonth function
function updateMonthData(newdata){
    opvinfant.data=newdata.infdataMo;
    opvminor.data=newdata.mindataMo;
    opvlineChart.update();
}
function fetchYear(value){
    $.post("../timeProcesses/opvWeek.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);//converts json data to string so that javascript can read it
            updateYearData(returnedData);

        })
}
//updates the current data gathered from fetchmonth function
function updateYearData(newdata){
    opvinfant.data=newdata.infdataYr;
    opvminor.data=newdata.mindataYr;
    opvlineChart.update();
}
function fetchOvall(value){
    $.post("../timeProcesses/opvWeek.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateOvData(returnedData);

        })
}
//updates the current data gathered from fetchOvall function
function updateOvData(newdata){
    opvinfant.data=newdata.infdataOv;
    opvminor.data=newdata.mindataOv;
    opvlineChart.update();
}
// ! End of OPV Function

// *IPV FUNCTIONS
//triggers when week button is clicked
$(document).ready(function (){
    $("#wk2").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("wk2").style.color = "#ffffff";
        document.getElementById("wk2").style.backgroundColor = "#363636";

        console.log("clicked button");
        var week = 1;
        caller1(week);
        //fetchWeek();
    })
})
//trigger upon month button click
$(document).ready(function (){
    $("#mo2").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("mo2").style.color = "#ffffff";
        document.getElementById("mo2").style.backgroundColor = "#363636";
        console.log("clicked button");
        var month = 2;
        caller1(month);
    })
})
//trigger upon year button click
$(document).ready(function (){
    $("#yr2").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("yr2").style.color = "#ffffff";
        document.getElementById("yr2").style.backgroundColor = "#363636";
        console.log("clicked button");
        var year = 3;
        caller1(year);
    })
})
//trigger upon overall button click
$(document).ready(function (){
    $("#ov2").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("ov2").style.color = "#ffffff";
        document.getElementById("ov2").style.backgroundColor = "#363636";
        var overall = 4;
        caller1(overall);
    })
})
//gets the json from a php
function caller1(vals){
    if (vals==1){
        fetchIpvWeek(vals);
    }else if (vals==2){
        fetchIpvMonth(vals);
    }else if(vals==3){
        fetchIpvYear(vals);
    }else if(vals==4){
        fetchIpvOvall(vals);
    }
}
//
function fetchIpvWeek(value){
    $.post("../timeProcesses/ipvData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateIpvWeekData(returnedData);
        })
}
//updates the current data gathered from fetchweek function
function updateIpvWeekData(newdata){
    ipvInfant.data=newdata.infdata;
    ipvMinor.data=newdata.mindata;
    ipvlineChart.update();
}

function fetchIpvMonth(value){
    $.post("../timeProcesses/ipvData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateIpvMonthData(returnedData);
        })
}
//updates the current data gathered from fetchmonth function
function updateIpvMonthData(newdata){
    ipvInfant.data=newdata.infdataMo;
    ipvMinor.data=newdata.mindataMo;
    ipvlineChart.update();
}
function fetchIpvYear(value){
    $.post("../timeProcesses/ipvData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);//converts json data to string so that javascript can read it
            updateIpvYearData(returnedData);

        })
}
//updates the current data gathered from fetchmonth function
function updateIpvYearData(newdata){
    ipvInfant.data=newdata.infdataYr;
    ipvMinor.data=newdata.mindataYr;
    ipvlineChart.update();
}
function fetchIpvOvall(value){
    $.post("../timeProcesses/ipvData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateIpvOvData(returnedData);

        })
}
// updates the current data gathered from fetchOvall function
function updateIpvOvData(newdata){
    ipvInfant.data=newdata.infdataOv;
    ipvMinor.data=newdata.mindataOv;
    ipvlineChart.update();
}
// ! End of IPV Functions

// *BCG FUNCTIONS
//triggers when week button is clicked
$(document).ready(function (){
    $("#wk3").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("wk3").style.color = "#ffffff";
        document.getElementById("wk3").style.backgroundColor = "#363636";

        console.log("clicked button");
        var week = 1;
        caller2(week);
        //fetchWeek();
    })
})
//trigger upon month button click
$(document).ready(function (){
    $("#mo3").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("mo3").style.color = "#ffffff";
        document.getElementById("mo3").style.backgroundColor = "#363636";
        console.log("clicked button");
        var month = 2;
        caller2(month);
    })
})
//trigger upon year button click
$(document).ready(function (){
    $("#yr3").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("yr3").style.color = "#ffffff";
        document.getElementById("yr3").style.backgroundColor = "#363636";
        console.log("clicked button");
        var year = 3;
        caller2(year);
    })
})
//trigger upon overall button click
$(document).ready(function (){
    $("#ov3").click(function (){
        $('.timestamp').attr('style','background-color:','rgba(180, 218, 243, 0.82)');
        $('.timestamp').attr('style','color:','black');
        document.getElementById("ov3").style.color = "#ffffff";
        document.getElementById("ov3").style.backgroundColor = "#363636";
        var overall = 4;
        caller2(overall);
    })
})
//gets the json from a php
function caller2(vals){
    if (vals==1){
        fetchBcgWeek(vals);
    }else if (vals==2){
        fetchBcgMonth(vals);
    }else if(vals==3){
        fetchBcgYear(vals);
    }else if(vals==4){
        fetchBcgOvall(vals);
    }
}
//
function fetchBcgWeek(value){
    $.post("../timeProcesses/bcgData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateBcgWeekData(returnedData);
        })
}
//updates the current data gathered from fetchweek function
function updateBcgWeekData(newdata){
    bcginfant.data=newdata.infdata;
    bcgminor.data=newdata.mindata;
    bcgadult.data=newdata.addata;
    bcgsenior.data=newdata.sendata;
    bcgpwd.data=newdata.pwddata;
    bcgpregnant.data=newdata.pregdata;
    bcglineChart.update();
}

function fetchBcgMonth(value){
    $.post("../timeProcesses/bcgData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateBcgMonthData(returnedData);
        })
}
//updates the current data gathered from fetchmonth function
function updateBcgMonthData(newdata){
    bcginfant.data=newdata.infdataMo;
    bcgminor.data=newdata.mindataMo;
    bcgadult.data=newdata.addataMo;
    bcgsenior.data=newdata.sendataMo;
    bcgpwd.data=newdata.pwddataMo;
    bcgpregnant.data=newdata.pregdataMo;
    bcglineChart.update();
}
function fetchBcgYear(value){
    $.post("../timeProcesses/bcgData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);//converts json data to string so that javascript can read it
            updateBcgYearData(returnedData);

        })
}
//updates the current data gathered from fetchmonth function
function updateBcgYearData(newdata){
    bcginfant.data=newdata.infdataYr;
    bcgminor.data=newdata.mindataYr;
    bcgadult.data=newdata.addataYr;
    bcgsenior.data=newdata.sendataYr;
    bcgpwd.data=newdata.pwddataYr;
    bcgpregnant.data=newdata.pregdataYr;
    bcglineChart.update();
}
function fetchBcgOvall(value){
    $.post("../timeProcesses/bcgData.php",{ctr:value})
        .done(function (data){
            var returnedData = JSON.parse(data);
            updateBcgOvData(returnedData);

        })
}
// updates the current data gathered from fetchOvall function
function updateBcgOvData(newdata){
    bcginfant.data=newdata.infdataOv;
    bcgminor.data=newdata.mindataOv;
    bcgadult.data=newdata.addataOv;
    bcgsenior.data=newdata.sendataOv;
    bcgpwd.data=newdata.pwddataOv;
    bcgpregnant.data=newdata.pregdataOv;
    bcglineChart.update();
}
// ! End of BCG Functions