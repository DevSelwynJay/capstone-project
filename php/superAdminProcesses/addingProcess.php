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
$year = (new DateTime)->format("Y");

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


//$userTabs = array('admin_archive'/*,'patient'*/);

//TRY CODES

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
    return date('Y')."-01-".$_6DigitCode;
}

function validateID($con,$new_id){//check the generated ID if existing

    $tables = array('admin','admin_archive');
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
//END TRY CODES

$userTables = array('admin_archive','admin');
//pending problem nadadagdag padin kahit may existing na kay archive
foreach ($userTables as $userTable){
    $adminID = $_SESSION['final_id'];
    $result =  mysqli_query($con,"SELECT email FROM $userTable WHERE email='$email'");
    if(mysqli_num_rows($result)>0){// the email is already in the database
        echo 0;
        break;
    }else{// the email is to be added
        //add sa db
        // Performing insert query execution to admin db
        $sql = "INSERT INTO admin (account_type, id, last_name, first_name, middle_name, gender, birthday, address, email, password, contact_no, role) VALUES
        ('1', '$adminID', '$lname', '$fname', '$mname ', '$gender', '2000-09-21', 'Sto. Rosario Paombong Bulacan', '$email', '$password', '$contactno', '$workcat')";

        //mysqli_query($sql);

        if(mysqli_query($con, $sql)){
            echo 1;
            break;
        } else{
            echo 0;
            break;
        }

    }

}

?>