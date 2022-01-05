<?php
session_start();
$_SESSION['active_patientOA_ID'] = $_POST['patientOA_ID'];
$_SESSION['active_reqID'] =  $_POST['reqID'];
$_SESSION['active_email'] =  $_POST['email'];
echo $_SESSION['active_patientOA_ID'].$_SESSION['active_reqID'];