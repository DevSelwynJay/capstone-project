<?php
//purpose of this code is to redirect the user to main
//example:
//user is admin -> will go to admin part
//user is super admin -> will go to super admin part
//user is patient -> will go to patient part
//need to add some codes later
session_start();
header("location:../../main.php",true);
exit();