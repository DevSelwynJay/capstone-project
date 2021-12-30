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


    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='Covid' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW()) group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["mindata"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='Covid' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW()) group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["addata"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='Covid' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW()) group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["sendata"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='Covid' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW()) group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pwddata"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='Covid' AND WEEKOFYEAR(date_vaccinated) = WEEKOFYEAR(NOW()) group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pregdata"] = $number5;

    $json = json_encode($covidArr);
    echo $json;

} elseif ($count==2) {// *2 signifies that month button is clicked

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

    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='Covid' AND MONTH(date_vaccinated)=MONTH(now())
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["mindataMo"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='Covid' AND MONTH(date_vaccinated)=MONTH(now())
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["addataMo"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='Covid' AND MONTH(date_vaccinated)=MONTH(now())
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["sendataMo"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='Covid' AND MONTH(date_vaccinated)=MONTH(now())
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pwddataMo"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='Covid' AND MONTH(date_vaccinated)=MONTH(now())
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pregdataMo"] = $number5;

    $json = json_encode($covidArr);
    echo $json;

}elseif ($count==3) {// *3 signifies that year button is clicked

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

    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='Covid' 
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["mindataYr"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='Covid' 
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["addataYr"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='Covid' 
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["sendataYr"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='Covid' 
                                          AND YEAR(date_vaccinated)=YEAR(now()) group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pwddataYr"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='Covid' AND YEAR(date_vaccinated)=YEAR(now())
                                          group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pregdataYr"] = $number5;

    $json = json_encode($covidArr);
    echo $json;

}elseif ($count==4) {// *4 signifies that overall button is clicked

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

    // ? Minor
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='Covid' 
                                           group by patient_id");
        $number[$ctr] = mysqli_num_rows($results[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["mindataOv"] = $number;
    // ? Adult
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results2[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Adult' 
                                          AND vaccine_name='Covid' 
                                           group by patient_id");
        $number2[$ctr] = mysqli_num_rows($results2[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["addataOv"]= $number2;
// ? Senior
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results3[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Senior'
                                            AND vaccine_name='Covid' 
                                           group by patient_id");
        $number3[$ctr] = mysqli_num_rows($results3[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["sendataOv"] = $number3;
// ? PWD
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results4[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='PWD'
                                            AND vaccine_name='Covid' 
                                           group by patient_id");
        $number4[$ctr] = mysqli_num_rows($results4[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pwddataOv"] = $number4;
// ? Pregnant
    $ctr = 0;$cc=1;
    while ($cc<8){
        $results5[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Pregnant'
                                            AND vaccine_name='Covid' 
                                          group by patient_id");
        $number5[$ctr] = mysqli_num_rows($results5[$ctr]);
        $ctr++;$cc++;
    }
    $ctr=0;
    $covidArr["pregdataOv"] = $number5;

    $json = json_encode($covidArr);
    echo $json;
}



?>