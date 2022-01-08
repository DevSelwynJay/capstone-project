<?php
//this code is to check if the gmail is in the database for google sign in
//check email and password for regular login
session_start();
$email = $_POST['email'];
$signInType = $_POST['signInType'];//possible value: 0 regular sign in, 1 sign in with google

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

//First, check the email to superAdmin table
//pag wala, search the email to admin table
//pag wala parin, sa patient table hanapin

$userTables = array('super_admin','admin','patient');

$isFound=false;
foreach ($userTables as $userTable){

    $result=null;
    if($signInType==0){//regular sign in
        $password=$_POST['password'];
        $result =  mysqli_query($con,"SELECT * FROM $userTable WHERE email='$email' AND password='$password'");
    }
    else if($signInType==1){//sign in with google
        $result =  mysqli_query($con,"SELECT * FROM $userTable WHERE email='$email'");
    }

    if(mysqli_num_rows($result)>0){//email or both email w/password is in the database

        //put the table name where you found the email in the session variable
        //it is needed to send and verify the otp
        $_SESSION['userTable'] = $userTable;


        //get account type, then put also in session variable
        //possible value, 0->superadmin 1->admin 2->patient
        //needed para malaman kung saan ireredirect sa patient view ba or sa admin view...
        while ($row=mysqli_fetch_assoc($result)){
               $_SESSION['account_type'] =  $row['account_type'];
               $_SESSION['user_full_name'] =  $row['last_name'].", ". $row['first_name']." ". $row['middle_name'];
               $_SESSION['logged_contact_no'] = $row['contact_no'];
               $_SESSION['email_session_for_sms_otp'] = $row['email'];//for sms confirmation lang to haha
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

