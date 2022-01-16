<?php
$con=null;
require '../DB_Connect.php';
extract($_POST);
if(isset($_POST['newMedName']) && isset($_POST['newMedCategory']) && isset($_POST['newMedsubCategory']) && isset($_POST['newMedDosage']) && isset($_POST['newMedStocks']) && isset($_POST['newMedMfgDate']) && isset($_POST['newMedExpDate'])){
    $newMedName = $_POST['newMedName'];
    $newMedCategory = $_POST['newMedCategory'];
    $newMedsubCategory = $_POST['newMedsubCategory'];
    $newMedDosage = $_POST['newMedDosage'];
    $newMedStocks = $_POST['newMedStocks'];
    $newMedMfgDate = $_POST['newMedMfgDate'];
    $newMedExpDate = $_POST['newMedExpDate'];
    $type = "Add";
    $newmedicinesql = "Insert into `medinventory` (`name`, `category`, `subcategory`, `dosage` , `stock`, `mfgdate`, `expdate`) values ('$newMedName','$newMedCategory','$newMedsubCategory','$newMedDosage','$newMedStocks','$newMedMfgDate','$newMedExpDate')";
    $result = mysqli_query($con,$newmedicinesql);
    $last_id = $con->insert_id;
    $newmedreportsql = "Insert into `medreport` (`id`,`name`, `category`,`subcategory`, `dosage` , `stock`, `mfgdate`, `expdate`,`type`) values ('$last_id','$newMedName','$newMedCategory','$newMedsubCategory','$newMedDosage','$newMedStocks','$newMedMfgDate','$newMedExpDate','$type')";
    $reportresult = mysqli_query($con,$newmedreportsql);
}

?>