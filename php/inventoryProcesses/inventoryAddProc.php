<?php
$con=null;
require '../DB_Connect.php';
extract($_POST);
if(isset($_POST['newMedName']) && isset($_POST['newMedCategory']) && isset($_POST['newMedStocks']) && isset($_POST['newMedMfgDate']) && isset($_POST['newMedExpDate'])){
    $newMedName = $_POST['newMedName'];
    $newMedCategory = $_POST['newMedCategory'];
    $newMedStocks = $_POST['newMedStocks'];
    $newMedMfgDate = $_POST['newMedMfgDate'];
    $newMedExpDate = $_POST['newMedExpDate'];
    $type = "Add";
    $newmedicinesql = "Insert into `medinventory` (`name`, `category`, `stock`, `mfgdate`, `expdate`) values ('$newMedName','$newMedCategory','$newMedStocks','$newMedMfgDate','$newMedExpDate')";
    $result = mysqli_query($con,$newmedicinesql);
    $newmedreportsql = "Insert into `medreport` (`name`, `category`, `stock`, `mfgdate`, `expdate`,`type`) values ('$newMedName','$newMedCategory','$newMedStocks','$newMedMfgDate','$newMedExpDate','$type')";
    $reportresult = mysqli_query($con,$newmedreportsql);
}

?>