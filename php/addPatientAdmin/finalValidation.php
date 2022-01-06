<?php
//sa add patient ng admin side
$contact = trim($_POST['contact']);
$email = trim($_POST['email']);

$con=null;
require '../DB_Connect.php';
if(!$con) {
    die("Error" . mysqli_error($con));
    echo 0;
    exit();
}

$tables = array('walk_in_patient');
$result=null;
$errMsg = null;

$existEmail = null;
$existContact = null;

foreach ($tables as $table){
    $result = mysqli_query($con,"SELECT * FROM $table WHERE contact_no = '$contact'");
    if(mysqli_num_rows($result)>=1){
        //echo json_encode(array("success"=>false,"message"=>""));
        $errMsg.="Contact number already exist!";
        $existContact = true;
        break;
    }
}
foreach ($tables as $table){
    $result = mysqli_query($con,"SELECT * FROM $table WHERE email = '$email'");
    if(mysqli_num_rows($result)>=1){
        //echo json_encode(array("success"=>false,"message"=>""));
        $errMsg.="Email already exist!";
        $existEmail = true;
        break;
    }
}

if($errMsg!=null){
    if($existContact&&$existEmail){
        $errMsg="Email and contact number already exist";
    }
    echo $errMsg;
    mysqli_close($con);
    exit();
}






?>