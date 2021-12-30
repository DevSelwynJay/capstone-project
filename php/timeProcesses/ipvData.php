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
    $ipvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='IPV' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW()) group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $ipvArr["infdata"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='IPV' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW()) group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $ipvArr["mindata"] = $number;

    $json = json_encode($ipvArr);
    echo $json;

} elseif ($count==2) {// 2 signifies that month button is clicked
    //INFANT
    $ipvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='IPV' AND MONTH(date_vaccinated)=MONTH(now())
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $ipvArr["infdataMo"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='IPV' AND MONTH(date_vaccinated)=MONTH(now())
                                            AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $ipvArr["mindataMo"] = $number;

    $json = json_encode($ipvArr);
    echo $json;

}elseif ($count==3) {// 3 signifies that year button is clicked
    //INFANT
    $ipvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='IPV' AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $ipvArr["infdataYr"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='IPV' AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $ipvArr["mindataYr"] = $number;

    $json = json_encode($ipvArr);
    echo $json;

}elseif ($count==4) {// 4 signifies that overall button is clicked
    //INFANT
    $ipvArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='IPV' group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $ipvArr["infdataOv"]= $number1;

    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='IPV' group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;

    $ipvArr["mindataOv"] = $number;

    $json = json_encode($ipvArr);
    echo $json;
}



?>