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

    $result = mysqli_query($con, "SELECT first_name,middle_name,last_name FROM $userData WHERE id='$adminId'");
    if (mysqli_num_rows($result)>0) {// the id is in the database fetch result
        foreach ($result as $ress){
            $name.=$ress;
        }
        echo $name;
        break;
    }
}
?>