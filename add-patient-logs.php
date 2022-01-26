<script>
    $("#logs-btn").click(function () {
        $("#pop-up-logs-acc-req").modal()
    })
</script>
<div class="modal modal-full-width" id="pop-up-logs-acc-req">
    <div class="content patients-view-container margin-top-3">


        <h3 style="color: var(--third-color)" class=""><i class="fas fa-history"></i>Account Request Logs</h3>

        <?php require 'logs/logs-search.html' ?>

        <table class="patients-view">
            <tbody id="logs-patient-view-table">
            <tr class="patients-view-title">
                <th>Patient Id</th>
                <th>Patient Name</th>
                <th>Address</th>
                <th>Age</th>
                <th>Gender</th>
            </tr>
            <tr class='clickable-row' data-href='http://localhost/capstone-project/individual-patient.php'>
                <td>01</td>
                <td>Name</td>
                <td>Hagonoy</th>
                <td>21</td>
                <td>M</td>
            </tr>
            <tr>
                <td>02</td>
                <td>Name</td>
                <td>Hagonoy</th>
                <td>21</td>
                <td>M</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        var table = $('#logs-patient-view-table').tableSortable({
            data: [],
            columns:
                {
                    action:"Action",
                    admin:"Admin",
                    // address:"Address",
                    // contact_no: "Contact",
                    // email:'Email',
                    date:"Date"
                }
            ,
            searchField: '.search-bar',
            // responsive: {
            //     720: {
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     },
            //     512:{
            //         columns: {
            //             // id: "ID",
            //             name:"Name",
            //             date:"Date Requested",
            //             button:"Action"
            //         },
            //     }
            // },
            rowsPerPage: 5,
            pagination: true,
            tableWillMount: function() {
                console.log('table will mount')
            },
            tableDidMount: function() {
                console.log('table did mount')
            },
            tableWillUpdate: function() {console.log('table will update')},
            tableDidUpdate: function() {
                if($("#logs-patient-view-table div .gs-table tbody tr").length==0){
                    let searchVal = "for "+ $("#search-logs").val()
                    $("#logs-patient-view-table div .gs-table tbody").html("").append("<tr style='pointer-events: none'><td colspan='3'><h3 style='text-align: center;width: 100%;color: var(--third-color)'>No Record "+searchVal+"</h3></td></tr>")
                }

                // console.log('table did update');  click_view_button();
                $("#logs-patient-view-table div .gs-table thead tr th").css("background","darkslategrey")
                for (a=0;a<parseInt( window.rowCount_logs_acc_req);a++){
                    $($($("#logs-patient-view-table div .gs-table-body").children()[a]).children()[0]).css("font-weight","500")
                }
                //thead color
                $("#logs-patient-view-table div .gs-table thead tr th").css("background","darkslategrey")
            },
            tableWillUnmount: function() {console.log('table will unmount')},
            tableDidUnmount: function() {console.log('table did unmount')},
            onPaginationChange: function(nextPage, setPage) {
                setPage(nextPage);
            }
        });
        $.get('logs/logs-add-walkin.php', function(data) {
            // Push data into existing data
            console.log(JSON.parse(data))
            if(JSON.parse(data).length==0){
                $("#logs-patient-view-table div .gs-table tbody").html("").append("<tr style='pointer-events: none'><td colspan='3'><h3 style='text-align: center;width: 100%;color: var(--third-color)'>No Record</h3></td></tr>")
                return
            }
            //table.setData(JSON.parse(data), null, true);
            window.rowCount_logs_acc_req = JSON.parse(data).length;
            // or Set new data on table, columns is optional.
            table.setData(JSON.parse(data),{
                // id: "ID",
                action:"Action",
                // address:"Address",
                // contact_no: "Contact",
                // email:'Email',
                admin_name:"Admin",
                date_occured:"Date"
            });
        })
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
        //thead color
        $("#logs-patient-view-table div .gs-table thead tr th").css("background","darkslategrey")


    })//document ready
</script>
<!--Pagination table style-->
<style>
    .active{
        background: var(--primary-color)!important;
        color: var(--secondary-color)!important;
        border:none!important;
        padding: 0.5em 0.5rem!important;
    }
    .btn-default{
        border:1px solid var(--light-grey)!important;
        padding: 0.5em 0.5rem!important;
    }
    .gs-pagination{
        margin-top: 0.5em;
    }
    .gs-pagination .row .col-md-6 span{
        font-size: clamp(0.4rem,0.8rem,1rem);
    }
    .gs-button,.gs-button span{
        color: var(--secondary-color);
    }
    th{
        background: var(--primary-color);
    }
    .btn-group button,.btn-group button span{/*sa pagination na button*/
        outline: none;
        padding: 0.2em 0.3rem;
    }
    button.view{
        padding: 0.5em;
        border:none;
        outline: none;
        background: var(--primary-color);
        color: var(--secondary-color);
    }
    @media(max-width: 1150px) {
        td{
            font-size: clamp(0.4rem,0.8rem,1rem);
        }
    }
    #logs-patient-view-table div .gs-table thead tr th{
        background: darkslategray!important;
    }

</style>
