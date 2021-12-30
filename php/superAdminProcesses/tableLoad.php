<?php
$con=null;
require '../DB_Connect.php';

$rpp = 5;
$page = '';
$usertab ='';
if (isset($_POST['page'])){
    $page = $_POST['page'];
}
else{
    $page = 1;
}
$start_from = ($page -1 )*$rpp;
$usertable = "SELECT id, first_name, middle_name, last_name, email FROM patient order by `date_created` asc limit $start_from, $rpp";
$result = mysqli_query($con, $usertable);
if(mysqli_num_rows($result)> 0) {
    $usertab = '<h3 class="margin-top-2" style="color:var(--third-color);font-weight: bold"></h3>
    
    <tbody>
      <tr class="title">
                    <th class="column_sort" id="pid" data-order="desc" style="cursor:pointer;">User/Patient ID</th>
                    <th class="column_sort" id="pfname" data-order="desc" style="cursor:pointer;">First Name</th>
                    <th class="column_sort" id="pmname" data-order="desc" style="cursor:pointer;">Middle Name</th>
                    <th class="column_sort" id="plname" data-order="desc" style="cursor:pointer;">Last Name</th>
                    <th class="column_sort" id="pemail" data-order="desc" style="cursor:pointer;">Email</th>
                </tr>
    ';
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $lname = $row['last_name'];
        $email = $row['email'];

        $usertab .= '<tr>
        <td scope="row">' . $id . '</td>
        <td>' . $fname .'</td>
        <td>' . $mname.'</td>
        <td>' . $lname .'</td>
        <td>' . $email . '</td>
        </tr>';

    }

    $usertab .= '</tbody><br><div align="center">';
    $page_query = "SELECT id, first_name, middle_name, last_name, email FROM patient order by `date_created` asc ";
    $page_result = mysqli_query($con, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records / $rpp);
    if($total_records <= $rpp){

    }
    else{
        for($i =1;$i<=$total_pages;$i++){
            $usertab .= '<span class="pagination_link" style="cursor:pointer;padding:6px;border:1px solid #ccc;"id="'.$i.'">'.$i.'</span>';
        }
    }
    echo $usertab;
}
else{
    echo $usertab;
}
?>