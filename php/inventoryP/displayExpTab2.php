<?php
session_start();
$con=null;
require '../DB_Connect.php';
$arr=array();
$res = mysqli_query($con,"Select id, CONCAT(name,'(',dosage,')') as name from `medinventory` where `expdate` < NOW() order by `dateadded` asc");
while($row=mysqli_fetch_assoc($res)){
    $row['button'] ='<i id="deleteicon" class="fas fa-trash deletebtnt" data-id="'.$row['id'].'"></i>';
    $arr[]=$row;
}
echo json_encode($arr);
