<?php
// Load the database configuration file
$con = null;
require '../DB_Connect.php';
// Filter the excel data
function filterData(&$str){
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
$type = $_GET['type'];
if(isset($_GET['daily'])){
    $time = '1 day';
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and DATE_FORMAT(`dateadded`,"%Y %M %d") = DATE_FORMAT(NOW(),"%Y %M %d") ';
}
elseif(isset($_GET['weekly'])){
    $time = '1 week';
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and yearweek(`dateadded`) = yearweek(NOW())';
}
elseif(isset($_GET['monthly'])){
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and MONTH(`dateadded`) = MONTH(NOW())';
    //MONTH(`dateadded`) = MONTH(NOW())
    $time = '1 month';
}
elseif(isset($_GET['quarterly'])){
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and QUARTER(`dateadded`) = QUARTER(NOW())';
    $time = '1 quarter';
}
elseif(isset($_GET['annually'])){
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and YEAR(`dateadded`) = YEAR(NOW())';
    //YEAR(`dateadded`) = YEAR(NOW())
    $time = '1 year';
}
elseif(isset($_GET['customdate'])){
    $date = $_GET['customdate'];
    $datearr = explode(',',$date);
    $date1 = $datearr[0];
    $startdate = date("Y-m-d", strtotime($date1));
    $date2 = $datearr[1];
    $enddate = date("Y-m-d", strtotime($date2));
    $sql = 'Select * from `medreport` where `type` = "'.$type.'" and date(dateadded) BETWEEN date("'.$startdate.'") and date("'.$enddate.'")';
}
// Excel file name for download
$fileName = "REPORT_".$type.'_'. date('Y-m-d') . ".xls";
// Column names
$fields = array('ID', 'MEDICINE NAME', 'CATEGORY', 'SUBCATEGORY', 'DOSAGE', 'STOCKS', 'MFGDATE', 'EXPDATE','DATEADDED');
// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";
// Fetch records from database
$excelquery = $sql;
$res = mysqli_query($con,$excelquery);
if(mysqli_num_rows($res)>0){
    // Output each row of the data
    while($row = mysqli_fetch_assoc($res)){
        $lineData = array($row['id'], $row['name'], $row['category'], $row['subcategory'], $row['dosage'], $row['stock'], $row['mfgdate'], $row['expdate'],$row['dateadded'] );
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
}else{
    $excelData .= 'No records found...'. "\n";
}
// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");
// Render excel data
echo $excelData;
exit;