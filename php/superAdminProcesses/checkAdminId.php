<?php
session_start();
    $adminId = $_POST['adminId'];
    $adminName = $_POST['adminName'];

    $con=null;
    require '../DB_Connect.php';

    if(!$con){
        die("Error".mysqli_error($con));
        exit();
    }

    $userDatas = array('admin_archive'/*,'patient'*/);
    foreach ($userDatas as $userData) {

        $result = mysqli_query($con, "SELECT id FROM $userData WHERE id='$adminId'");
        if ($adminId == $result) {// the id is already in the database
            echo 0;

        } else {// id is not yet in the databse
            echo 1;
        }
    }
?>