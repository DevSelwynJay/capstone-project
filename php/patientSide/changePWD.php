<?php
session_start();
$pass =  $_POST['pwd'];
$patient_id = $_SESSION['patient_id'];
$con = null;
require '../DB_Connect.php';
$query = mysqli_query($con,"UPDATE walk_in_patient SET password = '$pass' WHERE id = '$patient_id' ");
if($query){
    echo 1;
}
else{
    echo 0;
}