<?php
session_start();
$con = null;
require '../DB_Connect.php';

$_SESSION['active_event_id'] = $event_id = $_POST['event_id'];
$active_patient_id = $_SESSION['active_individual_patient_ID'];

$result = mysqli_query($con,"SELECT *,
       DATE_FORMAT(date_given,'%Y-%m-%d') as date_given, DATE_FORMAT(date_given,'%b %d, %Y') as date_given_fd,
       DATE_FORMAT(expected_next_date_vaccination,'%Y-%m-%d') as next_date
FROM vaccination_record WHERE event_id = $event_id");
if($row = mysqli_fetch_assoc($result)){
    $vaccine_name = $row['vaccine_name'];

    $subResult = mysqli_query($con,"SELECT * FROM vaccination_record WHERE patient_id = '$active_patient_id' AND vaccine_name = '$vaccine_name' ORDER BY date_given DESC");
    $row['dose_taken'] = mysqli_num_rows($subResult);

    echo json_encode($row);
}