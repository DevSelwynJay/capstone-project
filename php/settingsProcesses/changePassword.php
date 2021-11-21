<?php
session_start();
$old_pwd_input = $_POST['old_pwd'];
$new_pwd = $_POST['new_pwd'];
$confirm_pwd = $_POST['confirm_pwd'];
$table = $_SESSION['userTable'];
$email = $_SESSION['email'];
$con = null;
require '../DB_Connect.php';

$result = mysqli_query($con,"SELECT password FROM $table WHERE email = '$email'");
if($row = mysqli_fetch_array($result)){
    if($old_pwd_input!=$row[0]){
        echo -1;
        exit();
    }
}

if($confirm_pwd!=$new_pwd){
    echo 0;
}
else{
    mysqli_query($con,"UPDATE $table SET password = '$new_pwd' WHERE email = '$email'");
    echo 1;
}
mysqli_close($con);
?>