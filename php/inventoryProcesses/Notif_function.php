<?php
$con=null;
require '../DB_Connect.php';

$sql = "SELECT * FROM `medinventory` WHERE stock <= 100 AND expdate > NOW()";
$countres = mysqli_query($con,$sql);
$count = mysqli_num_rows($countres);
$sql2 = "SELECT * FROM `medinventory` WHERE stock = 0";
$countres2 = mysqli_query($con,$sql2);
$count4 = mysqli_num_rows($countres2);
$exptab = "Select * from `medinventory`  where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY";
$expire = "Select * from `medinventory` where `expdate` < NOW() - INTERVAL 1 DAY";
$res1 = mysqli_query($con,$expire);
$res2 = mysqli_query($con,$exptab);
$count2 = mysqli_num_rows($res1);
$count3 = mysqli_num_rows($res2);
$total = $count + $count2 + $count3 + $count4;
if($total <=8){
    $total = $total ;
}
else{
    $total = 9 ."&#8314;";
}

echo $total;
?>