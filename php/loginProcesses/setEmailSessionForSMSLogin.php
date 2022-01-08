<?php
session_start();
//pang by pass kasi iba process sa sms  /para mag kalaman lang ung session email
$_SESSION['email'] = $_SESSION['email_session_for_sms_otp'];