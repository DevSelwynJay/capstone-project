<?php

$con=null;
require '../DB_Connect.php';

if (isset($_POST['displayMedData'])) {
    $medtable = '<table >
    <tbody>
      <tr class="title">
                    <th>Medicine ID</th>
                    <th>Medicine Name</th>
                    <th>Category</th>
                    <th>No. of Stocks</th>
                    <th>Mfg. Date</th>
                    <th>Exp. Date</th>
                    <th>Date Added</th>
                    <th class="add-row"></th>
                </tr>
    ';

    $meddatatable = "Select * from `medinventory`";
    $result = mysqli_query($con, $meddatatable);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $medname = $row['name'];
        $category = $row['category'];
        $stocks = $row['stock'];
        $mfgdate = $row['mfgdate'];
        $expdate = $row['expdate'];
        $dateadded = $row['dateadded'];



        $medtable .= '<tr>
        <td scope="row">' . $id . '</td>
        <td>' . $medname . '</td>
        <td>' . $category . '</td>
        <td>' . $stocks . '</td>
        <td>' . $mfgdate . '</td>
        <td>' . $expdate . '</td>
        <td>' . $dateadded . '</td>
        <td class="add-btn"><i class="fas fa-plus" onclick="medDisplayUpdateModal('.$id.')"></i></td>
        </tr>';
    }
    $medtable .= '</tbody></tabel>';
    echo $medtable;
}


?>