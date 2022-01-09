<?php
session_start();
$con = null;
require 'php/DB_Connect.php';
$result= array();

$Senior = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE patient_type = 'Senior' ");

$Adult = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE patient_type = 'Adult' ");

$Minor = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE patient_type = 'Minor' ");

$Pregnant = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE patient_type = 'Pregnant' ");

$PWD = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE patient_type = 'PWD' ");

$Infant = mysqli_query($con,"SELECT * FROM walk_in_patient WHERE patient_type = 'Infant' ");

$patientCount = mysqli_query($con,"SELECT * FROM walk_in_patient");

$vaccinated = mysqli_query($con,"SELECT * FROM vaccination_record GROUP BY patient_id");

$result= array(
    "Senior"=>mysqli_num_rows($Senior),
    "Adult"=>mysqli_num_rows($Adult),
    "Minor"=>mysqli_num_rows($Minor),
    "Pregnant"=>mysqli_num_rows($Pregnant),
    "PWD"=>mysqli_num_rows($PWD),
    "Infant"=>mysqli_num_rows($Infant),
    "patientCount"=>mysqli_num_rows($patientCount),
    "vaccinated"=>mysqli_num_rows($vaccinated),

    );

echo json_encode($result);