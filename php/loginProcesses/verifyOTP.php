<?php
session_start();

$verificationType=$_POST['verificationType'];//the possible value is email or SMS
$inputtedOTP=$_POST['OTP'];

$con=null;
require '../DB_Connect.php';

if($verificationType=="email"){
    $email=$_POST['email'];
    //can be admin,super admin or patient
    //it depends on what database table where the email is found
    $userTable = $_SESSION['userTable'];

    $result = mysqli_query($con,"SELECT*FROM $userTable WHERE email = '$email' AND OTP = '$inputtedOTP'");
    if(mysqli_num_rows($result)>0){//verified OTP

        //saka palang ilalagay sa session variable si email kapag na verify na
        $_SESSION['email']=$email;

        echo json_encode(array("result"=> true));
    }
    else{
        echo json_encode(array("result"=> false));
    }

    //echo json_encode(array("name"=>$email,"time"=>$verificationType,"OTP"=>$isValidOTP));//pang debug lang
}
else if($verificationType=="SMS"){

}

mysqli_close($con);

