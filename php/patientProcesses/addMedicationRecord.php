<?php
session_start();

$patientID =   $_SESSION['active_individual_patient_ID'] ;
$patientPurok = "";
$patientType = "";

$amdinID =   $_SESSION['active_admin_ID'];

$inv_id=$_POST['inv_id'];
$medName=$_POST['medName'];
$medCat=$_POST['medCat'];
$medSubCat = $_POST['medSubCat'];
$qty=$_POST['qty'];
$interval=abs($_POST['interval']);
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

$query = "
INSERT INTO medication_record VALUES (
                DEFAULT , '$amdinID','$patientID','$patientType','$patientPurok' ,DEFAULT , $inv_id, '$medName','$medSubCat','$qty', '$dosage','$no_of_times',
                                      '$interval',DEFAULT ,'$start_date', '$end_date', '$description'
                      
)

";
$res = mysqli_query($con,$query);

$event_id = mysqli_insert_id($con);

//reduce the inv stock based on the given quantity
$ctr=0;
$residualStock=0;//stock to reduce sa next row kung naging negative ung nauna na binawasan
$res = mysqli_query($con,"SELECT * FROM medinventory WHERE name = '$medName' AND dosage='$dosage' AND stock>0 AND expdate > DATE_FORMAT(NOW(),'%Y-%m-%d') ORDER BY dateadded");
while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];//get the id coz it will use to update the stock of item

    if($ctr==0){
        mysqli_query($con,"UPDATE medinventory SET stock = stock - $qty WHERE id = $id");
    }
    else{
        $qty = $residualStock;
        mysqli_query($con,"UPDATE medinventory SET stock = stock - $residualStock WHERE id = $id");
    }

    //check if the current row na nabawasan ng stock is naging negative
    //if naging negative gawin zero ung stock ng current row
    // tos ung negative value convert sa postive tos bawas sa kasunod na row haha
    $subQuery = mysqli_query($con,"SELECT * FROM medinventory WHERE id= $id");
    if ($subRow = mysqli_fetch_assoc($subQuery)){

        $mfg = $row['mfgdate'];
        $exp = $row['expdate'];

        if($subRow['stock']>=0){
            //record item released in medreport table
            mysqli_query($con,"INSERT INTO medreport (event_id,id,name,category,subcategory,dosage,stock,mfgdate,expdate,type)
                            VALUES ($event_id,$id ,'$medName','$medCat','$medSubCat','$dosage',$qty,'$mfg','$exp','Medicine')
                        ");
            break;
        }
        else{
            mysqli_query($con,"UPDATE medinventory SET stock = 0 WHERE id = $id");
            $residualStock = abs($subRow['stock']);
            //record item released in medreport table
            mysqli_query($con,"INSERT INTO medreport (event_id,id,name,category,subcategory,dosage,stock,mfgdate,expdate,type)
                            VALUES ($event_id,$id,'$medName','$medCat','$medSubCat','$dosage',$qty-$residualStock,'$mfg','$exp','Medicine')
                        ");
        }
    }
$ctr++;
}

//$qty=$_POST['qty'];//just to ensure that the qty is correct coz it can be reduce if 2 or more medicine are deducted

if($res){
    echo 1;
}
else{
    echo 0;
}

mysqli_close($con);

