<?php
//calls name sana kaso dko pa napapagana to ignore muna
session_start();
$adminId = $_POST['adminId'];

$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

$userDatas = array('admin'/*,'patient'*/);
foreach ($userDatas as $userData) {

    $result = mysqli_query($con, "SELECT last_name,first_name,middle_name FROM $userData WHERE id='$adminId'");
    if (mysqli_num_rows($result)>0) {// the id is in the database fetch result
        while($row=mysqli_fetch_array($result)){
            $name = $row[0].", ".$row[1]." ".$row[2];
        }
        $_SESSION['adminCall']=$name;
        echo "$name";
        break;
    }
}
?>