<?php
session_start();
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
    $name2 = $_POST['updatemedicineName'];
    $category2 = $_POST['updatemedicineCategory'];
    $subcategory2 = $_POST['updatemedicinesubCategory'];
    $dosage = $_POST['upmedicineDosage'];
    $medstock=$_POST['updatemedicineStocks'];
    $medcritstock=$_POST['updatemedicineCritStocks'];
    $medmfgdate=$_POST['updatemedicineMfgDate'];
    $medexpdate=$_POST['updatemedicineExpDate'];

    $name = ucwords($name2);
    $category = ucwords($category2);
    $subcategory = ucwords($subcategory2);

    $type = "Update";
    $updatesql = "Update `medinventory` set `name`='$name',`category`='$category',`subcategory`='$subcategory',`dosage`='$dosage',`stock`='$medstock', `mfgdate`='$medmfgdate', `expdate`='$medexpdate' where `id`='$id'";
    $result=mysqli_query($con,$updatesql);
    $updatesql2 = "Update `medinventory` set `criticalstock`='$medcritstock' where `name` = '$name' ";
    $result2=mysqli_query($con,$updatesql2);
    $reportupdatesql = "Insert into `medreport` (`id`,`name`, `category`,`subcategory`,`dosage`, `stock`, `mfgdate`, `expdate`,`type`) values ('$id','$name','$category','$subcategory','$dosage','$medstock','$medmfgdate','$medexpdate','$type')";
    $reportresult = mysqli_query($con,$reportupdatesql);
    $admin_id = $_SESSION['active_admin_ID'];
    $admin_action = '1';
    $logsql = "Insert into `inventory_logs`(`admin_id`,`medicine_id`,`admin_action`) values('$admin_id','$id','$admin_action')";
    $logresult = mysqli_query($con,$logsql);
}
?>

