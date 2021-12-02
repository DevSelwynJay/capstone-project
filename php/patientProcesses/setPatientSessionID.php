<?php
session_start();
$_SESSION['active_individual_patient_ID'] = $_POST['id'];
echo $_SESSION['active_individual_patient_ID']
?>