<?php
session_start();

$new_password = $_POST['new_password'];
$email = $_SESSION['email_in_forgot_pwd'];
$userTable =  $_SESSION['userTable'];

$con=null;
require '../DB_Connect.php';

$result = mysqli_query($con,"UPDATE $userTable SET password = '$new_password' WHERE email = '$email'");
echo $result;
mysqli_close($con);
?>