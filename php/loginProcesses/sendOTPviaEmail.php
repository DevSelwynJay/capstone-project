<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$email = $_POST['email'];

$con=null;
require '../DB_Connect.php';

//get first the OTP of the user in the database
$result = mysqli_query($con,"SELECT OTP FROM admin WHERE email = '$email'");
$OTP="";
while($row = mysqli_fetch_assoc($result)){
    $OTP = $row['OTP'];
}

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
$mail->addAddress($email);

//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

// Set email format to HTML
$mail->isHTML(true);

// Mail subject
$mail->Subject = 'Login Verification Code';

// Mail body content
$bodyContent = '<h1>'.$OTP.'</h1>';
$bodyContent .= '<p>Please Enter the number above</p>';
$mail->Body    = $bodyContent;

// Send email
if(!$mail->send()) {
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}

?>