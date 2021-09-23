<?php
/*
========Benitez Alfred B.===============
*/
//**program related to function**//
class loginProcess{

    public function checkEmailInDatabase($con,$email):mysqli_result
    {
       return mysqli_query($con,"SELECT * FROM admin WHERE email='$email'");
    }

    public function generate6DigitCode(){
        try {

            $key = random_int(0, 999999);
            //echo "<br>".$key;
            return str_pad($key, 6, 0, STR_PAD_LEFT);
        } catch (Exception $e) {

        }
    }

    public function put_OTP_To_User_Record($con,$email,$code): mysqli_result|bool
    {
        //if the credentials is valid then register an OTP code to that specific user
       return mysqli_query($con,"UPDATE admin SET OTP = '$code' WHERE email = '$email'");

    }

    public function send_OTP_To_User_Email($con,$email){
     $result = mysqli_query($con,"SELECT OTP FROM admin WHERE email = '$email'");
     $OTP="";
     while($row = mysqli_fetch_assoc($result)){
           $OTP = $row['OTP'];
     }

    }

    public function verifyOTP($con,$email,$inputtedOTP): bool
    {
        $result = mysqli_query($con,"SELECT*FROM admin WHERE email = '$email' AND OTP = '$inputtedOTP'");
        if(mysqli_num_rows($result)>0){//verified OTP
            return true;
        }
        else{
            return false;
        }

    }
}
?>