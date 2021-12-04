<?php
$con = null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';
$medtable = '';
$type = 'Add';
if(isset($_POST['page'])){
    $page = $_POST['page'];
}
else{
    $page = 1;
}
$start_from = ($page - 1)*$rpp;
$medexpqry = "Select * from `medreport` where `type` like '%" . $type . "%' order by `dateadded` asc limit $start_from,$rpp";
$res = mysqli_query($con,$medexpqry);
if(mysqli_num_rows($res)> 0) {
    $medtable .= '<table class="reports__individual-reports-table">
                                <tbody>
                                   <tr>
                                      <th>Medicine Id</th>
                                      <th>Medicine Name</th>
                                      <th>Category</th>
                                      <th>No. of Stocks</th>
                                      <th>Mfg. Date</th>
                                      <th>EXP. Date</th>
                                   </tr>';
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $name = $row['name'];
        $category = $row['category'];
        $stock = $row['stock'];
        $mfgdate = $row['mfgdate'];
        $expdate = $row['expdate'];
        $medtable .= '<tr>
        <td scope="row">' . $id . '</td>
        <td>' . $name . '</td>
        <td>' . $category . '</td>
        <td>' . $stock . '</td>
        <td>' . $mfgdate . '</td>
        <td>' . $expdate . '</td>';
    }
    $medtable .= '</tbody></table><br><div align="center">';
    $page_query = "Select * from `medreport`  where `type` like '%" . $type . "%' order by `dateadded` asc ";
    $page_result = mysqli_query($con, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records / $rpp);
    if($total_records <= $rpp){

    }
    else{
        for ($i = 1; $i <= $total_pages; $i++) {
            $medtable .= '<span class="pagination_link" style="cursor:pointer;padding:6px;border:1px solid #ccc;"id="' . $i . '">' . $i . '</span>';
        }
    }
    echo $medtable;
}else{
    $medtable = "No Data Found";
    echo $medtable;
}





?>