<?php
session_start();//PATIENT SIDE

$con=null;
require '../DB_Connect.php';
$id_in_walk_in_patient = $_SESSION['patient_id'];//

    $arr = array();
    $result = mysqli_query($con,"SELECT *, DATE_FORMAT(start_date,'%Y-%m-%d') as start_date_1 ,
        DATE_FORMAT(start_date,'%M %d, %Y') as start_date_formatted,
        DATE_FORMAT(end_date,'%Y-%m-%d') as end_date_1,
        DATE_FORMAT(end_date,'%M %d, %Y') as end_date_formatted
        FROM medication_record
        WHERE patient_id = '$id_in_walk_in_patient'  ORDER BY date_given DESC");

    while($row= mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }
    echo json_encode($arr);

mysqli_close($con);
?>