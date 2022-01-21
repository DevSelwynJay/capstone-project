<?php
$con=null;
require '../DB_Connect.php';
//Display the Data on the Modal Update
if(isset($_POST['medupdateid'])){
    $med_id=$_POST['medupdateid'];
    $medupdatesql = "Select * from `medinventory` where `id`='$med_id'";
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
    $name = $_POST['updatemedicineName'];
    $category = $_POST['updatemedicineCategory'];
    $subcategory = $_POST['updatemedicinesubCategory'];
    $dosage = $_POST['upmedicineDosage'];
    $medstock=$_POST['updatemedicineStocks'];
    $medmfgdate=$_POST['updatemedicineMfgDate'];
    $medexpdate=$_POST['updatemedicineExpDate'];
    $type = "Update";
    $updatesql = "Update `medinventory` set `name`='$name',`category`='$category',`subcategory`='$subcategory',`dosage`='$dosage',`stock`='$medstock', `mfgdate`='$medmfgdate', `expdate`='$medexpdate' where `id`='$id'";
    $result=mysqli_query($con,$updatesql);
    $reportupdatesql = "Insert into `medreport` (`id`,`name`, `category`,`subcategory`,`dosage`, `stock`, `mfgdate`, `expdate`,`type`) values ('$id','$name','$category','$subcategory','$dosage','$medstock','$medmfgdate','$medexpdate','$type')";
    $reportresult = mysqli_query($con,$reportupdatesql);
}
?>

