<?php
$con=null;
require '../DB_Connect.php';


$usertable = "SELECT id, last_name, first_name, middle_name, email, contact_no, role, account_status FROM admin";
$result = mysqli_query($con, $usertable);

while ($row = mysqli_fetch_assoc($result)){


    $id = $row['id'];
    $fname = $row['first_name'];
    $mname = $row['middle_name'];
    $lname = $row['last_name'];
    $stat = $row['account_status'];
    if ($stat == 1) {
        $status = "Active";
        $buttonstat = "Deactivate";
        $butID = "adinactive";
        // $butclick = "patinactive()";
    } elseif ($stat == 0) {
        $status = "Deactivated";
        $buttonstat = "Activate";
        $butID = "adactive";
        // $butclick = "patactive()";
    }
    $fullname = $lname . ", " . $fname . " " . $mname;

    $row['name'] = $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['first_name'];
    $row['email']= $row['email'];
    $row['contact']= $row['contact_no'];
    $row['workcat']= $row['role'];
    $row['status'] = $status;
    $row['action'] = '<button class="$butID" onclick="adclick(\'' . str_replace("'", "\\'", $id) . '\', \'' . str_replace("'", "\\'", $fullname) . '\', \'' . str_replace("'", "\\'", $status) . '\')">' . $buttonstat . '</button>';

    $arr[] = $row;







}
echo json_encode($arr);

?>
