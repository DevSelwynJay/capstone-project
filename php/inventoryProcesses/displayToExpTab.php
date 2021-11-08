<?php
$con=null;
require '../DB_Connect.php';


if(isset($_POST['displayToExpData'])){
    $exptab = "Select id,name,expdate from `medinventory`";
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
        $datetoday = date("Y-m-d");
        $remaindays = datediff($datetoday, $date);

        if($remaindays <= 30 && $remaindays >= 2){
                $expiretab .= '<tr>
                    <td class="expired-text">'.$id.'</td>
                    <td class="expired-text">'.$name.'</td>
                    <td class="expired-text">'.$remaindays. ' days</td>
                    <td class="expired-text">'.$date.'</td>
                    <td class="warning-btn"><i class="fas fa-exclamation"></i></td>
               </tr>
               ';
        }

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