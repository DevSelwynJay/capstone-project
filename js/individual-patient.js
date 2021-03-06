$(document).ready(function() {
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

                let edit_btn = "";
                let status =  "";
                if(resultElement.can_edit==1){// edit only if end of medication is greater than date today
                    edit_btn = "<button onclick='getEventID("+resultElement.event_id+")' class='edit-event-btn'><i class=\"fas fa-edit\"></i>edit</button><br>"
                    status = "<strong><span style='color:darkblue;'>Status:</span> Active</strong><br><br>";
                }
                else {
                    status = "<strong style='color:darkred;'><span style='color:darkblue;'>Status:</span> Finished</strong><br><br>";
                }

                let formattedMedName = resultElement.medicine_name.substr(0,1).toUpperCase()+resultElement.medicine_name.substr(1).toLowerCase()
                $('#calendar').evoCalendar('addCalendarEvent', {
                    id: resultElement.event_id,
                    name: formattedMedName,
                    description:
                        status+
                        "<strong>Type</strong>" +
                        "<br> - Medicine: "+resultElement.medicine_sub_category+ "<br><br>"+
                        "<strong>Strength</strong>" +
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
                        "<br><br>"+"<strong>Date Given: </strong> "+resultElement.date_given+
                        "<br>"+"<strong>Quantity Given: </strong> "+resultElement.given_med_quantity +" tablets<br>"+
                        "<br>"+"<strong>Given by: </strong> "+resultElement.admin_name +"<br>"+
                        edit_btn
                    ,
                    date: date,
                    type: ' ',
                    color:event_color
                });
            }

        })//post end
    }


    //retrieve Vaccination Record and put in calendar
    function retrievePatientVaccinationRecord() {
        $.post('php/patientProcesses/retrievePatientVaccinationRecord.php').done(function (data) {
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

        let edit_btn = "";
        if(resultElement.can_edit==1){
            edit_btn = "<br><button onclick='getEventIDVaccine("+resultElement.event_id+")' class='edit-event-btn'><i class=\"fas fa-edit\"></i>edit</button><br>";
        }

        let indicator =  ordinal_suffix_of(parseInt(resultElement.current_dose)+1);//1st 2nd 3rd and so on......
        function generateDarkColorHex() {
            let color = "#";
            for (let i = 0; i < 3; i++)
                color += ("0" + Math.floor(Math.random() * Math.pow(16, 2) / 2).toString(16)).slice(-2);
            return color;
        }
        let event_color = generateDarkColorHex();

            let nextSched = resultElement.next_date_fd;
            if(nextSched==null){
                nextSched = "none"
            }

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
                    "<br> - "+nextSched +
                    "<br><br>"+"<strong>Given by: </strong> "+resultElement.admin_name +"<br>"+
                    edit_btn

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

    //retrieve patient medication and vaccination history
    function retrieveHistory() {

        let historyFilter = $('[name="med-filter"]:checked').val();//All,Active,Finished
        // alert(historyFilter)

        // let header = "<tr>\n" +
        //     "                                       <th>Name</th>\n" +
        //     "                                       <th>Type</th>\n" +
        //     "                                       <th>Date Given</th>\n" +
        //     "                                       <th>Description</th>\n" +
        //     "                                    </tr>"
        // $("#patient-history-table").html("").append(header)

        //get all vaccination/medication history then put into the table
        $.post('php/patientProcesses/retrieveHistory.php',{historyFilter:historyFilter}).done(
            function (data) {//#patient-history-table
                let result = JSON.parse(data)
                console.log(result)

                 setTimeout(()=>{
                     if(result.length==0){
                         $("#pagination").tableSortable({
                             data: result,
                             columns:
                                 {
                                     name:"No Record Available",
                                 }
                         })
                         $("#close-loading").trigger('click')
                         return
                     }
                     // for (const resultElement of result) {
                     //
                     //     $("#patient-history-table").append("" +
                     //         "<tr>" +
                     //         "<td>" + resultElement.name+"</td>"+
                     //         "<td>" + resultElement.type+"</td>"+
                     //         "<td>" + resultElement.date+"</td>"+
                     //         "<td>" + resultElement.description+"</td>"+
                     //
                     //         "</tr>")
                     // }

                     var table = $("#pagination").tableSortable({
                         data: result,
                         columns:
                             {
                                 name:"Name",
                                 type:"Type",
                                 date: "Date Given",
                                 description:"Description",
                             }
                         ,
                         searchField: '.search-bar',
                         rowsPerPage: 7,
                         pagination: true,
                         tableWillMount: function() {
                             console.log('table will mount')
                         },
                         tableDidMount: function() {
                             console.log('table did mount')
                         },
                         tableWillUpdate: function() {console.log('table will update')},
                         tableDidUpdate: function() {
                             console.log('table did update')
                             //row_click()
                         },
                         tableWillUnmount: function() {console.log('table will unmount')},
                         tableDidUnmount: function() {console.log('table did unmount')},
                         onPaginationChange: function(nextPage, setPage) {
                             setPage(nextPage);
                         }
                     });

                     $('#changeRows').on('change', function() {
                         table.updateRowsPerPage(parseInt($(this).val(), 10));
                     })

                     $('#rerender').click(function() {
                         table.refresh(true);
                     })

                     $('#distory').click(function() {
                         table.distroy();
                     })

                     $('#refresh').click(function() {
                         table.refresh();
                     })

                     $('#setPage2').click(function() {
                         table.setPage(1);
                     })

                     $("#close-loading").trigger('click')
                 },350)

            }
        )
    }//end of retrieveHistory()
    retrieveHistory()

    //just to prevent a click
    // $("a").click(function (e) {
    //     e.preventDefault()
    // })
    //========ACTIONS===============//
    $(".back-btn").click(function (){
        location.href="patient.php";
    })

    ///historyFilter
    $('[name="med-filter"]').on('click',function () {
        $("#pop-up-loading").modal({
            showClose:false, clickClose:false,escapeClose:false
        })
        retrieveHistory()
    })
    //history search bar
    $("#search-med-history").focus(function () {
       // $('[value="All"]').prop('checked',true)
      //  retrieveHistory()
    })

    $("#hidden-refresh-button").click(function () {
        $('#calendar').evoCalendar('destroy');
        calendar_instance()
        calendar_actions()
        retrievePatientMedicationRecord();
        retrievePatientVaccinationRecord();
        retrieveHistory()
        //alert("na refresh si calendar")
        $(".calendar-events").css("z-index","999")
        eventTogglerCounter = 1;
    })


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
})//end of document ready


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