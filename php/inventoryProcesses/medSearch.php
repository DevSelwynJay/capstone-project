<?php
$con=null;
require '../DB_Connect.php';
if(isset($_POST["search"])) {
    $search = $_POST["search"];
    $query = "select * from `medinventory` where name like '%" . $search . "%'";
    $result = mysqli_query($con, $query);
    $response = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $response[] = array(
                'value' => $row['id'],
                "label" => $row['id'] . ' ' . $row['name']
            );
        }
    } else {
        $response[] = "";
        $response[] = array(
            "label" => "No Record Found"
        );
    }
    echo json_encode($response);
}

