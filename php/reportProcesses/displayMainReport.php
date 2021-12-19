<?php
$con = null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';

$reportable ='';

$patientqry = "Select * from `walk_in_patient`";
$result = mysqli_query($con,$patientqry);
if(mysqli_num_rows($result)>0){
    $reportable .= '<table class="reports__table"><tbody>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                        </tr>';

    while($row = mysqli_fetch_assoc($result)) {
        $lname = $row['last_name'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $type = $row['patient_type'];

        $reportable .='<tr>
        <td>'.$fname.' '.$mname.' '.$lname.'</td>
        <td>'.$type.'</td>';

    }
    $reportable .='</tbody></table>';
    echo $reportable;


}
else{

    $reportable = "<h1>No Data Found</h1>";
    echo $reportable;
}
