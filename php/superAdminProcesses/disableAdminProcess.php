<?php
session_start();
    $adminId = $_POST['adminId'];
    $adminName = $_POST['adminName'];

    $con=null;
    require '../DB_Connect.php';

    if(!$con){
        die("Error".mysqli_error($con));
        exit();
    }

    $userDatas = array('admin_archive'/*,'patient'*/);
    foreach ($userDatas as $userData){

        $result =  mysqli_query($con,"SELECT id FROM $userData WHERE id='$adminId'");
        if($adminId==$result){// the email is already in the database
            echo 0;

        }else{// the record is to be added to archive and deleted to original record
            //add sa db
            // Performing insert query execution to admin db
            $sql = "INSERT INTO admin_archive select * from admin where id='$adminId'";

            if(mysqli_query($con, $sql)){
                $sql = "DELETE FROM admin WHERE id='$adminId'";
                if(mysqli_query($con, $sql)){
                    echo 1;
                }else{
                    echo 0;
                }
            } else{
                echo 0;
            }

        }

    }
?>