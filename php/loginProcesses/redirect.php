<?php
session_start();
/*purpose of this code is to redirect the user to main
example:
user is admin -> will go to admin part
user is super admin -> will go to super admin part
user is patient -> will go to patient part
need to add some codes later*/
if(!isset($_SESSION['email'])){
    header("location:../../index.php",true);
}
if(!isset($_SESSION['account_type'])){
    header("location:../../index.php",true);
}



//0->superadmin 1->admin 2-> walk in patient 3-> registered online patient
//make a condition kung saang page ireredirect using the session variable SESSION['account_type']
$type = $_SESSION['account_type'];
if($type==0){
    header("location:../../super-admin.php",true);
}
else if($type==1){
header("location:../../dashboard-admin.php",true);}
else if($type==2){
    header("location:../../dashboard-patient.php",true);}
else if($type==3){
    header("location:../../dashboard-patient.php",true);}
exit();