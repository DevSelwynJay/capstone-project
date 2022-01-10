<?php
session_start();
$adminId = $_POST['adminId'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}




    mysqli_query($con,"UPDATE admin SET account_status='1' WHERE id='$adminId'");


    $result = mysqli_query($con, "SELECT account_status FROM admin WHERE id='$adminId'");
    //echo "<script>console.log(''+$result);</script>";

    if($row = mysqli_fetch_assoc($result) ){
        if($row['account_status'] == 1){
            echo 1;
        }
        else {// pass didn't match in the database
            echo 0;
        }

    }

?>