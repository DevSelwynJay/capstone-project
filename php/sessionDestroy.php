<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['account_type']);
unset($_SESSION['userTable']);
header("location:../index.php",true);
exit();
?>