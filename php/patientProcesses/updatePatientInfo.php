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

//validate contact and email if changed so it can avoid duplication
if($contact!=""||$email!=""){
    require 'finalValidation.php';
    // the code will exit if there is a duplicate entry and return error message
}

$patientID = $_SESSION['active_individual_patient_ID'];//update only so may exisitng ID na

//email and password is optional in adding new walk in patient
//but email and password needs to be unique
//if many account added with no email and contact
//empty column will produce resulting to error
//to solve, if walk in patient provide empty email/pwd the value would be its ID including the word none
if($email==""||$email==null){
    $email = "none-".$patientID;
}
if($contact==""||$contact==null){
    $contact = "none-".$patientID;
}

//logic for updating
//kapag ung ung name bday ndi nagalaw simple update lang ung record
if($fname == $_SESSION['active_old_patient_info']['first_name']
    && $mname ==  $_SESSION['active_old_patient_info']['middle_name']
    && $lname ==  $_SESSION['active_old_patient_info']['last_name']
    && $bday ==  $_SESSION['active_old_patient_info']['birthday']
    && $suffix ==  $_SESSION['active_old_patient_info']['suffix']
//    && $purok == $_SESSION['active_old_patient_info']['purok']
  )
{
   $result = mysqli_query($con,"UPDATE walk_in_patient SET
last_name = '$lname', first_name= '$fname', middle_name = '$mname', suffix='$suffix',gender = '$gender', birthday = '$bday',
    purok = '$purok', house_no = '$house_no',   occupation = '$occu'  ,civil_status = '$civil', blood_type = '$bloodType',
                 weight = '$weight',    height = '$height', patient_type = '$patientType',
                           email = '$email', contact_no = '$contact' WHERE id = '$patientID'
");
   if($result){
       echo 1;
   }
   else{
       echo "Can't update";//sql error pag ganon
   }

    exit();
}
else{
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


    $result = mysqli_query($con,"UPDATE walk_in_patient SET
last_name = '$lname', first_name= '$fname', middle_name = '$mname', suffix='$suffix',gender = '$gender', birthday = '$bday',
    purok = '$purok', house_no = '$house_no',   occupation = '$occu'  ,civil_status = '$civil', blood_type = '$bloodType',
                 weight = '$weight',    height = '$height', patient_type = '$patientType',
                           email = '$email', contact_no = '$contact' WHERE id = '$patientID'
");

        if($result){
            echo 1;
        }
        else{
            echo mysqli_error($con);
        }
}

