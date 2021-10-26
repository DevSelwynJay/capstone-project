<?php
//wala pato saling pusa hahhaa
echo "
    <table>
        <tr>
            <th>Admin ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact No.</th>
            <th>Work Category</th>
        </tr>
";
        $con=null;
        include 'php/DB_Connect.php';
        $result = mysqli_query($con,"SELECT id, last_name, first_name, middle_name, email, contact_no, role FROM admin");
        while ($row=mysqli_fetch_array($result)){
            $id = $row[0];
            $name = $row[1].", ".$row[2]." ".$row[3];
            $email = $row[4];
            $contact_no = $row[5];
            $role = $row[6];

            echo "
                                 <style>tr:not(:first-child):hover { background-color : rgba(87,191,243,0.82) }</style>
                                 <tr>
                                   <td>$id</td>
                                   <td>$name</td>
                                   <td>$email</td>
                                   <td>$contact_no</td>
                                   <td>$role</td>
                                </tr>
                                 ";
        }
        mysqli_close($con);
        echo"
    </table>

";
?>