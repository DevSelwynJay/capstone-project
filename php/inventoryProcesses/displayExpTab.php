<?php
$con=null;
require '../DB_Connect.php';
$datetoday = date("Y-m-d");
$rpp = 5;
$page = '';
$expiredtab='';
if (isset($_POST['displayExpTabpage'])){
    $page = $_POST['displayExpTabpage'];
}
else{
    $page = 1;
}
$start_from = ($page -1 )*$rpp;

    $expire = "Select * from `medinventory` where `expdate` < '$datetoday' limit $start_from,$rpp";
    $result = mysqli_query($con,$expire);
    if(mysqli_num_rows($result)> 0){
    $expiredtab = '<h1>Expired Medicines</h1>
        <table>
            <tbody>
            <tr class="title">
                    <th>Medicine ID</th>
                    <th>Medicine Name</th>
                    <th>Status</th>
                </tr>';
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $expiredtab .= '<tr>
                    <td>'.$id.'</td>
                    <td>'.$name.'</td>
                    <td class="expired-text">Expired</td>
                    <td class="delete-btn"><i class="fas fa-trash" onclick="delModal('.$id.')" ></i></td>
                </tr>';
    }
    $expiredtab .= '</tbody>
        </table><br><div align="center">';
    $page_query = "Select * from `medinventory` where `expdate` < '$datetoday'";
    $page_result = mysqli_query($con,$page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$rpp);
for($i =1;$i<=$total_pages;$i++){
    $expiredtab .= '<span class="pagination_linkexp" style="cursor:pointer;padding:6px;border:1px solid #ccc;"id="'.$i.'">'.$i.'</span>';
}
        echo $expiredtab;
    }
    else{
        echo $expiredtab;
    }


?>

