<?php
//value from this is come from validateOnlinePatientAccount.php
session_start();
if($_SESSION['is_link']&&$_SESSION['hasRecord']>0){
    echo json_encode(array("status"=>"ok"));
}
else if($_SESSION['is_link']&&$_SESSION['hasRecord']==0){
    echo json_encode(array("status"=>"not","err_msg"=>"Cannot request an EMR. You do not have any record"));
}
else{
    echo json_encode(array("status"=>"not","err_msg"=>"Cannot request an EMR. Please try again later"));
}