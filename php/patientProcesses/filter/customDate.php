<?php
$val = $_POST['date'];
//$val = "2022-02-01%%%2022-02-01";
//02/01/2022 - 02/01/2022
$con = null;
require "../../DB_Connect.php";


//TODAYS patient

$dates = explode("%%%",$val);
//$result = mysqli_query($con,"SELECT*FROM walk_in_patient WHERE DATE_FORMAT(date_created,'%Y-%m-%d') >= DATE_FORMAT(NOW()-interval 7 day,'%Y-%m-%d')");

    $rowmain=array();

    //para sa patient na wala pang record
    $whereClause = "AND DATE_FORMAT(date_created,'%Y-%m-%d') >= '$dates[0]' AND DATE_FORMAT(date_created,'%Y-%m-%d') <= '$dates[1]' ";
    //para sa patient na may record
    $whereClause2 = "AND DATE_FORMAT(date_given,'%Y-%m-%d') >= '$dates[0]' AND DATE_FORMAT(date_given,'%Y-%m-%d') <= '$dates[1]' ";

    $result = mysqli_query($con,"SELECT*,timestampdiff(year,birthday,NOW()) as age,date_format(date_created,'%Y-%m-%d') as date_created_fd  FROM walk_in_patient");
    while ($row = mysqli_fetch_assoc($result)){

        $hasMedConsultation=false;$hasVacConsultation=false;$execute=false;
        $row['last_consultation']="None";//gawin none ang value sa dulo pag alang record
        $row["sort"] = "1999-01-01";//sorting purposes only

        //last med result kukunin
        $r1que= mysqli_query($con,"SELECT*,date_format(date_given,'%b %d, %Y')as fd, DATE_FORMAT(date_given,'%Y-%m-%d') as date_given_fd FROM medication_record WHERE patient_id='".$row['id']."'  ORDER BY date_given DESC");
        $lastMedConsultation="";
        if ($r1=mysqli_fetch_assoc($r1que)){
            $hasMedConsultation=true;
            $lastMedConsultation=$r1['date_given_fd'];

        }
        //last vac result kukunin
        $r1que= mysqli_query($con,"SELECT*,date_format(date_given,'%b %d, %Y')as fd, DATE_FORMAT(date_given,'%Y-%m-%d') as date_given_fd FROM vaccination_record WHERE patient_id='".$row['id']."'  ORDER BY date_given DESC");
        $lastVacConsultation="";
        if ($r1=mysqli_fetch_assoc($r1que)){
            $hasVacConsultation=true;
            $lastVacConsultation=$r1['date_given_fd'];
        }

        //compare the date from last vaccine and last med, ung malaki  kukunin which is ung latest
        if($hasMedConsultation&&$hasVacConsultation){
//            echo "Both";
            if($lastMedConsultation>$lastVacConsultation){
                if($lastMedConsultation>=$dates[0]&&$lastMedConsultation<=$dates[1]){
                    $row['last_consultation'] = $lastMedConsultation;
                    $row["sort"] = $lastMedConsultation;
                    $execute=true;
                }
            }
            else{
                if($lastVacConsultation>=$dates[0]&&$lastVacConsultation<=$dates[1]){
                    $row['last_consultation'] = $lastVacConsultation;
                    $row["sort"] = $lastVacConsultation;
                    $execute=true;
                }

//
            }
        }
        else if(!$hasMedConsultation&&$hasVacConsultation){
            if($lastVacConsultation>=$dates[0]&&$lastVacConsultation<=$dates[1]){
                $row['last_consultation'] = $lastVacConsultation;
                $row["sort"] = $lastVacConsultation;
                $execute=true;
            }
        }
        else if($hasMedConsultation&&!$hasVacConsultation){
            if($lastMedConsultation>=$dates[0]&&$lastMedConsultation<=$dates[1]){
                $row['last_consultation'] = $lastMedConsultation;
                $row["sort"] = $lastMedConsultation;
                $execute=true;
            }
//            echo "Med Only";
        }
        else if(!$hasMedConsultation&&!$hasVacConsultation){
            //pag walang med/vac record at
            //huling tingan ung registration date pag di parin pasok sa selected date filter skip ang loop i continue
            $r2s = mysqli_query($con,"SELECT* FROM walk_in_patient WHERE id='".$row["id"]."' $whereClause");
            if(mysqli_num_rows($r2s)>0){
                $execute=true;
            }

//            echo "No record";
        }


//        echo $row['last_consultation'];
//        echo "<br><br>";

        if($execute){
//            echo "<h1>Pasok</h1>";
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


    }
usort( $rowmain, function ($item1, $item2) {
    return $item2['sort'] <=> $item1['sort'];
});

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

//echo json_encode($_SESSION['arr']);