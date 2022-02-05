<?php
$con=null;
require '../DB_Connect.php';

$filstat = $_POST['filstat'];

if($filstat == "1"){
    $sts = "1";
}elseif ($filstat == "2"){
    $sts = "0";
}


$usertable = "SELECT id, last_name, first_name, middle_name, email, contact_no, role, account_status FROM admin where account_status = '$sts'";
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

    $row['adname'] = $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['first_name'];
    $row['ademail']= $row['email'];
    $row['adcontact']= $row['contact_no'];
    $row['adworkcat']= $row['role'];
    $row['adstatus'] = $status;
    $row['adaction'] = '<button class="$butID" onclick="adclick(\'' . str_replace("'", "\\'", $id) . '\', \'' . str_replace("'", "\\'", $fullname) . '\', \'' . str_replace("'", "\\'", $status) . '\')">' . $buttonstat . '</button>';

    $arr[] = $row;







}
echo json_encode($arr);

?>
