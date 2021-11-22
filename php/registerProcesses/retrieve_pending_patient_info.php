<?php
session_start();
$id = $_POST['id'];
$con=null;
require '../DB_Connect.php';
$result = mysqli_query($con,"SELECT*FROM patient_id WHERE id = '$id'");
$pic_count = mysqli_num_rows($result);
$pic_path_arr = array();
$pic_path="";
while ($row = mysqli_fetch_array($result)){
     array_push($pic_path_arr,$row[2]);
}
$pic_path = implode(" ",$pic_path_arr);
echo json_encode(array("pic_path"=>$pic_path));
?>