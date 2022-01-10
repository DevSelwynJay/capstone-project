<?php
    session_start();
    $email=$_POST['loggedEmail'];

    $pass = $_POST['swalpass'];
   // $pass = "tukmol21";
    $con = null;
    require '../DB_Connect.php';

    if (!$con) {
        die("Error" . mysqli_error($con));
        exit();
    }



        $result = mysqli_query($con, "SELECT password FROM super_admin WHERE email='$email'");
        if ($pass == $result) {// the pass matches in the database
            echo 1;
        } else {// pass didn't match in the database
            echo 0;
        }



?>