<?php
session_start();
$con = null;
require '../DB_Connect.php';
$arr = array();
$time = $_POST['interval'];
if($time == 'daily'){
    $time = '1 day';
    $sql = "Select * from `medreport` where `type` = 'Vaccine' and DATE_FORMAT(`dateadded`,'%Y %M %d') = DATE_FORMAT(NOW(),'%Y %M %d') order by `dateadded` asc";
}
elseif ($time == 'weekly'){
    $sql = "Select * from `medreport` where `type` = 'Vaccine' and yearweek(`dateadded`) = yearweek(NOW()) order by `dateadded` asc";
    $time = '1 week';
}
elseif ($time == 'monthly'){
    $sql = "Select * from `medreport` where `type` = 'Vaccine' and MONTH(`dateadded`) = MONTH(NOW()) order by `dateadded` asc";
    $time = '1 month';
}
elseif($time == 'quarterly'){
    $time = '1 quarter';
    $sql = "Select * from `medreport` where `type` = 'Vaccine' and QUARTER(`dateadded`) = QUARTER(NOW()) order by `dateadded` asc";
}
elseif ($time == 'annually'){
    $time = '1 year';
    $sql = "Select * from `medreport` where `type` = 'Vaccine' and YEAR(`dateadded`) = YEAR(NOW()) order by `dateadded` asc";
}
else{
    $datearr = explode(',',$time);
    $startdate = $datearr[0];
    $enddate = $datearr[1];
    $sql = "Select * from `medreport` where `type` = 'Vaccine' and date(dateadded) BETWEEN date('".$startdate."') and date('".$enddate."') order by `dateadded` asc";
}
$medexpqry = $sql;
$res = mysqli_query($con,$medexpqry);
while ($row = mysqli_fetch_assoc($res)) {
    $row['name'] = $row['name'] . '('.$row['dosage'].')';
    $row['category'] = $row['category'].'('.$row['subcategory'].')';
    $arr[] = $row;
}
echo json_encode($arr);
?>