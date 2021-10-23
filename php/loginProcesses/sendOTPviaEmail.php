<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once '../../vendor/autoload.php';
require_once '../../class-db.php';
$logged_email = $_POST['email'];

$con=null;
require '../DB_Connect.php';

//can be admin,super admin or patient
//it depends on what database table where the email is found
$userTable = $_SESSION['userTable'];

//get first the OTP of the user in the database
$result = mysqli_query($con,"SELECT OTP FROM $userTable WHERE email = '$logged_email'");
$OTP="";
while($row = mysqli_fetch_assoc($result)){
    $OTP = $row['OTP'];
}

/**
 * @return PHPMailer
 * @throws Exception
 */
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
$mail->addAddress($logged_email/*, 'RECIPIENT_NAME'*/);
$mail->isHTML(true);
$mail->Subject = 'OTP Verification Code';
$messageBody = '<h4 style="text-align: center"><b>Please enter the code below</b></h4>';
$messageBody.=  '<h1 style="text-align: center">'.$OTP.'</h1>';
$mail->Body = $messageBody;
$mail->addAttachment('../../img/jay.jpg',"jay");
//send the message, check for errors
if (!$mail->send()) {
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 0;
} else {
   // echo 'Message sent!';
    echo 1;
}

?>