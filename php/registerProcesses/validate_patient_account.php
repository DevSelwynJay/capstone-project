<?php
session_start();
$id = $_POST['pending_patient_id'];
//echo 0;
//exit();
//$id = "2021-02-538075";
$con = null;
require '../DB_Connect.php';
$success_query_count=0;
$result = mysqli_query($con,"INSERT INTO patient (id,last_name,first_name,middle_name,gender,birthday,address
,occupation,civil_status,email,password,contact_no,date_created ) SELECT id,last_name,first_name,middle_name,gender,birthday,address
,occupation,civil_status,email,password,contact_no,date_created
FROM pending_patient WHERE id='$id'");
if($result){$success_query_count+=1;}
$result = mysqli_query($con,"DELETE FROM pending_patient WHERE id = '$id'");
if($result){$success_query_count+=1;}
if($success_query_count==2){
    echo 1;
}
else{
    echo 0;
}

?>