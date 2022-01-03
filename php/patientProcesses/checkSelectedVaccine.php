<?php
//purpose of this code is to determine the no. of dosage currently taken py specific patient
session_start();
$vaccine_name = $_POST['vaccine_name'];
//$vaccine_name = "IPV";
$patientID =   $_SESSION['active_individual_patient_ID'] ;

$con = null;
require '../DB_Connect.php';

$response = array();

$curr_dose = null;

$result = mysqli_query($con,"SELECT *, DATE_FORMAT(expected_next_date_vaccination,'%b %d, %Y') as next_date, 
        DATE_FORMAT(date_given,'%b %d, %Y') as date_given_fd
       FROM vaccination_record WHERE patient_id = '$patientID' AND vaccine_name = '$vaccine_name' ORDER BY date_given DESC ");
if(mysqli_num_rows($result)<=0){
    echo json_encode(array("status"=>0));
    exit();
}

$curr_dose =  mysqli_num_rows($result);

//getting only the latest record
if($row = mysqli_fetch_assoc($result)){

    //checked if next sched is > NOW()
    // if it is, then admin can add another dose for that specific patient
    $id = $row['event_id'];
    $count = mysqli_query($con,"SELECT * FROM vaccination_record WHERE
                            event_id = $id AND DATE_FORMAT(expected_next_date_vaccination,'%Y-%m-%d') > DATE_FORMAT(NOW(),'%Y-%m-%d')
        ");
    if(mysqli_num_rows($count)>0){// nasa feature
        $row['canAdd'] = 0;
    }
    else{
        $row['canAdd'] = 1;
    }

    $row['status'] = 1;
    $row['curr_dose'] = $curr_dose;
    echo json_encode($row);
}

