<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
session_start();
$allId = $_POST['allId'];
$stats = $_POST['status'];
$acttype = $_POST['acttype'];

require_once '../../vendor/autoload.php';
require_once '../../class-db.php';

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

//require_once 'class-db.php';

if ($acttype=="1"){
    $sql = mysqli_query($con, "SELECT first_name, middle_name, last_name, email FROM admin WHERE id='$allId'");
    $ems =mysqli_fetch_assoc($sql) ;
    $fname = $ems['first_name'];
    $mname = $ems['middle_name'];
    $lname = $ems['last_name'];
    $emails = $ems['email'];
    $subject = 'Account Status';
    $fullname = "".$lname .", ".$fname. " ". $mname;
    if ($stats=="active") {

        $body = '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello '.$fullname.'</h2>
                    <p style="font-family: Arial;font-size: large;color: #4d4949">Your account has been deactivated. Please contact the health center if this is a mistake!</p>
                    
                </div>
';
    }elseif ($stats=="inactive") {
        $body = '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello ' . $fullname . '</h2>
                    <p style="font-family: Arial;font-size: large;color: #4d4949">Your account has been activated. Thank you for waiting!</p>
                    
                </div>
';
    }


}elseif ($acttype=="3"){
    $sql = mysqli_query($con, "SELECT first_name, middle_name, last_name, email FROM walk_in_patient WHERE id='$allId'");
    $ems =mysqli_fetch_assoc($sql) ;
    $fname = $ems['first_name'];
    $mname = $ems['middle_name'];
    $lname = $ems['last_name'];
    $emails = $ems['email'];
    $subject = 'Account Status';
    $fullname = $lname .", ".$fname. " ". $mname;

    if ($stats=="active") {

        $body = '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello '.$fullname.'</h2>
                    <p style="font-family: Arial;font-size: large;color: #4d4949">Your account has been deactivated. Please contact the health center if this is a mistake!</p>
                    
                </div>
';
    }elseif ($stats=="inactive") {
        $body = '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello ' . $fullname . '</h2>
                    <p style="font-family: Arial;font-size: large;color: #4d4949">Your account has been activated. Thank you for waiting!</p>
                    
                </div>
';
    }

}

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;

//Set the encryption mechanism to use:
// - SMTPS (implicit TLS on port 465) or
// - STARTTLS (explicit TLS on port 587)
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


    $mail->SMTPAuth = true;
    $mail->AuthType = 'XOAUTH2';

    $email = 'projectcapstone3m@gmail.com'; // the email used to register google app
    $clientId = '373815557222-68l0i08iuj7i2j5iq5inrt54550nm6fp.apps.googleusercontent.com';
    $clientSecret = 'ZKYd1Vg_ItboNx7oUKqlfqmU';

    $db = new DB();
    $refreshToken = $db->get_refersh_token();

//Create a new OAuth2 provider instance
    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]
    );

//Pass the OAuth provider instance to PHPMailer
    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]
        )
    );

    $mail->setFrom($email, 'Sto. Rosario Health Information System Paombong Bulacan');
    $mail->addAddress($emails);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
//$mail->addAttachment('img/jay.jpg',"jay");
//$pdf = include 'emr_gen.php';
//$mail->addStringAttachment($pdf,'doc.pdf');
//send the message, check for errors
if (!$mail->send()) {
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 0;
} else {
    // echo 'Message sent!';
    echo 1;
}