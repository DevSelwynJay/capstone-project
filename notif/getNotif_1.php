<?php
session_start();
$con=null;
require '../php/DB_Connect.php';
$notif_msg = array();

//pending patient
$res = mysqli_query($con,"SELECT*FROM pending_patient");
$row_count = mysqli_num_rows($res);
if($row_count>0){
    $notif_msg[]=  "<li><a href='pending-patient-acc.php'><span>$row_count</span> Pending Account Request</a></li>";
}



//last part of code, sa una mag dadagdag
echo json_encode($notif_msg);
