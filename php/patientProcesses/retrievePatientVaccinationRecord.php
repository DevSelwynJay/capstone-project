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
FROM vaccination_record WHERE patient_id = '$patientID' ORDER BY date_vaccinated ASC";

$result = mysqli_query($con,$query);
while($row= mysqli_fetch_assoc($result)){
    $CurrentVaccineName = $row['vaccine_name'];
    $CurrentDateVaccinated = $row['date_vaccinated'];

    //sub query each vaccine from record for determining current dose/maximum dosage
    $current_dose = mysqli_query($con,"SELECT *, COUNT(vaccine_name) as vaccine_count FROM vaccination_record
                WHERE patient_id = '$patientID' AND vaccine_name = '$CurrentVaccineName' AND DATE_FORMAT(date_vaccinated,'%Y-%m-%d') <= DATE_FORMAT('$CurrentDateVaccinated','%Y-%m-%d')
                GROUP BY vaccine_name
                ");//DATE_FORMAT(date_vaccinated,'%Y-%m-%d') <= DATE_FORMAT('$CurrentDateVaccinated','%Y-%m-%d')
    if($subRow = mysqli_fetch_assoc($current_dose)){
        $row['current_dose'] = $subRow['vaccine_count'];
    }

    //kunin ung updated date vaccinated ng specific vaccine tapos icompare sa date_vaccinated ng current loop
    //pag mas mababa ung date_vaccinated ng current loop di maeedit,,,, ung latest lang ang maeddit
    $can_edit_date_record =mysqli_query($con,"SELECT *, DATE_FORMAT(date_vaccinated,'%Y-%m-%d') as latest_date_vaccinated FROM vaccination_record
                WHERE patient_id = '$patientID' AND vaccine_name = '$CurrentVaccineName' ORDER BY date_vaccinated DESC
                ");
    if($_3rdRow = mysqli_fetch_assoc($can_edit_date_record)){
        if($CurrentDateVaccinated<$_3rdRow['latest_date_vaccinated']){
            $row['can_edit']= 0;
        }
        else{
            $row['can_edit']= 1;
        }
    }

    //get admin name who give medicine
    $admin_id = $row['admin_id'];$admin_name = "unknown";
    $getAdminInfo = mysqli_query($con,"SELECT*FROM admin WHERE id = '$admin_id' ");
    if($r1 = mysqli_fetch_assoc($getAdminInfo)){
        $admin_name = $r1['first_name']." ".$r1['middle_name']." ".$r1['last_name'];
    }

    //singit ang admin name sa response
    $row['admin_name'] = $admin_name;

    //$row['sample']="sample"; singit key value pair
    $arr[] = $row;

}
echo json_encode($arr)
?>