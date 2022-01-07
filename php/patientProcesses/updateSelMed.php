<?php
session_start();
$event_id = $_SESSION['active_event_id'];
echo $event_id;
$con = null;
require '../DB_Connect.php';
//start:start,end:end,description:description,no_times:no_times,interval:interval
$start = $_POST['start'];
$end = $_POST['end'];
$description = $_POST['description'];
$no_times = $_POST['no_times'];
$interval = $_POST['interval'];

$result = mysqli_query($con,"UPDATE medication_record 
SET start_date = '$start',end_date = '$end', description = '$description', no_times = '$no_times', interval_days = '$interval'
WHERE event_id = $event_id
");

echo mysqli_error($con);


