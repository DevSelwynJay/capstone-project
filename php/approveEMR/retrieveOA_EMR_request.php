<?php
session_start();
$con = null;
require '../DB_Connect.php';

$response = array();

//select online acc with request
$res = mysqli_query($con,"SELECT * FROM emr_request WHERE status = 0 ORDER BY date_requested");
while ($row = mysqli_fetch_assoc($res)){
    //logic select lahat ng online acc na may request
    //then iquery ung info sa online patient acc for displaying
       $id_of_patient_OA = $row['patientOA_ID'];// id of online patient account
     $subRes = mysqli_query($con,"SELECT * FROM patient WHERE id = '$id_of_patient_OA' ");
     if($subRow = mysqli_fetch_assoc($subRes)){
         $subRow['date_requested'] =   $row['date_requested'] ;
         $subRow['request_id'] =   $row['request_id'] ;
         $subRow['complete_name'] =  $subRow['first_name'].' '. $subRow['middle_name'].' '. $subRow['last_name'];
         $subRow['view_button'] = "<button class='view-req-btn' data-patientOA_ID='".$id_of_patient_OA."' data-reqID='".$subRow['request_id']."'
                                      data-name = '".$subRow['complete_name']."' data-email = '". $subRow['email']."'
                                    >View</button>";

             $response[]= $subRow;
     }
}
echo json_encode($response);
