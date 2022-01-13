<?php
session_start();
$con = null;
require 'php/DB_Connect.php';

$years = array();
$titles = array();
//array_push($arr,[0,1,2,3,4,5]);
//echo json_encode($arr);

$res = mysqli_query($con,"SELECT * FROM vaccination_record GROUP BY vaccine_name ORDER BY vaccine_name");
while ($row = mysqli_fetch_assoc($res)){
    array_push($titles,$row['vaccine_name']);
}

$res = mysqli_query($con,"SELECT *,DATE_FORMAT(date_given,'%Y') as date_given_fd FROM vaccination_record GROUP BY date_given_fd ORDER BY date_given_fd DESC");
while ($row = mysqli_fetch_assoc($res)){
    array_push($years,$row['date_given_fd']);

}

$bodyResult = array();
foreach ($years as $year){

    $currRow = array();
    array_push($currRow,$year);
    foreach ($titles as $title){
      $count = mysqli_num_rows(mysqli_query($con,"SELECT * FROM vaccination_record WHERE DATE_FORMAT(date_given,'%Y') = '$year' AND vaccine_name = '$title' "));
      array_push($currRow,$count);
    }

    array_push($bodyResult,$currRow);
}
array_unshift($titles,"Year");
array_unshift($bodyResult,$titles);

echo json_encode($bodyResult);
