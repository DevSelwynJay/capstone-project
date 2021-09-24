<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['account_type']);
header("location:../index.php",true);
exit();
?>