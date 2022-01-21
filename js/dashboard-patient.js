$(document).ready(function (e) {
    //Calendar instance
    function calendar_instance() {
        $('#calendar').evoCalendar({
            'sidebarDisplayDefault': false,
            'todayHighlight': false,
            'format': 'yyyy-m-dd',

        })
        //some custome style
        $(".day.calendar-today.calendar-active").css("background","#E4E4E4")
        $(".day.calendar-today.calendar-active").css("color","#585858")
    }
    calendar_instance();

    //Retrieve patient medical record and put in calendar
    function retrievePatientMedicationRecord(){
        $.post('php/patientSide/retrievePatientMedicationRecord.php').done(function (data) {
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
    }
    retrievePatientMedicationRecord()

    function getDatesFromRange(start,end,resultElement) {//for every individual record
        //tatawagin to ni  retrievePatientMedicationRecord()
        //ung function nato nasa loob ng for loop

        //ung start at end date na amy 1 sa dulo nkaformat naun as yyyy-mm-dd
        if(end==null||end==""||end=="0000-00-00"){//walang end date
            end = start
        }

        $.post('php/getDatesFromRange.php',{start_date:start,
            end_date:end,
            interval_days:resultElement.interval_days
        }).done(function (data) {

            //generate unique color for each medicine
            function generateDarkColorHex() {
                let color = "#";
                for (let i = 0; i < 3; i++)
                    color += ("0" + Math.floor(Math.random() * Math.pow(16, 2) / 2).toString(16)).slice(-2);
                return color;
            }
            let event_color = generateDarkColorHex();

            let dates = JSON.parse(data);
            let duration = dates.length
            console.log(duration)
            for (const date of dates) {//add the same event on different days

                let interval = resultElement.interval_days;// if daily or with interval
                let freq_sentence = ""
                if(interval==0){
                    freq_sentence = "Daily"
                }
                else {
                    freq_sentence = "With "+interval+" day/s of interval"
                }

                let formattedMedName = resultElement.medicine_name.substr(0,1).toUpperCase()+resultElement.medicine_name.substr(1).toLowerCase()
                $('#calendar').evoCalendar('addCalendarEvent', {
                    id: resultElement.event_id,
                    name: formattedMedName,
                    description:
                        "<strong>Type</strong>" +
                        "<br> - Medicine: "+resultElement.medicine_sub_category+ "<br><br>"+
                        "<strong>Strenght</strong>" +
                        "<br> - "+resultElement.dosage+
                        "<br><br>"+
                        "<strong>Frequency</strong>" +
                        "<br> - "+resultElement.no_times+" times a day"+
                        "<br> - "+freq_sentence+
                        "<br> - Duration of "+duration+" day/s"+
                        "<br><br><strong>Description: </strong><br>"+resultElement.description+
                        "<br><br><strong>Start of Medication</strong>" +
                        "<br> - "+resultElement.start_date_formatted+
                        "<br><br><strong>End of Medication</strong>" +
                        "<br> - "+resultElement.end_date_formatted+
                        "<br><br>"+"<strong>Date Received: </strong> "+resultElement.date_given+
                        "<br>"+"<strong>Quantity Received: </strong> "+resultElement.given_med_quantity +" tablets"
                    ,
                    date: date,
                    type: ' ',
                    color:event_color
                });
            }

        })//post end
    }

    function retrieveCurrentMedication(){
        let header = "<tr>\n" +
            "                                       <th>Name</th>\n" +
            "                                       <th>Times per day</th>\n" +
            "                                       <th>Duration</th>\n" +
            "                                    </tr>"
        $("#curr-med").html("").append(header)
         $.post("php/patientSide/retrieveCurrentMedication.php").done(function (data) {
             let result = JSON.parse(data);

             if(result.length==0){
                 $("#curr-med").html("")
                 $("#curr-med").append("<h5 style='color:var(--third-color);'>No Record Available</h5>")
                 return
             }

             for (const resultElement of result) {
                 $("#curr-med").append("" +
                     "<tr>" +
                             "<td data-label='Name'>" +  resultElement.medicine_name + " (" + resultElement.dosage + ")" + "</td>" +
                             "<td data-label='Times per day'>" + resultElement.no_times + "</td>" +
                             "<td data-label='Duration'>" + resultElement.duration_days+  " day/s, Until " +  resultElement.end_date  +"</td>" +
                     "</tr>")
             }
         })
    }
    retrieveCurrentMedication();

    //retrieve Vaccination Record and put in calendar
    function retrievePatientVaccinationRecord() {
        $.post('php/patientSide/PATIENTSIDEretrievePatientVaccinationRecord.php').done(function (data) {
            let result = JSON.parse(data);
            for (const resultElement of result) {

                markVaccineStartAndEnd(resultElement)

            }
        })//end of post
    }
    retrievePatientVaccinationRecord();

    function markVaccineStartAndEnd(resultElement) {

        function ordinal_suffix_of(i) {
            var j = i % 10,
                k = i % 100;
            if (j == 1 && k != 11) {
                return i + "st";
            }
            if (j == 2 && k != 12) {
                return i + "nd";
            }
            if (j == 3 && k != 13) {
                return i + "rd";
            }
            return i + "th";
        }

        let indicator =  ordinal_suffix_of(parseInt(resultElement.current_dose)+1);//1st 2nd 3rd and so on......
        function generateDarkColorHex() {
            let color = "#";
            for (let i = 0; i < 3; i++)
                color += ("0" + Math.floor(Math.random() * Math.pow(16, 2) / 2).toString(16)).slice(-2);
            return color;
        }
        let event_color = generateDarkColorHex();

        //let formattedMedName = resultElement.vaccine_name.substr(0,1).toUpperCase()+resultElement.vaccine_name.substr(1).toLowerCase()
        $('#calendar').evoCalendar('addCalendarEvent', [{
                id: resultElement.event_id,
                name: resultElement.vaccine_name,
                description:
                    "<strong><span style='color:darkblue;'>Status:</span> Dose "+resultElement.current_dose+" of "+resultElement.reccommended_no_of_dosage+"</strong><br><br>" +
                    "<strong>Type</strong>" +
                    "<br> - Vaccine: "+resultElement.vaccine_sub_category+ "<br><br>"+
                    "<strong>Strength</strong>" +
                    "<br> - "+resultElement.vaccine_dosage+
                    "<br><br>"+
                    "<strong>Required No. of Dosage</strong>" +
                    "<br> - "+resultElement.reccommended_no_of_dosage+" dose"+
                    // "<br> - "+freq_sentence+
                    // "<br> - Duration of "+duration+" day/s"+
                    "<br><br><strong>Description: </strong><br>"+resultElement.description+
                    "<br><br><strong>Date Vaccinated:</strong>" +
                    "<br> - "+resultElement.date_vaccinated_fd+
                    "<br><br><strong>Expected Next Schedule</strong>" +
                    "<br> - "+resultElement.next_date_fd
                // "<br><br>"+"<strong>Date of First Dose: </strong> "+resultElement.date_given
                ,
                date: resultElement.date_vaccinated,//date vaccinated
                type: ' ',
                color:event_color
            },
                {
                    id: resultElement.event_id,
                    name:resultElement.vaccine_name,
                    description:
                    //Note: Expected Next Schedule for the 2nd dose of Vaccine Name
                        "<strong> <span style='color: darkred'>Note:<br></span>Expected Schedule for<br> " +indicator+" Dose of "+resultElement.vaccine_name+"</strong><br><br>" +
                        // "<strong><span style='color:darkblue;'>Status:</span> Dose "+resultElement.current_dose+" of "+resultElement.reccommended_no_of_dosage+"</strong>" +
                        // "<br><br>"+
                        "<strong>Type</strong>" +
                        "<br> - Vaccine: "+resultElement.vaccine_sub_category+ "<br><br>"+
                        "<strong>Strength</strong>" +
                        "<br> - "+resultElement.vaccine_dosage+
                        // "<br><br>"+
                        // "<strong>Required No. of Dosage</strong>" +
                        // "<br> - "+resultElement.reccommended_no_of_dosage+" dose"+
                        // "<br> - "+freq_sentence+
                        // "<br> - Duration of "+duration+" day/s"+
                        "<br><br><strong>Last Vaccinated on:</strong>" +
                        "<br> - "+resultElement.date_vaccinated_fd
                    // "<br><br><strong>Next Date of Vaccination</strong>" +
                    // "<br> - "+resultElement.next_date_fd
                    // "<br><br>"+"<strong>Date of First Dose: </strong> "+resultElement.date_given
                    ,
                    date: resultElement.next_date,//next schedule
                    type: ' ',
                    color:event_color
                }]
        );


    }

    function getVaccineSchedule() {

        $("#vacc-sched").html("").append("<tbody id='vac-sched-tbody'></tbody>")
        $("#vac-sched-tbody").append("" +
            "<tr>" +
                "<th>Name</th>"+
                "<th>Next Shedule</th>"+
            "</tr>")

        $.post("php/patientSide/getVaccineSched.php").done(
            function (data) {
                let result = JSON.parse(data)

                if(result.length==0){
                    $("#vac-sched-tbody").html("")
                    $("#vac-sched-tbody").append("<h5 style='color:var(--third-color);'>No Record Available</h5>")
                    return
                }

                for (const resultElement of result) {

                    let nextSched = resultElement.next_sched
                    let curr_dose = resultElement.curr_dose
                    let rec_no_dose = resultElement.rec_no_dose


                    if(resultElement.next_sched==null){
                        nextSched = "none"
                    }

                    $("#vac-sched-tbody").append(
                        "<tr>" +
                        "<td data-label='Name'>"+resultElement.vaccine_name+" <span style='font-size: 1rem'>(Dose "+curr_dose+" of "+rec_no_dose+")</span></td>" +
                        "<td data-label='Next Shedule'>"+nextSched+"</td>" +
                        "<tr>" +
                    "")
                }

            }
        )
    }
    getVaccineSchedule()

    let eventTogglerCounter = 1;
    function calendar_actions() {
        //Calendar UI fix ================================--
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
            $('#calendar').evoCalendar('toggleSidebar',false);
            $(".calendar-events").css("z-index","999")
            eventTogglerCounter = 1;
        });
        // selectMonth
        $('#calendar').on('selectMonth', function(event, activeMonth, monthIndex) {
            $('#calendar').evoCalendar('toggleEventList',false);
        });
        // selectYear
        $('#calendar').on('selectYear', function(event, activeYear) {
            $('#calendar').evoCalendar('toggleEventList',false);
        });

        //fix overlap

        //sidebar left
        $("#sidebarToggler").on('click',function () {
            $('#calendar').evoCalendar('toggleEventList',false);
            $(".calendar-events").css("z-index","unset")
            eventTogglerCounter = 0;

        })
        //side bar right
        $("#eventListToggler").click(function () {

            $('#calendar').evoCalendar('toggleSidebar',false);

            if($(document).width()<=768){
                $(".calendar-events").css("z-index","999")
                eventTogglerCounter = 1;
                return
            }
            if(eventTogglerCounter==1){
                $(".calendar-events").css("z-index","unset")
                eventTogglerCounter = 0;
            }
            else {
                $(".calendar-events").css("z-index","999")
                eventTogglerCounter = 1;
            }

        })
    }
    calendar_actions()

    $(window).resize(function () {//custom css is removed when resizing resulting to magulong layout
        //alert($(document).width())
        //to fix this are the code

        $(".calendar-events").css("z-index","999")
        eventTogglerCounter = 1;

        // alert("resixe")
        adjustZoom()
    })
    adjustZoom();
})

function adjustZoom() {
    // document.body.style.zoom = "90%";
    if($(document).width()<=1200){
        // document.body.style.zoom = "100%";
        $(".patient-content__container").css("zoom","100%")
    }
    else if($(document).width()<=1400){
        // document.body.style.zoom = "80%";
        $(".patient-content__container").css("zoom","82%")
    }
    else if($(document).width()<=1600){
        // document.body.style.zoom = "90%";
        $(".patient-content__container").css("zoom","85%")
    }
    else if($(document).width()<=2000){
        // document.body.style.zoom = "100%";
        $(".patient-content__container").css("zoom","92%")
    }
    else {
        $(".patient-content__container").css("zoom","100%")
    }
}