<?php
session_start();

$patientID =   $_SESSION['active_individual_patient_ID'] ;
$patientPurok = "";
$patientType = "";

$amdinID =   $_SESSION['active_admin_ID'];

$inv_id=$_POST['inv_id'];
$medName=$_POST['medName'];
$medSubCat = $_POST['medSubCat'];
$qty=$_POST['qty'];
$interval=$_POST['interval'];
$dosage=$_POST['dosage'];
$no_of_times=$_POST['no_of_times'];
$description=$_POST['description'];
$start_date=$_POST['start_date'];
$end_date=$_POST['end_date'];
if($end_date==""||$end_date==null){
    $end_date=$start_date;
}

$con = null;
require '../DB_Connect.php';

$res  = mysqli_query($con,"SELECT*FROM walk_in_patient WHERE id='$patientID'");
if($row = mysqli_fetch_assoc($res)){
    $patientPurok = $row['purok'];
    $patientType = $row['patient_type'];
}

//stock
$ctr=0;
$residualStock=0;//stock to reduce sa next row kung naging negative ung nauna nang binawasan
$res = mysqli_query($con,"SELECT * FROM medinventory WHERE name = '$medName' AND dosage='$dosage' AND stock>0 ORDER BY dateadded");
while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];

    if($ctr==0){
        mysqli_query($con,"UPDATE medinventory SET stock = stock - $qty WHERE id = $id");
    }
    else{
        mysqli_query($con,"UPDATE medinventory SET stock = stock - $residualStock WHERE id = $id");
    }

    //if the row na nabawasan ng stock naging negative
    //gawin uling zero ung row na un tos ung negative value convert sa postive tos bawas sa kasunod na row haha
    $subQuery = mysqli_query($con,"SELECT * FROM medinventory WHERE id= $id");
    if ($subRow = mysqli_fetch_assoc($subQuery)){
        if($subRow['stock']>=0){
            break;
        }
        else{
            mysqli_query($con,"UPDATE medinventory SET stock = 0 WHERE id = $id");
            $residualStock = abs($subRow['stock']);
        }
    }
$ctr++;
}

$query = "
INSERT INTO medication_record VALUES (
                DEFAULT , '$amdinID','$patientID','$patientType','$patientPurok' ,DEFAULT , $inv_id, '$medName','$medSubCat','$qty', '$dosage','$no_of_times',
                                      '$interval',DEFAULT ,'$start_date', '$end_date', '$description'
                      
)

";
$res = mysqli_query($con,$query);

if($res){
    echo 1;
}
else{
    echo 0;
}

mysqli_close($con);

