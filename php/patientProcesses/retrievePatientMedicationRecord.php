<?php
session_start();
$patientID =$_SESSION['active_individual_patient_ID'];
//echo $patientID;
//exit();
$con=null;
require '../DB_Connect.php';
$arr = array();
$result = mysqli_query($con,"SELECT *, DATE_FORMAT(start_date,'%Y-%m-%d') as start_date_1 , 
       DATE_FORMAT(start_date,'%M %d, %Y') as start_date_formatted,
       DATE_FORMAT(end_date,'%Y-%m-%d') as end_date_1,
        DATE_FORMAT(end_date,'%M %d, %Y') as end_date_formatted
FROM medication_record WHERE patient_id = '$patientID'");
while($row= mysqli_fetch_assoc($result)){
    $arr[] = $row;
}
echo json_encode($arr)
?>