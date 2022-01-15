<?php
session_start();
$event_id = $_SESSION['active_event_id'];
$active_patient_id = $_SESSION['active_individual_patient_ID'];

$rec_dose = $_POST['updated_rec_dose'];
$next_sched = $_POST['updated_next_sched'];
$vaccine_name = $_POST['vaccine_name'];

$con = null;
require '../DB_Connect.php';
if($next_sched==null||$next_sched==""){
    $result = mysqli_query($con,"UPDATE vaccination_record SET expected_next_date_vaccination = NULL WHERE event_id = $event_id ");
}
else{
    $result = mysqli_query($con,"UPDATE vaccination_record SET expected_next_date_vaccination = '$next_sched' WHERE event_id = $event_id ");
}
$result = mysqli_query($con,"UPDATE vaccination_record SET reccommended_no_of_dosage = '$rec_dose' 
WHERE patient_id = '$active_patient_id' AND vaccine_name = '$vaccine_name'
");