<?php
$con=null;
require '../DB_Connect.php';
if (isset($_POST['displayMedData'])) {
    $medtable = '<table >
    <tbody>
      <tr class="title">
                    <th class="column_sort" id="id" data-order="desc">Medicine ID</th>
                    <th class="column_sort" id="name" data-order="desc">Medicine Name</th>
                    <th class="column_sort" id="category" data-order="desc">Category</th>
                    <th class="column_sort" id="stock" data-order="desc">No. of Stocks</th>
                    <th class="column_sort" id="mfgdate" data-order="desc">Mfg. Date</th>
                    <th class="column_sort" id="expdate" data-order="desc">Exp. Date</th>
                    <th class="column_sort" id="dateadded" data-order="desc">Date Added</th>
                    <th class="add-row"></th>
                </tr>
    ';
    $meddatatable = "Select * from `medinventory`  where `expdate` > NOW() order by `dateadded` asc";
    $result = mysqli_query($con, $meddatatable);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $medname = $row['name'];
        $category = $row['category'];
        $stocks = $row['stock'];
        $mfgdate = $row['mfgdate'];
        $expdate = $row['expdate'];
        $dateadded = $row['dateadded'];
        $datetoday = date("Y-m-d");
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
    $medtable .= '</tbody></table>';
    echo $medtable;
}
?>