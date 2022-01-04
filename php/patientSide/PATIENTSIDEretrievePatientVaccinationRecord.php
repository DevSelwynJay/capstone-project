<?php
$con=null;
require '../DB_Connect.php';
$id_in_walk_in_patient = $_SESSION['merge_id'];// //merge id is the id that is from walk in patient ,
// it was generate because the name,bday,purok of online patient account has
//the same record in walk in patient table

$arr = array();
$query = "SELECT *,DATE_FORMAT(date_vaccinated,'%b %d, %Y') as date_vaccinated_fd,
       DATE_FORMAT(date_vaccinated,'%Y-%m-%d') as date_vaccinated,
       DATE_FORMAT(expected_next_date_vaccination,'%b %d, %Y') as next_date_fd,
        DATE_FORMAT(expected_next_date_vaccination,'%Y-%m-%d') as next_date
FROM vaccination_record WHERE patient_id = '$id_in_walk_in_patient' ORDER BY date_vaccinated ASC";

$result = mysqli_query($con,$query);
while($row= mysqli_fetch_assoc($result)){
    $CurrentVaccineName = $row['vaccine_name'];
    $CurrentDateVaccinated = $row['date_vaccinated'];

    //sub query each vaccine from record for determining current dose/maximum dosage
    $current_dose = mysqli_query($con,"SELECT *, COUNT(vaccine_name) as vaccine_count FROM vaccination_record
                WHERE patient_id = '$id_in_walk_in_patient' AND vaccine_name = '$CurrentVaccineName' AND DATE_FORMAT(date_vaccinated,'%Y-%m-%d') <= DATE_FORMAT('$CurrentDateVaccinated','%Y-%m-%d')
                GROUP BY vaccine_name
                ");//DATE_FORMAT(date_vaccinated,'%Y-%m-%d') <= DATE_FORMAT('$CurrentDateVaccinated','%Y-%m-%d')
    if($subRow = mysqli_fetch_assoc($current_dose)){
        $row['current_dose'] = $subRow['vaccine_count'];
    }

    //$row['sample']="sample"; singit key value pair
    $arr[] = $row;

}
echo json_encode($arr);



?>