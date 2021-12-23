<?php
$con=null;
require '../DB_Connect.php';
$output ='';
$order = $_POST["order"];
$rpp = 5;
$page = '';

if (isset($_POST['page'])){
    $page = $_POST['page'];
}
else{
    $page = 1;
}
$start_from = ($page -1 )*$rpp;
if($order == 'desc'){
    $order = 'asc';
}
else{
    $order = 'desc';
}
$query = "select * from `medinventory` where expdate > NOW() order by ".$_POST["column_name"]." ".$_POST["order"]." limit $start_from, $rpp ";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result)> 0) {
    $output .= '<table >
    <tbody>
      <tr class="title">
                    <th class="column_sort" id="id" data-order="' . $order . '" style="cursor:pointer;"> Medicine ID</th>
                    <th class="column_sort" id="name" data-order="' . $order . '" style="cursor:pointer;">Medicine Name</th>
                    <th >Category</th>
                    <th class="column_sort" id="stock" data-order="' . $order . '" style="cursor:pointer;">No. of Stocks</th>
                    <th >Date</th>
                   
                    <th class="column_sort" id="dateadded" data-order="' . $order . '" style="cursor:pointer;">Date Added</th>
                    <th class="add-row"></th>
                </tr>';
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $medname = $row['name'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $dosage = $row['dosage'];
        $stocks = $row['stock'];
        $mfgdate = $row['mfgdate'];
        $expdate = $row['expdate'];
        $dateadded = $row['dateadded'];
        $output .= '<tr>
        <td scope="row">' . $id . '</td>
        <td>' . $medname .' ('.$dosage. ')</td>
        <td>' . $category.' ('.$subcategory. ')</td>';
        if ($stocks >= 100) {
            $output .= '<td>' . $stocks . '</td>';
        } else {
            $output .= '<td style="color: red">' . $stocks . '</td>';
        }
        $output .= '<td>' . $mfgdate .'-'.$expdate .'</td>
        <td>' . $dateadded . '</td>
        <td class="add-btn"><i class="fas fa-plus" onclick="medDisplayUpdateModal(' . $id . ')"></i></td>
        </tr>';
    }
    $output .= '</tbody></table><br><div align="center">';
    $page_query = "select * from `medinventory` where expdate > NOW() order by ".$_POST["column_name"]." ".$_POST["order"]." ";
    $page_result = mysqli_query($con, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records / $rpp);
    if($total_records <= $rpp){

    }
    else{
        for($i =1;$i<=$total_pages;$i++){
            $output .= '<span class="pagination_link" style="cursor:pointer;padding:6px;border:1px solid #ccc;"id="'.$i.'">'.$i.'</span>';
        }
    }
}
echo $output;