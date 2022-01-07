<?php
session_start();
//kapag nagclick sa table row tatawagin ung script na to
$_SESSION['active_patientOA_ID'] = $_POST['patientOA_ID'];
$_SESSION['active_reqID'] =  $_POST['reqID'];
$_SESSION['active_email'] =  $_POST['email'];
$_SESSION['active_EMR_req_name'] =  $_POST['name'];
echo $_SESSION['active_patientOA_ID'].$_SESSION['active_reqID'];