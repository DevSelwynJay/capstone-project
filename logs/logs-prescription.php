<?php
session_start();
$con = null;
require '../php/DB_Connect.php';
$arr = array();
$tables = array("medication_record","vaccination_record");
foreach ($tables as $table){
    $res = mysqli_query($con,"SELECT * FROM $table");
    while($row = mysqli_fetch_assoc($res)){

        //get admin info who take that action
        $row['admin_name']="Unknown";
        $queryAdminName = mysqli_query($con,"SELECT * FROM admin WHERE id = '". $row["admin_id"]. "'");
        if($r1 = mysqli_fetch_assoc($queryAdminName)){
            $row['admin_name'] = $r1['first_name']." ".$r1['middle_name']." ".$r1['last_name'];
        }
        //get patient name
        $row['patient_name']="Unknown";

        $queryPatientName = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE id = '". $row['patient_id']. "'");

        if($r2=mysqli_fetch_assoc($queryPatientName)){
            $row['patient_name'] = $r2['first_name']." ".$r2['middle_name']." ".$r2['last_name']." ".$r2['suffix'];
        }

        //for action message
        if($table=="medication_record"){
            $row['action']= "Gave ".$row['given_med_quantity']." ".$row['medicine_name']." ".$row['dosage']." to <span class='view' data-id='".$row['patient_id']."' style='font-weight: 600;color: #2b2b2b'>".$row['patient_name']."</span> ";
        }
        else{
            $row['action']= "Gave ".$row['vaccine_name']." ".$row['vaccine_dosage']." to <span class='view' data-id='".$row['patient_id']."' style='font-weight: 600;color: #2b2b2b'>".$row['patient_name']."</span> ";
        }

        $row['date_occured'] = $row['date_given'];
        $arr[]= $row;
    }
}

usort( $arr, function ($item1, $item2) {
    return $item2['date_given'] <=> $item1['date_given'];
});

echo json_encode($arr);