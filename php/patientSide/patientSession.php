<?php
session_start();//sa patient side
$con = null;
require '../DB_Connect.php';
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=2){
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
    exit();
}
$email = $_SESSION['email'];
$res = mysqli_query($con,"SELECT*FROM patient where email = '$email' ");
if($res){
    if($row = mysqli_fetch_assoc($res)){

        echo json_encode(array(
            "patient_id"=>$row['id']
        ,"patient_name"=>$row['first_name']." ".$row['middle_name']." ".$row['last_name']
        ));

    }
}
else{
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
}
