<?php
session_start();

$con = null;
require '../DB_Connect.php';

$patientOA_ID = $_SESSION['patient_id'];//patient account ID

//check if may existing request na si online patient acc ng EMR
//pag meron update lang para para maupdate din ung date requested
$res = mysqli_query($con,"SELECT * FROM emr_request WHERE patientOA_ID = '$patientOA_ID' AND status = 0 ORDER BY date_requested DESC");
if(mysqli_num_rows($res)>0){ //may existing request
    if($row = mysqli_fetch_assoc($res)){
        $req_id = $row['request_id'];
        mysqli_query($con,"UPDATE emr_request SET status = -1 WHERE patientOA_ID = '$patientOA_ID' AND request_id=$req_id ");
        mysqli_query($con,"UPDATE emr_request SET status = 0 WHERE patientOA_ID = '$patientOA_ID' AND request_id=$req_id ");
    }
echo 1;
}
else{
    mysqli_query($con,"INSERT INTO emr_request VALUES (DEFAULT,DEFAULT, '$patientOA_ID', DEFAULT,DEFAULT,DEFAULT )");
echo 2;
}




