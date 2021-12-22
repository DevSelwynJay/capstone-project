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


//0->superadmin 1->admin 2->patient
//make a condition kung saang page ireredirect using the session variable SESSION['account_type']
$type = $_SESSION['account_type'];
if($type==0){
    header("location:../../super-admin.php",true);
}
else if($type==1){
header("location:../../dashboard-admin.html",true);}
else if($type==2){
    header("location:../../dashboard.php",true);}
exit();