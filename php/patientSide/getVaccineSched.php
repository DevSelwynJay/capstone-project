<?php
session_start();//PATIENT SIDE

$con=null;
require '../DB_Connect.php';

$patientID= $_SESSION['merge_id'];

$response = array();

//logic select all vaccine taken by the patient then subquery the latest to display na next sched
$res = mysqli_query($con,"SELECT * FROM vaccination_record WHERE patient_id = '$patientID' GROUP BY vaccine_name");
while ($row = mysqli_fetch_assoc($res)){
     $curr_vaccine = $row['vaccine_name'];

     //kunin lang ung unang lumabas
     $subRest = mysqli_query($con,"SELECT *,DATE_FORMAT(expected_next_date_vaccination,'%b %d, %Y') as next_sched FROM vaccination_record WHERE patient_id = '$patientID'
                and vaccine_name = '$curr_vaccine' ORDER BY date_given DESC
        ");
    //kunin lang ung unang lumabas para sa latest
     if($subRow= mysqli_fetch_assoc($subRest)){
         $row['rec_no_dose'] = $subRow['reccommended_no_of_dosage'];
         $row['next_sched'] =  $subRow['next_sched'];
     }

    $row['curr_dose'] = mysqli_num_rows($subRest);

     $response[] = array("vaccine_name"=>$curr_vaccine,
         "rec_no_dose" =>  $row['rec_no_dose'],
         "curr_dose"=>  $row['curr_dose'],
         "next_sched"=> $row['next_sched']
         );


}

echo json_encode($response);