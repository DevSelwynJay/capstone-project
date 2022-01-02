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
$fields = array('PATIENT NAME', 'BIRTHDATE', 'ADDRESS', 'GENDER', 'DATE GIVEN');

// Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database
$excelquery = 'Select * from `medication_record` where `patient_type` = "'.$type.'" and `date_given` > NOW()- interval '.$time.' ';
$res = mysqli_query($con,$excelquery);
if(mysqli_num_rows($res)>0){
    // Output each row of the data
    while($row = mysqli_fetch_assoc($res)){
        $patient_id = $row['patient_id'];
        $date_given = $row['date_given'];
        $patqry = 'Select * from `walk_in_patient` where id = "'.$patient_id.'"';
        $record2 = mysqli_query($con,$patqry);
        while($row3 = mysqli_fetch_assoc($record2)){
            $lname = $row3['last_name'];
            $fname = $row3['first_name'];
            $mname = $row3['middle_name'];
            $pat_name = $fname .' '.$mname.' '.$lname;
            $bday = $row3['birthday'];
            $purok = $row3['purok'];
            $house_no = $row3['house_no'];
            $address = $row3['address'];
            $comaddress = 'Purok '.$purok.' House No.'.$house_no.' '.$address;
            $gender = $row3['gender'];
            $lineData = array($pat_name,$bday,$comaddress,$gender,$date_given);
            array_walk($lineData, 'filterData');
            $excelData .= implode("\t", array_values($lineData)) . "\n";

        }

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