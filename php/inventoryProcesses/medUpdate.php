<?php
$con=null;
require '../DB_Connect.php';

//Display the Data on the Modal Update

if(isset($_POST['medupdateid'])){
    $med_id=$_POST['medupdateid'];

    $medupdatesql = "Select * from `medinventory` where `id`=$med_id";
    $result = mysqli_query($con,$medupdatesql);
    $response = array();
    while($row=mysqli_fetch_assoc($result)){
        $response=$row;
    }
    echo json_encode($response);
}else{
    $response['status']=200;
    $response['message']="Invalid or Data not found";
}

//Update Query

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $medstock=$_POST['updatemedicineStocks'];
    $medmfgdate=$_POST['updatemedicineMfgDate'];
    $medexpdate=$_POST['updatemedicineExpDate'];


    $updatesql = "Update `medinventory` set `stock`='$medstock', `mfgdate`='$medmfgdate', `expdate`='$medexpdate' where `id`=$id";

    $result=mysqli_query($con,$updatesql);

}

?>

