<?php
session_start();
$con=null;
require '../DB_Connect.php';
$datetoday = date("Y-m-d");
$arr=array();
$res = mysqli_query($con,"Select id, CONCAT(name,'(',dosage,')') as name, `expdate` from `medinventory` where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY order by `dateadded` desc");
while($row=mysqli_fetch_assoc($res)){
    $date = $row['expdate'];
    $remaindays=datediff($datetoday,$date);
    $row['remaindays']=$remaindays;
    $row['icon']='<i id="exclamation" class="fas fa-exclamation"></i>';
    $arr[]=$row;
}
echo json_encode($arr);
function datediff($datetoday, $expdate){
    $diff = strtotime($expdate) - strtotime($datetoday);
    return abs(round($diff/86400));
}
