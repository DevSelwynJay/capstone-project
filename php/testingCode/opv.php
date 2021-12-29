<?php
//trial palang wala pa to
$con=null;
require '../DB_Connect.php';

if(!$con){
    die("Error".mysqli_error($con));
    exit();
}
//$ctr = 0;
//$temp = '';
//SAMPLE ADULT
/*
$dataArray = array();
$result = mysqli_query($con, "SELECT id FROM walk_in_patient WHERE purok='1' AND patient_type='Adult'");
$result1 = mysqli_query($con, "SELECT id FROM walk_in_patient WHERE purok='2' AND patient_type='Adult'");
$result2 = mysqli_query($con, "SELECT id FROM walk_in_patient WHERE purok='3' AND patient_type='Adult'");
$result3 = mysqli_query($con, "SELECT id FROM walk_in_patient WHERE purok='4' AND patient_type='Adult'");
$result4 = mysqli_query($con, "SELECT id FROM walk_in_patient WHERE purok='5' AND patient_type='Adult'");
$result5 = mysqli_query($con, "SELECT id FROM walk_in_patient WHERE purok='6' AND patient_type='Adult'");
$result6 = mysqli_query($con, "SELECT id FROM walk_in_patient WHERE purok='7' AND patient_type='Adult'");
$number[0] = mysqli_num_rows($result);
$number[1] = mysqli_num_rows($result1);
$number[2] = mysqli_num_rows($result2);
$number[3] = mysqli_num_rows($result3);
$number[4] = mysqli_num_rows($result4);
$number[5] = mysqli_num_rows($result5);
$number[6] = mysqli_num_rows($result6);

while ($ctr<7) {
    $dataArray[$ctr] = $number[$ctr];
    $ctr = $ctr + 1;
}
$adultJson = json_encode($dataArray);
*/
/*
    //infant to minor
    $childArray = array();
    $ctr = 0;
    $temp = '';
    $result = mysqli_query($con, "SELECT sum(reccommended_no_of_dosage) FROM vaccination_record WHERE patient_purok='1' AND vaccine_sub_category='Child' group by vaccine_sub_category");
    $result1 = mysqli_query($con, "SELECT sum(reccommended_no_of_dosage) FROM vaccination_record WHERE patient_purok='2' AND vaccine_sub_category='Child' group by vaccine_sub_category");
    $result2 = mysqli_query($con, "SELECT sum(reccommended_no_of_dosage) FROM vaccination_record WHERE patient_purok='3' AND vaccine_sub_category='Child' group by vaccine_sub_category");
    $result3 = mysqli_query($con, "SELECT sum(reccommended_no_of_dosage) FROM vaccination_record WHERE patient_purok='4' AND vaccine_sub_category='Child' group by vaccine_sub_category");
    $result4 = mysqli_query($con, "SELECT sum(reccommended_no_of_dosage) FROM vaccination_record WHERE patient_purok='5' AND vaccine_sub_category='Child' group by vaccine_sub_category");
    $result5 = mysqli_query($con, "SELECT sum(reccommended_no_of_dosage) FROM vaccination_record WHERE patient_purok='6' AND vaccine_sub_category='Child' group by vaccine_sub_category");
    $result6 = mysqli_query($con, "SELECT sum(reccommended_no_of_dosage) FROM vaccination_record WHERE patient_purok='7' AND vaccine_sub_category='Child' group by vaccine_sub_category");

    //checks if theres a result and gets it if there is but if no result show 0
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)) {
            $temp = $temp . $row[0];
            break;
        }
        $number[0] = $temp;
        $temp='';
    }else{
        $number[0] = mysqli_num_rows($result);
    }
    if(mysqli_num_rows($result1)>0){
        while($row = mysqli_fetch_array($result1)) {
            $temp = $temp . $row[0];
            break;
        }
        $number[1] = $temp;
        $temp='';
    }else{
        $number[1] = mysqli_num_rows($result1);
    }
    if(mysqli_num_rows($result2)>0){
        while($row = mysqli_fetch_array($result2)) {
            $temp = $temp . $row[0];
            break;
        }
        $number[2] = $temp;
        $temp='';
    }else{
        $number[2] = mysqli_num_rows($result2);
    }
    if(mysqli_num_rows($result3)>0){
        while($row = mysqli_fetch_array($result3)) {
            $temp = $temp . $row[0];
            break;
        }
        $number[3] = $temp;
        $temp='';
    }else{
        $number[3] = mysqli_num_rows($result3);
    }
    if(mysqli_num_rows($result4)>0){
        while($row = mysqli_fetch_array($result4)) {
            $temp = $temp . $row[0];
            break;
        }
        $number[4] = $temp;
        $temp='';
    }else{
        $number[4] = mysqli_num_rows($result4);
    }
    if(mysqli_num_rows($result5)>0){
        while($row = mysqli_fetch_array($result5)) {
            $temp = $temp . $row[0];
            break;
        }
        $number[5] = $temp;
        $temp='';
    }else{
        $number[5] = mysqli_num_rows($result5);
    }
    if(mysqli_num_rows($result6)>0){
        while($row = mysqli_fetch_array($result6)) {
            $temp = $temp . $row[0];
            break;
        }
        $number[6] = $temp;
        $temp='';
    }else{
        $number[6] = mysqli_num_rows($result6);
    }

    while ($ctr<7) {
        $childArray[$ctr] = $number[$ctr];
        $ctr = $ctr + 1;
    }
    $childJson = json_encode($childArray);
*/
//INFANT
$babyArr = array();
$number1 = array();
$results1 = array();
$ctr = 0;$cc=1;
while ($cc<8){
    $results1[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Infant' AND vaccine_name='OPV' group by patient_id");
    $number1[$ctr] = mysqli_num_rows($results1[$ctr]);
    $ctr++;$cc++;
}
/*
$result = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='1' AND vaccine_sub_category='Child' group by vaccine_sub_category,vaccine_name");
$result1 = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='2' AND vaccine_sub_category='Child' group by vaccine_sub_category,vaccine_name");
$result2 = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='3' AND vaccine_sub_category='Child' group by vaccine_sub_category,vaccine_name");
$result3 = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='4' AND vaccine_sub_category='Child' group by vaccine_sub_category,vaccine_name");
$result4 = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='5' AND vaccine_sub_category='Child' group by vaccine_sub_category,vaccine_name");
$result5 = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='6' AND vaccine_sub_category='Child' group by vaccine_sub_category,vaccine_name");
$result6 = mysqli_query($con, "SELECT vaccine_id FROM vaccination_record WHERE patient_purok='7' AND vaccine_sub_category='Child' group by vaccine_sub_category,vaccine_name");

//checks if theres a result and gets it if there is but if no result show 0
$number[0] = mysqli_num_rows($result);
$number[1] = mysqli_num_rows($result1);
$number[2] = mysqli_num_rows($result2);
$number[3] = mysqli_num_rows($result3);
$number[4] = mysqli_num_rows($result4);
$number[5] = mysqli_num_rows($result5);
$number[6] = mysqli_num_rows($result6);
*/
$ctr=0;
while ($ctr<7) {
    $babyArr[$ctr] = $number1[$ctr];
    $ctr = $ctr + 1;
}
$babyJson= json_encode($babyArr);

//minor
$childArray = array();
$number = array();
$results = array();
$ctr = 0;$cc=1;
$temp = '';
while ($cc<8){
    $results[$ctr] = mysqli_query($con, "SELECT event_id FROM vaccination_record WHERE patient_purok='$cc' AND patient_type='Minor'
                                            AND vaccine_name='OPV'  group by patient_id");
    $number[$ctr] = mysqli_num_rows($results[$ctr]);
    $ctr++;$cc++;
}

$ctr=0;
while ($ctr<7) {
    $childArray[$ctr] = $number[$ctr];
    $ctr = $ctr + 1;
}
$minorJson= json_encode($childArray);



$arr["num2"] = array(65,68,75,81,95,105,130);
$json = json_encode($arr);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--Jquery-->
    <script src="../../js/jquery-3.6.0.js"></script>
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="../../jquery-ui/jquery-ui.css">
    <script src="../../jquery-ui/jquery-ui.js"></script>
    <script src="../../js/track.js"></script>
    <style>
        #opvChart {
            background-color: rgb(204, 209, 243);
        }
        .tab{
            display: flex;

        }
        .timestamp{
            font-size:1rem;
            margin: 0.7rem 0.7rem 0.7rem 0.7rem;
            padding: 0.5rem 1rem 0.5rem 1rem;
            border-radius:4px;
            border:1px solid #656565;
            background-color: rgba(180, 218, 243, 0.82);
        }
        .timestamp:hover{
            background-color: #465A72;
            color: #FFFFFF;
            cursor: pointer;
        }
    </style>

</head>
<body>
<!--period to period button-->
<div class="tab">
    <div id="wk1" class="timestamp">Weekly</div>
    <div id="mo1" class="timestamp" >Monthly</div>
    <div id="yr1" class="timestamp" >Yearly</div>
    <div id="ov1" class="timestamp" >Overall</div>
</div>
<!--this is where the linechart goes-->
<div class="container" style="width: 100%; height: 100%">
    <canvas id="opvChart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>
</div>
<script>
    document.getElementById("ov1").style.color = "#ffffff";
    document.getElementById("ov1").style.backgroundColor = "#363636";
//creation of variable to handle and manipulate the canvas that was made
    var speedCanvas = document.getElementById("opvChart");
    speedCanvas.fillStyle = 'lightGreen';
    Chart.defaults.color = "#ffffff";
    //creating multiple datasets
    var opvinfant = {
        label: "Infant",
        data: <?php  echo $babyJson?>,
        lineTension: 0.1,//curve of line
        fill: false,
        borderWidth: 1,
        borderColor: 'yellow'
    };

    var opvminor = {
        label: "Minor",
        data: <?php echo $minorJson; ?>,
        lineTension: 0.1,
        borderWidth: 1,
        fill: false,
        borderColor: 'lightGreen'
    };
// inputing all needed data into a finalized dataset
    var speedData = {
        labels: ["Purok 1", "Purok 2", "Purok 3", "Purok 4", "Purok 5", "Purok 6", "Purok 7"],
        datasets: [opvinfant,opvminor]
    };

    var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
                boxWidth: 100,
                fontColor: 'white'
            }
        }
    };
// uploading the data to the chart
    var opvlineChart = new Chart(speedCanvas, {
        type: 'line',
        data: speedData,
        options: chartOptions,
        hoverOffset: 3,// delay effect ng hover
        options: {
            //scales signifies the gridlines, x is fo x axis and y is for y axis
            scales: {
                x: {
                    grid:{
                        display:false
                    }
                },
                y: {
                    grid:{
                        color: "gray"
                        //    display:false
                    }
                }
            },
            plugins: {
                title: {
                    font: {
                        size: 18
                    },
                    display: true,
                    text: 'OPV Graph'
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 14,
                            family: 'Helvetica Neue',
                            color: 'black'
                        }
                    }
                }
            }
        }
    });
    //reload with time interval
    //window.setInterval("reloadIFrame();", 30000);
    function reloadIFrame() {
        location.reload();
    }
</script>
</body>
</html>