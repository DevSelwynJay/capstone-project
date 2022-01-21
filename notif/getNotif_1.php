<?php
session_start();
$con=null;
require '../php/DB_Connect.php';
$notif_msg = array();

//pending patient
$res = mysqli_query($con,"SELECT * FROM `pending_patient`");
$row_count = mysqli_num_rows($res);
//to expire
$toexpire = mysqli_query($con,"Select * from `medinventory`  where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY");
$toexpire_row_count=mysqli_num_rows($toexpire);
//expired
$expired = mysqli_query($con,"Select * from `medinventory` where `expdate` < NOW()");
$expired_row_count=mysqli_num_rows($expired);
//out of stocks
$out_of_stocks = mysqli_query($con,"SELECT * FROM `medinventory` WHERE `stock` = 0");
$out_of_stocks_row_count =mysqli_num_rows($out_of_stocks);
//critical stocks
$critical_stock = mysqli_query($con,"SELECT * FROM `medinventory` WHERE `stock` <= `criticalstock`");
$critical_stock_row_count = mysqli_num_rows($critical_stock);
if($row_count>0){
    $notif_msg[]=  "<li><a href='pending-patient-acc.php'><span>$row_count</span> Pending Account Request</a></li>";
}
if($toexpire_row_count>0){
    $notif_msg[]=  "<li><a href='pending-patient-acc.php'><span>$toexpire_row_count</span> To Expire Medicine/s in our Inventory</a></li>";
}
if($expired_row_count>0){
    $notif_msg[]=  "<li><a href='pending-patient-acc.php'><span>$expired_row_count</span> Expired Medicine/s in our Inventory</a></li>";
}
if($out_of_stocks_row_count>0){
    $notif_msg[]=  "<li><a href='pending-patient-acc.php'><span>$out_of_stocks_row_count</span> Out of Stocks Medicine/s in our Inventory</a></li>";
}
if($critical_stock_row_count>0){
    $notif_msg[]=  "<li><a href='pending-patient-acc.php'><span>$critical_stock_row_count</span> Critical Stocks Medicine/s in our Inventory</a></li>";
}


//last part of code, sa una mag dadagdag
echo json_encode($notif_msg);
