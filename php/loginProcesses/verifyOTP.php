<?php
session_start();
$email=$_POST['email'];
$verificationType=$_POST['verificationType'];
$inputtedOTP=$_POST['OTP'];

if($verificationType=="email"){
    $con=null;
    require '../DB_Connect.php';
    require 'loginProcess.php';
    $loginProcess  = new loginProcess();
    $isValidOTP =  $loginProcess->verifyOTP($con,$email,$inputtedOTP);

    $_SESSION['email']=$email;

    echo json_encode(array("result"=>$isValidOTP));

    //echo json_encode(array("name"=>$email,"time"=>$verificationType,"OTP"=>$isValidOTP));//pang debug lang
}

