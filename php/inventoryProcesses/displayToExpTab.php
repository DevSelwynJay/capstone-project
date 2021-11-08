<?php
$con=null;
require '../DB_Connect.php';

$datetoday = date("Y-m-d");


if(isset($_POST['displayToExpData'])){
    $exptab = "Select * from `medinventory` where `expdate` between NOW()  AND NOW() + INTERVAL 30 DAY";
    $result = mysqli_query($con, $exptab);
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


                $expiretab .= '<tr>
                    <td class="expired-text">'.$id.'</td>
                    <td class="expired-text">'.$name.'</td>
                    <td class="expired-text">'.$remaindays.'</td>
                    <td class="warning-btn"><i class="fas fa-exclamation"></i></td>
               </tr>
               ';


    }
    $exptable .= $expiretab;
    $exptable .= '</tbody>
        </table>';
    echo  $exptable;

}
function datediff($datetoday, $expdate){
    $diff = strtotime($expdate) - strtotime($datetoday);

    return abs(round($diff/86400));
}

?>