<?php
session_start();


$con = null;
require '../DB_Connect.php';

//echo 1;
$trimmedFname = trim($_POST['fname']);
$trimmedMname = trim($_POST['mname']);
$trimmedLname = trim($_POST['lname']);

$fname = strtoupper(substr($trimmedFname,0,1)).strtolower(substr($trimmedFname,1));
$mname = strtoupper(substr($trimmedMname,0,1)).strtolower(substr($trimmedMname,1));
$lname = strtoupper(substr($trimmedLname,0,1)).strtolower(substr($trimmedLname,1));

$suffix = preg_replace('/[^A-Za-z0-9\-]/', '', trim($_POST['suffix']));//remove special character

$occu = trim($_POST['occu']);
$civil = trim($_POST['civil']);
$email = trim($_POST['email']);
$contact = trim($_POST['contact']);
$gender = trim($_POST['gender']);
$bday = trim($_POST['bday']);
$purok = trim($_POST['purok']);
$house_no = abs((int)trim($_POST['house_no']));

$bloodType = $_POST['bloodType'];
$height = $_POST['height'];
$weight = $_POST['weight'];

$patientType = trim($_POST['patientType']);

//validate contact and email if provided
if($contact!=""||$email!=""){
   require 'finalValidation.php';
   // the code will exit if there is a duplicate entry and return error message
}


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
    return date('Y')."-02-".$_6DigitCode;
}

function validateID($con,$new_id){//check the generated ID if existing

    $tables = array(/*'patient','pending_patient','patient_archive'*/'walk_in_patient','pending_patient','declined_patient');
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

//email and password is optional in adding new walk in patient
//but email and password needs to be unique
//if many account added with no email and contact
//empty column will produce resulting to error
//to solve, if walk in patient provide empty email/pwd the value would be its ID including the word none
$temp_email=null;
if($email==""||$email==null){
   $temp_email = $email = "none-".$patientID;
}
if($contact==""||$contact==null){
    $contact = "none-".$patientID;
}

//another added validation pag may kamuka na name bday purok bawal
$tables = array('walk_in_patient','pending_patient');
foreach ($tables as $table){
    $resultCheckDuplication = mysqli_query($con,"SELECT * FROM $table 
WHERE last_name = '$lname' AND first_name='$fname' AND middle_name='$mname' AND suffix = '$suffix'
AND purok = $purok AND birthday = '$bday'
");
    if(mysqli_num_rows($resultCheckDuplication)>0){
        echo "Cannot add patient. Duplication Detected!";
        exit();
    }
    $resultCheckDuplication = mysqli_query($con,"SELECT * FROM $table 
WHERE last_name = '$lname' AND first_name='$fname' AND middle_name='$mname' AND suffix = '$suffix'
 AND birthday = '$bday'
");
    if(mysqli_num_rows($resultCheckDuplication)>0){
        echo "Cannot add patient. Duplication Detected!";
        exit();
    }
}

function generateRandomString($length = 8): string
{
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$_SESSION['randomPassword'] = $randomPassword = generateRandomString();
$_SESSION['newAddWalkInPatientEmail'] = $email;
$_SESSION['newAddWalkInPatientName'] = $fname." ".$mname." "." ".$lname." ".$suffix;

$query = "INSERT INTO walk_in_patient VALUES (
                 2,DEFAULT, '$patientID','$lname','$fname','$mname','$suffix'
                 ,'$gender','$bday','$purok','$house_no','Sto. Rosario Paombong Bulacan'
                 ,'$occu','$civil','$bloodType','$weight','$height'
                 ,'$patientType','$email','$randomPassword','$contact',''
                 ,DEFAULT 
                                   
                                   
)";

//if walk in patient nag provide ng email, magkakaaccess sa online acc si patient, then send ng temp password
if($email!=$temp_email){
    require 'sendPassword.php';
}

$result = mysqli_query($con,$query);

if($result){
    echo 1;
}
else{
    echo mysqli_error($con);
}