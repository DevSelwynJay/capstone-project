<?php
session_start();
$con=null;
require '../DB_Connect.php';
$arr=array();


//Query for the mean time
//$medpatientqry = "Select * from `medication_record` limit $start_from,$rpp";

//Official Query
$medpatientqry = "Select * from `medication_record` where DATE_FORMAT(`date_given`,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') GROUP BY `patient_id`";
$medresult = mysqli_query($con,$medpatientqry);


while($rowmed = mysqli_fetch_assoc($medresult)){
    $idmed = $rowmed['patient_id'];
    $datemed = $rowmed ['date_given'];
    $patientmedqry = "Select * from `walk_in_patient` where `id` = '".$idmed."' ";
    $medresult2 = mysqli_query($con,$patientmedqry);
    if(mysqli_num_rows($medresult2)>0){
        while($rowresult = mysqli_fetch_assoc($medresult2)){
            $rowresult['name'] = $rowresult['first_name'].' '.$rowresult['middle_name'].' '.$rowresult['last_name'];
            $rowresult['consultation_type']="Medication";


            $arr[]=$rowresult;
        }
    }
}
    echo json_encode($arr);




