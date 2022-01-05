<?php
session_start();
$_SESSION['active_patientOA_ID'] = $_POST['patientOA_ID'];
$_SESSION['active_reqID'] =  $_POST['reqID'];
echo $_SESSION['active_patientOA_ID'].$_SESSION['active_reqID'];