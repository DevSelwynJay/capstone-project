<?php
session_start();
$isSearch = $_POST['isSearch'];
$val = $_POST['val'];
$con=null;
$res="";
require "../DB_Connect.php";
if(!$isSearch){
    $res = mysqli_query($con,"SELECT `name`,SUM(`stock`) AS stock FROM `medinventory` WHERE DATE_FORMAT(`expdate`,'%Y-%m-%d') >= DATE_FORMAT(NOW(),'%Y-%m-%d') GROUP BY `name` ORDER BY `name`, `dateadded` ASC ");
}
else{
    $res = mysqli_query($con,"SELECT `name`,SUM(`stock`) AS stock FROM `medinventory` WHERE DATE_FORMAT(`expdate`,'%Y-%m-%d') >= DATE_FORMAT(NOW(),'%Y-%m-%d') AND `name` LIKE '".$val."%' OR `category` LIKE '$val%' OR `subcategory` LIKE '$val%'   GROUP by `name` ORDER BY `name`, `dateadded` ASC");
}
$arr = array();
while ($row=mysqli_fetch_assoc($res)){
   $arr[]=$row;
}
echo json_encode($arr);