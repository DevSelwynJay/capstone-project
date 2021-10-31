<?php
session_start();
$email = $_POST['email'];
$con=null;
require '../DB_Connect.php';

$userTables = array('admin','patient');

$isFound=false;
foreach ($userTables as $userTable){

        $result =  mysqli_query($con,"SELECT * FROM $userTable WHERE email='$email'");

    if(mysqli_num_rows($result)>0){//email or is in the database
        $_SESSION['email_in_forgot_pwd'] = $email;
        //put the table name where you found the email in the session variable
        //it is needed to send and verify the otp
        $_SESSION['userTable'] = $userTable;

        while ($row=mysqli_fetch_assoc($result)){
            $_SESSION['user_full_name'] =  $row['last_name'].", ". $row['first_name']." ". $row['middle_name'];
        }


        //echo 1;//notify the js callback function that gmail account is in the database
        echo json_encode(array("status"=>1,"full_name"=> $_SESSION['user_full_name'],"email"=>$email));
        $isFound=true;
        break;
    }

}

if(!$isFound){
    echo 0;
}
mysqli_close($con);
exit();
?>