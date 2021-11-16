<?php
$con=null;
require '../DB_Connect.php';

$datetoday = date("Y-m-d");

if(isset($_POST['displayExpTab'])){
    $expire = "Select * from `medinventory` where `expdate` < '$datetoday'";
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



        $expiredtab .= '<tr>
                    <td>'.$id.'</td>
                    <td>'.$name.'</td>
                    <td class="expired-text">Expired</td>
                    <td class="delete-btn"><i class="fas fa-trash"></i></td>
                </tr>';

    }

    $expiredtab .= '</tbody>
        </table>';

    echo $expiredtab;

}

?>

