<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once '../../vendor/autoload.php';
require_once '../../class-db.php';

$logged_email = $_POST['email'];
$user_full_name = $_SESSION['user_full_name'];

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
$mail->addAddress($logged_email/*, 'RECIPIENT_NAME'*/);
$mail->isHTML(true);
$mail->Subject = 'Login OTP Verification';

$messageBody= '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello '.$user_full_name.'</h2>
                    <p style="font-family: Arial;font-size: large;color: #4d4949">Here is your login OTP verification code:</p>
                    <h1 style="font-family: Arial;color: #3f3b3b">'.$OTP.'</h1>
                    <div style="max-height: fit-content;background: #d4dce3;padding: 5px 10px">
                        <p style="font-family: Arial;color: #3f3b3b">Please copy the code above and enter it into the login page to proceed. OTP code is always generated everytime that you will login into the system</p>
                    </div>
                    <p style="font-family: Arial;color: #3f3b3b;padding: 10px;font-size: large">Not the one who logged the account? <a href="http://localhost/capstone-project">Secure your account now</a></p>
                </div>
';


$mail->Body = $messageBody;
//$mail->addAttachment('../../img/jay.jpg',"jay");
//send the message, check for errors
if (!$mail->send()) {
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 0;
} else {
   // echo 'Message sent!';
    echo 1;
}



?>