<?php
session_start();
$patientID =$_SESSION['active_individual_patient_ID'];
//echo $patientID;
//exit();
$con=null;
require '../DB_Connect.php';
$arr = array();
$result = mysqli_query($con,"SELECT *, timestampdiff(year,birthday,NOW()) as age FROM walk_in_patient WHERE id = '$patientID'");
if($row= mysqli_fetch_assoc($result)){//only runs one
    $arr[] = $row;
}
echo json_encode($arr)

?>