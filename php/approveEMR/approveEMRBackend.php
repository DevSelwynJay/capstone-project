<?php
session_start();

$con = null;
require '../DB_Connect.php';

$active_patientOA_ID = $_SESSION['active_patientOA_ID'];
$active_reqID = $_SESSION['active_reqID'];

//find the patient id from the request table to patient db
$result = mysqli_query($con,"SELECT * FROM patient WHERE id = '$active_patientOA_ID' ");
if(mysqli_num_rows($result)<=0){
    echo "no account";
    exit();
}

//then query it to get the info of the online patient account
if($row = mysqli_fetch_assoc($result)){//query online account
    //will use to check if there is the same record in walk in patient db
    $pfname =  $row['first_name'];
    $plname =  $row['last_name'];
    $pmname =  $row['middle_name'];
    $pbday  =  $row['birthday'];
    $ppurok =  $row['purok'];

    //check if online acc has the same record in walk in patient
    $subResult = mysqli_query($con,"SELECT *,DATE_FORMAT(birthday,'%b %d, %Y') as bday,timestampdiff(year,birthday,NOW()) as age
        FROM walk_in_patient 
        WHERE last_name = '$plname' AND first_name = '$pfname' AND middle_name = '$pmname' 
          AND birthday = '$pbday' AND purok = '$ppurok'  
        
        ");

    //then if may kamukang record si online acc sa walk_in_patient
    if(mysqli_num_rows($subResult)>0){
        //kunin ung id sa walk in patient
        if($subRow = mysqli_fetch_assoc($subResult)){
            $id_in_walk_in_patient=$subRow['id'];

            //reset the session variable related to emr request
            $_SESSION['active_emr_account'] = array(
                "name"=> $subRow['first_name']." ".$subRow['middle_name']." ".$subRow['last_name'],
                "gender"=> $subRow['gender'],"birthday"=>$subRow['bday'], "age"=>$subRow['age'],
                "address"=> "Purok ".$subRow['purok']." , ".$subRow['house_no']." ".$subRow['address'],
                "occupation"=> $subRow['occupation'], "civil_status"=>$subRow['civil_status'],
                "blood_type"=>$subRow['blood_type'], "weight"=>$subRow['weight'] , "height"=>$subRow['height'],
                "patient_type"=>$subRow['patient_type']
            );
            echo json_encode( $_SESSION['active_emr_account']);
            $_SESSION['active_emr_medication'] = array();



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
        }// if($subRow = mysqli_fetch_assoc($result))
    }//if(mysqli_num_rows($subResult)>0)

//    foreach ( $_SESSION['active_emr_medication'] as $item){
//        echo json_encode($item);
//    }

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
