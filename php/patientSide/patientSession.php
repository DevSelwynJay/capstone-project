<?php
session_start();
$con = null;
require '../DB_Connect.php';

if(!isset($_SESSION['email'])){
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
    exit();
}
else{
    $isPatient=false;
    foreach (array(2,3) as $item){

        if($item==$_SESSION['account_type']){
            $isPatient=true;
            break;
        }
    }
    if(!$isPatient){
        echo json_encode(array(
            "patient_name"=>"no logged patient"
        ));
        exit();
    }
}
$email = $_SESSION['email'];
$res = mysqli_query($con,"SELECT *, timestampdiff(year ,birthday,NOW()) as age, DATE_FORMAT(birthday,'%M %e, %Y') as bday FROM walk_in_patient where email = '$email' ");
if(mysqli_num_rows($res)<=0){
    echo json_encode(array(
        "patient_name"=>"invalid patient email"
    ));
    exit();
}
if($res){
    if($row = mysqli_fetch_assoc($res)){
        $_SESSION['is_link'] = true;
        $patient_id = $_SESSION['patient_id'] = $row['id'];
        $_SESSION['patientOA_pwd'] = $row['password'];

        echo json_encode(array(
            "patient_id"=>$row['id']
            ,"patient_name"=>$row['first_name']." ".$row['middle_name']." ".$row['last_name']
            ,"age"=>$row['age'],"gender"=>$row['gender'],"birthday"=>$row['bday'],
            "contact_no"=>$row['contact_no'], "address"=>"Purok ".$row['purok'].", ".$row['house_no']." ".$row['address'],
            "email"=>$row['email']
        ));



        //check the online account if there is existing med or vaccine record using the id of the walk_in_patient that matched
        $_SESSION['hasRecord']  = 0;
        $result = mysqli_query($con,"SELECT * FROM vaccination_record WHERE patient_id = '$patient_id' ");
        if(mysqli_num_rows($result)>0){$_SESSION['hasRecord']+=1;}
        $result = mysqli_query($con,"SELECT * FROM medication_record WHERE patient_id = '$patient_id' ");
        if(mysqli_num_rows($result)>0){$_SESSION['hasRecord']+=1;}


    }
}
else{
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
}
