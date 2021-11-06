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
    return date('Y')."-02-".$_6DigitCode;
}

function validateID($con,$new_id){//check the generated ID if existing

    $tables = array('patient','pending_patient');
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
        $targetFilePath = $targetDir . $fileName;

        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            // Upload file to server
            if(move_uploaded_file($_FILES["upload"]["tmp_name"][$key], $targetFilePath)){
                // Image db insert sql
                //$insertValuesSQL .= "('".$fileName."', NOW()),";

                $result = mysqli_query($con,"INSERT INTO patient_id (id,file_path) VALUES ('$patientID','ID/$patientID/$fileName')");
            }else{
                //$errorUpload .= $_FILES['files']['name'][$key].' | ';
            }
        }else{
            //$errorUploadType .= $_FILES['files']['name'][$key].' | ';
        }

    }//for

    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];

    $suffix = $_POST['suffix'];
    if($suffix!=""){
        $lname.=" ".$suffix;
    }

    $occupation = $_POST['occupation'];
    $civil_status = $_POST['civil_status'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $pwd = $_POST['pwd'];
    $gender = $_POST['gender'];
    $bday = $_POST['bday'];
    $purok = $_POST['purok'];
    $house_no = $_POST['house_no'];



    $address = $house_no." Purok ".$purok." Sto. Rosario Paombong Bulacan";

    mysqli_query($con,
        "INSERT INTO pending_patient VALUES ('$patientID','$lname','$fname','$mname','$gender','$bday','$address','$occupation','$civil_status',NULL,'$email','$pwd','$contact' )");
    //insert the records in pending_patient table

}

?>