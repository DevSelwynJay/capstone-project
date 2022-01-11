<?php
session_start();
$con= null;
require 'php/DB_Connect.php';
$result = array();
$query = mysqli_query($con,"SELECT * FROM admin");
while ($row = mysqli_fetch_assoc($query)){
    $result[] = $row;
}
echo json_encode($result);