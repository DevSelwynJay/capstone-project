<?php
$con=null;
require '../DB_Connect.php';

if(isset($_POST["query"])){
    $output ='';
    $query = "select * from `medinventory` where name like '%".$_POST["query"]."%'";
    $result = mysqli_query($con,$query);
    $output = '<ul class="list-group list-group-flush">';
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
            $output .= '<li class="list-group-item text-dark" onclick="medDisplayUpdateModal('.$row["id"].')">'.$row["name"].'</li>';
        }

    }
    else{
        $output .= '<li class="list-group-item text-dark">Medicine Not Found</li>';
    }
    echo $output;
}

