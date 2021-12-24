<?php
session_start();
//the id from walk in patient to get the record
$patient_id = $_SESSION['merge_id'];

$con=null;
require '../DB_Connect.php';

$arr = array();
//get the end of medication date that is from the future
$query = "SELECT *, timestampdiff(day,start_date,end_date)+1 as duration_days,
       DATE_FORMAT(start_date,'%b %d, %Y') as start_date, DATE_FORMAT(end_date,'%b %d, %Y') as end_date
FROM medication_record WHERE patient_id = '$patient_id' AND end_date >= NOW() ";

$result = mysqli_query($con,$query);
while($row = mysqli_fetch_assoc($result) ){
    $arr[] = $row;
}

echo json_encode($arr);
mysqli_close($con);
