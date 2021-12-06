$(document).ready(function() {
    //Calendar instance
    $('#calendar').evoCalendar({
        'sidebarDisplayDefault': false,
        'todayHighlight': true,
        'format': 'yyyy-m-dd',

    })
    //some custome style
    $(".day.calendar-today.calendar-active").css("background","#E4E4E4")
    $(".day.calendar-today.calendar-active").css("color","#585858")
    //this object has fixed key needed sa calendar
    let eventObject = {
        id: ' ',
        name: ' ',
        description: ' ',
        date: ' ',
        type: ' ',
        color:' '
    }
    let prescription = []//over all event ni patient
    //Retrieve patient medical record and put in calendar
    $.post('php/patientProcesses/retrievePatientMedicationRecord.php').done(function (data) {
        let result = JSON.parse(data);
        for (const resultElement of result) {
            getDatesFromRange( resultElement.start_date_1, resultElement.end_date_1,resultElement)
            //alert(JSON.stringify(resultElement))
            // $('#calendar').evoCalendar('addCalendarEvent', {
            //     id: resultElement.event_id,
            //     name: resultElement.medicine_name,
            //     description: resultElement.description,
            //     date: resultElement.start_date_1,
            //     type: ' ',
            //     color:"#02A9F7"
            // });

        }

    })//end of post
    function getDatesFromRange(start,end,resultElement) {

        $.post('php/getDatesFromRange.php',{start_date:start,
            end_date:end,
            interval_days:resultElement.interval_days
        }).done(function (data) {
            let dates = JSON.parse(data);
            //alert(dates.length)

            for (const date of dates) {//add the same event on different days
                $('#calendar').evoCalendar('addCalendarEvent', {
                    id: resultElement.event_id,
                    name: resultElement.medicine_name,
                    description: "<strong>"+resultElement.no_times+" times a day</strong>" +
                        "<br><br><strong>Description: </strong>"+resultElement.description
                    ,
                    date: date,
                    type: ' ',
                    color:"#02A9F7"
                });
            }

        })//post end
    }

    //just to prevent a click
    $("a").click(function (e) {
        e.preventDefault()
    })
    //========ACTIONS===============//
    $(".back-btn").click(function (){
        location.href="patient.php";
    })
    $("#add-prescription").click(function () {

    })
    //Selected an Event
    $('#calendar').on('selectEvent', function(event, activeEvent) {
        // code here...
        //alert(activeEvent.name)
    });
    //Select a Date
    $('#calendar').on('selectDate', function(event, newDate, oldDate) {
        //alert(newDate)
        $(".event-empty p").html("No record on this day")
        $('#calendar').evoCalendar('toggleEventList',true);
    });
    // selectMonth
    $('#calendar').on('selectMonth', function(event, activeMonth, monthIndex) {
        $('#calendar').evoCalendar('toggleEventList',false);
    });
    // selectYear
    $('#calendar').on('selectYear', function(event, activeYear) {
        $('#calendar').evoCalendar('toggleEventList',false);
    });
    //sidebar left
    $("#sidebarToggler").on('click',function () {
        $('#calendar').evoCalendar('toggleEventList',false);
    })




})//end of document ready