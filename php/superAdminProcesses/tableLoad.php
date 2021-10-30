<?php
//wala pato saling pusa hahhaa
        $con=null;
        require '../DB_Connect.php';
        $result = mysqli_query($con,"SELECT id, last_name, first_name, middle_name, email, contact_no, role FROM admin");
        //$c=mysqli_num_rows();$ctr=0;
        while ($row=mysqli_fetch_array($result)){
            $id = $row[0];
            $name = $row[1].", ".$row[2]." ".$row[3];
            $email = $row[4];
            $contact_no = $row[5];
            $role = $row[6];

        }

        mysqli_close($con);
$html= "
                                
                                 <tr>
                                   <td>$id</td>
                                   <td>$name</td>
                                   <td>$email</td>
                                   <td>$contact_no</td>
                                   <td>$role</td>
                                </tr>
                                 ";

    echo $html;
?>