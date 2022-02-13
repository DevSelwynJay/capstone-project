<?php
session_start();
$con = null;
$allergies = $_POST['text'];
require "php/DB_Connect.php";
$patient_id = $_SESSION['active_individual_patient_ID'];
mysqli_query($con,"UPDATE walk_in_patient SET allergies = '$allergies' WHERE id = '$patient_id' ");