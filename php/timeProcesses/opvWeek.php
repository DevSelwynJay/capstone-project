<?php
//trial palang wala pa to
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

//INFANT
$opvArr = array();
$number1 = array();
$results1 = array();
$ctr = 0;$cc=1;
while ($cc<8){
    $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='OPV' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW());");
    $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
    $ctr++;$cc++;
}

$ctr=0;

    $opvArr["infdata"]= $number1;
    $ctr = $ctr + 1;



//minor
$childArray = array();
$number = array();
$results = array();
$ctr = 0;$cc=1;
$temp = '';
while ($cc<8){
    $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='OPV' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW());");
    $number[$ctr] = mysqli_num_rows($results[$ctr]);
    $ctr++;$cc++;
}

$ctr=0;

    $opvArr["mindata"] = $number;
    $ctr = $ctr + 1;


$json = json_encode($opvArr);
echo $json;

?>