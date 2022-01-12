<?php
session_start();
$emails = trim($_POST['email']);//ung bago
$password = trim($_POST['pwd']);

$email = (string)$emails;
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//    echo 1;//true
    echo "Invalid email format";
    exit();
}

if($password!=$_SESSION['patientOA_pwd']){
    echo "Invalid password";
    exit();
}

$con= null;
require '../DB_Connect.php';

//check duplicate email
$userTables = array('super_admin','admin','walk_in_patient','pending_patient');
foreach ($userTables as $table){
    if($_SESSION['email']==$emails){
        //wala namang nabago
        echo "You only entered your current email";
        exit();
    }

    $checkEmail = mysqli_query($con,"SELECT * FROM $table WHERE email = '$emails' ");
    if(mysqli_num_rows($checkEmail)>0){
       echo "Email already taken";
       exit();
    }
}



$patient_id = $_SESSION['patient_id'];

$res = mysqli_query($con,"UPDATE walk_in_patient SET email = '$emails' WHERE id = '$patient_id' ");
if($res){
    $_SESSION['email'] = $emails; //lagay sa session ung bagong email
    echo 1;
}
else{
    echo 0;
}
mysqli_close($con);
exit();