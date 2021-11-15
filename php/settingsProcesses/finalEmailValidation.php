<?php
session_start();
$logged_email = $_POST['logged_email'];
$new_email = $_POST['new_email'];
$user_full_name= $_SESSION['user_full_name'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once '../../vendor/autoload.php';
require_once '../../class-db.php';

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
$mail->addAddress($new_email/*, 'RECIPIENT_NAME'*/);
$mail->isHTML(true);
$mail->Subject = 'New Email';

$messageBody= '
                <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
                    <h2 style="font-family: Arial;color: #4d4949">Hello '.$user_full_name.'</h2>
                    <p style="font-family: Arial;font-size: large;color: #4d4949">From now on, you will now use '.$new_email.' to log in to the system</p>
                 
                    <div style="max-height: fit-content;background: #d4dce3;padding: 5px 10px">
                        <p style="font-family: Arial;color: #3f3b3b">Your old email ('.$logged_email.') was replaced successfully</p>
                    </div>
                 </div>
';


$mail->Body = $messageBody;
$validEmail=false;
$mail->addAttachment('../../img/jay.jpg',"jay");
//send the message, check for errors
if (!$mail->send()) {
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 0;
} else {
    // echo 'Message sent!';
    $validEmail = true;
}

if($validEmail) {
    $table = $_SESSION['userTable'];
    $_SESSION['email'] = $new_email;
    $con = null;
    require '../DB_Connect.php';
    $result = mysqli_query($con, "UPDATE $table SET email = '$new_email' WHERE email = '$logged_email' ");
    echo 1;
    mysqli_close($con);
}
?>