<?php
session_start();
$con=null;
require "../DB_Connect.php";
$arr = array();
$res = mysqli_query($con,"SELECT name,SUM(stock) as stock FROM medinventory GROUP by name ORDER BY name DESC");
while ($row=mysqli_fetch_assoc($res)){

   $arr[]=$row;

}
echo json_encode($arr);