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
            "type"=> $row['type'].": ".$row['medicine_sub_category'],
            "date"=>$row['fd'],
            "description"=>$row['description'],
            "date_given"=>$row['date_given']//for sorting purposes only
        );
    }
}

function getVaccination($con,$patientID,$querySuffix){

    $query = "SELECT *,DATE_FORMAT(date_given,'%b %d, %Y') as fd FROM vaccination_record WHERE patient_id = '$patientID' ".$querySuffix;
    $result = mysqli_query($con,$query);
    while ($row  = mysqli_fetch_assoc($result)){
        $_SESSION['allHistory'][] = array(
            "name"=>$row['vaccine_name'],
            "type"=> $row['type'].": ".$row['vaccine_sub_category'],
            "date"=>$row['fd'],
            "description"=>$row['description'],
            "date_given"=>$row['date_given']//for sorting purposes only
        );
    }
}

function queryFinishedVaccine($con,$patientID){
    $response = array();

//logic select all vaccine taken by the patient then subquery the latest to display na next sched
// if walang next sched, lilitaw sa finished tab ng history
    $res = mysqli_query($con,"SELECT * FROM vaccination_record WHERE patient_id = '$patientID'  GROUP BY vaccine_name");
    while ($row = mysqli_fetch_assoc($res)){
        $curr_vaccine = $row['vaccine_name'];

        //kunin lang ung unang lumabas
        $subRest = mysqli_query($con,"SELECT *, DATE_FORMAT(date_given,'%b %d, %Y') as fd,
       DATE_FORMAT(expected_next_date_vaccination,'%b %d, %Y') as next_sched FROM vaccination_record
        WHERE patient_id = '$patientID'and vaccine_name = '$curr_vaccine' 
        ORDER BY date_given DESC
        ");
        //kunin lang ung unang lumabas para sa latest
        if($subRow= mysqli_fetch_assoc($subRest)){

            if(!is_null($subRow['expected_next_date_vaccination'])){
                continue;
            }
            //singit sa row array ng main loop
            $row['curr_dose'] = mysqli_num_rows($subRest);//naka ilang dose na
            $row['rec_no_dose'] = $subRow['reccommended_no_of_dosage'];
            $row['next_sched'] =  $subRow['next_sched'];

            $_SESSION['allHistory'][] = array(
                "name"=>$curr_vaccine,
                "type"=> $subRow['type'].": ".$subRow['vaccine_sub_category'],
                "date"=>$subRow['fd'],
                "description"=>$subRow['description'],
                "date_given"=>$subRow['date_given']//for sorting purposes only
            );
        }

//        $response[] = array("vaccine_name"=>$curr_vaccine,
//            "rec_no_dose" =>  $row['rec_no_dose'],
//            "curr_dose"=>  $row['curr_dose'],
//            "next_sched"=> $row['next_sched']
//        );
    }
}

function queryActiveVaccine($con,$patientID){
    $response = array();

//logic select all vaccine taken by the patient then subquery the latest to display na next sched
// if walang next sched, lilitaw sa finished tab ng history
    $res = mysqli_query($con,"SELECT * FROM vaccination_record WHERE patient_id = '$patientID'  GROUP BY vaccine_name");
    while ($row = mysqli_fetch_assoc($res)){
        $curr_vaccine = $row['vaccine_name'];

        //kunin lang ung unang lumabas
        $subRest = mysqli_query($con,"SELECT *, DATE_FORMAT(date_given,'%b %d, %Y') as fd,
       DATE_FORMAT(expected_next_date_vaccination,'%b %d, %Y') as next_sched FROM vaccination_record
        WHERE patient_id = '$patientID'and vaccine_name = '$curr_vaccine' 
        ORDER BY date_given DESC
        ");
        //kunin lang ung unang lumabas para sa latest
        if($subRow= mysqli_fetch_assoc($subRest)){

            if(is_null($subRow['expected_next_date_vaccination'])){
                continue;
            }
            //singit sa row array ng main loop
            $row['curr_dose'] = mysqli_num_rows($subRest);//naka ilang dose na
            $row['rec_no_dose'] = $subRow['reccommended_no_of_dosage'];
            $row['next_sched'] =  $subRow['next_sched'];

            $_SESSION['allHistory'][] = array(
                "name"=>$curr_vaccine." (Dose ".$row['curr_dose']." of ".$row['rec_no_dose'].")",
                "type"=> $subRow['type'].": ".$subRow['vaccine_sub_category'],
                "date"=>$subRow['fd'],
                "description"=>$subRow['description'],
                "date_given"=>$subRow['date_given']//for sorting purposes only
            );
        }



//        $response[] = array("vaccine_name"=>$curr_vaccine,
//            "rec_no_dose" =>  $row['rec_no_dose'],
//            "curr_dose"=>  $row['curr_dose'],
//            "next_sched"=> $row['next_sched']
//        );



    }
}

$querySuffixMed="";
$querySuffixVaccine="";

if($historyFilter=="Active"){//
    $querySuffixMed="AND DATE_FORMAT(end_date,'%Y-%m-%d') >= DATE_FORMAT(NOW(),'%Y-%m-%d')";
    $querySuffixVaccine = "AND DATE_FORMAT(expected_next_date_vaccination,'%Y-%m-%d') >= DATE_FORMAT(NOW(),'%Y-%m-%d')";
    //ung may next schedule pa ng  vaccine
    getMedication($con,$patientID,$querySuffixMed);
//    getVaccination($con,$patientID,$querySuffixVaccine);
    queryActiveVaccine($con,$patientID);
}
else if($historyFilter=="Finished"){
    $querySuffixMed="AND DATE_FORMAT(end_date,'%Y-%m-%d') < DATE_FORMAT(NOW(),'%Y-%m-%d')";
    $querySuffixVaccine = "AND DATE_FORMAT(expected_next_date_vaccination,'%Y-%m-%d') < DATE_FORMAT(NOW(),'%Y-%m-%d')";
    getMedication($con,$patientID,$querySuffixMed);
    //getVaccination($con,$patientID,$querySuffixVaccine);
    queryFinishedVaccine($con,$patientID);
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