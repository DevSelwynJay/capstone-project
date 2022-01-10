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

$tables = array('walk_in_patient','pending_patient');
$result=null;
$errMsg = null;

$existEmail = null;
$existContact = null;

foreach ($tables as $table){
    if($contact == $_SESSION['active_old_patient_info']['contact_no']){
        //wala naman nabago sa contact skip na pagskip sa duplication
        break;
    }

    $result = mysqli_query($con,"SELECT * FROM $table WHERE contact_no = '$contact'");
    if(mysqli_num_rows($result)>=1){
        //echo json_encode(array("success"=>false,"message"=>""));
        $errMsg.="Newly added contact is already taken!";
        $existContact = true;
        break;
    }
}
$tables = array('walk_in_patient','pending_patient','super_admin','admin');
foreach ($tables as $table){
    if($email == $_SESSION['active_old_patient_info']['email']){
        //wala naman nabago sa contact skip na pagskip sa duplication
        break;
    }
    $result = mysqli_query($con,"SELECT * FROM $table WHERE email = '$email'");
    if(mysqli_num_rows($result)>=1){
        //echo json_encode(array("success"=>false,"message"=>""));
        $errMsg.="Newly added email already taken!";
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