<?php
$con=null;
require '../DB_Connect.php';

extract($_POST);

if(isset($_POST['newMedName']) && isset($_POST['newMedCategory']) && isset($_POST['newMedStocks']) && isset($_POST['newMedMfgDate']) && isset($_POST['newMedExpDate'])){

    $newmedicinesql = "Insert into `medinventory` (`name`, `category`, `stock`, `mfgdate`, `expdate`) values ('$newMedName','$newMedCategory','$newMedStocks','$newMedMfgDate','$newMedExpDate')";


    $result = mysqli_query($con,$newmedicinesql);


}

?>