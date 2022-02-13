<?php
session_start();
$name = $_POST['name'];
$con=null;
require "../DB_Connect.php";
$arr = array();
$res = mysqli_query($con,"SELECT * FROM medinventory where name = '$name' AND DATE_FORMAT(`expdate`,'%Y-%m-%d') >= DATE_FORMAT(CURRENT_DATE(),'%Y-%m-%d') ORDER BY dateadded");
while ($row=mysqli_fetch_assoc($res)){
    $arr[]=$row;
}
echo json_encode($arr);