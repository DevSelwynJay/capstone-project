<?php
session_start();
$_SESSION['email'] = "projectcapstone3m@gmail.com";
//alfredogiebenitez@gmail.com//admin
//$_SESSION['user_full_name']="Alfredo Sample";
//capstoneproject3m@gmail.com//superadmin
$_SESSION['userTable']="super_admin";//online patient account table
$_SESSION['account_type']=0;
header("location:php/loginProcesses/redirect.php");
//shortcut to login just put existing email as a value