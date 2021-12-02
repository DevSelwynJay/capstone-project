<?php
session_start();
$con = null;
require 'DB_Connect.php';
if(!isset($_SESSION['email'])){
    echo "No Logged Admin";
    exit();
}
$email = $_SESSION['email'];
$res = mysqli_query($con,"SELECT*FROM admin where email = '$email' ");
if($res){
    if($row = mysqli_fetch_assoc($res)){
        echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
    }
}
else{
    echo "No Logged Admin";
}

?>