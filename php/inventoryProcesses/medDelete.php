<?php
$con=null;
require '../DB_Connect.php';


if(isset($_POST['id'])){
    $id = $_POST['id'];
    $reportsql = "Select * from `medinventory` where id = $id";
    $reportres = mysqli_query($con, $reportsql);
    while($row = mysqli_fetch_assoc($reportres)){
    $name = $row['name'];
    $category = $row['category'];
    $stocks = $row['stock'];
    $mfgdate = $row['mfgdate'];
    $expdate = $row['expdate'];
    }
    $type = "Delete";
    $reportin = "Insert into `medreport`(`name`,`category`,`stock`,`mfgdate`,`expdate`,`type`) values ('$name','$category','$stocks','$mfgdate','$expdate','$type')";
    $reportinsert = mysqli_query($con,$reportin);
    $deletesql = "Delete from `medinventory` where id = $id";
    $deleteresult = mysqli_query($con,$deletesql);
}