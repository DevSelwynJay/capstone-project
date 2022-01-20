<?php
session_start();
$con = null;
require '../php/DB_Connect.php';
$arr = array();
$res = mysqli_query($con,"SELECT * FROM logs_acc_req ORDER by date_occured DESC");
while($row = mysqli_fetch_assoc($res)){

    //get admin info who take that action
    $row['admin_name']="Unknown";
    $queryAdminName = mysqli_query($con,"SELECT * FROM admin WHERE id = '". $row["admin_id"]. "'");
    if($r1 = mysqli_fetch_assoc($queryAdminName)){
        $row['admin_name'] = $r1['first_name']." ".$r1['middle_name']." ".$r1['last_name'];
    }
    //get patient name
    $row['patient_name']="Unknown";
    $status = $row['admin_action'];// 0 declines 1 approved//varchar ' '
    if($status=='0'){
        $queryPatientName = mysqli_query($con,"SELECT * FROM declined_patient WHERE id = '". $row['patient_id']. "'");
    }
    else{
        $queryPatientName = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE id = '". $row['patient_id']. "'");
    }
    if($r2=mysqli_fetch_assoc($queryPatientName)){
        $row['patient_name'] = $r2['first_name']." ".$r2['middle_name']." ".$r2['last_name'];
    }

    //for action message
    if($status==0){
        $row['action']= "Declined Account Request of ". $row['patient_name'];
    }
    else{
        $row['action']= "Accepted Account Request of ". $row['patient_name'];
    }

    $arr[]= $row;
}

echo json_encode($arr);