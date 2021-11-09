<?php
$contact = $_POST['contact'];
$email = $_POST['email'];

$con=null;
require '../DB_Connect.php';
if(!$con) {
    die("Error" . mysqli_error($con));
    echo 0;
    exit();
}

$tables = array('pending_patient','patient');
$result=null;
$errMsg = null;
foreach ($tables as $table){
    $result = mysqli_query($con,"SELECT * FROM $table WHERE contact_no = '$contact'");
    if(mysqli_num_rows($result)>=1){
        //echo json_encode(array("success"=>false,"message"=>""));
        $errMsg.="<p>Contact number already exist</p>";
        break;
    }
}
foreach ($tables as $table){
    $result = mysqli_query($con,"SELECT * FROM $table WHERE email = '$email'");
    if(mysqli_num_rows($result)>=1){
        //echo json_encode(array("success"=>false,"message"=>""));
        $errMsg.="<p>Email already exist</p>";
        break;
    }
}

if($errMsg==null){
    echo json_encode(array("success"=>true,"message"=>"okay"));
}
else{
    echo json_encode(array("success"=>false,"message"=>$errMsg));
}
mysqli_close($con);




?>