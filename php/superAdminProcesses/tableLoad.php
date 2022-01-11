<?php
$con=null;
require '../DB_Connect.php';

$ctr=1;
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
$usertable = "SELECT id, first_name, middle_name, last_name, email, account_status, password FROM walk_in_patient where email like '%@%' order by `date_created` asc limit $start_from, $rpp";
$result = mysqli_query($con, $usertable);
$usertab = '<h3 class="margin-top-2" style="color:var(--third-color);font-weight: bold"></h3>
    
    <tbody>
      <tr class="title">
                    <th class="column_sort" id="pid" data-order="desc" style="cursor:pointer;">First Name</th>
                    <th class="column_sort" id="pfname" data-order="desc" style="cursor:pointer;">Middle Name</th>
                    <th class="column_sort" id="pmname" data-order="desc" style="cursor:pointer;">Last Name</th>
                    <th class="column_sort" id="plname" data-order="desc" style="cursor:pointer;">Email</th>
                    <th class="column_sort" id="pemail" data-order="desc" style="cursor:pointer;">Status</th>
                    <th class="column_sort" id="pact" data-order="desc" style="cursor:pointer;">Action</th>
                </tr>
    ';
if(mysqli_num_rows($result)> 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $ctr++;
        $id = $row['id'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $lname = $row['last_name'];
        $email = $row['email'];
        $stat = $row['account_status'];
        if($stat==1){
            $status="Active";
            $buttonstat = "Deactivate";
            $butID = "patinactive";
           // $butclick = "patinactive()";
        }elseif ($stat==0){
            $status="Deactivated";
            $buttonstat = "Activate";
            $butID = "patactive";
           // $butclick = "patactive()";
        }

        $fullname = $lname .", ".$fname. " ". $mname;

            $usertab .= '<tr>
            <td class="patdata1"  scope="row" hidden>' . $id . '</td>
            <td class="patdata2"  hidden>' . $fullname . '</td>
            <td>' . $fname . '</td>
            <td>' . $mname . '</td>
            <td>' . $lname . '</td>
            <td>' . $email . '</td>
            <td>' . $status . '</td>
            <td ><button class="$butID" onclick="patclick(\''.str_replace("'", "\\'", $id).'\', \''.str_replace("'", "\\'", $fullname).'\', \''.str_replace("'", "\\'", $status).'\')">' . $buttonstat . '</button></td>
            </tr>';

    }


    $usertab .= '</tbody><br><div align="center">';
    $page_query = "SELECT id, first_name, middle_name, last_name, email, account_status FROM walk_in_patient order by `date_created` asc ";
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
    $str = "Currently Zero Account...";
    $usertab .= '<tr><td colspan="6">' . $str . '</td>
            </tr>';
    echo $usertab;
}

?>