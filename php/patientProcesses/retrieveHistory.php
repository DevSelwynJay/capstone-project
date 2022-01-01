<?php
session_start();
$historyFilter = $_POST['historyFilter'];//All,Active,Finished
//$historyFilter = "Vaccine";//All,Active,Finished

$con = null;
require '../DB_Connect.php';

$_SESSION['allHistory'] = array();
$patientID =   $_SESSION['active_individual_patient_ID'] ;

function getMedication($con,$patientID,$querySuffix){
    $query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM medication_record WHERE patient_id = '$patientID' ".$querySuffix;
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

function getVaccination($con,$patientID,$querySuffix){

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

$querySuffixMed="";
$querySuffixVaccine="";

if($historyFilter=="Active"){
    $querySuffixMed="AND DATE_FORMAT(end_date,'%Y-%m-%d') >= DATE_FORMAT(NOW(),'%Y-%m-%d')";
    getMedication($con,$patientID,$querySuffixMed);
    getVaccination($con,$patientID,$querySuffixVaccine);
}
else if($historyFilter=="Finished"){
    $querySuffixMed="AND DATE_FORMAT(end_date,'%Y-%m-%d') < DATE_FORMAT(NOW(),'%Y-%m-%d')";
    getMedication($con,$patientID,$querySuffixMed);
    getVaccination($con,$patientID,$querySuffixVaccine);
}
else{
    getMedication($con,$patientID,$querySuffixMed);
    getVaccination($con,$patientID,$querySuffixVaccine);
}


usort( $_SESSION['allHistory'], function ($item1, $item2) {
    return $item2['date_given'] <=> $item1['date_given'];
});
echo json_encode( $_SESSION['allHistory']);
mysqli_close($con);