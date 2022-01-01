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
if(isset($_GET['daily'])){
    $time = '1 day';
}
elseif(isset($_GET['weekly'])){
    $time = '1 week';
}
elseif(isset($_GET['monthly'])){
    $time = '1 month';
}
elseif(isset($_GET['quarterly'])){
    $time = '1 quarter';
}
elseif(isset($_GET['annually'])){

    $time = '1 year';
}

$type = $_GET['type'];


// Excel file name for download
$fileName = "REPORT_".$type.'_'. date('Y-m-d') . ".xls";

// Column names
$fields = array('ID', 'MEDICINE NAME', 'CATEGORY', 'SUBCATEGORY', 'DOSAGE', 'STOCKS', 'MFGDATE', 'EXPDATE','DATEADDED');

// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database
$excelquery = 'Select * from `medreport` where `type` = "'.$type.'" and `dateadded` > NOW()- interval '.$time.' ';
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