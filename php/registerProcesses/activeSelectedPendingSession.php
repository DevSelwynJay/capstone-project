<?php
//set session for selected row
session_start();
$_SESSION['selected_pending_account'] = array();
//2022-02-883244//$_POST['id']
$id = $_POST['id'];
$con=null;
require '../DB_Connect.php';
$result = mysqli_query($con,"SELECT*FROM pending_patient WHERE id = '$id'");
if($row = mysqli_fetch_assoc($result)){
    $_SESSION['selected_pending_account'] = $row;
    echo json_encode($row);
}

