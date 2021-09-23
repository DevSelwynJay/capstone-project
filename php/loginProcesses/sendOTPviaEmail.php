<?php
$email = $_POST['email'];

$con=null;
require '../DB_Connect.php';
require 'loginProcess.php';

$loginProcess = new loginProcess();
$loginProcess->send_OTP_To_User_Email($con,$email);


?>