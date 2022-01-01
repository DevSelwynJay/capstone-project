<?php
session_start();
$historyFilter = $_POST['historyFilter'];//All,Medicine,Vaccine
//$historyFilter = "Vaccine";//All,Medicine,Vaccine

$con = null;
require '../DB_Connect.php';

$_SESSION['allHistory'] = array();
$patientID =   $_SESSION['active_individual_patient_ID'] ;

function getMedication($con,$patientID){
    $query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM medication_record WHERE patient_id = '$patientID' ";
    $result = mysqli_query($con,$query);
    while ($row  = mysqli_fetch_assoc($result)){
        $_SESSION['allHistory'][] = array(
            "name"=>$row['medicine_name'],
            "type"=> $row['type'],
            "date"=>$row['fd'],
            "description"=>$row['description'],
            "date_given"=>$row['date_given']//for sorting purposes only
        );
    }
}

function getVaccination($con,$patientID){

    $query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM vaccination_record WHERE patient_id = '$patientID' ";
    $result = mysqli_query($con,$query);
    while ($row  = mysqli_fetch_assoc($result)){
        $_SESSION['allHistory'][] = array(
            "name"=>$row['vaccine_name'],
            "type"=> $row['type'],
            "date"=>$row['fd'],
            "description"=>$row['description'],
            "date_given"=>$row['date_given']//for sorting purposes only
        );
    }
}

if($historyFilter=="All"){
    getMedication($con,$patientID);
    getVaccination($con,$patientID);
}
elseif ($historyFilter=="Medicine"){
    getMedication($con,$patientID);
}
elseif($historyFilter=="Vaccine"){
    getVaccination($con,$patientID);
}

usort( $_SESSION['allHistory'], function ($item1, $item2) {
    return $item2['date_given'] <=> $item1['date_given'];
});
echo json_encode( $_SESSION['allHistory']);
mysqli_close($con);