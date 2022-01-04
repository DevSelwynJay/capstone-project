<?php
session_start();
$con = null;
require '../DB_Connect.php';

if(!isset($_SESSION['email'])||$_SESSION['account_type']!=2){
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
    exit();
}
$email = $_SESSION['email'];
$res = mysqli_query($con,"SELECT *, timestampdiff(year ,birthday,NOW()) as age, DATE_FORMAT(birthday,'%M %e, %Y') as bday FROM patient where email = '$email' ");
if(mysqli_num_rows($res)<=0){
    echo json_encode(array(
        "patient_name"=>"invalid patient email"
    ));
    exit();
}
if($res){
    if($row = mysqli_fetch_assoc($res)){

        //will use to check if there the same record in walk in patient db
        $_SESSION['pfname'] = $row['first_name'];
        $_SESSION['plname'] = $row['last_name'];
        $_SESSION['pmname'] = $row['middle_name'];
        $_SESSION['pbday'] = $row['birthday'];
        $_SESSION['ppurok'] = $row['purok'];

        $_SESSION['is_link']=true;//to determine that this is connected to patient record on the admin side
        $_SESSION['patient_id'] = $row['id'];

        echo json_encode(array(
            "patient_id"=>$row['id']
            ,"patient_name"=>$row['first_name']." ".$row['middle_name']." ".$row['last_name']
            ,"age"=>$row['age'],"gender"=>$row['gender'],"birthday"=>$row['bday'],
            "contact_no"=>$row['contact_no'], "address"=>"Purok ".$row['purok'].", ".$row['house_no']." ".$row['address']
        ));

    }
}
else{
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
}
