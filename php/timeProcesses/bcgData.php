<?php
//trial palang wala pa to
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}

$count = $_POST["ctr"];


if($count==1){// *1 signifies week data
    //INFANT
    $bcgArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    //adult
    $number2 = array();
    $results2 = array();
    //senior
    $number3 = array();
    $results3 = array();
    //pwd
    $number4 = array();
    $results4 = array();
    //pregrant
    $number5 = array();
    $results5 = array();

    // ? Infant
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='BCG' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["infdata"]= $number1;

    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='BCG' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["mindata"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='BCG' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["addata"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='BCG' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["sendata"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='BCG' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pwddata"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='BCG' AND date_vaccinated BETWEEN (NOW() - INTERVAL 7 DAY) AND NOW() group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pregdata"] = $number5;

    $json = json_encode($bcgArr);
    echo $json;

} elseif ($count==2) {// *2 signifies that month button is clicked

    //INFANT
    $bcgArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    //adult
    $number2 = array();
    $results2 = array();
    //senior
    $number3 = array();
    $results3 = array();
    //pwd
    $number4 = array();
    $results4 = array();
    //pregrant
    $number5 = array();
    $results5 = array();

    // ? Infant
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='BCG' AND date_vaccinated>now() - interval 1 month group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["infdataMo"]= $number1;

    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='BCG' AND date_vaccinated>now() - interval 1 month group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["mindataMo"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='BCG' AND date_vaccinated>now() - interval 1 month group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["addataMo"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='BCG' AND date_vaccinated>now() - interval 1 month group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["sendataMo"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='BCG' AND date_vaccinated>now() - interval 1 month group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pwddataMo"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='BCG' AND date_vaccinated>now() - interval 1 month group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pregdataMo"] = $number5;

    $json = json_encode($bcgArr);
    echo $json;

}elseif ($count==3) {// *3 signifies that year button is clicked
    //INFANT
    $bcgArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    //adult
    $number2 = array();
    $results2 = array();
    //senior
    $number3 = array();
    $results3 = array();
    //pwd
    $number4 = array();
    $results4 = array();
    //pregrant
    $number5 = array();
    $results5 = array();

    // ? Infant
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='BCG' 
                                          AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW() group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["infdataYr"]= $number1;

    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='BCG' 
                                          AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW() group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["mindataYr"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='BCG' 
                                          AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW() group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["addataYr"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='BCG' 
                                          AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW() group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["sendataYr"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='BCG' 
                                          AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW() group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pwddataYr"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='BCG' AND date_vaccinated BETWEEN (NOW() - INTERVAL 1 YEAR) AND NOW()
                                          group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pregdataYr"] = $number5;

    $json = json_encode($bcgArr);
    echo $json;

}elseif ($count==4) {// *4 signifies that overall button is clicked
    //INFANT
    $bcgArr = array();
    $number1 = array();
    $results1 = array();
    $ctr = 0;$cc=1;
//minor
    $number = array();
    $results = array();
    //adult
    $number2 = array();
    $results2 = array();
    //senior
    $number3 = array();
    $results3 = array();
    //pwd
    $number4 = array();
    $results4 = array();
    //pregrant
    $number5 = array();
    $results5 = array();

    // ? Infant
    while ($cc<8){
        $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' 
                                          AND vaccine_name='BCG' group by patient_id");
        $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["infdataOv"]= $number1;

    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='BCG' 
                                           group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["mindataOv"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='BCG' 
                                           group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["addataOv"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='BCG' 
                                           group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["sendataOv"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='BCG' 
                                           group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pwddataOv"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='BCG' 
                                          group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $bcgArr["pregdataOv"] = $number5;

    $json = json_encode($bcgArr);
    echo $json;
}



?>