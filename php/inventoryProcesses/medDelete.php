<?php
$con=null;
require '../DB_Connect.php';



    $id = $_POST['id'];
    $reportsql = "Select * from `medinventory` where id = '$id'";
    $reportres = mysqli_query($con, $reportsql);
    while($row = mysqli_fetch_assoc($reportres)){
    $name = $row['name'];
    $category = $row['category'];
        $subcategory = $row['subcategory'];
        $dosage = $row['dosage'];
    $stocks = $row['stock'];
    $mfgdate = $row['mfgdate'];
    $expdate = $row['expdate'];
    }
    $type = "Delete";
    $reportin = "Insert into `medreport`(`id`,`name`,`category`,`subcategory`,`dosage`,`stock`,`mfgdate`,`expdate`,`type`) values ('$id','$name','$category','$subcategory','$dosage','$stocks','$mfgdate','$expdate','$type')";
    $reportinsert = mysqli_query($con,$reportin);
    $deletesql = "DELETE FROM `medinventory` WHERE id = '$id'";
    $deleteresult = mysqli_query($con,$deletesql);
