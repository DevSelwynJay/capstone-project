<?php
session_start();
$con = null;
require '../DB_Connect.php';

if(!isset($_SESSION['email'])||$_SESSION['account_type']!=2){
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
    exit();
}
$email = $_SESSION['email'];
$res = mysqli_query($con,"SELECT *, timestampdiff(year ,birthday,NOW()) as age, DATE_FORMAT(birthday,'%M %e, %Y') as bday FROM patient where email = '$email' ");
if(mysqli_num_rows($res)<=0){
    echo json_encode(array(
        "patient_name"=>"invalid patient email"
    ));
    exit();
}
if($res){
    if($row = mysqli_fetch_assoc($res)){
        $_SESSION['is_link']=false;//to determine that this is connected to patient record on the admin side

        //will use to check if there the same record in walk in patient db
        $_SESSION['pfname'] = $row['first_name'];
        $_SESSION['plname'] = $row['last_name'];
        $_SESSION['pmname'] = $row['middle_name'];
        $_SESSION['pbday'] = $row['birthday'];
        $_SESSION['ppurok'] = $row['purok'];

        $_SESSION['patientOA_ID'] = $row['id'];

        echo json_encode(array(
            "patient_id"=>$row['id']
            ,"patient_name"=>$row['first_name']." ".$row['middle_name']." ".$row['last_name']
            ,"age"=>$row['age'],"gender"=>$row['gender'],"birthday"=>$row['bday'],
            "contact_no"=>$row['contact_no'], "address"=>"Purok ".$row['purok'].", ".$row['house_no']." ".$row['address']
        ));

        //look weather the online account credentials has the same record in the walk in patient db
        //if meron set the acc status as linked
        $pfname = $_SESSION['pfname'] ;
        $plname = $_SESSION['plname'] ;
        $pmname = $_SESSION['pmname'];
        $pbday = $_SESSION['pbday'];
        $ppurok = $_SESSION['ppurok'];
        $result = mysqli_query($con,"SELECT * FROM walk_in_patient 
        WHERE last_name = '$plname' AND first_name = '$pfname' AND middle_name = '$pmname' 
          AND birthday = '$pbday' AND purok = '$ppurok'  
        
        ");
        $id_in_walk_in_patient=null;
        if(mysqli_num_rows($result)>0){//may kamuka si online acc sa walk_in_patient na DB
            $_SESSION['is_link']=true;
            if($row = mysqli_fetch_assoc($result)){
                $_SESSION['merge_id'] = $id_in_walk_in_patient = $row['id'];
                //merge id is the id that is from walk in patient ,
                // it was generate because the name,bday,purok of online patient account has
                //the same record in walk in patient table
            }
        }

        //check the online account if there is existing med or vaccine record using the id of the walk_in_patient that matched
        $_SESSION['hasRecord']  = 0;
        $result = mysqli_query($con,"SELECT * FROM vaccination_record WHERE patient_id = '$id_in_walk_in_patient' ");
        if(mysqli_num_rows($result)>0){$_SESSION['hasRecord']+=1;}
        $result = mysqli_query($con,"SELECT * FROM medication_record WHERE patient_id = '$id_in_walk_in_patient' ");
        if(mysqli_num_rows($result)>0){$_SESSION['hasRecord']+=1;}


    }
}
else{
    echo json_encode(array(
        "patient_name"=>"no logged patient"
    ));
}
