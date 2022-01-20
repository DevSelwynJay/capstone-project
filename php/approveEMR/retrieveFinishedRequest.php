<?php
session_start();
$con = null;
require '../DB_Connect.php';

$response = array();

//select online acc with finished request
$res = mysqli_query($con,"SELECT * FROM emr_request ORDER BY date_requested DESC");
while ($row = mysqli_fetch_assoc($res)){
    //logic select lahat ng online acc na may request history ,
    //then iquery ung info sa online patient acc for displaying
    $id_of_patient_OA = $row['patientOA_ID'];// id of online patient account
    $subRes = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE id = '$id_of_patient_OA' ");
    if($subRow = mysqli_fetch_assoc($subRes)){

        if($row['status']==0){//not yet approved or decline
           continue;
        }

        $subRow['admin_name'] = "Unknown";
        $adminID= $row['admin_id'];//get the admin info who in charged of accepting/declining request
        if($adminInfo = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM admin WHERE id ='$adminID'"))){
            $subRow['admin_name']=$adminInfo['first_name']." ".$adminInfo['middle_name']." ".$adminInfo['last_name'];
        }

        if($row['status']==1){//int ung data type sa table column na status
            $subRow['status'] = "Approved by ". $subRow['admin_name'];
        }
        if($row['status']==-1){
            $subRow['status'] = "Declined by ". $subRow['admin_name'];
        }


        $subRow['date_requested'] =   $row['date_requested'] ;
        $subRow['request_id'] =   $row['request_id'] ;
        $subRow['complete_name'] =  $subRow['first_name'].' '. $subRow['middle_name'].' '. $subRow['last_name'].' '.$subRow['suffix'];
        $subRow['view_button'] = "<button class='view-req-btn' data-patientOA_ID='".$id_of_patient_OA."' data-reqID='".$subRow['request_id']."'
                                      data-name = '".$subRow['complete_name']."' data-email = '". $subRow['email']."'
                                    >View</button>";

        $response[]= $subRow;
    }
}
echo json_encode($response);
