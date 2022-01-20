<?php
session_start();
//echo 1

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
require_once '../../vendor/autoload.php';
require_once '../../class-db.php';

$id = $_POST['id'];
$decline_msg = $_POST['decline_msg'];

$patient_email="";
$user_full_name="";
$con = null;
require '../DB_Connect.php';
$result = mysqli_query($con,"SELECT*FROM pending_patient WHERE id = '$id'");
if($row =mysqli_fetch_assoc($result)){
  $patient_email = $row['email'];
  $user_full_name = $row['last_name'].", ".$row['first_name']." ".$row['middle_name'];
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

//Gmail_Connect
$clientId=null;$clientSecret=null;$email=null;
require '../Gmail_Connect.php';//includes client ID and client secret and email of client used in sending email


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
$mail->addAddress($patient_email/*, 'RECIPIENT_NAME'*/);
$mail->isHTML(true);
$mail->Subject = 'Declined Request';

$messageBody= '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello '.$user_full_name.'</h2>
                    <h1 style="font-family: Arial;font-size: large;color: #4d4949">Our system declined your account request!</h1>
                    <p style="font-family: Arial;color: #3f3b3b">'.$decline_msg.'</p>
                    </div>
';


$mail->Body = $messageBody;
//$mail->addAttachment('../../img/jay.jpg',"jay");
//send the message, check for errors
if (!$mail->send()) {
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 0;
} else {
    $admin_id = $_SESSION['active_admin_ID'];

    // echo 'Message sent!';
    mysqli_query($con,"INSERT INTO declined_patient (account_type,id,last_name,first_name,middle_name,suffix,gender,birthday,purok,address
,occupation,civil_status,patient_type,email,password,contact_no ) SELECT account_type,id,last_name,first_name,middle_name,suffix,gender,birthday,purok,address
,occupation,civil_status,patient_type,email,password,contact_no
FROM pending_patient WHERE id='$id'");
    mysqli_query($con,"DELETE FROM pending_patient WHERE id = '$id'");

    //PUT IN THE LOGS
    mysqli_query($con,"INSERT INTO logs_acc_req (admin_id,patient_id,admin_action,description) 
    VALUES ('$admin_id','$id','0','$decline_msg')
    ");
    echo 1;
}

mysqli_close($con);
?>