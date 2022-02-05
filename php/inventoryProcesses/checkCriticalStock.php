<?php
session_start();
$con=null;
require '../DB_Connect.php';
$medname = ucwords($medname2 = $_POST['medName']);
$checksql = "Select * from `medinventory` where `name` = '$medname' ";
$res = mysqli_query($con,$checksql);
$critstock ='';
while($row = mysqli_fetch_assoc($res)){
    $critstock = $row['criticalstock'];
}
echo $critstock;