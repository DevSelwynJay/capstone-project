<?php
session_start();
$con=null;
require '../DB_Connect.php';
$res = mysqli_query($con,"SELECT id, CONCAT(last_name,', ',first_name,' ',middle_name) as name, DATE_FORMAT(date_created,'%M %e %Y') as date, 
       CONCAT('<button class=view data-id=',id,' data-fname=', first_name ,' data-mname=', middle_name ,' data-lname=', last_name ,' data-email=',email ,'>View Info','</button>')  as button FROM pending_patient");
$arr = array();
while ($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
}
echo json_encode($arr);
?>
