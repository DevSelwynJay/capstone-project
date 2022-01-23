<?php
session_start();
$con = null;
require '../DB_Connect.php';
$arr = array();

$time = $_POST['interval'];
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
$patientqry = "Select * from `vaccination_record` where `patient_type` = 'Adult' and `date_given` > NOW()-interval ".$time." order by `date_given` asc";
$result = mysqli_query($con,$patientqry);

    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['patient_id'];
        $date = $row['date_given'];
        $patientqry2 = 'Select * from `walk_in_patient` where `id` = "'.$id.'" ';
        $result2 = mysqli_query($con,$patientqry2);
        if(mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_assoc($result2)) {

                $row['name'] = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                $row['address']= 'Purok ' . $row['purok'] . ' House No.' . $row['house_no'] . ' ' . $row['address'];
                $row['gender'] = $row['gender'];
                $row['date'] = $date;

                $arr[] = $row;


            }



        }
    }
echo json_encode($arr);


