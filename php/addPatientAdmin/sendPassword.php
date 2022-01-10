<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;


require_once '../../vendor/autoload.php';
require_once '../../class-db.php';

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

$mail->setFrom($email, 'Sto Rosario Health Information System');
$mail->addAddress($_SESSION['newAddWalkInPatientEmail'], 'RECIPIENT_NAME');
$mail->isHTML(true);
$mail->Subject = 'Account Registered';
$messageBody= '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello, '.$_SESSION['newAddWalkInPatientName'].'</h2>
                    <p style="font-family: Arial;font-size: large;color: #4d4949">Your patient account is successfully registered. We provided a temporary password</p>
                    <h1>'.$_SESSION['randomPassword'].'</h1> 
                    <p style="font-family: Arial;font-size: large;color: #4d4949">Please take note that you can change it later after logging in. Thank you!</p>
                    <p style="font-family: Arial;font-size: small;color: #4d4949"><a href="https://storosariohis.online"></a></p>
                </div>
               
';
$mail->Body = $messageBody;
//$mail->addAttachment('img/jay.jpg',"jay");
//$pdf = include 'emr_gen.php';
//$mail->addStringAttachment($pdf,'doc.pdf');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}