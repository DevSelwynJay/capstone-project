<?php
session_start();
$email = $_SESSION['email'];
echo strval($email);
?>