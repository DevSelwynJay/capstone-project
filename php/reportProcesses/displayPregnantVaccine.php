<?php
session_start();
$con = null;
require '../DB_Connect.php';
$arr = array();

$time = $_POST['interval'];
if($time == 'daily'){
    $time = '1 day';
    $sql = 'Select * from `vaccination_record` where `patient_type` = "Pregnant" and DATE_FORMAT(`date_given`,"%Y %M %d") = DATE_FORMAT(NOW(),"%Y %M %d")  order by `date_given` asc';
}
elseif ($time == 'weekly'){
    $time = '1 week';
    $sql = 'Select * from `vaccination_record` where `patient_type` = "Pregnant" and yearweek(`date_given`) = yearweek(NOW()) order by `date_given` asc';

}
elseif ($time == 'monthly'){
    $sql = 'Select * from `vaccination_record` where `patient_type` = "Pregnant" and MONTH(`date_given`) = MONTH(NOW()) order by `date_given` asc';
    //MONTH(`dateadded`) = MONTH(NOW())
    $time = '1 month';
}
elseif($time == 'quarterly'){
    $sql = 'Select * from `vaccination_record` where `patient_type` = "Pregnant" and QUARTER(`date_given`) = QUARTER(NOW()) order by `date_given` asc';
    $time = '1 quarter';
}
elseif ($time == 'annually'){
    $sql = 'Select * from `vaccination_record` where `patient_type` = "Pregnant" and YEAR(`date_given`) = YEAR(NOW()) order by `date_given` asc';
    //YEAR(`dateadded`) = YEAR(NOW())
    $time = '1 year';
}
else{
    $datearr = explode(',',$time);
    $startdate = $datearr[0];
    $enddate = $datearr[1];
    $sql = 'Select * from `vaccination_record` where `patient_type` = "Pregnant" and date(date_given) BETWEEN date("'.$startdate.'") and date("'.$enddate.'") order by `date_given` asc';
}
$patientqry = $sql;
$result = mysqli_query($con,$patientqry);

while ($row = mysqli_fetch_assoc($result)){
    $id = $row['patient_id'];
    $date = $row['date_given'];
    $vacName = $row['vaccine_name'].' ('.$row['vaccine_dosage'].')';
    $patientqry2 = 'Select * from `walk_in_patient` where `id` = "'.$id.'" ';
    $result2 = mysqli_query($con,$patientqry2);
    if(mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result2)) {

            $row['name'] = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
            $row['address']= 'Purok ' . $row['purok'] . ' House No.' . $row['house_no'] . ' ' . $row['address'];
            $row['gender'] = $row['gender'];
            $row['date'] = $date;
            $row['vaccineName'] = $vacName;

            $arr[] = $row;


        }



    }
}
echo json_encode($arr);


