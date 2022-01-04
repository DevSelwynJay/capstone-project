<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;


require_once 'vendor/autoload.php';
require_once 'class-db.php';

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

$mail->setFrom($email, 'projectcapstone3m@gmail.com');
$mail->addAddress('benitez.alfredo.b.1128@gmail.com', 'RECIPIENT_NAME');
$mail->isHTML(true);
$mail->Subject = 'Email Subject';
$mail->Body = '<b>Email Body</b>';
$mail->addAttachment('img/jay.jpg',"jay");
$pdf = include 'emr_gen.php';
$mail->addStringAttachment($pdf,'doc.pdf');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}