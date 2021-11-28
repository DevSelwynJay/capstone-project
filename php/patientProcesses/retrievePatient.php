<?php
session_start();
$con=null;
require '../DB_Connect.php';
$result="";
$tables = array('patient');
foreach ($tables as $table){
    $result = mysqli_query($con,"SELECT *,timestampdiff(year,birthday,NOW()) as age FROM $table");

    $counter=0;
    $row_color= "";
    while ($row = mysqli_fetch_array($result)){

        echo "<tr class='even'>";
        echo "<td>$row[1]</td>";
        $full_name = $row[2].", ".$row[3]." ".$row[4];
        $age = $row['age'];
        echo "<td>$full_name</td>";
        echo "<td>$age</td>";
        echo "<td>$row[7]</td>";
        echo "<td>$row[5]</td>";
        echo "<tr>";
    }

}
?>