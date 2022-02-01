<?php
$val = $_POST['filterValue'];
$con = null;
require "../../DB_Connect.php";

$_SESSION['arr'] = array();
//TODAYS patient
if($val=="1"){
$symbol = "=";
$minusClause = "";
query($con,$symbol,$minusClause);
}
else if($val=="2"){
    $symbol = "=";
    $minusClause = "-interval 1 day";
    query($con,$symbol,$minusClause);
}
else if($val=="3"){
    $symbol = ">=";
    $minusClause = "-interval 7 day";
    query($con,$symbol,$minusClause);
}
else if($val=="4"){
    $symbol = ">=";
    $minusClause = "-interval 30 day";
    query($con,$symbol,$minusClause);
}



//$result = mysqli_query($con,"SELECT*FROM walk_in_patient WHERE DATE_FORMAT(date_created,'%Y-%m-%d') >= DATE_FORMAT(NOW()-interval 7 day,'%Y-%m-%d')");

function query($con,$symbol,$minusClause){
    $rowmain=array();

    //para sa patient na wala pang record
    $whereClause = "AND DATE_FORMAT(date_created,'%Y-%m-%d') $symbol DATE_FORMAT(NOW()$minusClause,'%Y-%m-%d')";
    //para sa patient na may record
    $whereClause2 = "AND DATE_FORMAT(date_given,'%Y-%m-%d') $symbol DATE_FORMAT(NOW()$minusClause,'%Y-%m-%d')";

    $result = mysqli_query($con,"SELECT*,timestampdiff(year,birthday,NOW()) as age FROM walk_in_patient");
    while ($row = mysqli_fetch_assoc($result)){

        $hasMedConsultation=false;$hasVacConsultation=false;
        $row['last_consultation']="";//gawin none ang value sa dulo pag alang record

        //last med result kukunin
        $r1que= mysqli_query($con,"SELECT*,DATE_FORMAT(date_given,'%Y-%m-%d') as date_given_fd FROM medication_record WHERE patient_id='".$row['id']."' $whereClause2 ORDER BY date_given DESC");
        $lastMedConsultation="";
        if ($r1=mysqli_fetch_assoc($r1que)){
            $hasMedConsultation=true;
            $lastMedConsultation=$r1['date_given'];
//            echo json_encode($r1);
        }
        //last vac result kukunin
        $r1que= mysqli_query($con,"SELECT*,DATE_FORMAT(date_given,'%Y-%m-%d') as date_given_fd FROM vaccination_record WHERE patient_id='".$row['id']."' $whereClause2 ORDER BY date_given DESC");
        $lastVacConsultation="";
        if ($r1=mysqli_fetch_assoc($r1que)){
            $hasVacConsultation=true;
            $lastVacConsultation=$r1['date_given'];
//            echo json_encode($r1);
        }

        //compare the date from last vaccine and last med, ung malaki  kukunin which is ung latest
        if($hasMedConsultation&&$hasVacConsultation){
//            echo "Both";
            if($lastMedConsultation>$lastVacConsultation){
                $row['last_consultation'] = $lastMedConsultation;
//                echo "Med Higher";
            }
            else{
                $row['last_consultation'] = $lastVacConsultation;
//                echo "Vaccine Higher";
            }
        }
        else if(!$hasMedConsultation&&$hasVacConsultation){
            $row['last_consultation'] = $lastVacConsultation;
//            echo "Vaccine Only";
        }
        else if($hasMedConsultation&&!$hasVacConsultation){
            $row['last_consultation'] = $lastMedConsultation;
//            echo "Med Only";
        }
        else if(!$hasMedConsultation&&!$hasVacConsultation){
            //pag walang med/vac record at
            //huling tingan ung registration date pag di parin pasok sa selected date filter skip ang loop i continue
            $row['last_consultation'] = "None";
            $r2s = mysqli_query($con,"SELECT* FROM walk_in_patient WHERE id='".$row["id"]."' $whereClause");
            if(mysqli_num_rows($r2s)==0){
                continue;
            }
//            echo "No record";
        }


//        echo $row['last_consultation'];
//        echo "<br><br>";

        //set account type
        if($row['account_type']==2){
            //walk in
            $row['account_type']="Walk In";
        }
        else if($row['account_type']==3){
            //walk in
            $row['account_type']="From Online";
        }

        $row['name']=$row['first_name']." ".$row['middle_name']." ".$row['last_name']." ".$row['suffix'];
        $row["account_type"]=$row['account_type'];
        $row["last_consultation"]= $row['last_consultation'];
        $rowmain[]=$row;
//        echo "<br><br>";

    }
    echo json_encode($rowmain);

//    $whereClause = "WHERE DATE_FORMAT(date_given,'%Y-%m-%d') $symbol DATE_FORMAT(NOW()$minusClause,'%Y-%m-%d')";
//    $result = mysqli_query($con,"SELECT*FROM walk_in_patient INNER JOIN medication_record ON walk_in_patient.id = medication_record.patient_id ".$whereClause);
//    while ($r1 = mysqli_fetch_assoc($result)){
//        $_SESSION['arr'][]= $r1;
//    }
//
//    $whereClause = "WHERE DATE_FORMAT(date_created,'%Y-%m-%d') $symbol DATE_FORMAT(NOW()$minusClause,'%Y-%m-%d')";
//    $result = mysqli_query($con,"SELECT*FROM walk_in_patient ".$whereClause);
//    while ($r1 = mysqli_fetch_assoc($result)){
//        $_SESSION['arr'][]= $r1;
//    }
}
//echo json_encode($_SESSION['arr']);