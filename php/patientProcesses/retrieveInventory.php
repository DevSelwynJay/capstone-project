<?php
session_start();
//$key=$_POST['key'];
//$key="O";
$con=null;
require '../DB_Connect.php';
$res = mysqli_query($con,"SELECT *,name as label from medinventory  ");
$arr = array();
while ($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
}
echo json_encode($arr);
?>