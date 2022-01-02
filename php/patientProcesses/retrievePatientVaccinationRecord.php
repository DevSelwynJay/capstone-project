<?php
session_start();
$patientID =$_SESSION['active_individual_patient_ID'];
//$patientID = "2021-03-111222";
//echo $patientID;
//exit();
$con=null;
require '../DB_Connect.php';
$arr = array();
$query = "SELECT *,DATE_FORMAT(date_vaccinated,'%b %d, %Y') as date_vaccinated_fd,
       DATE_FORMAT(date_vaccinated,'%Y-%m-%d') as date_vaccinated,
       DATE_FORMAT(expected_next_date_vaccination,'%b %d, %Y') as next_date_fd,
        DATE_FORMAT(expected_next_date_vaccination,'%Y-%m-%d') as next_date
FROM vaccination_record WHERE patient_id = '$patientID' ";

$result = mysqli_query($con,$query);
while($row= mysqli_fetch_assoc($result)){

    //$row['sample']="sample"; singit key value pair
    $arr[] = $row;

}
echo json_encode($arr)
?>