<?php
session_start();
//the id from walk in patient to get the record
$patient_id = $_SESSION['merge_id'];
//merge id is the id that is from walk in patient ,
// it was generate because the name,bday,purok of online patient account has
//the same record in walk in patient table

$con=null;
require '../DB_Connect.php';

$arr = array();
//get the end of medication date that is from the future
$query = "SELECT *, 
       DATE_FORMAT(start_date,'%Y-%m-%d') as start_date, DATE_FORMAT(end_date,'%Y-%m-%d') as end_date,
       DATE_FORMAT(start_date,'%b %d, %Y') as start_date_1, DATE_FORMAT(end_date,'%b %d, %Y') as end_date_1
FROM medication_record WHERE patient_id = '$patient_id' AND DATE_FORMAT(end_date,'%Y-%m-%d') >= DATE_FORMAT(NOW(),'%Y-%m-%d') ";

$result = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($result) ){

    $duration_days = getDuration($row['start_date'],$row['end_date'],$row['interval_days']+1);
    if($row['end_date']=="0000-00-00 00:00:00"){
        echo "null";
    }
    //$arr[] = $row;
    $arr[] = array(
        "medicine_name"=>$row['medicine_name'],
        "dosage"=>$row['dosage'],
        "no_times"=>$row['no_times'],
        "duration_days"=>$duration_days,
        "end_date"=>$row['end_date_1']

    );
}

echo json_encode($arr);
mysqli_close($con);

function getDuration($start, $end, $interval=0,$format = 'Y-m-d') :int{
    $array = array();
    $interval = new DateInterval('P'.$interval.'D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) {
        $array[] = $date->format($format);
    }

    return count($array);
}
