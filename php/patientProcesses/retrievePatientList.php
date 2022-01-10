<?php
session_start();
$con=null;
require '../DB_Connect.php';
$res = mysqli_query($con,"SELECT id, CONCAT(first_name,' ',middle_name,' ',last_name) as name, patient_type, purok, address, timestampdiff(year,birthday,NOW()) as age , DATE_FORMAT(birthday,'%b %d %Y') as bday FROM walk_in_patient");
$arr = array();
while ($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
}
echo json_encode($arr);
?>