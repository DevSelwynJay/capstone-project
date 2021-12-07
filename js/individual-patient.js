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
    function getDatesFromRange(start,end,resultElement) {//for every individual record

        $.post('php/getDatesFromRange.php',{start_date:start,
            end_date:end,
            interval_days:resultElement.interval_days
        }).done(function (data) {
            let dates = JSON.parse(data);
            let duration = JSON.stringify(dates.length)
            for (const date of dates) {//add the same event on different days

                let interval = resultElement.interval_days;// if daily or with interval
                let freq_sentence = ""
                if(interval==0){
                    freq_sentence = "Daily"
                }
                else {
                    freq_sentence = "with "+interval+" day/s of interval"
                }

                $('#calendar').evoCalendar('addCalendarEvent', {
                    id: resultElement.event_id,
                    name: resultElement.medicine_name,
                    description:
                        "<strong>Frequency</strong>" +
                        "<br> - "+resultElement.no_times+" times a day"+
                        "<br> - "+freq_sentence+
                        "<br><br><strong>Description: </strong><br>"+resultElement.description+
                        "<br><br><strong>Medication Started</strong>" +
                        "<br> - "+resultElement.start_date_formatted+
                        +"<br>"+ duration+
                        "<br><br>"+"<strong>Date Given: </strong>"+resultElement.date_given
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