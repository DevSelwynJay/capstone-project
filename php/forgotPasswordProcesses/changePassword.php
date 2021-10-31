<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require_once '../../vendor/autoload.php';
require_once '../../class-db.php';
$new_password = $_POST['new_password'];
$logged_email = $_SESSION['email_in_forgot_pwd'];
$userTable =  $_SESSION['userTable'];

$con=null;
require '../DB_Connect.php';

$result = mysqli_query($con,"UPDATE $userTable SET password = '$new_password' WHERE email = '$logged_email'");
if(!$result){
    echo 0;
    mysqli_close($con);
    exit();
}
// send email that will notify the user that his/her password has been changed
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
$mail->Subject = 'Password Changed';


function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }elseif(preg_match('/Firefox/i',$u_agent)){
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }elseif(preg_match('/OPR/i',$u_agent)){
        $bname = 'Opera';
        $ub = "Opera";
    }elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
        $bname = 'Apple Safari';
        $ub = "Safari";
    }elseif(preg_match('/Netscape/i',$u_agent)){
        $bname = 'Netscape';
        $ub = "Netscape";
    }elseif(preg_match('/Edge/i',$u_agent)){
        $bname = 'Edge';
        $ub = "Edge";
    }elseif(preg_match('/Trident/i',$u_agent)){
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }else {
            $version= $matches['version'][1];
        }
    }else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

// now try it
$ua=getBrowser();
$yourbrowser= "Browser used: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'];

date_default_timezone_set("Asia/Manila");

$name = $_SESSION['user_full_name'];

$messageBody= '
               <div  style="background: #eaeef3;padding: 20px;margin: 5px 0 0 0 ">
    <h2 style="font-family: Arial;color: #4d4949">Hello '.$name.'</h2>
    <h1 style="font-family: Arial;font-size: larger;color: #4d4949">Your password has been reset</h1>

    <div style="max-height: fit-content;background: #d4dce3;padding: 5px 10px">
        <p style="font-family: Arial;color: #3f3b3b">'.$yourbrowser.' '.date('m-d-y h:i:s').'</p>
    </div>
    </div>
';


$mail->Body = $messageBody;
//$mail->addAttachment('../../img/jay.jpg',"jay");
//send the message, check for errors
if (!$mail->send()) {
    // echo 'Mailer Error: ' . $mail->ErrorInfo;
    //echo 0;
} else {
    // echo 'Message sent!';
}
echo 1;
mysqli_close($con);
unset($_SESSION['email_in_forgot_pwd'],$_SESSION['userTable'],$_SESSION['user_full_name']);
?>