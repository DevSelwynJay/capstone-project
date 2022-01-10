<?php
session_start();
$adminId = $_POST['adminId'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}



$userDatas = array('admin'/*,'patient'*/);
foreach ($userDatas as $userData) {
    mysqli_query($con,"UPDATE $userData SET account_status='1' WHERE id='$adminId'");
    $result = mysqli_query($con, "SELECT account_status FROM $userData WHERE id='$adminId'");
    if ($result == 1) {// the email is already in the database
        echo 1;
        break;
    } else {// the status is not updated
        echo 0;

    }
}

?>