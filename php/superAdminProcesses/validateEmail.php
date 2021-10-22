<?php
//checks kung may nag eexist ba na ganoong email
session_start();
$emails = $_POST['email'];
$email = (string)$emails;
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 1;//true
} else{
    echo 0;//false
}
?>