<?php
$contact = $_POST['contact'];
$email = $_POST['email'];
//fname:fname,mname:mname,lname:lname,bday:bday,purok:purok
$trimmedFname = trim($_POST['fname']);
$trimmedMname = trim($_POST['mname']);
$trimmedLname = trim($_POST['lname']);

$fname = strtoupper(substr($trimmedFname,0,1)).strtolower(substr($trimmedFname,1));
$mname = strtoupper(substr($trimmedMname,0,1)).strtolower(substr($trimmedMname,1));
$lname = strtoupper(substr($trimmedLname,0,1)).strtolower(substr($trimmedLname,1));

$suffix = preg_replace('/[^A-Za-z0-9\-]/', '', trim($_POST['suffix']));//remove special character
if($suffix!=""){
    $lname.=" ".$suffix;
}

$bday = trim($_POST['bday']);
$purok = trim($_POST['purok']);

$con=null;
require '../DB_Connect.php';
if(!$con) {
    die("Error" . mysqli_error($con));
    echo 0;
    exit();
}

$tables = array('pending_patient','walk_in_patient');
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
$tables = array('pending_patient','walk_in_patient','super_admin','admin');//bawal may mag kamukang email sa system
foreach ($tables as $table){
    $result = mysqli_query($con,"SELECT * FROM $table WHERE email = '$email'");
    if(mysqli_num_rows($result)>=1){
        //echo json_encode(array("success"=>false,"message"=>""));
        $errMsg.="<p>Email already exist</p>";
        break;
    }
}
//another added validation pag may kamuka na name bday purok bawal
$resultCheckDuplication = mysqli_query($con,"SELECT * FROM walk_in_patient 
WHERE last_name = '$lname' AND first_name='$fname' AND middle_name='$mname'
AND purok = $purok AND birthday = '$bday'
");
if(mysqli_num_rows($resultCheckDuplication)>0){
    $errMsg.= "<p>Duplication Detected</p>";

}
$resultCheckDuplication = mysqli_query($con,"SELECT * FROM walk_in_patient 
WHERE last_name = '$lname' AND first_name='$fname' AND middle_name='$mname'
AND birthday = '$bday'
");
if(mysqli_num_rows($resultCheckDuplication)>0){
    $errMsg.= "<p>Duplication Detected</p>";
}

if($errMsg==null){
    echo json_encode(array("success"=>true,"message"=>"okay"));
}
else{
    echo json_encode(array("success"=>false,"message"=>$errMsg));
}
mysqli_close($con);




?>