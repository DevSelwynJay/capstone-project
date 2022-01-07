<?php
session_start();
$_SESSION['active_event_id'] = $_POST['event_id'];
$event_id = $_POST['event_id'];
$con = null;
require '../DB_Connect.php';
$result = mysqli_query($con,"SELECT *,DATE_FORMAT(start_date,'%Y-%m-%d') as start_date,DATE_FORMAT(end_date,'%Y-%m-%d') as end_date,
       DATE_FORMAT(date_given,'%b %d, %Y') as date_given
FROM medication_record WHERE event_id = $event_id ");
if($row = mysqli_fetch_assoc($result)){
   echo json_encode(array(
        "med_id"=>$row['medicine_id'],
        "name"=>$row['medicine_name'],
        "type"=>$row['type'], "med_sub_cat"=>$row['medicine_sub_category'],
         "dosage"=>$row['dosage'],
        "no_times"=>$row['no_times'],
         "interval"=>$row['interval_days'],
        "date_given"=> $row['date_given'],
        "start_date"=>$row['start_date'],
        "end_date"=>$row['end_date'],
        "description"=>$row['description']
    ));
}