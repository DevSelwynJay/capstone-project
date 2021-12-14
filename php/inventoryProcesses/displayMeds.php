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
$meddatatable = "Select * from `medinventory`  where `expdate` > NOW() order by `dateadded` asc limit $start_from, $rpp";
$result = mysqli_query($con, $meddatatable);
if(mysqli_num_rows($result)> 0) {
    $medtable = '<h3 class="margin-top-2" style="color:var(--third-color);font-weight: bold">Medicine Inventory</h3>
    <table>
    <tbody>
      <tr class="title">
                    <th class="column_sort" id="id" data-order="desc">Medicine ID</th>
                    <th class="column_sort" id="name" data-order="desc">Medicine Name</th>
                    <th class="column_sort" id="category" data-order="desc">Category</th>
                    <th class="column_sort" id="subcategory" data-order="desc">Sub-Category</th>
                    <th class="column_sort" id="dosage" data-order="desc">Dosage</th>
                    <th class="column_sort" id="stock" data-order="desc">No. of Stocks</th>
                    <th class="column_sort" id="mfgdate" data-order="desc">Mfg. Date</th>
                    <th class="column_sort" id="expdate" data-order="desc">Exp. Date</th>
                    <th class="column_sort" id="dateadded" data-order="desc">Date Added</th>
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
        <td scope="row">' . $id . '</td>
        <td>' . $medname . '</td>
        <td>' . $category . '</td>
        <td>'.$subcategory.'</td>
        <td>'.$dosage.'</td>';

        if ($stocks >= 100) {
            $medtable .= '<td>' . $stocks . '</td>';
        } else {
            $medtable .= '<td style="color: red">' . $stocks . '</td>';
        }

        $medtable .= '<td>' . $mfgdate . '</td>
        <td>' . $expdate . '</td>
        <td>' . $dateadded . '</td>
        <td class="add-btn"><i class="fas fa-plus" onclick="medDisplayUpdateModal(' . $id . ')"></i></td>
        </tr>';
    }
    $medtable .= '</tbody></table><br><div align="center">';
    $page_query = "Select * from `medinventory`  where `expdate` > NOW() order by `dateadded` asc ";
    $page_result = mysqli_query($con, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records / $rpp);
    if($total_records <= $rpp){

    }
    else{
        for($i =1;$i<=$total_pages;$i++){
            $medtable .= '<span class="pagination_link" style="cursor:pointer;padding:6px;border:1px solid #ccc;"id="'.$i.'">'.$i.'</span>';
        }
    }
    echo $medtable;
}
else{
    echo $medtable;
}
?>