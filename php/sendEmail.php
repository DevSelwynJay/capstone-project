<?php
$email_address = $_POST['email_address'];
$login_verification_code = $_POST['login_verification_code'];

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer;

$mail->isSMTP();                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;               // Enable SMTP authentication
$mail->Username = 'projectcapstone3m@gmail.com';   // SMTP username
$mail->Password = 'mukamo11';   // SMTP password
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                    // TCP port to connect to

// Sender info
$mail->setFrom('projectcapstone3m@gmail.com', 'Sto. Rosario Health Information System');
//$mail->addReplyTo('projectcapstone3m@gmail.com', 'Sto. Rosario Health Information System');

// Add a recipient
$mail->addAddress('benitez.alfredo.b.1128@gmail.com');

//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

// Set email format to HTML
$mail->isHTML(true);

// Mail subject
$mail->Subject = 'Login Verification Code';

// Mail body content
$bodyContent = '<h1>102932</h1>';
$bodyContent .= '<p>Please Enter the number above</p>';
$mail->Body    = $bodyContent;

// Send email
/*if(!$mail->send()) {
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}*/

?>