<?php
$con = null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';

$reportable ='';
//Query for the mean time
$medpatientqry = "Select * from `medication_record`";
$vacpatientqry = "Select * from `vaccination_record`";
/*Official Query
$medpatientqry = "Select * from `medication_record` where `date_given` > NOW()";
$vacpatientqry = "Select * from `vaccination_record`where `date_given` > NOW()";*/
$medresult = mysqli_query($con,$medpatientqry);
$vacresult = mysqli_query($con,$vacpatientqry);
if(mysqli_num_rows($medresult)>0 || mysqli_num_rows($vacresult)>0){
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
    $patientmedqry = 'Select * from `walk_in_patient` where `id` = "'.$idmed.'" ';
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
        <td>Medication</td>';
        }
    }
}
while($rowvac = mysqli_fetch_assoc($vacresult)){
    $idvac = $rowvac['patient_id'];
    $datevac = $rowvac['date_given'];
    $patientvacqry = 'Select * from `walk_in_patient` where `id` = "'.$idvac.'" ';
    $vacresult2 = mysqli_query($con,$patientvacqry);
    if(mysqli_num_rows($vacresult2)>0){
        while($rowresult2 = mysqli_fetch_assoc($vacresult2)){
            $lname = $rowresult2['last_name'];
            $fname = $rowresult2['first_name'];
            $mname = $rowresult2['middle_name'];
            $type = $rowresult2['patient_type'];

            $reportable .='<tr>
        <td>'.$fname.' '.$mname.' '.$lname.'</td>
        <td>'.$type.'</td>
        <td>Vacination</td>';
        }
    }
}
$reportable .='</tbody></table>';
echo $reportable;
}
else{
    $reportable = "<h1 style='color: black;'>No Consultations Today</h1>";
    echo $reportable;
}

