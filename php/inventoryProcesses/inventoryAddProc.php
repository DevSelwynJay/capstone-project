<?php
session_start();
$con=null;
require '../DB_Connect.php';
extract($_POST);
    $newMedName2 = $_POST['newMedName'];
    $newMedGenName2 = $_POST['newMedGenName'];
    $newMedCategory2 = $_POST['newMedCategory'];
    $newMedsubCategory2 = $_POST['newMedsubCategory'];
    $newMedDosage = $_POST['newMedDosage'];
    $newMedStocks = $_POST['newMedStocks'];
    $newmedCritStocks = $_POST['newMedCritStocks'];
    $newMedMfgDate = $_POST['newMedMfgDate'];
    $newMedExpDate = $_POST['newMedExpDate'];
    $newMedName = ucwords($newMedName2);
    $newMedGenName = ucwords($newMedGenName2);
    $newMedCategory = ucwords($newMedCategory2);
    $newMedsubCategory = ucwords($newMedsubCategory2);
    $_6DigitCode = generate_6_Digits();
    if($newMedCategory == "Medicine"){
        $_SESSION['category'] = '04';
    }
    else{
        $_SESSION['category'] = '05';
    }
    $_SESSION['final_id'] = $new_id = generateID($_6DigitCode,$_SESSION['category']);
    validateID($con,$new_id);
    $medicineID = $_SESSION['final_id'];//final
    $type = "Add";
    $newmedicinesql = "Insert into `medinventory` (`id`,`name`,`gen_name`, `category`, `subcategory`, `dosage` , `stock`,`criticalstock`, `mfgdate`, `expdate`) values ('$medicineID','$newMedName','$newMedGenName','$newMedCategory','$newMedsubCategory','$newMedDosage','$newMedStocks','$newmedCritStocks','$newMedMfgDate','$newMedExpDate')";
    $result = mysqli_query($con,$newmedicinesql);
    $newmedreportsql = "Insert into `medreport` (`id`,`name`,`gen_name`, `category`,`subcategory`, `dosage` , `stock`, `mfgdate`, `expdate`,`type`) values ('$medicineID','$newMedName','$newMedGenName','$newMedCategory','$newMedsubCategory','$newMedDosage','$newMedStocks','$newMedMfgDate','$newMedExpDate','$type')";
    $reportresult = mysqli_query($con,$newmedreportsql);
    $admin_id = $_SESSION['active_admin_ID'];
    $admin_action = '0';
    $logsql = "Insert into `inventory_logs`(`admin_id`,`medicine_id`,`admin_action`) values('$admin_id','$medicineID','$admin_action')";
    $logresult = mysqli_query($con,$logsql);
function generate_6_Digits(): string
{
    $key=0;
    try {
        $key = random_int(0, 999999);
    } catch (Exception $e) {
    }
    return str_pad($key, 6, 0, STR_PAD_LEFT);
}
function generateID($_6DigitCode,$finalCategory): string
{
    return date('Y')."-".$finalCategory."-".$_6DigitCode;
}
function validateID($con,$new_id){//check the generated ID if existing
    $tables = array('medinventory');
    foreach ($tables as $table){
        $result = mysqli_query($con,"SELECT id FROM $table WHERE id = '$new_id'");
        if(mysqli_num_rows($result)>0){
            //nag eexist na ung ID
            $_6DigitCode = generate_6_Digits();
            $_SESSION['final_id'] = $new_id = generateID($_6DigitCode,$_SESSION['category']);
            validateID($con,$new_id);
        }
    }
}
?>