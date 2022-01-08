<?php
$con = null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';

$reportable ='';
if(isset($_POST['page'])){
    $page = $_POST['page'];
}
else{
    $page = 1;
}
$start_from = ($page - 1)*$rpp;
//Query for the mean time
$vacpatientqry = "Select * from `vaccination_record` limit $start_from,$rpp";

/*Official Query

$vacpatientqry = "Select * from `vaccination_record`where `date_given` > NOW() limit $start_from,$rpp";*/
$medresult = mysqli_query($con,$vacpatientqry);

if(mysqli_num_rows($medresult)>0){
    $reportable .= '
                    <table class="reports__table"><tbody>
                        <tr>
                            <th>Name</th>
                            <th>Patient Type</th>
                            <th>Consultation Type</th>
                        </tr>';
    while($rowmed = mysqli_fetch_assoc($medresult)){
        $idmed = $rowmed['patient_id'];
        $datemed = $rowmed ['date_given'];
        $patientmedqry = "Select * from `walk_in_patient` where `id` = '".$idmed."' ";
        $medresult2 = mysqli_query($con,$patientmedqry);
        if(mysqli_num_rows($medresult2)>0){
            while($rowresult = mysqli_fetch_assoc($medresult2)){
                $lname = $rowresult['last_name'];
                $fname = $rowresult['first_name'];
                $mname = $rowresult['middle_name'];
                $type = $rowresult['patient_type'];

                $reportable .='<tr>
        <td>'.$fname.' '.$mname.' '.$lname.'</td>
        <td>'.$type.'</td>
        <td>Vaccination</td></tr>';
            }
        }
    }

    $reportable .='</tbody></table><br><div align="center">';
   /* $medpage = "Select * from `vaccination_record`where `date_given` > NOW()";*/
    $medpage = "Select * from `vaccination_record`";

    $page_result = mysqli_query($con, $medpage);

    $medcount = mysqli_num_rows($page_result);
    $total_record = mysqli_num_rows($page_result);

    $total_pages = ceil($total_record/$rpp);
    if($total_record <= $rpp){

    }
    else{
        for ($i = 1; $i <= $total_pages; $i++) {
            $reportable .= '<span class="pagination_link2" style="cursor:pointer;padding:5px 5px;"id="' . $i . '">' . $i . '</span>';
        }
    }
    $reportable .= '</div>';
    echo $reportable;
}
else{
    $reportable = "<h1 style='color: black;'>No Consultations Today</h1>";
    echo $reportable;
}
