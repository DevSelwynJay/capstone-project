<?php
session_start();
$id = $_POST['pending_patient_id'];
$admin_id = $_SESSION['active_admin_ID'];
//echo 0;
//exit();
//$id = "2021-02-538075";
$con = null;
require '../DB_Connect.php';
$success_query_count=0;
$result = mysqli_query($con,"INSERT INTO walk_in_patient (account_type,id,last_name,first_name,middle_name,suffix,gender,birthday,purok,address
,occupation,civil_status,patient_type,email,password,contact_no ) SELECT account_type,id,last_name,first_name,middle_name,suffix,gender,birthday,purok,address
,occupation,civil_status,patient_type,email,password,contact_no
FROM pending_patient WHERE id='$id'");

//PUT IN THE LOGS
mysqli_query($con,"INSERT INTO logs_acc_req (admin_id,patient_id,admin_action,description) 
    VALUES ('$admin_id','$id','1','Information Provided is Valid')
    ");
if($result){$success_query_count+=1;}

if($success_query_count==1){
    require 'approvePendingEmail.php';
    $result = mysqli_query($con,"DELETE FROM pending_patient WHERE id = '$id'");
    echo 1;
}
else{
    echo 0;
}

?>