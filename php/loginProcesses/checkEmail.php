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

$result =  mysqli_query($con,"SELECT * FROM admin WHERE email='$email'");
if(mysqli_num_rows($result)>0){//email is in the database

    //generate 6 digit code OTP
    $key = random_int(0, 999999);
    $_6DigitCode = str_pad($key, 6, 0, STR_PAD_LEFT);

    //put the OTP in user's record
    mysqli_query($con,"UPDATE admin SET OTP = '$_6DigitCode' WHERE email = '$email'");

    echo 1;//notify the js callback function that gmail account is in the database

}
else{
    echo 0;
}

mysqli_close($con);
exit();

