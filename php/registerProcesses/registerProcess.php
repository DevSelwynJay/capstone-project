<?php
session_start();

$con=null;
require '../DB_Connect.php';
if(!$con) {
    die("Error" . mysqli_error($con));
    exit();
}

//generate 6 digit random number
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

    $tables = array('walk_in_patient','pending_patient'/*'patient','pending_patient','patient_archive'*/);
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

$allowTypes = array('jpg','png','jpeg','gif');
$userFolder = mkdir('../../ID/'.$_SESSION['final_id']);//to create specific folder for user using ID
echo $userFolder;
$targetDir = "../../ID/".$_SESSION['final_id']."/";
$fileNames = array_filter($_FILES['upload']['name']);
if(!empty($fileNames)){
    foreach($_FILES['upload']['name'] as $key=>$val){


        // File upload path
        $fileName = basename($_FILES['upload']['name'][$key]);
        echo $fileName;
        $targetFilePath = $targetDir . str_replace(' ','',$fileName);

        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["upload"]["tmp_name"][$key], $targetFilePath)){
                // Image db insert sql
                //$insertValuesSQL .= "('".$fileName."', NOW()),";

                $result = mysqli_query($con,"INSERT INTO patient_id (id,file_path) VALUES ('$patientID','ID/$patientID/".str_replace(' ','',$fileName)."')");
            }else{
                //$errorUpload .= $_FILES['files']['name'][$key].' | ';
            }
        }else{
            //$errorUploadType .= $_FILES['files']['name'][$key].' | ';
        }

    }//for

    $trimmedFname = trim($_POST['fname']);
    $trimmedMname = trim($_POST['mname']);
    $trimmedLname = trim($_POST['lname']);

    $fname = strtoupper(substr($trimmedFname,0,1)).strtolower(substr($trimmedFname,1));
    $mname = strtoupper(substr($trimmedMname,0,1)).strtolower(substr($trimmedMname,1));
    $lname = strtoupper(substr($trimmedLname,0,1)).strtolower(substr($trimmedLname,1));

    $suffix = preg_replace('/[^A-Za-z0-9\-]/', '', trim($_POST['suffix']));//remove special character
    if($suffix!=""){
        $lname.=" ".$suffix;
    }

    $occupation = trim($_POST['occupation']);
    $civil_status = trim($_POST['civil_status']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $pwd = trim($_POST['pwd']);
    $gender = trim($_POST['gender']);
    $bday = trim($_POST['bday']);
    $purok = trim($_POST['purok']);
    $house_no = trim($_POST['house_no']);

    //add default value to patient type (Adult, Minor or Senior)
    $today = date('Y-m-d');
    $age  = date_diff(date_create($bday),date_create($today));
    $patient_type="";
    if($age->format('%y')<=1){
        $patient_type = "Infant";
    }
    else if($age->format('%y')<18){
        $patient_type = "Minor";
    }
    else if ($age->format('%y')<60){
        $patient_type = "Adult";
    }
    else{
        $patient_type = "Senior";
    }

    $address = "Sto. Rosario Paombong Bulacan";

    mysqli_query($con,
        "INSERT INTO pending_patient VALUES (DEFAULT ,'$patientID','$lname','$fname','$mname','$gender','$bday','$purok','$house_no','$address','$occupation','$civil_status',DEFAULT ,DEFAULT ,DEFAULT, '$patient_type','$email','$pwd','$contact',DEFAULT ,DEFAULT )");
    //insert the records in pending_patient table
    header("location:../../index.php");
}

?>