<?php
session_start();

$patientID =   $_SESSION['active_individual_patient_ID'] ;
$patientPurok = "";
$patientType = "";

$amdinID =   $_SESSION['active_admin_ID'];

$inv_id=$_POST['inv_id'];
$inv_name=$_POST['inv_name'];
$inv_type=$_POST['inv_type'];
$sub_category = $_POST['sub_category'];
$dosage = $_POST['dosage'];
$rec_no_dosage=$_POST['rec_no_dosage'];
$qty=1;//always one
$description_vaccine=$_POST['description_vaccine'];
$set_next_sched=$_POST['set_next_sched'];

$con = null;
require '../DB_Connect.php';

$res  = mysqli_query($con,"SELECT*FROM walk_in_patient WHERE id='$patientID'");
if($row = mysqli_fetch_assoc($res)){
    $patientPurok = $row['purok'];
    $patientType = $row['patient_type'];
}

$query="";//nadoble kasi need nnull kapag wlang laman ung date
if($set_next_sched==""||$set_next_sched==null){
    $query = "
INSERT INTO vaccination_record VALUES (
                DEFAULT , '$amdinID','$patientID','$patientType','$patientPurok' ,DEFAULT , '$inv_id', '$inv_name','$dosage','$sub_category', '$rec_no_dosage',DEFAULT,
                                      DEFAULT ,NULL, '$description_vaccine'
                      
)

";
}
else{
    $query = "
INSERT INTO vaccination_record VALUES (
                DEFAULT , '$amdinID','$patientID','$patientType','$patientPurok' ,DEFAULT , '$inv_id', '$inv_name','$dosage','$sub_category', '$rec_no_dosage',DEFAULT,
                                      DEFAULT ,'$set_next_sched', '$description_vaccine'
                      
)

";
}
$res = mysqli_query($con,$query);
$event_id = mysqli_insert_id($con);

//reduce the inv stock based on the given quantity
$ctr=0;
$residualStock=0;//stock to reduce sa next row kung naging negative ung nauna na binawasan
$res = mysqli_query($con,"SELECT * FROM medinventory WHERE name = '$inv_name' AND dosage='$dosage' AND stock>0 AND expdate > DATE_FORMAT(NOW(),'%Y-%m-%d') ORDER BY dateadded");
while($row = mysqli_fetch_assoc($res)){
    $id = $row['id'];//get the id coz it will use to update the stock of item

    if($ctr==0){
        mysqli_query($con,"UPDATE medinventory SET stock = stock - $qty WHERE id = '$id'");
    }
    else{
        $qty = $residualStock;
        mysqli_query($con,"UPDATE medinventory SET stock = stock - $residualStock WHERE id = '$id'");
    }

    //check if the current row na nabawasan ng stock is naging negative
    //if naging negative gawin zero ung stock ng current row
    // tos ung negative value convert sa postive tos bawas sa kasunod na row haha
    $subQuery = mysqli_query($con,"SELECT * FROM medinventory WHERE id= '$id'");
    if ($subRow = mysqli_fetch_assoc($subQuery)){

        $mfg = $row['mfgdate'];
        $exp = $row['expdate'];

        if($subRow['stock']>=0){
            //record item released in medreport table
            mysqli_query($con,"INSERT INTO medreport (event_id,id,name,category,subcategory,dosage,stock,mfgdate,expdate,type)
                            VALUES ($event_id,'$id' ,'$inv_name','$inv_type','$sub_category','$dosage',$qty,'$mfg','$exp','Vaccine')
                        ");
            break;
        }
        else{
            mysqli_query($con,"UPDATE medinventory SET stock = 0 WHERE id = '$id'");
            $residualStock = abs($subRow['stock']);
            //record item released in medreport table
            mysqli_query($con,"INSERT INTO medreport (event_id,id,name,category,subcategory,dosage,stock,mfgdate,expdate,type)
                            VALUES ($event_id,'$id','$inv_name','$inv_type','$sub_category','$dosage',$qty-$residualStock,'$mfg','$exp','Vaccine')
                        ");
        }
    }
    $ctr++;
}

if($res){
    echo 1;
}
else{
    echo 0;
}

mysqli_close($con);

