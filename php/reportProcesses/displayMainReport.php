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
//$medpatientqry = "Select * from `medication_record` limit $start_from,$rpp";

//Official Query
$medpatientqry = "Select * from `medication_record` where DATE_FORMAT(date_given,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') limit $start_from,$rpp";
$medresult = mysqli_query($con,$medpatientqry);

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
        <td data-label="Patient Name">'.$fname.' '.$mname.' '.$lname.'</td>
        <td data-label="Patient Type">'.$type.'</td>
        <td data-label="Consultation Type">Medication</td></tr>';
        }
    }
}

$reportable .='</tbody></table><br><div align="center">';
    $medpage = "Select * from `medication_record` where DATE_FORMAT(date_given,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')";

    $page_result = mysqli_query($con, $medpage);

    $medcount = mysqli_num_rows($page_result);
    $total_record = mysqli_num_rows($page_result);

    $total_pages = ceil($total_record/$rpp);
    if($total_record <= $rpp){

    }
    else{
        for ($i = 1; $i <= $total_pages; $i++) {
            $reportable .= '<span class="pagination_link" style="cursor:pointer;padding:5px 5px;"id="' . $i . '">' . $i . '</span>';
        }
    }
    $reportable .= '</div>';
echo $reportable;
}
else{
    $reportable = "<h1 style='color: black;'>No Consultations Today</h1>";
    echo $reportable;
}

