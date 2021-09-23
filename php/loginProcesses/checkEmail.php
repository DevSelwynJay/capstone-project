<?php
//this code is to check if the gmail is in the database
session_start();
$email = $_POST['email'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

//First, check the email to superAdmin table
//pag wala, search the email to admin table
//pag wala parin, sa patient table hanapin

$userTables = array(/*'superadmin',*/'admin'/*,'patient'*/);

$isFound=false;
foreach ($userTables as $userTable){

    $result =  mysqli_query($con,"SELECT * FROM $userTable WHERE email='$email'");

    if(mysqli_num_rows($result)>0){//email is in the database

        //put the table name where you found the email in the session variable
        //it is needed to send and verify the otp
        $_SESSION['userTable'] = $userTable;

        //get account type, then put also in session variable
        //0->superadmin 1->admin 2->patient
        //needed para malaman kung saan ireredirect sa patient view ba or sa admin view...
        while ($row=mysqli_fetch_assoc($result)){
               $_SESSION['account_type'] =  $row['account_type'];
        }

        //generate 6 digit code OTP
        $key=0;
        try {
            $key = random_int(0, 999999);
        } catch (Exception $e) {
        }
        $_6DigitCode = str_pad($key, 6, 0, STR_PAD_LEFT);

        //put the OTP in user's record
        mysqli_query($con,"UPDATE $userTable SET OTP = '$_6DigitCode' WHERE email = '$email'");

        echo 1;//notify the js callback function that gmail account is in the database
        $isFound=true;
        break;
    }

}

if(!$isFound){
    echo 0;
}
mysqli_close($con);
exit();

