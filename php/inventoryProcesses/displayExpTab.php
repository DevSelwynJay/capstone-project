<?php
$con=null;
require '../DB_Connect.php';

if(isset($_POST['displayExpTab'])){
    $expire = "Select id,name,expdate from `medinventory`";
    $result = mysqli_query($con,$expire);
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
        $date = $row['expdate'];
        $datetoday = date("Y-m-d");
        $remaindays = datediff($datetoday, $date);

        if($remaindays <= 1){
            $expiretab .= '<tr>
                    <td>'.$id.'</td>
                    <td>'.$name.'</td>
                    <td class="expired-text">Expired</td>
                    <td class="delete-btn"><i class="fas fa-trash"></i></td>
                </tr>';
        }
    }
    $expiredtab .= $expiretab;
    $expiredtab .= '</tbody>
        </table>';

    echo $expiredtab;

}



function datediff($datetoday, $expdate){
    $diff = strtotime($expdate) - strtotime($datetoday);

    return abs(round($diff/86400));
}
?>

