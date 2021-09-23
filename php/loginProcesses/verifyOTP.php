<?php
session_start();
$email=$_POST['email'];
$verificationType=$_POST['verificationType'];//the possible value is email or sms
$inputtedOTP=$_POST['OTP'];

if($verificationType=="email"){

    $con=null;
    require '../DB_Connect.php';
    require 'loginProcess.php';
    $loginProcess  = new loginProcess();
    $isValidOTP =  $loginProcess->verifyOTP($con,$email,$inputtedOTP);

    if($isValidOTP){
        $_SESSION['email']=$email;

        echo json_encode(array("result"=> true));
    }
    else{
        echo json_encode(array("result"=> false));
    }


    //echo json_encode(array("name"=>$email,"time"=>$verificationType,"OTP"=>$isValidOTP));//pang debug lang
}

