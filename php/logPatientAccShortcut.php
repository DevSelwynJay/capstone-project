<?php
session_start();
$_SESSION['email'] = "benitez.alfredo.b.1128@gmail.com";
//alfredpogiebenitez@gmail.com//benitez.alfredo.b.1128@gmail.com//patient
//alfredogiebenitez@gmail.com//admin
//capstoneproject3m@gmail.com//superadmin
//$_SESSION['user_full_name']="Alfredo Sample";
$_SESSION['userTable']="patient";//online patient account table
$_SESSION['account_type']=2;
header("location:loginProcesses/redirect.php");
//shortcut to login just put existing email as a value