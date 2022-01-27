<?php
// db settings
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}



// fetch records
$sql = "SELECT id, first_name, middle_name, last_name, email, account_status, password FROM walk_in_patient where email like '%@%' order by `date_created` asc";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)) {
    if($row['account_status'] == '1'){
        $row['account_status'] ='Active';
        $fullname = ''.$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
        $buttonstat = 'Deactivate';
        $row['password'] ='<button class="$butID" onclick="patclick(\''.str_replace("'", "\\'", $row['id']).'\', \''.str_replace("'", "\\'", $fullname).'\', \''.str_replace("'", "\\'", $row['account_status']).'\')">' . $buttonstat . '</button>';
        $array[] = $row;
    }elseif ($row['account_status'] == '0'){
        $row['account_status'] ='Deactivated';
        $fullname = ''.$row['last_name'].', '.$row['first_name'].' '.$row['middle_name'];
        $buttonstat = 'Activate';
        $row['password'] ='<button class="$butID" onclick="patclick(\''.str_replace("'", "\\'", $row['id']).'\', \''.str_replace("'", "\\'", $fullname).'\', \''.str_replace("'", "\\'", $row['account_status']).'\')">' . $buttonstat . '</button>';
        $array[] = $row;
    }


}

$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($dataset);
?>