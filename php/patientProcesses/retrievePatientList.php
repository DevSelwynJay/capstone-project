<?php
session_start();
$con=null;
require '../DB_Connect.php';
$res = mysqli_query($con,"SELECT account_type,id, CONCAT(first_name,' ',middle_name,' ',last_name,' ',suffix) as name, patient_type, purok, address, timestampdiff(year,birthday,NOW()) as age , DATE_FORMAT(birthday,'%b %d %Y') as bday, DATE_FORMAT(date_created,'%b %d %Y') as date FROM walk_in_patient ORDER BY first_name");
$arr = array();
while ($row = mysqli_fetch_assoc($res)){

    if($row['account_type']==2){
        //walk in
        $row['account_type']="Walk In";
    }
    else if($row['account_type']==3){
        //walk in
        $row['account_type']="From Online";
    }
    $arr[] = $row;
}
echo json_encode($arr);
?>