<?php
$con = null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';
$patienttable = '';
$type = 'Add';
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
$patientqry = "Select * from `walk_in_patient` where `patient_type` = 'Minor' and `date_created` > NOW()-interval ".$time." order by `date_created` asc limit $start_from,$rpp";
$result = mysqli_query($con,$patientqry);
if(mysqli_num_rows($result)>0){
    $patienttable .= '<table class="reports__individual-reports-table">
                                <tbody>
                                   <tr>
                                      <th>Name</th>
                                      <th>Age</th>
                                      <th>Address</th>
                                      <th>Gender</th>
                                      <th>Date of Consultation</th>
                                   </tr>';
    while ($row = mysqli_fetch_assoc($result)){
        $lname = $row['last_name'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $bday = $row['birthday'];
        $purok = $row['purok'];
        $house_no = $row['house_no'];
        $address = $row['address'];
        $gender = $row['gender'];
        $today = date("YYYY-MM-DD");
        $diff = datediff(date_create($bday),date_create($today));
        $age = $diff->format('%y');

        $patienttable .='<tr>
        <td>'.$fname.' '.$mname.' '.$lname.'</td>
        <td>'.$age.'</td>
        <td>'.$purok.' '.$house_no.' '.$address.'</td>
        <td>'.$gender.'</td></tr>';
    }

}
else{
    $patienttable = "<h1 style='color: black;'>No Data Found</h1>";
    echo $patienttable;
}