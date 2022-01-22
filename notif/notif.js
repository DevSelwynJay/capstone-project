$(document).ready(function () {
    function getNotif() {
        $.post("notif/getNotif_1.php").done(function (data) {
            let notifMessages = JSON.parse(data);//get notif messages

            $(".counter").css("visibility","hidden")//hide first the counter
            $(".notification-dropdown").html("")//reset notification items

            if(notifMessages.length==0){//pag walang notif stop ang code
                $(".notification-dropdown").html("<li>No new notification</li>")//reset notification items
                return
            }
            // alert("may laman")
            for (const notifMessage of notifMessages) {
                $(".notification-dropdown").append(notifMessage)
            }

            //put notification count
            let notif_count = $(".notification-dropdown li").length;
            $(".counter").html(notif_count).css("visibility","visible")
            // alert()
        })
    }//end of function
    getNotif()
    setInterval(()=>{
        getNotif()
    },6000)

})