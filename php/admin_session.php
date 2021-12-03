<?php
session_start();
$con = null;
require 'DB_Connect.php';
if(!isset($_SESSION['email'])){
    echo json_encode(array(
        "admin_name"=>"no logged admin"
    ));
    exit();
}
$email = $_SESSION['email'];
$res = mysqli_query($con,"SELECT*FROM admin where email = '$email' ");
if($res){
    if($row = mysqli_fetch_assoc($res)){
       echo json_encode(array(
           "admin_id"=>$row['id']
           ,"admin_name"=>$row['first_name']." ".$row['middle_name']." ".$row['last_name']
        ));

    }
}
else{
    echo json_encode(array(
        "admin_name"=>"no logged admin"
    ));
}

?>