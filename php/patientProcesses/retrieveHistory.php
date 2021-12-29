<?php
session_start();

$con = null;
require '../DB_Connect.php';

$allHistory = array();
$patientID =   $_SESSION['active_individual_patient_ID'] ;

$query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM medication_record WHERE patient_id = '$patientID' ";
$result = mysqli_query($con,$query);
while ($row  = mysqli_fetch_assoc($result)){
    $allHistory[] = array(
        "name"=>$row['medicine_name'],
         "type"=> $row['type'],
        "date"=>$row['fd'],
        "description"=>$row['description'],
        "date_given"=>$row['date_given']//for sorting purposes only
    );
}

$query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM vaccination_record WHERE patient_id = '$patientID' ";
$result = mysqli_query($con,$query);
while ($row  = mysqli_fetch_assoc($result)){
    $allHistory[] = array(
        "name"=>$row['vaccine_name'],
        "type"=> $row['type'],
        "date"=>$row['fd'],
        "description"=>$row['description'],
        "date_given"=>$row['date_given']//for sorting purposes only
    );
}
usort($allHistory, function ($item1, $item2) {
    return $item2['date_given'] <=> $item1['date_given'];
});
echo json_encode($allHistory);
mysqli_close($con);