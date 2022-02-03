<?php
session_start();
$con=null;
require '../DB_Connect.php';
$arr=array();
$table = '';
//$res = mysqli_query($con,"Select id, CONCAT(name,'(',dosage,')') as name,CONCAT(category,'(',subcategory,')') as category, stock,criticalstock, CONCAT(mfgdate,'-',expdate) as mfgdate, dateadded from `medinventory` where `expdate` > NOW() order by `dateadded` asc");
$sql = "Select name, SUM(stock) as stock from `medinventory` Group by name";
$res2 = mysqli_query($con,$sql);
$table .= '<tbody>
                            <tr>
                                <th>MEDICINE NAME</th>
                                <th>STOCKS</th>
                                <th>MEDICINE ID</th>
                                <th>CATEGORY</th>
                                <th>DATE</th>
                                <th>DATEADDED</th>
                                <th>ACTION</th>
                            </tr>';


$row=mysqli_fetch_assoc($res2);
    $medname = $row['name'];
    $medstocks = $row['stock'];
    $table .= '<tr data-tt-id="1">
                <td>'.$medname.'</td>
              </tr>
              ';
    $sql2 = "Select * from `medinventory` where name='$medname'";
    $result = mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_assoc($result);
        $table .= '<tr data-tt-id="2" data-tt-parent-id="1">
                <td>'.$row2['name'].'</td>
              </tr>';

    /*$id = $row['id'];
    $row['button'] ='<i id="updatebtn" class="fas fa-plus updta"  data-id="'.$id.'" ></i>';
    if ($row['stock'] <= $row['criticalstock']) {
        $row['stock'] = '<span style="color: red" title="Critital Stocks: '.$row['criticalstock'].'">'.$row['stock'].'</span>';
    } else {
        $row['stock'] = '<span   title="Critital Stocks: '.$row['criticalstock'].'">'.$row['stock'].'</span>';
    }*/



$table .= '</tbody>';
echo $table;
