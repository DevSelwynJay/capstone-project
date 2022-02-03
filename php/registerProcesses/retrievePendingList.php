<?php
session_start();
$con=null;
require '../DB_Connect.php';
$res = mysqli_query($con,"SELECT *,id, CONCAT(first_name,' ',middle_name,' ',last_name,' ',suffix) as name, DATE_FORMAT(date_created,'%Y-%m-%d %r') as date, address, contact_no, email,
       CONCAT('<button class=view data-id=',id,' data-fname=', first_name ,' data-mname=', middle_name ,' data-lname=', last_name ,' data-email=',email ,'>View','</button>')  as button FROM pending_patient ORDER BY date_created");
$arr = array();
while ($row = mysqli_fetch_assoc($res)){
    $arr[] = $row;
}
echo json_encode($arr);
?>
