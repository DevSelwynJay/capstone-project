<?php
session_start();
$_SESSION['email'] = "evaluateval@gmail.com";
//alfredogiebenitez@gmail.com//admin//evaluateval@gmail.com
//capstoneproject3m@gmail.com//superadmin
$_SESSION['user_full_name']="Alfredo Sample";
$_SESSION['userTable']="admin";
$_SESSION['account_type']=1;
//shortcut to login just put existing email as a value
header("location:../patient.php");
?>