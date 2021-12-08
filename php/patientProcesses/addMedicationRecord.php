<?php
session_start();

$patientID =   $_SESSION['active_individual_patient_ID'] ;
$patientPurok = "";

$amdinID =   $_SESSION['active_admin_ID'];

$inv_id=$_POST['inv_id'];
$medName=$_POST['medName'];
$qty=$_POST['qty'];
$interval=$_POST['interval'];
$dosage=$_POST['dosage'];
$no_of_times=$_POST['no_of_times'];
$description=$_POST['description'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];

$con = null;
require '../DB_Connect.php';

$res  = mysqli_query($con,"SELECT*FROM walk_in_patient WHERE id='$patientID'");
if($row = mysqli_fetch_assoc($res)){
    $patientPurok = $row['purok'];
}


$query = "
INSERT INTO medication_record VALUES (
                DEFAULT , '$amdinID','$patientID','$patientPurok' ,DEFAULT , $inv_id, '$medName','$qty', '$dosage','$no_of_times',
                                      '$interval',DEFAULT ,'$start_date', '$end_date', '$description'
                      
)

";
$res = mysqli_query($con,$query);

if($res){
    echo 1;
}
else{
    echo 0;
}

mysqli_close($con);

