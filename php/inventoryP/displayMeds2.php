<?php
session_start();
$con=null;
require '../DB_Connect.php';
$arr=array();
$res = mysqli_query($con,"Select id, CONCAT(name,'(',dosage,')') as name, stock from `medinventory` where `expdate` < NOW() and `stock` > `criticalstock` order by `dateadded` asc");
while($row=mysqli_fetch_assoc($res)){
    $row['button'] ='<i class="fa-light fa-circle-exclamation"></i>';
    $arr[]=$row;
}
echo json_encode($arr);
