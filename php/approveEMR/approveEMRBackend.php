<?php
session_start();

$con = null;
require '../DB_Connect.php';

$active_patientOA_ID = $_SESSION['active_patientOA_ID'];
$active_reqID = $_SESSION['active_reqID'];

//find the patient id from the request table to patient db
$result = mysqli_query($con,"SELECT *,DATE_FORMAT(birthday,'%b %d, %Y') as bday, timestampdiff(year,birthday,NOW()) as age
FROM walk_in_patient WHERE id = '$active_patientOA_ID' ");
if(mysqli_num_rows($result)<=0){
    echo "no account";
    exit();
}

//then query it to get the info of the online patient account
if($row = mysqli_fetch_assoc($result)){//query online account
    $id_in_walk_in_patient = $row['id'];

    //reset the session variable related to emr request
    $_SESSION['active_emr_account'] = array(
        "name"=> $row['first_name']." ".$row['middle_name']." ".$row['last_name'],
        "gender"=> $row['gender'],"birthday"=>$row['bday'], "age"=>$row['age'],
        "address"=> "Purok ".$row['purok']." , ".$row['house_no']." ".$row['address'],
        "occupation"=> $row['occupation'], "civil_status"=>$row['civil_status'],
        "blood_type"=>$row['blood_type'], "weight"=>$row['weight'] , "height"=>$row['height'],
        "patient_type"=>$row['patient_type']
    );
    echo json_encode( $_SESSION['active_emr_account']);
    $_SESSION['active_emr_medication'] = array();
    $_SESSION['active_emr_vaccination'] = array();



    //query now the medication record from med record table using the walk in patient id
    $queMed = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM medication_record WHERE patient_id = '$id_in_walk_in_patient' ORDER BY date_given DESC";
    $queMedResult = mysqli_query($con,$queMed);
    while ($row  = mysqli_fetch_assoc($queMedResult)){
        $_SESSION['active_emr_medication'][] = array(
            "name"=>$row['medicine_name']." (".$row['dosage'].")",
            "type"=> $row['type'].": ".$row['medicine_sub_category'],
            "date"=>$row['fd'],
            "description"=>$row['description'],
            "date_given"=>$row['date_given']//for sorting purposes only
        );
    }//while ($row  = mysqli_fetch_assoc($result))
    echo json_encode( $_SESSION['active_emr_medication']);

    $query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM vaccination_record WHERE patient_id = '$id_in_walk_in_patient' ORDER BY date_given DESC ";
    $result = mysqli_query($con,$query);
    while ($row  = mysqli_fetch_assoc($result)){
        $_SESSION['active_emr_vaccination'][] = array(
            "name"=>$row['vaccine_name'],
            "type"=> $row['type'].": ".$row['vaccine_sub_category'],
            "date"=>$row['fd'],
            "description"=>$row['description'],
            "date_given"=>$row['date_given']//for sorting purposes only
        );
    }

}




//$_SESSION['allHistory'] = array();
//    $query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM vaccination_record WHERE patient_id = '$patientID' ".$querySuffix;
//    $result = mysqli_query($con,$query);
//    while ($row  = mysqli_fetch_assoc($result)){
//        $_SESSION['allHistory'][] = array(
//            "name"=>$row['vaccine_name'],
//            "type"=> $row['type'].": ".$row['vaccine_sub_category'],
//            "date"=>$row['fd'],
//            "description"=>$row['description'],
//            "date_given"=>$row['date_given']//for sorting purposes only
//        );
//    }
