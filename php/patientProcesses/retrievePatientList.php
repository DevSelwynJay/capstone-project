<?php
session_start();
$con=null;
require '../DB_Connect.php';
$res = mysqli_query($con,"SELECT *,account_type,id, CONCAT(first_name,' ',middle_name,' ',last_name,' ',suffix) as name, patient_type, purok, address, timestampdiff(year,birthday,NOW()) as age , DATE_FORMAT(birthday,'%b %d %Y') as bday, DATE_FORMAT(date_created,'%b %d %Y') as date FROM walk_in_patient ORDER BY first_name");
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

    $row["last_consultation"]="None";//kapag may consulation record maoover
    $row["sort"] = "1999-01-01";//sorting purposes only

    $getLastMedication = mysqli_query($con,"SELECT *,date_format(date_given,'%Y-%m-%d')as fd FROM medication_record WHERE patient_id = '".$row['id']."' ORDER BY date_given DESC");
    if($r1=mysqli_fetch_assoc($getLastMedication)){
        $row["last_consultation"] = $r1['fd'];
        $row["sort"] = $r1['date_given'];//sorting purposes only
        $getLastVac = mysqli_query($con,"SELECT *,date_format(date_given,'%Y-%m-%d')as fd FROM vaccination_record WHERE patient_id = '".$row['id']."' ORDER BY date_given DESC");
        if(mysqli_num_rows($getLastVac)>0){
            if($r2=mysqli_fetch_assoc($getLastVac)){
                if($r2['fd']>$r1['fd']){
                    $row["last_consultation"] = $r2['fd'];
                    $row["sort"] = $r2['date_given'];//sorting purposes only
                }
            }
        }
    }
    else{//wlang medication
        $getLastVac = mysqli_query($con,"SELECT *,date_format(date_given,'%Y-%m-%d')as fd FROM vaccination_record WHERE patient_id = '".$row['id']."' ORDER BY date_given DESC");
        if(mysqli_num_rows($getLastVac)>0){
            if($r2=mysqli_fetch_assoc($getLastVac)){
                    $row["last_consultation"] = $r2['fd'];
                    $row["sort"] = $r2['date_given'];//sorting purposes only
            }
        }
    }
    $arr[] = $row;
}

usort( $arr, function ($item1, $item2) {
    return $item2['sort'] <=> $item1['sort'];
});

echo json_encode($arr);
?>