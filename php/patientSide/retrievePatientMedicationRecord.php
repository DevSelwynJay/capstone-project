<?php
session_start();//PATIENT SIDE

//echo $patientID;
//exit();
//info from online patient account
$pfname = $_SESSION['pfname'] ;
$plname = $_SESSION['plname'] ;
$pmname = $_SESSION['pmname'];
$pbday = $_SESSION['pbday'];
$ppurok = $_SESSION['ppurok'];

$con=null;
require '../DB_Connect.php';

//look weather the online account credentials has the same record in the walk in patient db
//then get the ID of the same record in walk_in_db
$result = mysqli_query($con,"SELECT * FROM walk_in_patient 
WHERE last_name = '$plname' AND first_name = '$pfname' AND middle_name = '$pmname' 
  AND birthday = '$pbday' AND purok = '$ppurok'  

");
//echo mysqli_num_rows($result);
if(mysqli_num_rows($result)>0){//may kamuka si online patient account sa walk in patient DB
    $id_in_walk_in_patient = null;

    if($row = mysqli_fetch_assoc($result)){
        $_SESSION['merge_id'] = $id_in_walk_in_patient = $row['id'];
        //merge id is the id that is from walk in patient ,
        // it was generate because the name,bday,purok of online patient account has
        //the same record in walk in patient table
    }
    //echo json_encode($mergeAcc);

    $arr = array();
    $result = mysqli_query($con,"SELECT *, DATE_FORMAT(start_date,'%Y-%m-%d') as start_date_1 ,
        DATE_FORMAT(start_date,'%M %d, %Y') as start_date_formatted,
        DATE_FORMAT(end_date,'%Y-%m-%d') as end_date_1,
        DATE_FORMAT(end_date,'%M %d, %Y') as end_date_formatted
        FROM medication_record
        WHERE patient_id = '$id_in_walk_in_patient'  ORDER BY date_given DESC");

    while($row= mysqli_fetch_assoc($result)){
        $arr[] = $row;
    }
    echo json_encode($arr);


}//main if
mysqli_close($con);

?>