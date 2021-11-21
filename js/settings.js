let birthday=""
let bdayISO=""
window.onload = function () {
$.post("php/settingsProcesses/showInfo.php").done(function (data) {
    let result = JSON.parse(data)
    //alert(result)
    $("#fname").html(result.fname); $("#fname-edit-2").val(result.fname);
    $("#mname").html(result.mname);$("#mname-edit-2").val(result.mname);
    $("#lname").html(result.lname);  $("#lname-edit-2").val(result.lname);
    $("#gender").html(result.gender)
    $("#age").html(result.age);$("#age-edit-2").val(result.age)
    $("#bday").html(result.bday); $("#bday-edit-2").val(result.bday)
    bdayISO = result.bdayISO
    $("#address").html(result.address); $("#address-edit-2").val(result.address)
})

    $(".save-changes").prop('disabled',true).css('background',"#6D6D6D")
}//
//=============
$(document).ready(function () {


    //click
    $("tr .fa-edit").click(function () {
       let selected_ID = $(this).prop('id')
        setTimeout(function () {
            $("#edit-modal").modal({
                //escapeClose: false,
                clickClose: false,
                showClose: false
            })
            $("#"+selected_ID+"-2").trigger('focus')
            let gender = $("#gender").html()
            //alert(gender)
            $("#"+gender).prop('selected',true)
            $(".modal").css('padding',"1rem")
        },300)
    })

    $("#bday-edit-2").datepicker({
        dateFormat: 'yy-mm-dd',
        defaultDate: '2005-01-01',
        changeMonth: true,
        changeYear: true,
        yearRange:'1900:new Date()',
        maxDate: new Date(),
    })
    $("#bday-edit-2").focus(function () {
        $(".ui-datepicker-month").css("padding","1px").css("margin-right","0.5rem").css("border-radius","0.2rem").css("border","none")
        $(".ui-datepicker-year").css("padding","1px").css("border-radius","0.2rem").css("border","none")
        console.log($(this).val())
    })
    $("#okay-edit-btn").on('click',function () {
        birthday = $("#bday-edit-2").val();
        //alert(birthday)
        let date= new Date($("#bday-edit-2").val())
        const options = {  year: 'numeric', month: 'long', day: 'numeric' };
        $("#bday").html(date.toLocaleDateString(undefined,options))

        $("#fname").html($("#fname-edit-2").val());
        $("#mname").html($("#mname-edit-2").val());;
        $("#lname").html($("#lname-edit-2").val());
        $("#gender").html($("#gender-edit-2").val());
        //$("#age").html(result.age);$("#age-edit-2").val(result.age)
        $("#address").html($("#address-edit-2").val());
        $(".save-changes").prop('disabled',false).css('background',"#02A9F7")
        $("[href='#edit-modal']").trigger('click')
    })
    $(".save-changes").on('click',function () {
        $("#confirm-changes").modal({
            //escapeClose: false,
            //clickClose: false,
            showClose: false
        })
    })
    $("#confirm-changes-ok-btn").click(function () {
        $("#pop-up-loading").modal({
            escapeClose: false,
            clickClose: false,
            showClose: false
        })
        let bday_txt = $("#bday-edit-2").val();
        if(bday_txt.length>10){
            birthday = bdayISO
        }
        //$("[href='#confirm-changes']").trigger('click')
        $.post('php/settingsProcesses/updatePersonal.php',{
            fname:$("#fname").html(),
            mname:$("#mname").html(),
            lname:$("#lname").html(),
            gender:$("#gender").html(),
            bday:birthday,
            address:$("#address").html()


        }).done(function (data) {
            setTimeout(function (data) {
                location.reload()
            },2000)

        })
    })

    address_autocomlete()

    /*convert date to string
    date= new Date("1999-01-24")
    const options = {  year: 'numeric', month: 'long', day: 'numeric' };
    alert(date.toLocaleDateString(undefined,options))*/
})//end od ready
//======================functions========================================
function address_autocomlete() {
    //$("#address-edit-2").autocomplete({
    //  source:['Sto. Rosario Paombong Bulacan',"Paombong","Bulacan"]
    //})
    function split( val ) {
        return val.split( / \s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }

    $( "#address-edit-2" )
        // don't navigate away from the field on tab when selecting an item
        .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 0,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                response( $.ui.autocomplete.filter(
                    ['Sto. Rosario Paombong Bulacan',"Paombong","Bulacan","Purok"], extractLast( request.term ) ) );
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( " " );
                return false;
            }
        });
}//
