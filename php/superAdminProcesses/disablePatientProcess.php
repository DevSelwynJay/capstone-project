<?php
session_start();
$patId = $_POST['patId'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}



mysqli_query($con,"UPDATE walk_in_patient SET account_status='0' WHERE id='$patId'");
//$sql = mysqli_query($con,"UPDATE admin SET account_status='0' WHERE id='$adminId'");

//if(mysqli_query($con, $sql)){
//  echo 1;
//}else{
//   echo 0;
//}

$result = mysqli_query($con, "SELECT account_status FROM walk_in_patient WHERE id='$patId'");
//echo "<script>console.log(''+$result);</script>";

if($row = mysqli_fetch_assoc($result) ){
    if($row['account_status'] == 0){
        echo 1;
    }
    else {// pass didn't match in the database
        echo 0;
    }

}

?>