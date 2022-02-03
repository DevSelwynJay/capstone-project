<?php
session_start();
$name = $_POST['name'];
$con=null;
require "../DB_Connect.php";
$arr = array();
$res = mysqli_query($con,"SELECT * FROM medinventory where name = '$name' ");
while ($row=mysqli_fetch_assoc($res)){

    $arr[]=$row;

}
echo json_encode($arr);