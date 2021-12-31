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
             for (const resultElement of result) {
                 $("#curr-med").append("" +
                     "<tr>" +
                             "<td>" +  resultElement.medicine_name + " (" + resultElement.dosage + ")" + "</td>" +
                             "<td>" + resultElement.no_times + "</td>" +
                             "<td>" + resultElement.duration_days+  " day/s, Until " +  resultElement.end_date  +"</td>" +
                     "</tr>")
             }
         })
    }
    retrieveCurrentMedication();

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
})