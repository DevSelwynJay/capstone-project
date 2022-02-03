<?php
session_start();
$patientID =$_SESSION['active_individual_patient_ID'];
//echo $patientID;
//exit();
$con=null;
require '../DB_Connect.php';
$arr = array();
date_default_timezone_set('Asia/Manila');
$curr_date = date('Y-m-d');
$result = mysqli_query($con,"SELECT *, DATE_FORMAT(start_date,'%Y-%m-%d') as start_date_1 , 
       DATE_FORMAT(start_date,'%M %d, %Y') as start_date_formatted,
       DATE_FORMAT(end_date,'%Y-%m-%d') as end_date_1,
        DATE_FORMAT(end_date,'%M %d, %Y') as end_date_formatted
FROM medication_record WHERE patient_id = '$patientID'  ORDER BY date_given DESC");
while($row= mysqli_fetch_assoc($result)){

    if($curr_date>$row['end_date_1']){
        $row['can_edit']=0; //cant edit pag lumagpas na ang end of medication
    }
    else{
        $row['can_edit']=1; //can edit pag hindi pa lumalagpas na ang end of medication
    }

    //get admin name who give medicine
    $admin_id = $row['admin_id'];$admin_name = "unknown";
    $getAdminInfo = mysqli_query($con,"SELECT*FROM admin WHERE id = '$admin_id' ");
    if($r1 = mysqli_fetch_assoc($getAdminInfo)){
        $admin_name = $r1['first_name']." ".$r1['middle_name']." ".$r1['last_name'];
    }

    //singit ang admin name sa response
    $row['admin_name'] = $admin_name;

    $arr[] = $row;
}
echo json_encode($arr)
?>