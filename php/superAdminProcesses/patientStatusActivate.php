<?php
session_start();
$patId = $_POST['patId'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}




mysqli_query($con,"UPDATE walk_in_patient SET account_status='1' WHERE id='$patId'");


$result = mysqli_query($con, "SELECT account_status FROM walk_in_patient WHERE id='$patId'");
if($row = mysqli_fetch_assoc($result) ){
    if($row['account_status'] == 1){
        echo 1;
    }
    else {// pass didn't match in the database
        echo 0;
    }

}

?>