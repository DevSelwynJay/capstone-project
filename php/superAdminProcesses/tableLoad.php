<?php
$con=null;
require '../DB_Connect.php';

$filstat = $_POST['filstat'];

if($filstat == "1"){
    $sts = "1";
}elseif ($filstat == "2"){
    $sts = "0";
}


$usertable = "SELECT id, first_name, middle_name, last_name, email, account_status, password FROM walk_in_patient where email like '%@%' and account_status = '$sts' order by `date_created` asc";
$result = mysqli_query($con, $usertable);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['id'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $lname = $row['last_name'];
        $stat = $row['account_status'];
        if ($stat == 1) {
            $status = "Active";
            $buttonstat = "Deactivate";
            $butID = "patinactive";
            // $butclick = "patinactive()";
        } elseif ($stat == 0) {
            $status = "Deactivated";
            $buttonstat = "Activate";
            $butID = "patactive";
            // $butclick = "patactive()";
        }
        $fullname = $lname . ", " . $fname . " " . $mname;

        $row['name'] = $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name'];
        $row['email'] = $row['email'];
        $row['status'] = $status;
        $row['action'] = '<button class="$butID" onclick="patclick(\'' . str_replace("'", "\\'", $id) . '\', \'' . str_replace("'", "\\'", $fullname) . '\', \'' . str_replace("'", "\\'", $status) . '\')">' . $buttonstat . '</button>';

        $arr[] = $row;

    }
    echo json_encode($arr);
}else{
    $arr = array();
    echo json_encode($arr);
}



?>
