<?php
session_start();
$con=null;
require '../DB_Connect.php';
$res = mysqli_query($con,"SELECT id, CONCAT(last_name,', ',first_name,' ',middle_name) as name, patient_type, purok, address, timestampdiff(year,birthday,NOW()) as age FROM walk_in_patient");
$arr = array();
while ($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
}
echo json_encode($arr);
?>