<?php
session_start();


$con = null;
require '../DB_Connect.php';

//echo 1;
$fname = strtoupper(substr($_POST['fname'],0,1)).strtolower(substr($_POST['fname'],1));
$mname = strtoupper(substr($_POST['mname'],0,1)).strtolower(substr($_POST['mname'],1));
$lname = strtoupper(substr($_POST['lname'],0,1)).strtolower(substr($_POST['lname'],1));

$suffix = $_POST['suffix'];
if($suffix!=""){
    $lname.=" ".$suffix;
}

$occu = $_POST['occu'];
$civil = $_POST['civil'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$bday = $_POST['bday'];
$purok = $_POST['purok'];
$house_no = $_POST['house_no'];

$bloodType = $_POST['bloodType'];
$height = $_POST['height'];
$weight = $_POST['weight'];

$patientType = $_POST['patientType'];

function generate_6_Digits(): string
{
    $key=0;
    try {
        $key = random_int(0, 999999);
    } catch (Exception $e) {
    }
    return str_pad($key, 6, 0, STR_PAD_LEFT);
}

function generateID($_6DigitCode): string
{
    return date('Y')."-03-".$_6DigitCode;
}

function validateID($con,$new_id){//check the generated ID if existing

    $tables = array('patient','pending_patient','patient_archive');
    foreach ($tables as $table){
        $result = mysqli_query($con,"SELECT id FROM $table WHERE id = '$new_id'");
        if(mysqli_num_rows($result)>0){
            //nag eexist na ung ID
            $_6DigitCode = generate_6_Digits();
            $_SESSION['final_id'] = $new_id = generateID($_6DigitCode);
            validateID($con,$new_id);
        }
    }
}

$_6DigitCode = generate_6_Digits();
$_SESSION['final_id'] = $new_id = generateID($_6DigitCode);
validateID($con,$new_id);

$patientID = $_SESSION['final_id'];

$query = "INSERT INTO walk_in_patient VALUES (
                 DEFAULT ,'$patientID','$lname','$fname','$mname'
                 ,'$gender','$bday','$purok','$house_no','Sto. Rosario Paombong Bulacan'
                 ,'$occu','$civil','$bloodType','$weight','$height'
                 ,'$patientType','$email','','$contact',''
                 ,DEFAULT 
                                   
                                   
)";
$result = mysqli_query($con,$query);

if($result){
    echo 1;
}
else{
    echo 0;
}