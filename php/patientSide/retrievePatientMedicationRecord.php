<?php
session_start();//PATIENT SIDE

$con=null;
require '../DB_Connect.php';
$id_in_walk_in_patient = $_SESSION['patient_id'];//

    $arr = array();
    $result = mysqli_query($con,"SELECT *, DATE_FORMAT(start_date,'%Y-%m-%d') as start_date_1 ,
        DATE_FORMAT(start_date,'%M %d, %Y') as start_date_formatted,
        DATE_FORMAT(end_date,'%Y-%m-%d') as end_date_1,
        DATE_FORMAT(end_date,'%M %d, %Y') as end_date_formatted
        FROM medication_record
        WHERE patient_id = '$id_in_walk_in_patient'  ORDER BY date_given DESC");

    while($row= mysqli_fetch_assoc($result)){

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
    echo json_encode($arr);

mysqli_close($con);
?>