<?php
$con=null;
require '../DB_Connect.php';
$output ='';
$order = $_POST["order"];
if($order == 'desc'){
    $order = 'asc';
}
else{
    $order = 'desc';
}
$query = "select * from `medinventory` where expdate > NOW() order by ".$_POST["column_name"]." ".$_POST["order"]."";
$result = mysqli_query($con, $query);
$output .= '<table >
    <tbody>
      <tr class="title">
                    <th class="column_sort" id="id" data-order="'.$order.'"> Medicine ID</th>
                    <th class="column_sort" id="name" data-order="'.$order.'">Medicine Name</th>
                    <th class="column_sort" id="category" data-order="'.$order.'">Category</th>
                    <th class="column_sort" id="stock" data-order="'.$order.'">No. of Stocks</th>
                    <th class="column_sort" id="mfgdate" data-order="'.$order.'">Mfg. Date</th>
                    <th class="column_sort" id="expdate" data-order="'.$order.'">Exp. Date</th>
                    <th class="column_sort" id="dateadded" data-order="'.$order.'">Date Added</th>
                    <th class="add-row"></th>
                </tr>';

while($row = mysqli_fetch_array($result)){
    $id = $row['id'];
    $medname = $row['name'];
    $category = $row['category'];
    $stocks = $row['stock'];
    $mfgdate = $row['mfgdate'];
    $expdate = $row['expdate'];
    $dateadded = $row['dateadded'];

    $output .= '<tr>
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
$output .= '</tbody></table>';
echo $output;