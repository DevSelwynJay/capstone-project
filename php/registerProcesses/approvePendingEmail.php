<?php
//echo 1

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;
require_once '../../vendor/autoload.php';
require_once '../../class-db.php';

$patient_email="";
$user_full_name="";



    $patient_email = $_SESSION['selected_pending_account']['email'];
    $user_full_name = $_SESSION['selected_pending_account']['last_name'].", ".$_SESSION['selected_pending_account']['first_name']." ".$_SESSION['selected_pending_account']['middle_name'];

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
$mail->Subject = 'Account Request Approved';

$messageBody= '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello '.$user_full_name.'</h2>
            
                    <h1 style="font-family: Arial;font-size: large;color: #4d4949">Our system accepted your online account request.</h1>
                    <p style="font-family: Arial;color: #3f3b3b">You can now login your online patient account. Thank you!</p>
                    <br>
                    <h2 style="font-family: Arial;color: #3f3b3b">Note: You will be required to bring the id you provided on the registration to your first consultation</h2>
                    </div>
';


$mail->Body = $messageBody;
$mail->send()
//$mail->addAttachment('../../img/jay.jpg',"jay");
//send the message, check for errors


?>