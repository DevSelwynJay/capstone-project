<?php
session_start();
$event_id = $_SESSION['active_event_id'];
//echo $event_id;
$con = null;
require '../DB_Connect.php';
//start:start,end:end,description:description,no_times:no_times,interval:interval
$start = $_POST['start'];
$end = $_POST['end'];
$description = $_POST['description'];
$no_times = $_POST['no_times'];
$interval = $_POST['interval'];
$qtyIsUpdate  = $_POST['qtyIsUpdate']; // 0 wala nag bago ,1 naupdate nadagdagan qty //2 naupdate pero nabawasan qty
$updated_qty = $_POST['updated_qty'];
$medName = $_POST['med_name'];
$dosage = $_POST['med_dosage'];

if($qtyIsUpdate==0){//di nagalaw qty
    $result = mysqli_query($con,"UPDATE medication_record 
SET start_date = '$start',end_date = '$end', description = '$description', no_times = '$no_times', interval_days = '$interval'
WHERE event_id = $event_id
");
}
else{//nadagdagan given qty or nabawasan
    //first step isauli ung nasa medreport na qty papuntang inventory para malinis
    $queryMedReport = mysqli_query($con,"SELECT * FROM medreport WHERE event_id = $event_id AND type = 'Medicine' ");
    if(mysqli_num_rows($queryMedReport)>0){
        while ($row_QMR = mysqli_fetch_assoc($queryMedReport)){
            $inv_id = $row_QMR['id'];
            $stock = $row_QMR['stock'];
            mysqli_query($con,"UPDATE medinventory SET stock = stock + $stock WHERE id = '$inv_id'");

        }
    }
//    delete the corresponding record of the event ID
    mysqli_query($con,"DELETE FROM medreport WHERE event_id = $event_id AND type = 'Medicine' ");

    if($qtyIsUpdate==1||$qtyIsUpdate==2){//dagdag given qty or bawas
//reduce the inv stock based on the given quantity
        $ctr=0;
        $residualStock=0;//stock to reduce sa next row kung naging negative ung nauna na binawasan
        $res = mysqli_query($con,"SELECT * FROM medinventory WHERE name = '$medName' AND dosage='$dosage' AND stock>0 AND expdate > DATE_FORMAT(NOW(),'%Y-%m-%d') ORDER BY dateadded");
        while($row = mysqli_fetch_assoc($res)){
            $id = $row['id'];//get the id coz it will use to update the stock of item

            if($ctr==0){
                mysqli_query($con,"UPDATE medinventory SET stock = stock - $updated_qty WHERE id = '$id'");
            }
            else{
                $updated_qty = $residualStock;
                mysqli_query($con,"UPDATE medinventory SET stock = stock - $residualStock WHERE id = '$id'");
            }

            //check if the current row na nabawasan ng stock is naging negative
            //if naging negative gawin zero ung stock ng current row
            // tos ung negative value convert sa postive tos bawas sa kasunod na row haha
            $subQuery = mysqli_query($con,"SELECT * FROM medinventory WHERE id= '$id'");
            if ($subRow = mysqli_fetch_assoc($subQuery)){

                $mfg = $row['mfgdate'];
                $exp = $row['expdate'];
                $medCat = $row['category'];
                $medSubCat = $row['subcategory'];

                if($subRow['stock']>=0){
                    //record item released in medreport table
                    mysqli_query($con,"INSERT INTO medreport (event_id,id,name,category,subcategory,dosage,stock,mfgdate,expdate,type)
                            VALUES ($event_id,'$id' ,'$medName','$medCat','$medSubCat','$dosage',$updated_qty,'$mfg','$exp','Medicine')
                        ");
                    break;
                }
                else{
                    mysqli_query($con,"UPDATE medinventory SET stock = 0 WHERE id = '$id'");
                    $residualStock = abs($subRow['stock']);
                    //record item released in medreport table
                    mysqli_query($con,"INSERT INTO medreport (event_id,id,name,category,subcategory,dosage,stock,mfgdate,expdate,type)
                            VALUES ($event_id,'$id','$medName','$medCat','$medSubCat','$dosage',$updated_qty-$residualStock,'$mfg','$exp','Medicine')
                        ");
                }
            }
            $ctr++;
        }

        $updated_qty = $_POST['updated_qty'];
        mysqli_query($con,"UPDATE medication_record
SET start_date = '$start',end_date = '$end', description = '$description', no_times = '$no_times', interval_days = '$interval', given_med_quantity = '$updated_qty'
WHERE event_id = $event_id
");
    }// end if($qtyIsUpdate==1){//dagdag given qty


}//end main else


echo mysqli_error($con);


