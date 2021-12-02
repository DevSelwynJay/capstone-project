<?php
$con=null;
require '../php/DB_Connect.php';
$res = mysqli_query($con,"SELECT*FROM admin");
$arr = array();
while ($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
}
echo json_encode($arr);

?>