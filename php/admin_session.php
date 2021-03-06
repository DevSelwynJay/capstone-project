<?php
session_start();
$con = null;
require 'DB_Connect.php';
if(!isset($_SESSION['email'])||$_SESSION['account_type']!=1){
    echo json_encode(array(
        "admin_name"=>"no logged admin"
    ));
    exit();
}
$email = $_SESSION['email'];
$res = mysqli_query($con,"SELECT *, timestampdiff(year,birthday,NOW()) as age, DATE_FORMAT(birthday,'%b %d, %Y') as fd FROM admin where email = '$email' ");
if(mysqli_num_rows($res)<=0){
    echo json_encode(array(
        "admin_name"=>"invalid admin email"
    ));
    exit();
}
if($res){
    if($row = mysqli_fetch_assoc($res)){

        $_SESSION['active_admin_ID']  = $row['id'] ;
        $_SESSION['active_admin_name'] = $row['first_name']." ".$row['middle_name']." ".$row['last_name'];

       echo json_encode(array(
           "admin_id"=>$row['id']
           ,"admin_name"=>$row['first_name']." ".$row['middle_name']." ".$row['last_name'],
           "fname"=>$row['first_name'],"mname"=>$row['middle_name'],"lname"=>$row['last_name'],
           "gender"=>$row['gender'], "birthday"=>$row['fd'], "age"=>$row['age'],
           "address"=> $row['address']
        ));

    }
}
else{
    echo json_encode(array(
        "admin_name"=>"no logged admin"
    ));
}

?>