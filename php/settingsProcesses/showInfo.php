<?php
session_start();
//echo json_encode(array("status"=>true))
$con=null;
require '../DB_Connect.php';
$table = $_SESSION['userTable'];
$logged_email = $_SESSION['email'];
$result = mysqli_query($con,"SELECT *, DATE_FORMAT(birthday,'%M %e %Y') as bday, timestampdiff(year,birthday,NOW()) as age FROM $table WHERE email = '$logged_email'");
while($row = mysqli_fetch_assoc($result)){
    echo json_encode(array(
        "fname"=>$row['first_name'],
         "mname"=>$row['middle_name'],
        "lname"=>$row['last_name'],
        "gender"=>$row['gender'],
        "age"=>$row['age'],
        "bday"=>$row['bday'],
        "bdayISO"=>$row['birthday'],
        "address"=>$row['address'],
    ));
}

?>