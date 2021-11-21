<?php
session_start();
$fname = strtoupper(substr($_POST['fname'],0,1)).strtolower(substr($_POST['fname'],1));
$mname = strtoupper(substr($_POST['mname'],0,1)).strtolower(substr($_POST['mname'],1));
$lname = strtoupper(substr($_POST['lname'],0,1)).strtolower(substr($_POST['lname'],1));
$gender = $_POST['gender'];
$bday = $_POST['bday'];
$address = $_POST['address'];

$table = $_SESSION['userTable'];
$email = $_SESSION['email'];
$con = null;
require '../DB_Connect.php';
$result = mysqli_query($con,"UPDATE $table set last_name='$lname', first_name='$fname', middle_name='$mname',gender='$gender',birthday='$bday',address='$address' WHERE email='$email'");

?>