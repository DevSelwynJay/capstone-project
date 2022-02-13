<?php
session_start();
$isSearch = $_POST['isSearch'];
$val = $_POST['val'];
$con=null;
$res="";
require "../DB_Connect.php";
date_default_timezone_set('Asia/Manila');
$curr_date = date('Y-m-d');
if(!$isSearch){
    $res = mysqli_query($con,"SELECT `name`,SUM(`stock`) AS stock, COUNT(name) as row_count FROM `medinventory` GROUP BY `name` ORDER BY `name`, `dateadded` ASC ");
}
else{
    $res = mysqli_query($con,"SELECT `name`,SUM(`stock`) AS stock, COUNT(name) as row_count  FROM `medinventory` WHERE `name` LIKE '".$val."%' OR `category` LIKE '$val%' OR `subcategory` LIKE '$val%'   GROUP by `name` ORDER BY `name`, `dateadded` ASC");
}
$arr = array();
while ($row=mysqli_fetch_assoc($res)){

    $row_count = $row['row_count'];
    $current_inv = $row['name'];
    //query kung expired lahat ng med, para malaman pag ung
    //row count = to count ng expired med wag display ung
    //pag expire lahat wag display ung root kasi expired lahat ng med under noon
    $sub_row = mysqli_query($con,"SELECT * FROM medinventory WHERE name = '$current_inv' AND  DATE_FORMAT(`expdate`,'%Y-%m-%d') <= DATE_FORMAT(NOW(),'%Y-%m-%d') ");
    if($row_count==mysqli_num_rows($sub_row)){
       continue;
    }
    $arr[]=$row;
}
//DATE_FORMAT(`expdate`,'%Y-%m-%d') >= DATE_FORMAT(NOW(),'%Y-%m-%d') AND      ------  ,DATE_FORMAT(expdate,'%Y-%m-%d') as expdatefd
echo json_encode($arr);