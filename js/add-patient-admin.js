$(document).ready(function () {
  //action=========
    $("#trigger-add-patient-modal").on('click',function(e){
        //validation
        e.preventDefault()

        let patientType = $('[name="patient-type"]:checked').val()
        let fname = $('[name="fname"]').val()
        let mname = $('[name="mname"]').val()
        let lname = $('[name="lname"]').val()
        let suffix =$('[name="suffix"]').val() // not required
        let occu = $('[name="occupation"]').val()// not required
        let civil = $('[name="civil_status"]').val()
        let email = $('[name="email"]').val()
        let contact = $('[name="contact"]').val()
        let gender = $('[name="gender"]').val()
        let bday = $('[name="bday"]').val()
        let purok = $('[name="purok"]').val()
        let house_no = $('[name="house_no"]').val()// not required

        let bloodType　=　$("#blood-type").val();
        let height　=　$("#height").val();
        let weight　=　$("#weight").val();

        if (fname == "" || mname == "" || lname == "" ||patientType==""|| civil == "" ||
            gender == "" || bday == "" || purok == "") {
            console.log("fill all the field")//html form bahala sa pag notify kung kumpleto na
            $("#pop-up-error").modal(
                {
                    escapeClose:false,
                    showClose:false
                }
            )
            $("#pop-up-error-message").html("Please fill all the required fields!")
            return
        }//if

            //pag oks na lahat ng  input
            //show add patient confirm modal
            $("#pop-up-confirm-add-patient").modal(
                {
                    escapeClose:false,
                    showClose:false
                }
            )
            //action for adding patient
            $("#final-confirm-add-patient-btn").off('click')
            $("#final-confirm-add-patient-btn").on('click',function (e) {

                $("#pop-up-loading").modal({
                    showClose:false,clickClose:false,escapeClose:false
                })

                $.post("php/addPatientAdmin/AddPatientAdmin.php",{
                    fname:fname, mname:mname, lname:lname, suffix:suffix,
                    occu:occu,
                    civil:civil,
                    email:email,
                    contact:contact,
                    gender:gender,
                    bday:bday,
                    purok:purok, house_no:house_no,
                    bloodType:bloodType, height:height, weight:weight,
                    patientType:patientType
                }).done(
                    function (data) {


                        if(data==1){
                            setTimeout(()=>{
                                $("#pop-up-success").modal({
                                    showClose:false,
                                    escapeClose:false
                                })
                            },1000)
                        }
                        else{
                            setTimeout(()=>{
                                $("#pop-up-error").modal({
                                    showClose:false,
                                    escapeClose:false
                                })
                                $("#pop-up-error-message").html(data)
                                console.log(data)
                            },1000)
                        }
                    }
                )
            })

    })//click
})//document