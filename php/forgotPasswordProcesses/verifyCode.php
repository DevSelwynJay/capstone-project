<?php
session_start();
$email = $_POST['email'];
$con=null;
require '../DB_Connect.php';

$inputtedOTP = $_POST['inputtedOTP'];
$email =  $_POST['email'];
$table = $_SESSION['userTable'];

$result = mysqli_query($con,"SELECT OTP FROM $table WHERE OTP = '$inputtedOTP'");
if(mysqli_num_rows($result)>0){
    echo json_encode(array("OK"=>true));
}
else{
    echo json_encode(array("OK"=>false));
}
?>