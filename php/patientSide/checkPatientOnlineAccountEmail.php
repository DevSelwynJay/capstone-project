<?php
session_start();

$email = $_POST['email'];
if($email==$_SESSION['email']){
    echo 1;
}
else {
    echo 0;
}