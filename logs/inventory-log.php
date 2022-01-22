<?php
session_start();
$con = null;
require '../php/DB_Connect.php';

$arr = array();
$res = mysqli_query($con,"SELECT * FROM `inventory_logs` ORDER by date_occured DESC");
while($row = mysqli_fetch_assoc($res)){

    //get admin info who take that action
    $row['admin_name']="Unknown";
    $queryAdminName = mysqli_query($con,"SELECT * FROM `admin` WHERE id = '". $row["admin_id"]. "'");
    if($r1 = mysqli_fetch_assoc($queryAdminName)){
        $row['admin_name'] = $r1['first_name']." ".$r1['middle_name']." ".$r1['last_name'];
    }
    //get patient name
    $row['medicine_name']="Unknown";
    $status = $row['admin_action'];// 0 declines 1 approved//varchar ' '
    $queryinventory = mysqli_query($con,"Select * from `medinventory` WHERE id = '". $row["medicine_id"]. "'");
    if($r2=mysqli_fetch_assoc($queryinventory)){
        $row['medicine_name'] = $r2['name']."(".$r2['dosage'].")";
    }

    //for action message
    if($status==0){
        $row['action']=  $row['medicine_name'] . " was Added to Inventory";
    }
    elseif($status==1){
        $row['action']= $row['medicine_name'] . " was Updated to Inventory";
    }
    else{
        $row['action']= $row['medicine_name'] . " was Deleted to Inventory";
    }

    $arr[]= $row;
}

echo json_encode($arr);

