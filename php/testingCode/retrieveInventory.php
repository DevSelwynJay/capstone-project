<?php
session_start();
$isSearch = $_POST['isSearch'];
$val = $_POST['val'];
$con=null;
$res="";
require "../DB_Connect.php";
if(!$isSearch){
    $res = mysqli_query($con,"SELECT name,SUM(stock) as stock FROM medinventory GROUP by name ORDER BY name ");
}
else{
    $res = mysqli_query($con,"SELECT name,SUM(stock) as stock FROM medinventory WHERE name LIKE '".$val."%' OR category LIKE '$val%' OR subcategory LIKE '$val%' GROUP by name ORDER BY name ");
}
$arr = array();
while ($row=mysqli_fetch_assoc($res)){
   $arr[]=$row;
}
echo json_encode($arr);