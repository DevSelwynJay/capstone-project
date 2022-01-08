<?php
session_start();

$email = $_POST['pwd'];
if($email==$_SESSION['patientOA_pwd']){
    echo 1;
}
else {
    echo 0;
}