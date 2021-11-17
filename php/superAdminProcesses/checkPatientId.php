<?php
//check kung nag eexist na ung ID niya sa patient archive
session_start();
$patientId = $_POST['patId'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

$userDatas = array('patient_archive'/*,'patient'*/);
foreach ($userDatas as $userData) {

    $result = mysqli_query($con, "SELECT id FROM $userData WHERE id='$patientId'");
    if ($patientId == $result) {// the id is already in the database
        echo 0;
        break;
    } else {// id is not yet in the database
        echo 1;
    }
}
?>