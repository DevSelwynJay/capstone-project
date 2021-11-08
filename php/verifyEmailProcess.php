<?php

// Include library file
require_once './VerifyEmail.php';

// Initialize library class
$mail = new VerifyEmail();

// Set the timeout value on stream
$mail->setStreamTimeoutWait(20);

// Set debug output mode
$mail->Debug= TRUE;
$mail->Debugoutput= 'html';

// Set email address for SMTP request
$mail->setEmailFrom('projectcapstone3m@gmail.com');

// Email to check
$email = 'alfredbenitez40@gmail.com';

// Check if email is valid and exist
if($mail->check($email)){
    echo 'Email &lt;'.$email.'&gt; is exist!';
}elseif(verifyEmail::validate($email)){
    echo 'Email &lt;'.$email.'&gt; is valid, but not exist!';
}else{
    echo 'Email &lt;'.$email.'&gt; is not valid and not exist!';
}

?>