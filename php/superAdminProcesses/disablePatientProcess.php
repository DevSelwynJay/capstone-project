<?php
//transfer data from patient table to patient archive and delete data transferred to patient table
session_start();
$patientId = $_POST['patId'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

$userDatas = array('patient_archive'/*,'patient'*/);
foreach ($userDatas as $userData){

    $result =  mysqli_query($con,"SELECT id FROM $userData WHERE id='$patientId'");
    if($patientId==$result){// the email is already in the database
        echo 0;
        break;
    }else{// the record is to be added to archive and deleted to original record
        //add sa db
        // Performing insert query execution to patient db
        $sql = "INSERT INTO patient_archive select * from patient where id='$patientId'";

        if(mysqli_query($con, $sql)){
            $sql = "DELETE FROM patient WHERE id='$patientId'";
            if(mysqli_query($con, $sql)){
                echo 1;
                break;
            }else{
                echo 0;
                break;
            }
        } else{
            echo 0;
            break;
        }

    }

}
?>