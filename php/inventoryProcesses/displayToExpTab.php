<?php
$con=null;
require '../DB_Connect.php';
$datetoday = date("Y-m-d");
$rpp = 5;
$page = '';
$exptable='';
if (isset($_POST['displayToExpDatapage'])){
    $page = $_POST['displayToExpDatapage'];
}
else{
    $page = 1;
}
$start_from = ($page -1 )*$rpp;

    $exptab = "Select * from `medinventory` where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY limit $start_from,$rpp";
    $result = mysqli_query($con, $exptab);
    if(mysqli_num_rows($result)>0){

    $exptable = '<h1>Medicine to Expire</h1><table>
            <tbody>
            <tr class="title">
                    <th>Medicine ID</th>
                    <th>Medicine Name</th>
                    <th>Remaining Days</th>
                </tr>';
    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $date = $row['expdate'];
        $remaindays=datediff($datetoday,$date);
        $exptable .= '<tr>
                    <td class="expired-text">'.$id.'</td>
                    <td class="expired-text">'.$name.'</td>
                    <td class="expired-text">'.$remaindays.'</td>
                    <td class="warning-btn"><i class="fas fa-exclamation"></i></td>
               </tr>
               ';
    }
    $exptable .= '</tbody>
        </table><br><div align="center">';
    $page_query = "Select * from `medinventory` where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY";
    $page_result = mysqli_query($con,$page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$rpp);
for($i =1;$i<=$total_pages;$i++){
    $exptable .= '<span class="pagination_linktoexp" style="cursor:pointer;padding:6px;border:1px solid #ccc;"id="'.$i.'">'.$i.'</span>';
}
        echo  $exptable;
    }
    else{
        echo  $exptable;
    }


function datediff($datetoday, $expdate){
    $diff = strtotime($expdate) - strtotime($datetoday);
    return abs(round($diff/86400));
}

?>