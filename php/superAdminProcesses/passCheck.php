<?php
    session_start();
    $email=$_POST['loggedEmail'];
    //$email="galvezirish17@gmail.com";
    $pass = $_POST['swalpass'];
    //$pass = "tukmol21";
    $con = null;
    require '../DB_Connect.php';

    if (!$con) {
        die("Error" . mysqli_error($con));
        exit();
    }
    $result = mysqli_query($con, "SELECT password FROM super_admin WHERE email='$email'");
    //echo "<script>console.log(''+$result);</script>";

    if($row = mysqli_fetch_assoc($result) ){
        if($row['password'] == $pass){
            echo 1;
        }
        else {// pass didn't match in the database
            echo 0;
        }

    }
?>