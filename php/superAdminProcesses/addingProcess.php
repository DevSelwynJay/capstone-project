<?php
//this code is to check if the gmail is already in the database for adding admin
session_start();
$email = $_POST['email'];
$fname = ucfirst($_POST['fname']);
$lname = ucfirst($_POST['lname']);
$mname = ucfirst($_POST['mname']);
$password = $_POST['password'];
$gender = ucfirst($_POST['gender']);
$confirmpass = $_POST['confirmpass'];
$contactno = $_POST['contactno'];
$workcat = ucwords($_POST['workcat']);

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}
//check if the gmail exist in admin or patient
//First, check the email to superAdmin table
//pag wala, search the email to admin table
//pag wala parin, sa patient table hanapin

$userTables = array('admin'/*,'patient'*/);

foreach ($userTables as $userTable){

    $result =  mysqli_query($con,"SELECT email FROM $userTable WHERE email='$email'");
    if($email==$result){// the email is already in the database
        echo 0;

    }else{// the email is to be added
        //add sa db
        // Performing insert query execution to admin db

        $sql = "INSERT INTO admin (account_type, last_name, first_name, middle_name, gender, email, password, contact_no, role) VALUES
        ('1', '$lname', '$fname', '$mname ', '$gender', '$email', '$password', '$contactno', '$workcat')";

        //mysqli_query($sql);

        if(mysqli_query($con, $sql)){
            echo 1;
        } else{
            echo 0;
        }

    }

}

?>