<?php
session_start();
//if(isset($_SESSION['email'])){//may nakalogin na account
//    unset($_SESSION['email']);
//    unset($_SESSION['account_type']);
//    unset($_SESSION['userTable']);
//}
$sessions = array_keys($_SESSION);
foreach ($sessions as $key){
    unset($_SESSION[$key]);
}
header("location:../index.php",true);
exit();
?>