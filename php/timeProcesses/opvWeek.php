<?php
//trial palang wala pa to
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

$count = $_POST["ctr"];


if($count==1){
    //INFANT
    $opvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='OPV' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $opvArr["infdata"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='OPV' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $opvArr["mindata"] = $number;

    $json = json_encode($opvArr);
    echo $json;

} elseif ($count==2) {// 2 signifies that month button is clicked
    //INFANT
    $opvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='OPV' AND date_vaccinated>now() - interval 1 month
                                           group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $opvArr["infdataMo"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='OPV' AND date_vaccinated>now() - interval 1 month
                                             group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $opvArr["mindataMo"] = $number;

    $json = json_encode($opvArr);
    echo $json;

}elseif ($count==3) {// 3 signifies that year button is clicked
    //INFANT
    $opvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='OPV' AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW() group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $opvArr["infdataYr"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='OPV' AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW() group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $opvArr["mindataYr"] = $number;

    $json = json_encode($opvArr);
    echo $json;

}elseif ($count==4) {// 4 signifies that overall button is clicked
    //INFANT
    $opvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='OPV' group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $opvArr["infdataOv"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='OPV' group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $opvArr["mindataOv"] = $number;

    $json = json_encode($opvArr);
    echo $json;
}



?>