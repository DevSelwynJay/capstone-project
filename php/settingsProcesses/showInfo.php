<?php
session_start();
//echo json_encode(array("status"=>true))
$con=null;
require '../DB_Connect.php';
$table = $_SESSION['userTable'];
$logged_email = $_SESSION['email'];
$result = mysqli_query($con,"SELECT *, DATE_FORMAT(birthday,'%M %e %Y') as bday, timestampdiff(year,birthday,NOW()) as age FROM $table WHERE email = '$logged_email'");
while($row = mysqli_fetch_array($result)){
    echo json_encode(array(
        "fname"=>$row[3],
         "mname"=>$row[4],
        "lname"=>$row[2],
        "gender"=>$row[5],
        "age"=>$row['age'],
        "bday"=>$row['bday'],
        "address"=>$row[7],
    ));
}

?>