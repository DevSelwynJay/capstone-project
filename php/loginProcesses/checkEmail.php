<?php
//this code is to check if the gmail is in the database
session_start();
$email = $_POST['email'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

require './loginProcess.php';
$loginProcess = new loginProcess();
$result =  $loginProcess->checkEmailInDatabase($con,$email);
if(mysqli_num_rows($result)>0){

    $_6DigitCode = $loginProcess->generate6DigitCode();
    $loginProcess->put_OTP_To_User_Record($con,$email,$_6DigitCode);

    echo 1;//notify the js callback function that gmail account is in the database

}
else{
    echo 0;
}

mysqli_close($con);
exit();

