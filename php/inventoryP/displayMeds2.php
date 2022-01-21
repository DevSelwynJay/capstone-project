<?php
session_start();
$con=null;
require '../DB_Connect.php';
$arr=array();
$res = mysqli_query($con,"Select id, CONCAT(name,'(',dosage,')') as name,CONCAT(category,'(',subcategory,')') as category, stock,criticalstock, CONCAT(mfgdate,'-',expdate) as mfgdate, dateadded from `medinventory` where `expdate` > NOW() order by `dateadded` asc");

while($row=mysqli_fetch_assoc($res)){
    $row['button'] ='<i id="updatebtn" class="fas fa-plus" onclick="medDisplayUpdateModal(' . $row['id'] . ')"></i>';
    if ($row['stock'] >= $row['criticalstock']) {
        $row['stock'] = '<span title="'.$row['criticalstock'].'">'.$row['stock'].'</span>';
    } else {
        $row['stock'] = '<span style="color: red" title="Critital Stocks: '.$row['criticalstock'].'">'.$row['stock'].'</span>';
    }


    $arr[]=$row;
}
echo json_encode($arr);
