<?php
$con=null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';
$medtable ='';
if (isset($_POST['page'])){
    $page = $_POST['page'];
}
else{
    $page = 1;
}
$start_from = ($page -1 )*$rpp;
$meddatatable = "Select * from `medinventory`  where  `expdate` > NOW() order by `dateadded` asc limit $start_from, $rpp";
$result = mysqli_query($con, $meddatatable);

if(mysqli_num_rows($result)> 0) {
    $medtable = '<h3 class="margin-top-2" style="color:var(--third-color);font-weight: bold">Medicine Inventory</h3>
    <table>
    <tbody>
      <tr class="title">
                    <th class="column_sort" id="id" data-order="desc" style="cursor:pointer;">Medicine ID</th>
                    <th class="column_sort" id="name" data-order="desc" style="cursor:pointer;">Medicine Name</th>
                    <th >Category</th>
                    <th class="column_sort" id="stock" data-order="desc" style="cursor:pointer;">No. of Stocks</th>
                    <th id="date" title="Manufacturing Date - Expiration Date" >Date <i class="fas fa-info-circle" title="Manufacturing Date - Expiration Date"></i></th>
                    <th class="column_sort" id="dateadded" data-order="desc" style="cursor:pointer;">Date Added</th>
                    <th class="add-row"></th>
                </tr>
    ';


    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $medname = $row['name'];
        $category = $row['category'];
        $subcategory = $row['subcategory'];
        $dosage = $row['dosage'];
        $stocks = $row['stock'];
        $mfgdate = $row['mfgdate'];
        $expdate = $row['expdate'];
        $dateadded = $row['dateadded'];
        $datetoday = date("Y-m-d");
        $medtable .= '<tr>
        <td scope="row" data-label="Medicine ID">' . $id . '</td>
        <td data-label="Medicine Name">' . $medname .' ('.$dosage. ')</td>
        <td data-label="Category">' . $category.' ('.$subcategory. ')</td>';

        if ($stocks >= 100) {
            $medtable .= '<td data-label="No. of Stocks">' . $stocks . '</td>';
        } else {
            $medtable .= '<td data-label="No. of Stocks" style="color: red">' . $stocks . '</td>';
        }

        $medtable .= '<td data-label="Date">' . $mfgdate .'-'.$expdate .'</td>
        <td data-label="Date Added">' . $dateadded . '</td>
        <td class="add-btn"><i class="fas fa-plus" onclick="medDisplayUpdateModal(' . $id . ')"></i></td>
        </tr>';
    }
    $medtable .= '</tbody></table><br><div align="center">';
    $page_query = "Select * from `medinventory`  where `stock` > 0 AND `expdate` > NOW() order by `dateadded` asc ";
    $page_result = mysqli_query($con, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records / $rpp);
    if($total_records <= $rpp){

    }
    else{
        for($i =1;$i<=$total_pages;$i++){
            $medtable .= '<span class="pagination_link" style="cursor:pointer;padding:5px 5px;border:1px solid #cccccc;"id="' .$i.'">'.$i.'</span>';
        }
    }
    $medtable .= '</div>';
    echo $medtable;
}
else{
    echo $medtable;
}
?>