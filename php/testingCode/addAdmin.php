<?php
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

//let assume that all the fields are complete and correct
//this code will generate unique ID for Admin
//then add the record to the admin table

//generate 6 digit random number
function generate_6_Digits(): string
{
    $key=0;
    try {
        $key = random_int(0, 999999);
    } catch (Exception $e) {
    }
    return str_pad($key, 6, 0, STR_PAD_LEFT);
}

$_6DigitCode = generate_6_Digits();
$_6DigitCode = "112123";//in overwrite ko lang gamit ung 6Digit last part of ID ng isang account
//para matesting kung mag gegenerate ba sya ng bago pag duplicate at kung mag loloop ang function

//ung last 6 digit lang ng ID ung i checheck for duplication
function check($con,$_6DigitCode)
{
    //this function is recursive it means we call this current function within this function
    //mauulit hanngat may kamukang ID ung na generate na 6 Digit

    //select all id in database to check for duplication
    $result = mysqli_query($con, "SELECT id FROM admin");
    while ($row = mysqli_fetch_array($result)) {

        //the id is separated by dash '-' ([dateRegistered]YYYY-[accountType])xx-[random6Digit]-xxxxxx) ex. 2021-01-xxxxxx
        //divide it into three parts using explode
        $trimmedIDArray = explode("-", $row[0]);

        //we only need to get the 3rd part which is the random 6 digit code of the ID
        $_3rd_part_of_ID = $trimmedIDArray[2];
        echo "ID in Database: " . $_3rd_part_of_ID . "<br>";

        //check if the generated 6Digit is duplicated or not
        //if duplicated generate again a 6Digit Code
        if ($_6DigitCode == $_3rd_part_of_ID) {

            echo "Duplicated because the 6 Digit generated is also $_6DigitCode<br>";
            echo "Generating new One<br><br>";
            $_6DigitCode = generate_6_Digits();
            echo "The new 6 Digit Generated is $_6DigitCode<br>";
            echo "Repeating the loop again<br><br>";
            //recursive function is another way of looping
            check($con,$_6DigitCode);

        }
        echo "============<br>";

    }//end of while
}

check($con,$_6DigitCode);
echo "<br><br>Thank You";

mysqli_close($con);
?>