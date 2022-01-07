<?php
session_start();
$active_patient_id = $_SESSION['active_individual_patient_ID'];

$con = null;
require '../DB_Connect.php';
$response = array();

$result = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE id = '$active_patient_id' ");

if($row = mysqli_fetch_assoc($result)){
    $response = $row;
    echo json_encode($response);
}
