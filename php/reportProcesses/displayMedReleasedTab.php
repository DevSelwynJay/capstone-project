<?php
session_start();
$con = null;
require '../DB_Connect.php';
$arr = array();

$time = $_POST['interval'];
if($time == 'daily'){
    $time = '1 day';
}
elseif ($time == 'weekly'){
    $time = '1 week';
}
elseif ($time == 'monthly'){
    $time = '1 month';
}
elseif($time == 'quarterly'){
    $time = '1 quarter';
}
elseif ($time == 'annually'){
    $time = '1 year';
}
$medexpqry = "Select * from `medreport` where `type` = 'Medicine' and `dateadded` > NOW()- interval ".$time." order by `dateadded` asc";
$res = mysqli_query($con,$medexpqry);
while ($row = mysqli_fetch_assoc($res)) {

    $row['name'] = $row['name'] . '('.$row['dosage'].')';
    $row['category'] = $row['category'].'('.$row['subcategory'].')';
    $arr[] = $row;
}

echo json_encode($arr);




?>