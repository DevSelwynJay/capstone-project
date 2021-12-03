$(document).ready(function() {
    //Calendar instance
    $('#calendar').evoCalendar({
        'sidebarDisplayDefault': false,
        'todayHighlight': true,
        'format': 'yyyy-m-dd'
    })
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
    $.post('php/patientProcesses/retrievePatientMedicalRecord.php').done(function (data) {
        let result = JSON.parse(data);
        for (const resultElement of result) {
            alert(JSON.stringify(resultElement))
            $('#calendar').evoCalendar('addCalendarEvent', {
                id: resultElement.event_id,
                name: resultElement.medicine_name,
                description: resultElement.description,
                date: resultElement.start_date_1,
                type: ' ',
                color:"#02A9F7"
            });

        }

    })//end of post

    //just to prevent a click
    $("a").click(function (e) {
        e.preventDefault()
    })
    //========ACTIONS===============//
    $(".back-btn").click(function (){
        location.href="patient.php";
    })
    //Selected an Event
    $('#calendar').on('selectEvent', function(event, activeEvent) {
        // code here...
        //alert(activeEvent.id)
    });
    //Select a Date
    $('#calendar').on('selectDate', function(event, newDate, oldDate) {
        //alert(newDate)
    });




})//end of document ready