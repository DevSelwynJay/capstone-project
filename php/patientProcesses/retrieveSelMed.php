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

    //get the current stock of the medicine in the selected medication
    $selectedMed = $row['medicine_name'];
    $selectedMedDosage = $row['dosage'];
  $get_curr_stock =  mysqli_query($con,"SELECT *, SUM(stock) as stock_count from medinventory WHERE
                 name = '$selectedMed' AND dosage = '$selectedMedDosage' AND
                   expdate > DATE_FORMAT(NOW(),'%Y-%m-%d') GROUP BY name,dosage");
  if($curr_stock_row= mysqli_fetch_assoc($get_curr_stock)){
      $curr_stock_row['stock_count'];
  }

    echo json_encode(array(
        "med_id"=>$row['medicine_id'],
        "name"=>$row['medicine_name'],
        "type"=>$row['type'], "med_sub_cat"=>$row['medicine_sub_category'],
         "dosage"=>$row['dosage'],
        "given_qty"=>$row['given_med_quantity'],
        "curr_stock"=>$curr_stock_row['stock_count'],
        "no_times"=>$row['no_times'],
         "interval"=>$row['interval_days'],
        "date_given"=> $row['date_given'],
        "start_date"=>$row['start_date'],
        "end_date"=>$row['end_date'],
        "description"=>$row['description']
    ));
}