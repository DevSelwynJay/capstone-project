<?php
$con = null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';
$patienttable = '';

$time = $_POST['interval'];



if(isset($_POST['page'])){
    $page = $_POST['page'];
}
else{
    $page = 1;
}
$start_from = ($page - 1)*$rpp;
if($time == 'daily'){
    $time = '1 day';
}
elseif ($time == 'weekly'){
    $time = '1 week';
}
elseif ($time == 'monthly'){
    $time = '1 month';
}
elseif($time == 'quarterly'){
    $time = '1 quarter';
}
elseif ($time == 'annually'){
    $time = '1 year';
}
$patientqry = "Select * from `vaccination_record` where `patient_type` = 'Adult' and `date_given` > NOW()-interval ".$time." order by `date_given` asc limit $start_from,$rpp";
$result = mysqli_query($con,$patientqry);
if(mysqli_num_rows($result)>0){
    $patienttable .= '<table class="reports__individual-reports-table">
                                <tbody>
                                   <tr>
                                      <th>Name</th>
                                      
                                      <th>Address</th>
                                      <th>Gender</th>
                                      <th>Date of Consultation</th>
                                   </tr>';
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['patient_id'];
        $date = $row['date_given'];
        $patientqry2 = 'Select * from `walk_in_patient` where `id` = "'.$id.'" ';
        $result2 = mysqli_query($con,$patientqry2);
        if(mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $lname = $row['last_name'];
                $fname = $row['first_name'];
                $mname = $row['middle_name'];
                $bday = $row['birthday'];
                $purok = $row['purok'];
                $house_no = $row['house_no'];
                $address = $row['address'];
                $gender = $row['gender'];

                $patienttable .= '<tr>
        <td>' . $fname . ' ' . $mname . ' ' . $lname . '</td>
        
        <td>Purok ' . $purok . ' House No.' . $house_no . ' ' . $address . '</td>
        <td>' . $gender . '</td>
        <td>' . $date . '</td></tr>';
            }

        }
    }
    $patienttable .= '</tbody></table><br><div align="center">';
    $page_qry = "Select * from `vaccination_record` where `patient_type` = 'Adult' and `date_given` > NOW()-interval ".$time." order by `date_given` asc";
    $page_result = mysqli_query($con, $page_qry);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records / $rpp);
    if($total_records <= $rpp){

    }
    else{
        for ($i = 1; $i <= $total_pages; $i++) {
            $patienttable .= '<span class="pagination_linkadult" style="cursor:pointer;padding:6px;border:1px solid #ccc;"id="' . $i . '">' . $i . '</span>';
        }
    }

    echo $patienttable;

}
else{
    $patienttable = "<h1 style='color: black;'>No Data Found</h1>";
    echo $patienttable;
}